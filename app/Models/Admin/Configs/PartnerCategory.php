<?php

namespace App\Models\Admin\Configs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PartnerCategory extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'partner_categories';

    protected $fillable = [
        'id',
        'title',
        'slug',
        'color',
        'responsible',
        'see_validity',
        'parent_category',
        'value',
        'active',
        'update_by',
        'created_by'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = mb_strtoupper($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = str_replace(",", ".", $value);
    }

    public function getValueAttribute($value)
    {
        return str_replace(".", ",", $value);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }
}
