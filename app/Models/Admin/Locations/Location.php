<?php

namespace App\Models\Admin\Locations;

use App\Models\Admin\Ambiences\Ambience;
use App\Models\Admin\Configs\ReasonEvent;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Location extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'locations';

    protected $fillable = [
        'ambience', 'ambience_id', 'partner', 'partner_id', 'ambience_tenant', 'ambience_tenant_id',
        'location_date', 'location_hour_start', 'location_hour_end', 'event_type', 'event_benefited',
        'value', 'deposit', 'lighting', 'dressing_room', 'security', 'janitor', 'indication_id',
        'reason_event_id', 'value_extra', 'loc_time', 'updated_because', 'deleted_at',
        'deleted_because', 'deleted_by', 'updated_by', 'created_by','active'
    ];

    public function setLocationDateAttribute($value)
    {
        if ($value != "") {
            $this->attributes['location_date'] = implode("-", array_reverse(explode("/", $value)));
        } else {
            $this->attributes['location_date'] = NULL;
        }
    }
    public function getLocationDateAttribute($value)
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
    public function getValueAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
    public function setDepositAttribute($value)
    {

        $this->attributes['deposit'] = $this->convert_value($value);
    }
    public function getDepositAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
    public function setValueExtraAttribute($value)
    {
        if ($value) {
            $this->attributes['value_extra'] = $this->convert_value($value);
        }
    }
    public function getValueExtraAttribute($value)
    {
        if ($value) {
            return number_format($value, 2, ',', '.');
        }
    }

    public function getPaidAttribute()
    {
        $paids = $this->installments->where('active',1);
        if($paids){
            $p=0;
            foreach ($paids as $item) {
                $p+=$item->value_db;
            }
            return number_format($p, 2, ',', '.');
        }else{
            return 0;
        }
    }

    public function getRemainingAttribute()
    {
        $paids = $this->installments->where('active',1);
        if($paids){
            $remaing = $this->value_db - $this->convert_value($this->paid);
            return number_format($remaing, 2, ',', '.');
        }else{
            return $this->value;
        }
    }

    public function partners()
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }
    public function installments()
    {
        return $this->hasMany(Installment::class,  'location_id','id');
    }
    public function indication()
    {
        return $this->belongsTo(Partner::class, 'indication_id', 'id');
    }
    public function reason()
    {
        return $this->belongsTo(ReasonEvent::class, 'reason_event_id', 'id');
    }
    public function ambiences()
    {
        return $this->belongsTo(Ambience::class,  'ambience_id','id');
    }
    public function getCashbackAttribute()
    {
        if($this->indication_id && $this->ambiences->cashback != '' && $this->value_db > 0)
        {
            $cash = $this->ambiences->cashback/100;
            $cashback =  $this->value_db * $cash;
            // $cashback = $this->ambiences->cashback;
        }else{
            $cashback = 0;
        }

        return $cashback;
    }
    public function ambienceTenants()
    {
        return $this->belongsTo(AmbienceTenant::class, 'ambience_tenant_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }

    public function scopeFilterFields($query, $filters)
    {
        foreach ($filters as $key => $value) {

            if ($key == 'location_date') {

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
