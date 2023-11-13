<?php

namespace App\Models\Admin\Configs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AmbienceTenant extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'ambience_tenants';

    protected $fillable = [
        'id', 'title', 'slug', 'type', 'obs', 'active', 'update_by', 'created_by'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title']=mb_strtoupper($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }

    public function getConvertTypeAttribute()
    {
        switch ($this->type) {
            case '1':
                return 'Sócio';
                break;
            case '2':
                return 'Não sócio';
                break;

            default:
                return '';
                break;
        }
    }

    public function scopeFilterFields($query, $filters)
    {
        foreach ($filters as $key => $value) {
            $converted = $value;
            if ($key == 'searchType') {
                // Ajuste por correspondência aproximada
                if (stripos('Sócio', $value) !== false) {
                    $converted = 1;
                } elseif (stripos('Não sócio', $value) !== false) {
                    $converted = 2;
                }
            }
            // if ($key == 'searchType') {
            //     switch ($value) {
            //         case 'Sócio':
            //             $converted = 1;
            //             break;
            //         case 'Não sócio':
            //             $converted = 2;
            //             break;
            //     }
            // }
            return array('f'=>'LIKE','converted'=>'%' . $converted . '%');
        }
    }
}
