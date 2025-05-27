<?php

namespace App\Models\Admin\Locations;

use App\Models\Admin\Financial\Received;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Installment extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'installments';

    protected $fillable = [
        'title',
        'active',
        'value',
        'form_payment',
        'installment_maturity_date',
        'received_id',
        'location_id',
        'updated_because',
        'deleted_at',
        'deleted_because',
        'deleted_by',
        'updated_by',
        'created_by'
    ];

    public function setInstallmentMaturityDateAttribute($value)
    {
        if ($value != "") {
            $this->attributes['installment_maturity_date'] = implode("-", array_reverse(explode("/", $value)));
        } else {
            $this->attributes['installment_maturity_date'] = NULL;
        }
    }
    public function getInstallmentMaturityDateAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
                ->format('d/m/Y');
        }
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $this->convert_value($value);
    }
    public function getPaymentAttribute($value)
    {
        switch ($value) {
            case "DIN":
                $payment = 'DINHEIRO';
                break;
            case "BOL":
                $payment = 'BOLETO';
                break;
            case "PIX":
                $payment = 'PIX CAIXA';
                break;
            case "PIXM":
                $payment = 'PIX MAQUINA';
                break;
            case "BOL":
                $payment = 'BOLETO';
                break;
            case "CAR":
                $payment = 'CARTÃO';
                break;
            default:
                $payment =    'DINHEIRO';
                break;
        }
        return $payment;
    }

    public function getValueAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }
    public function received()
    {
        return $this->belongsTo(Received::class, 'received_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }

    public function convert_value($value)
    {
        str_replace(' ', '', $value);
        ltrim($value);
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        return str_replace(' ', '', $value);
    }

    public function getValueDbAttribute()
    {
        $value = $this->value;
        str_replace(' ', '', $value);
        ltrim($value);
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        return str_replace(' ', '', $value);
    }
    public function scopeFilterFields($query, $filters)
    {
        foreach ($filters as $key => $value) {

            if ($key == 'installment_maturity_date') {

                if (substr_count($value, " ") === 1) {
                    $partesSpace = explode(" ", $value);
                    if (substr_count($partesSpace[0], "/") === 1) {
                        $partes = explode("/", $partesSpace[0]);
                        $converted = $partes[1] . "%-" . $partes[0] . "% " . $partesSpace[1];
                    } elseif (substr_count($partesSpace[0], "/") === 2) {
                        $partes = explode("/", $partesSpace[0]);
                        $converted = $partes[2] . "%-" . $partes[1] . "-" . $partes[0] . "% " . $partesSpace[1];
                    } else {
                        $converted = $value;
                    }
                } else {
                    if (substr_count($value, "/") === 1) {
                        $partes = explode("/", $value);
                        $converted = $partes[1] . "%-" . $partes[0];
                    } elseif (substr_count($value, "/") === 2) {
                        $partes = explode("/", $value);
                        $converted = $partes[2] . "%-" . $partes[1] . "-" . $partes[0];
                    } else {
                        $converted = $value;
                    }
                }
                return array('f' => 'LIKE', 'converted' => '%' . $converted . '%');
            }
        }
    }
}
