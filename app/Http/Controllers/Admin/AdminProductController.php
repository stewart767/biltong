<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with(['category', 'images'])->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'sku' => 'nullable|string|max:50|unique:products,sku',
            'pack_size' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'promo_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'short_description' => 'nullable|string|max:300',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'storage_instructions' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'weight_options_raw' => 'nullable|string',
            'protein' => 'nullable|string|max:50',
            'energy' => 'nullable|string|max:50',
            'fat' => 'nullable|string|max:50',
            'salt' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:3072',
        ]);

        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-" . $counter++;
        }

        // Process weight options
        $weightOptions = null;
        if (!empty($validated['weight_options_raw'])) {
            $lines = explode("\n", str_replace("\r", "", $validated['weight_options_raw']));
            $weightOptions = [];
            foreach ($lines as $i => $line) {
                $parts = explode(':', trim($line));
                if (count($parts) >= 2) {
                    $weight = trim($parts[0]);
                    $p = (float) trim($parts[1]);
                    $weightOptions[] = [
                        'weight' => $weight,
                        'price' => $p,
                        'label' => $weight,
                        'is_default' => ($i === 0),
                    ];
                }
            }
        }

        // Process nutritional info
        $nutritionalInfo = [
            'protein_per_100g' => $validated['protein'] ?? '52.4g',
            'energy_kcal_per_100g' => $validated['energy'] ?? '274 kcal',
            'total_fat_per_100g' => $validated['fat'] ?? '6.8g',
            'salt_sodium_per_100g' => $validated['salt'] ?? '4.2g',
        ];

        $product = Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'sku' => $validated['sku'] ?? ('INAS-' . strtoupper(Str::random(6))),
            'pack_size' => $validated['pack_size'],
            'price' => $validated['price'],
            'promo_price' => $validated['promo_price'] ?? null,
            'stock' => $validated['stock'],
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'ingredients' => $validated['ingredients'] ?? null,
            'storage_instructions' => $validated['storage_instructions'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
            'weight_options' => $weightOptions,
            'nutritional_info' => $nutritionalInfo,
            'certifications' => ['100% Halal', 'Tanzanian Pasture Beef'],
            'badges' => ['Artisanal Cut'],
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/products'), $filename);
            $product->images()->create([
                'image_path' => 'images/products/' . $filename,
                'is_primary' => true,
                'alt_text' => $product->name,
            ]);
        } else {
            // Default placeholder image
            $product->images()->create([
                'image_path' => 'images/biltong-original-1.jpg',
                'is_primary' => true,
                'alt_text' => $product->name,
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', "Product '{$product->name}' created successfully.");
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'sku' => 'nullable|string|max:50|unique:products,sku,' . $product->id,
            'pack_size' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'promo_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'short_description' => 'nullable|string|max:300',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'storage_instructions' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'weight_options_raw' => 'nullable|string',
            'protein' => 'nullable|string|max:50',
            'energy' => 'nullable|string|max:50',
            'fat' => 'nullable|string|max:50',
            'salt' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:3072',
        ]);

        $weightOptions = $product->weight_options;
        if (!empty($validated['weight_options_raw'])) {
            $lines = explode("\n", str_replace("\r", "", $validated['weight_options_raw']));
            $weightOptions = [];
            foreach ($lines as $i => $line) {
                $parts = explode(':', trim($line));
                if (count($parts) >= 2) {
                    $weight = trim($parts[0]);
                    $p = (float) trim($parts[1]);
                    $weightOptions[] = [
                        'weight' => $weight,
                        'price' => $p,
                        'label' => $weight,
                        'is_default' => ($i === 0),
                    ];
                }
            }
        }

        $nutritionalInfo = $product->nutritional_info ?? [];
        if (!empty($validated['protein'])) $nutritionalInfo['protein_per_100g'] = $validated['protein'];
        if (!empty($validated['energy'])) $nutritionalInfo['energy_kcal_per_100g'] = $validated['energy'];
        if (!empty($validated['fat'])) $nutritionalInfo['total_fat_per_100g'] = $validated['fat'];
        if (!empty($validated['salt'])) $nutritionalInfo['salt_sodium_per_100g'] = $validated['salt'];

        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'sku' => $validated['sku'] ?? $product->sku,
            'pack_size' => $validated['pack_size'],
            'price' => $validated['price'],
            'promo_price' => $validated['promo_price'] ?? null,
            'stock' => $validated['stock'],
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'ingredients' => $validated['ingredients'] ?? null,
            'storage_instructions' => $validated['storage_instructions'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
            'weight_options' => $weightOptions,
            'nutritional_info' => $nutritionalInfo,
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/products'), $filename);
            
            // set previous primary to false
            $product->images()->update(['is_primary' => false]);
            $product->images()->create([
                'image_path' => 'images/products/' . $filename,
                'is_primary' => true,
                'alt_text' => $product->name,
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', "Product '{$product->name}' updated successfully.");
    }

    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', "Product '{$name}' deleted.");
    }
}
