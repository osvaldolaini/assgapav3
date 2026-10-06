<?php

namespace App\Models\Admin\Sellers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerPaymentItem extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'seller_payment_items';

    protected $fillable = [
        'seller_payment_id',
        'item_type',
        'item_id',
        'value',
    ];

    protected $casts = [
        'value' => 'decimal:2',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(SellerPayment::class, 'seller_payment_id');
    }

    public function item(): MorphTo
    {
        return $this->morphTo();
    }
}
