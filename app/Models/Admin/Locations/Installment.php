<?php

namespace App\Models\Admin\Locations;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Installment extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'installments';

    protected $fillable = [
        'title','active','value','form_payment','installment_maturity_date','received_id',
        'location_id', 'updated_because','deleted_at', 'deleted_because','deleted_by',
        'updated_by','created_by'
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
            case "DIN": $payment = 'DINHEIRO';   break;
            case "PIX": $payment = 'PIX';   break;
            case "BOL": $payment = 'BOLETO';   break;
            case "CAR": $payment = 'CARTÃO';   break;
            default: $payment =    'DINHEIRO';   break;
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

}
