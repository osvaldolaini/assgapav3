<?php

namespace App\Models\Admin\Ambiences;

use App\Models\Admin\Configs\AmbienceCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AmbienceUnavailability extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'unavailabilities';

    protected $fillable = [
        'id',
        'ambience_id',
        'type',
        'start',
        'end',
        'title',
        'updated_because',
        'deleted_at',
        'deleted_because',
        'deleted_by',
        'updated_by',
        'created_by',
        'active',
        'validity'
    ];
    // protected $casts = [
    //     'start' => 'datetime:Y-m-d H:i:s',
    //     'end' => 'datetime:Y-m-d H:i:s',
    // ];
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = mb_strtoupper($value);
    }
    public function getValidityAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)
            ->format('d/m/Y');
    }
    public function setValidityAttribute($value)
    {
        $this->attributes['validity'] = implode("-", array_reverse(explode("/", $value)));
    }

    public function getStartAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)
            ->format('d/m/Y');
    }
    public function setStartAttribute($value)
    {
        $this->attributes['start'] = implode("-", array_reverse(explode("/", $value))) . ' 00:00:00';
    }
    public function getEndAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)
            ->format('d/m/Y');
    }
    public function setEndAttribute($value)
    {
        $this->attributes['end'] = implode("-", array_reverse(explode("/", $value))) . ' 00:00:00';
    }

    public function ambience(): BelongsTo
    {
        return $this->belongsTo(Ambience::class, 'ambience_id', 'id');
    }

    public function getTypeListAttribute($value)
    {
        switch ($this->type) {
            case 0:
                $type = 'Pré reserva';
                break;
            case 1:
                $type = 'Indisponibilidade';
                break;

            default:
                $type = 'Indisponibilidade';
                break;
        }
        return $type;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }
}
