<?php

namespace App\Models\Admin\Pool;

use App\Models\Admin\Financial\Received;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SeasonPay extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'season_pays';

    protected $fillable = [
        'title',
        'active',
        'paid_in',
        'value',
        'form_payment',
        'partner_id',
        'type',
        'bracelets',
        'updated_because',
        'deleted_at',
        'deleted_because',
        'deleted_by',
        'updated_by',
        'created_by',
        'received_id',
        'season_id',
    ];
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = mb_strtoupper($value);
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $this->convert_value($value);
    }
    public function getValueAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setPaidInAttribute($value)
    {
        if ($value != "") {
            $this->attributes['paid_in'] = implode("-", array_reverse(explode("/", $value)));
        } else {
            $this->attributes['paid_in'] = NULL;
        }
    }
    public function getPaidInAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
                ->format('d/m/Y');
        }
    }

    public function setBraceletsAttribute($value)
    {
        $this->attributes['bracelets'] = json_encode($value);
    }

    public function getJsonBraceletsAttribute()
    {
        return json_decode($this->bracelets);
    }

    public function partners()
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }
    public function season()
    {
        return $this->belongsTo(Season::class,  'season_id', 'id');
    }
    public function received()
    {
        return $this->belongsTo(Received::class,  'received_id', 'id');
    }

    public function getDeletedAtInAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
                ->format('d/m/Y');
        }
    }


    public function getPaymentAttribute()
    {
        switch ($this->form_payment) {
            case 'BOL':
                return 'BOLETO';
                break;
            case 'PIX':
                return 'PIX';
                break;
            case 'CAR':
                return 'CARTÃO';
                break;
            case 'DIN':
                return 'DINHEIRO';
                break;
        }
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
    public function scopeFilterFields($query, $filters)
    {
        foreach ($filters as $key => $value) {

            if ($key == 'paid_in') {

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
