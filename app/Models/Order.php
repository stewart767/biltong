<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'delivery_city',
        'delivery_area',
        'delivery_address',
        'delivery_method',
        'delivery_fee',
        'subtotal',
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
            'total' => 'decimal:2',
            'ordered_via_whatsapp' => 'boolean',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'TZS ' . number_format($this->total, 0);
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->order_status) {
            'pending' => 'bg-amber-100 text-amber-800 border-amber-300',
            'confirmed' => 'bg-blue-100 text-blue-800 border-blue-300',
            'processing' => 'bg-purple-100 text-purple-800 border-purple-300',
            'dispatched' => 'bg-indigo-100 text-indigo-800 border-indigo-300',
            'delivered' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'cancelled' => 'bg-red-100 text-red-800 border-red-300',
            default => 'bg-zinc-100 text-zinc-800 border-zinc-300',
        };
    }

    public function getWhatsAppUrlAttribute(): string
    {
        $phone = '255682869629';
        $text = "Hello INAS Biltong! I would like to confirm my order #{$this->order_number}.\n\n"
            . "Customer: {$this->customer_name}\n"
            . "Phone: {$this->customer_phone}\n"
            . "Delivery Area: {$this->delivery_area}, {$this->delivery_city}\n"
            . "Total: TZS " . number_format($this->total, 0) . "\n"
            . "Payment: " . strtoupper($this->payment_method) . "\n\n"
            . "Items:\n";

        foreach ($this->items as $item) {
            $text .= "- {$item->product_name} ({$item->pack_size}) x {$item->quantity} = TZS " . number_format($item->subtotal, 0) . "\n";
        }

        return "https://wa.me/{$phone}?text=" . urlencode($text);
    }
}
