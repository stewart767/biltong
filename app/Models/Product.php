<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'pack_size',
        'price',
        'promo_price',
        'short_description',
        'description',
        'weight_options',
        'stock',
        'is_featured',
        'is_active',
        'ingredients',
        'nutritional_info',
        'storage_instructions',
        'certifications',
        'badges',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'promo_price' => 'decimal:2',
            'weight_options' => 'array',
            'nutritional_info' => 'array',
            'certifications' => 'array',
            'badges' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'stock' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function inventoryLogs(): HasMany
    {
        return $this->hasMany(Inventory::class)->latest();
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->ofMany([
            'is_primary' => 'max',
            'sort_order' => 'min',
        ]);
    }

    public function getEffectivePriceAttribute(): float
    {
        if ($this->promo_price && $this->promo_price > 0 && $this->promo_price < $this->price) {
            return (float) $this->promo_price;
        }

        return (float) $this->price;
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Tshs ' . number_format($this->effective_price, 0);
    }

    public function getFormattedRegularPriceAttribute(): string
    {
        return 'Tshs ' . number_format($this->price, 0);
    }

    public function getIsOnSaleAttribute(): bool
    {
        return (bool) ($this->promo_price && $this->promo_price > 0 && $this->promo_price < $this->price);
    }

    public function getDiscountPercentageAttribute(): ?int
    {
        if (!$this->is_on_sale || $this->price <= 0) {
            return null;
        }

        return (int) round((($this->price - $this->promo_price) / $this->price) * 100);
    }

    public function getImageUrlAttribute(): string
    {
        $primary = $this->images->firstWhere('is_primary', true) ?? $this->images->first();

        if ($primary && $primary->image_path) {
            $path = $primary->image_path;
            if (str_starts_with($path, 'http')) {
                return $path;
            }
            if (str_starts_with($path, 'images/')) {
                return asset($path);
            }
            return asset('storage/' . $path);
        }

        return asset('images/biltong-original-1.jpg');
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }
}
