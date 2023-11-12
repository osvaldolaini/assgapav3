<?php

namespace App\Models\Admin\Ambiences;

use App\Models\Admin\Configs\AmbienceCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Ambience extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'ambiences';

    protected $fillable = [
        'id','title','slug','capacity','cashback','time_week','time_weekend','obs',
        'contract','term','term_return','multiple','need','ambience_category',
        'update_by','created_by','active'
    ];
    public function setTitleAttribute($value)
    {
        $this->attributes['title']=strtoupper($value);
        $this->attributes['slug']=Str::slug($value);
    }
    public function category():BelongsTo
    {
        return $this->belongsTo(AmbienceCategory::class,'ambience_category','id');
    }
    public function pivots():HasMany
    {
        return $this->hasMany(AmbienceTenantPivot::class,'ambience_id','id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }
}
