<?php

namespace App\Models\Admin\Configs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ReasonEvent extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'reason_events';

    protected $fillable = [
        'id','title','active','update_by','created_by'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title']=strtoupper($value);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }
}
