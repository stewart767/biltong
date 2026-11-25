<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            if (str_starts_with($this->image, 'http') || str_starts_with($this->image, '/')) {
                return $this->image;
            }
            return asset($this->image);
        }

        $map = [
            'traditional-biltong' => 'images/biltong-original-1.jpg',
            'chilli-bites' => 'images/chilli-biltong.jpg',
            'droewors' => 'images/droewors.jpg',
            'carvers-slab' => 'images/carvers-slab.jpg',
            'wholesale' => 'images/wholesale-box.jpg',
        ];

        return asset($map[$this->slug] ?? 'images/biltong-original-1.jpg');
    }
}
