<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->hasMany(ProductImage::class)->orderBy('is_primary', 'desc')->orderBy('sort_order', 'asc');
    }

    public function primaryImage()
    {
        return $this->images()->where('is_primary', true)->first() ?? $this->images()->first();
    }

    public function getImageUrlAttribute(): string
    {
        $primary = $this->primaryImage();
        if ($primary && $primary->image_path) {
            if (str_starts_with($primary->image_path, 'http') || str_starts_with($primary->image_path, '/')) {
                return $primary->image_path;
            }
            return asset($primary->image_path);
        }
        return asset('images/biltong-original-main.jpg');
    }

    public function getEffectivePriceAttribute(): float
    {
        return (float) ($this->promo_price && $this->promo_price > 0 ? $this->promo_price : $this->price);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'TZS ' . number_format($this->effective_price, 0);
    }

    public function getFormattedOriginalPriceAttribute(): ?string
    {
        if ($this->promo_price && $this->promo_price < $this->price) {
            return 'TZS ' . number_format($this->price, 0);
        }
        return null;
    }
}
