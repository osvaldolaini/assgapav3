<?php

namespace App\Models\Admin\Configs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CostCenter extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'cost_centers';

    protected $fillable = [
        'id','title','slug','color','category','active','update_by','created_by'
    ];

    public function setCategoryAttribute($value)
    {
        $this->attributes['category']=mb_strtoupper($value);
    }
    public function setTitleAttribute($value)
    {
        $this->attributes['title']=mb_strtoupper($value);
        $this->attributes['slug']=Str::slug($value);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }
}
