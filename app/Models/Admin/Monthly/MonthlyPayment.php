<?php

namespace App\Models\Admin\Monthly;

use App\Models\Admin\Financial\Received;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class MonthlyPayment extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'monthly_payments';

    protected $fillable = [
        'title','paid_in','partner_id','start_suspension','end_suspension',
        'status','ref','value', 'received_id',
        'received','form_payment','updated_by','created_by',
    ];
    public static function monthlyExists($ref,$partner_id)
    {
        return static::where('ref', $ref)->where('partner_id', $partner_id)->exists();
    }
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = mb_strtoupper($value);
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

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }

    public function receiveds()
    {
        return $this->belongsTo(Received::class,  'received_id', 'id');
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
    public function getMonthlyRefAttribute()
    {
        $today = Carbon::parse($this->ref)->locale('pt-BR');
        return mb_strtoupper($today->translatedFormat('F Y'));
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }

    public function convert_value($value)
    {
        str_replace(' ', '', $value);
        ltrim($value);
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        return str_replace(' ', '', $value);
    }
}
