<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'delivery_city',
        'delivery_area',
        'delivery_address',
        'delivery_method',
        'delivery_fee',
        'subtotal',
        'coupon_code',
        'discount_amount',
        'total',
        'payment_method',
        'payment_status',
        'payment_reference',
        'order_status',
        'notes',
        'ordered_via_whatsapp',
    ];

    protected function casts(): array
    {
        return [
            'delivery_fee' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'total' => 'decimal:2',
            'ordered_via_whatsapp' => 'boolean',
        ];
    }

    public const STATUS_PENDING = 'Pending';
    public const STATUS_AWAITING_PAYMENT = 'Awaiting Payment';
    public const STATUS_PAID = 'Paid';
    public const STATUS_PROCESSING = 'Processing';
    public const STATUS_READY_FOR_DELIVERY = 'Ready for Delivery';
    public const STATUS_SHIPPED = 'Shipped';
    public const STATUS_DELIVERED = 'Delivered';
    public const STATUS_CANCELLED = 'Cancelled';

    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_AWAITING_PAYMENT,
            self::STATUS_PAID,
            self::STATUS_PROCESSING,
            self::STATUS_READY_FOR_DELIVERY,
            self::STATUS_SHIPPED,
            self::STATUS_DELIVERED,
            self::STATUS_CANCELLED,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function delivery(): HasOne
    {
        return $this->hasOne(Delivery::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Tshs ' . number_format($this->total, 0);
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Tshs ' . number_format($this->subtotal, 0);
    }

    public function getFormattedDeliveryFeeAttribute(): string
    {
        return $this->delivery_fee > 0 ? 'Tshs ' . number_format($this->delivery_fee, 0) : 'FREE';
    }

    public function getFormattedDiscountAttribute(): string
    {
        return 'Tshs ' . number_format($this->discount_amount, 0);
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->order_status) {
            self::STATUS_PAID, self::STATUS_DELIVERED => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            self::STATUS_PROCESSING, self::STATUS_READY_FOR_DELIVERY, self::STATUS_SHIPPED => 'bg-amber-100 text-amber-800 border-amber-300',
            self::STATUS_CANCELLED => 'bg-red-100 text-red-800 border-red-300',
            default => 'bg-stone-100 text-stone-800 border-stone-300',
        };
    }
}
