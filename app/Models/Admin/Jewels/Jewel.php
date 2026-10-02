<?php

namespace App\Models\Admin\Jewels;

use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Jewel extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'jewels';
    protected $fillable = [
        'title',
        'paid_in',
        'partner_id',
        'start_suspension',
        'end_suspension',
        'status',
        'received_id',
        'received',
        'form_payment',
        'partner',
        'partner_id',
        'value',
        'indication_id',
        'obs',
        'updated_because',
        'deleted_at',
        'deleted_because',
        'deleted_by',
        'updated_by',
        'created_by',
        'active'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
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
            $this->attributes['paid_in'] = implode("-", array_reverse(explode("/", $value)));
        } else {
            $this->attributes['paid_in'] = NULL;
        }
    }
    public function getPaidInAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
                ->format('d/m/Y');
        }
    }
    public function convert_value($value)
    {
        str_replace(' ', '', $value);
        ltrim($value);
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        return str_replace(' ', '', $value);
    }
    public function getValueDbAttribute()
    {
        $value = $this->value;
        str_replace(' ', '', $value);
        ltrim($value);
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        return str_replace(' ', '', $value);
    }
    public function getPaymentAttribute()
    {
        switch ($this->form_payment) {
            case 'BOL':
                return 'BOLETO';
                break;
            case 'PIX':
                return 'PIX';
                break;
            case 'CAR':
                return 'CARTÃO';
                break;
            case 'DIN':
                return 'DINHEIRO';
                break;
        }
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }
    public function indication(): HasMany
    {
        return $this->hasMany(Partner::class, 'indication_id', 'id');
    }
}
