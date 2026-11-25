<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public static function getActiveCategories()
    {
        try {
            return Cache::remember('active_categories_list', 3600, function () {
                return static::where('is_active', true)->orderBy('sort_order')->get();
            });
        } catch (\Throwable $e) {
            return static::where('is_active', true)->orderBy('sort_order')->get();
        }
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            if (str_starts_with($this->image, 'http') || str_starts_with($this->image, '/')) {
                return $this->image;
            }
            return asset($this->image);
        }

        $map = [
            'traditional-biltong' => 'images/bbq-biltong.jpg',
            'spiced-chilli-biltong' => 'images/chilli-biltong.jpg',
            'chilli-bites' => 'images/chilli-biltong.jpg',
            'droewors-dried-sausage' => 'images/droewors.jpg',
            'droewors' => 'images/droewors.jpg',
            'carvers-slab' => 'images/carvers-slab.jpg',
            'wholesale-bundles' => 'images/wholesale-box.jpg',
            'wholesale' => 'images/wholesale-box.jpg',
        ];

        return asset($map[$this->slug] ?? 'images/bbq-biltong.jpg');
    }
}
