<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminCategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')->orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|max:3072',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $request->file('image')->getClientOriginalName());
            $request->file('image')->move(public_path('images/categories'), $filename);
            $imagePath = 'images/categories/' . $filename;
        }

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
            'image' => $imagePath,
        ]);

        Cache::forget('active_categories_list');

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|max:3072',
        ]);

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $request->file('image')->getClientOriginalName());
            $request->file('image')->move(public_path('images/categories'), $filename);
            $imagePath = 'images/categories/' . $filename;
        }

        $category->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
            'image' => $imagePath,
        ]);

        Cache::forget('active_categories_list');

        return redirect()->route('admin.categories.index')->with('success', 'Category photo and details updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        Cache::forget('active_categories_list');

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
    }
}
