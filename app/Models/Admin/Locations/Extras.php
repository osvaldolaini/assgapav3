<?php

namespace App\Models\Admin\Locations;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Extras extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'location_extras';

    protected $fillable = [
        'location_id','dressing_room','lighting','janitor','security','inflatable',
        'brigade','qtd_dressing_room','qtd_lighting','qtd_janitor', 'qtd_security',
        'qtd_inflatable','qtd_brigade','form_payment','date_payment','active'
    ];

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

    public function setDatePaymentAttribute($value)
    {
        if ($value != "") {
            $this->attributes['date_payment'] = implode("-", array_reverse(explode("/", $value)));
        } else {
            $this->attributes['date_payment'] = NULL;
        }
    }
    public function getDatePaymentAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
                ->format('d/m/Y');
        }
    }

    public function setBrigadeAttribute($value)
    {
        $this->attributes['brigade'] = $this->convert_value($value);
    }

    public function getBrigadeAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setInflatableAttribute($value)
    {
        $this->attributes['inflatable'] = $this->convert_value($value);
    }

    public function getInflatableAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setSecurityAttribute($value)
    {
        $this->attributes['security'] = $this->convert_value($value);
    }

    public function getSecurityAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
    public function setJanitorAttribute($value)
    {
        $this->attributes['janitor'] = $this->convert_value($value);
    }

    public function getJanitorAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setLightingAttribute($value)
    {
        $this->attributes['lighting'] = $this->convert_value($value);
    }

    public function getLightingAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
    public function setDressingRoomAttribute($value)
    {
        $this->attributes['dressing_room'] = $this->convert_value($value);
    }

    public function getDressingRoomAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
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
}

