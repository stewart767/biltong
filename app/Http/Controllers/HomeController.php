<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
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

        $originalProduct = Product::where('slug', 'biltong-original-100g')->first() 
            ?? Product::where('is_active', true)->first();

        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.home', compact('featuredProducts', 'originalProduct', 'categories'));
    }
}
