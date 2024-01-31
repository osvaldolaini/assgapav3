<?php

namespace App\Models\Admin\Pool;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Pool extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'pools';

    protected $fillable = [
        'table','register_id','client','partner','created_at'
    ];

    public function getCreatedAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d H:i:s', $value)
                ->format('d/m/Y H:i:s');
        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }

}
