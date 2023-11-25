<?php

namespace App\Models\Admin\Ambiences;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AmbienceTenantPivot extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'ambience_ambience_tenant_pivot';

    protected $fillable = [
        'id','ambience_id','ambienceTenant_id','value','deposit'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = str_replace(",", ".", $value);
    }

    public function getValueAttribute($value)
    {
        return number_format($value,2,',','.');
    }
    public function setDepositAttribute($value)
    {
        $this->attributes['deposit'] = str_replace(",", ".", $value);
    }

    public function getDepositAttribute($value)
    {
        return number_format($value,2,',','.');
    }
}
