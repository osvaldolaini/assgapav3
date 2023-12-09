<?php

namespace App\Models\Admin\Financial;

use App\Models\Admin\Configs\CostCenter;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Bill extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'bills';

    protected $fillable = [
        'title','active','creditor','creditor_document','paid_in','value','cost_center_id','type',
        'updated_because','deleted_at','deleted_because','deleted_by','updated_by','creditor_id',
        'created_by'
    ];
    public function setCreditorAttribute($value)
    {
        $this->attributes['creditor']=mb_strtoupper($value);
    }
    public function setTitleAttribute($value)
    {
        $this->attributes['title']=mb_strtoupper($value);
    }

    public function cost_center():BelongsTo
    {
        return $this->belongsTo(CostCenter::class,'cost_center_id','id');
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
            $this->attributes['paid_in']=implode("-",array_reverse(explode("/",$value)));
        }else{
            $this->attributes['paid_in']=NULL;
        }
    }
    public function getPaidInAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
            ->format('d/m/Y');
        }
    }

    public function getDeletedAtInAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
            ->format('d/m/Y');
        }
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'creditor_id', 'id');
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

            if ($key == 'type') {
                $converted = $value;
                // Ajuste por correspondência aproximada
                if (stripos('Despesa', $value) !== false) {
                    $converted = 2;
                } elseif (stripos('despesa', $value) !== false) {
                    $converted = 2;
                }elseif (stripos('Receira', $value) !== false) {
                    $converted = 1;
                }elseif (stripos('Receira', $value) !== false) {
                    $converted = 1;
                }

                return array('f'=>'LIKE','converted'=>'%' . $converted . '%');
            }

        }
    }
}
