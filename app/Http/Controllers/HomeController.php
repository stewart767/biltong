<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::with(['category', 'images'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->take(6)
            ->get();

        if ($featuredProducts->count() < 5) {
            $extra = Product::with(['category', 'images'])
                ->where('is_active', true)
                ->whereNotIn('id', $featuredProducts->pluck('id'))
                ->take(5 - $featuredProducts->count())
                ->get();
            $featuredProducts = $featuredProducts->concat($extra);
        }

        $originalProduct = $featuredProducts->firstWhere('slug', 'biltong-original-100g')
            ?? $featuredProducts->first();

        $categories = Category::getActiveCategories();

        return view('pages.home', compact('featuredProducts', 'originalProduct', 'categories'));
    }
}
