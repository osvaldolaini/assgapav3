<?php

namespace App\Models\Admin\Marketing;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Email extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'emails';

    protected $fillable = [
        'id', 'title', 'slug', 'text', 'active', 'send_by', 'send_at', 'send_quantity', 'update_by', 'created_by'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = mb_strtoupper($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }
    /*Setar a e pegar datas */
    public function setSendAtAttribute($value)
    {
        if ($value != "") {
            $this->attributes['send_at'] = implode("-", array_reverse(explode("/", $value)));
        } else {
            $this->attributes['send_at'] = NULL;
        }
    }
    public function getSendAtAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
                ->format('d/m/Y');
        }
    }
    public function scopeFilterFields($query, $filters)
    {
        foreach ($filters as $key => $value) {

            if ($key == 'send_at') {

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
