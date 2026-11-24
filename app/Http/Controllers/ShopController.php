<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $categorySlug = $request->get('category');
        $query = Product::with(['category', 'images'])->where('is_active', true);

        if ($categorySlug && $categorySlug !== 'all') {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('ingredients', 'like', "%{$search}%");
            });
        }

        $products = $query->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc')->get();
        $categories = Category::withCount(['products' => function ($q) {
            $q->where('is_active', true);
        }])->where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.shop', compact('products', 'categories'));
    }

    public function show(string $slug): View
    {
        $product = Product::with(['category', 'images'])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->take(3)
            ->get();

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::where('is_active', true)
                ->where('id', '!=', $product->id)
                ->take(3)
                ->get();
        }

        return view('pages.product-show', compact('product', 'relatedProducts'));
    }
}
