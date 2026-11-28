<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $heroBanner = Banner::where('type', 'hero')->where('is_active', true)->orderBy('sort_order')->first();
        $heroSlides = Banner::where('type', 'hero')->where('is_active', true)->orderBy('sort_order')->get();
        $promoBanner = Banner::where('type', 'promo')->where('is_active', true)->orderBy('sort_order')->first();
        $comboBanner = Banner::where('type', 'combo_pack')->where('is_active', true)->orderBy('sort_order')->first();

        $featuredProducts = Product::with(['category', 'images', 'variants'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderByRaw("CASE 
                WHEN category_id IN (SELECT id FROM categories WHERE slug IN ('gourmet-burgers', 'hot-deals-combos', 'crispy-chicken', 'sides-fries')) THEN 0 
                ELSE 1 
            END")
            ->orderBy('id', 'asc')
            ->take(8)
            ->get();

        if ($featuredProducts->count() < 4) {
            $extra = Product::with(['category', 'images', 'variants'])
                ->where('is_active', true)
                ->whereNotIn('id', $featuredProducts->pluck('id'))
                ->take(4 - $featuredProducts->count())
                ->get();
            $featuredProducts = $featuredProducts->concat($extra);
        }

        $categories = Category::withCount(['products' => fn ($q) => $q->where('is_active', true)])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('pages.home', compact('heroBanner', 'heroSlides', 'promoBanner', 'comboBanner', 'featuredProducts', 'categories', 'testimonials'));
    }
}
