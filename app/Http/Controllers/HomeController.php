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
        $featuredProducts = Cache::remember('home_featured_products', 1800, function () {
            $products = Product::with(['category', 'images'])
                ->where('is_active', true)
                ->where('is_featured', true)
                ->take(6)
                ->get();

            if ($products->count() < 5) {
                $extra = Product::with(['category', 'images'])
                    ->where('is_active', true)
                    ->whereNotIn('id', $products->pluck('id'))
                    ->take(5 - $products->count())
                    ->get();
                $products = $products->concat($extra);
            }

            return $products;
        });

        $originalProduct = $featuredProducts->firstWhere('slug', 'biltong-original-100g') 
            ?? $featuredProducts->first();

        $categories = Category::getActiveCategories();

        return view('pages.home', compact('featuredProducts', 'originalProduct', 'categories'));
    }
}
