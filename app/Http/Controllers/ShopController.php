<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $categorySlug = $request->get('category');
        $sort = $request->get('sort', 'featured');

        $query = Product::with(['category', 'images', 'variants'])->where('is_active', true);

        if ($categorySlug && $categorySlug !== 'all') {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ingredients', 'like', "%{$search}%");
            });
        }

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'featured':
            default:
                $query->orderByRaw("CASE 
                    WHEN category_id IN (SELECT id FROM categories WHERE slug IN ('gourmet-burgers', 'hot-deals-combos', 'crispy-chicken', 'sides-fries')) THEN 0 
                    ELSE 1 
                END")->orderBy('id', 'asc');
                break;
        }

        $products = $query->paginate(24)->withQueryString();

        $featuredProducts = Product::with(['category', 'images', 'variants'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->take(8)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::with(['category', 'images', 'variants'])
                ->where('is_active', true)
                ->take(4)
                ->get();
        }

        $categories = Category::withCount(['products' => function ($q) {
            $q->where('is_active', true);
        }])->where('is_active', true)->orderBy('sort_order')->get();

        $currentCategory = $categorySlug && $categorySlug !== 'all' 
            ? Category::where('slug', $categorySlug)->first() 
            : null;

        return view(view()->exists('pages.menu') ? 'pages.menu' : 'pages.shop', compact('products', 'categories', 'currentCategory', 'sort', 'featuredProducts'));
    }

    public function menu(Request $request): View
    {
        return $this->index($request);
    }

    public function show(string $slug): View
    {
        $product = Product::with(['category', 'images', 'variants'])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with(['category', 'images'])
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->take(4)
            ->get();

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::with(['category', 'images'])
                ->where('is_active', true)
                ->where('id', '!=', $product->id)
                ->take(4)
                ->get();
        }

        return view('pages.product-show', compact('product', 'relatedProducts'));
    }

    public function quickView(int $id): JsonResponse
    {
        $product = Product::with(['category', 'images', 'variants'])->findOrFail($id);

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'category' => $product->category?->name,
            'price' => $product->price,
            'promo_price' => $product->promo_price,
            'formatted_price' => $product->formatted_price,
            'formatted_regular_price' => $product->formatted_regular_price,
            'is_on_sale' => $product->is_on_sale,
            'image' => $product->image_url,
            'images' => $product->images->pluck('image_path')->map(fn ($p) => str_starts_with($p, 'http') ? $p : asset($p)),
            'short_description' => $product->short_description,
            'pack_size' => $product->pack_size,
            'stock' => $product->stock,
            'variants' => $product->variants,
            'ingredients' => $product->ingredients,
            'badges' => $product->badges,
            'url' => route('product.show', $product->slug),
        ]);
    }
}
