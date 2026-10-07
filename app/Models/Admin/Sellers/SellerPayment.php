<?php

namespace App\Models\Admin\Sellers;

use App\Enums\Payments\PaymentStatus;
use App\Models\Admin\Financial\Bill;
use App\Models\Admin\Registers\Partner;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerPayment extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'seller_payments';

    protected $fillable = [
        'seller_id',
        'date',
        'value',
        'form_payment',
        'observation',
        'bill_id',
        'created_by',
    ];

    protected $casts = [
        'date' => 'date',
        'value' => 'decimal:2',
    ];

    protected function casts(): array
    {
        return [
            'status' => PaymentStatus::class,
        ];
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Partner::class, 'seller_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(SellerPaymentItem::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function bills()
    {
        return $this->belongsTo(Bill::class,  'bill_id', 'id');
    }
}
