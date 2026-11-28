<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $categoryId = $request->get('category_id');

        $query = Product::with(['category', 'images', 'variants'])->latest();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")->orWhere('sku', 'like', "%{$search}%");
        }

        if ($categoryId && $categoryId !== 'all') {
            $query->where('category_id', $categoryId);
        }

        $products = $query->paginate(15)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories', 'search', 'categoryId'));
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
            'badge' => 'nullable|string|max:50',
            'images.*' => 'nullable|image|max:4096',
            'image' => 'nullable|image|max:4096',
        ]);

        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-" . $counter++;
        }

        $nutritionalInfo = [
            'protein' => $validated['protein'] ?? '28g',
            'calories' => $validated['energy'] ?? '155 kcal',
            'fat' => $validated['fat'] ?? '4g',
            'salt' => $validated['salt'] ?? '1.2g',
        ];

        $product = Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'sku' => $validated['sku'] ?? ('COY-' . strtoupper(Str::random(6))),
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
            'nutritional_info' => $nutritionalInfo,
            'certifications' => ['100% Halal Certified', 'TBS Compliant', 'Prime Pasture Beef'],
            'badges' => $request->filled('badge') ? [$request->input('badge')] : ['Popular'],
        ]);

        // Inventory log
        Inventory::create([
            'product_id' => $product->id,
            'change_type' => 'initial_stock',
            'quantity' => $product->stock,
            'stock_after' => $product->stock,
            'notes' => 'Initial product creation',
            'user_id' => Auth::id(),
        ]);

        // Process images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $idx => $file) {
                $filename = time() . '_' . $idx . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/products'), $filename);
                $product->images()->create([
                    'image_path' => 'images/products/' . $filename,
                    'is_primary' => ($idx === 0),
                    'sort_order' => $idx,
                    'alt_text' => $product->name,
                ]);
            }
        } elseif ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/products'), $filename);
            $product->images()->create([
                'image_path' => 'images/products/' . $filename,
                'is_primary' => true,
                'sort_order' => 0,
                'alt_text' => $product->name,
            ]);
        } else {
            $product->images()->create([
                'image_path' => 'images/biltong-original-1.jpg',
                'is_primary' => true,
                'sort_order' => 0,
                'alt_text' => $product->name,
            ]);
        }

        // Process default variant
        ProductVariant::create([
            'product_id' => $product->id,
            'weight' => $product->pack_size,
            'sku' => $product->sku . '-DEF',
            'price' => $product->price,
            'promo_price' => $product->promo_price,
            'stock' => $product->stock,
            'is_default' => true,
            'is_active' => true,
        ]);

        // Process additional weight options/variants if provided
        if (!empty($validated['weight_options_raw'])) {
            $lines = explode("\n", str_replace("\r", "", $validated['weight_options_raw']));
            foreach ($lines as $line) {
                $parts = explode(':', trim($line));
                if (count($parts) >= 2) {
                    $weight = trim($parts[0]);
                    $price = (float) trim($parts[1]);
                    if ($weight !== $product->pack_size) {
                        ProductVariant::create([
                            'product_id' => $product->id,
                            'weight' => $weight,
                            'sku' => $product->sku . '-' . Str::slug($weight),
                            'price' => $price,
                            'promo_price' => null,
                            'stock' => 50,
                            'is_default' => false,
                            'is_active' => true,
                        ]);
                    }
                }
            }
        }

        ActivityLog::log('created_product', "Created product '{$product->name}' (SKU: {$product->sku})", $product);
        Cache::forget('home_featured_products');

        return redirect()->route('admin.products.index')->with('success', "Product '{$product->name}' created successfully.");
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        $product->load(['images', 'variants', 'inventoryLogs']);
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
            'protein' => 'nullable|string|max:50',
            'energy' => 'nullable|string|max:50',
            'fat' => 'nullable|string|max:50',
            'salt' => 'nullable|string|max:50',
            'badge' => 'nullable|string|max:50',
            'images.*' => 'nullable|image|max:4096',
            'image' => 'nullable|image|max:4096',
        ]);

        $nutritionalInfo = $product->nutritional_info ?? [];
        if (!empty($validated['protein'])) $nutritionalInfo['protein'] = $validated['protein'];
        if (!empty($validated['energy'])) $nutritionalInfo['calories'] = $validated['energy'];
        if (!empty($validated['fat'])) $nutritionalInfo['fat'] = $validated['fat'];
        if (!empty($validated['salt'])) $nutritionalInfo['salt'] = $validated['salt'];

        $oldStock = $product->stock;
        $newStock = (int) $validated['stock'];

        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'sku' => $validated['sku'] ?? $product->sku,
            'pack_size' => $validated['pack_size'],
            'price' => $validated['price'],
            'promo_price' => $validated['promo_price'] ?? null,
            'stock' => $newStock,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'ingredients' => $validated['ingredients'] ?? null,
            'storage_instructions' => $validated['storage_instructions'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
            'badges' => $request->filled('badge') ? [$request->input('badge')] : $product->badges,
            'nutritional_info' => $nutritionalInfo,
        ]);

        // If stock changed manually, log it
        if ($oldStock !== $newStock) {
            Inventory::create([
                'product_id' => $product->id,
                'change_type' => 'manual_adjustment',
                'quantity' => $newStock - $oldStock,
                'stock_after' => $newStock,
                'notes' => 'Admin manual inventory update',
                'user_id' => Auth::id(),
            ]);
        }

        // New uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/products'), $filename);
                $product->images()->create([
                    'image_path' => 'images/products/' . $filename,
                    'is_primary' => false,
                    'alt_text' => $product->name,
                ]);
            }
        } elseif ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/products'), $filename);
            $product->images()->update(['is_primary' => false]);
            $product->images()->create([
                'image_path' => 'images/products/' . $filename,
                'is_primary' => true,
                'alt_text' => $product->name,
            ]);
        }

        ActivityLog::log('updated_product', "Updated product '{$product->name}'", $product);
        Cache::forget('home_featured_products');

        return redirect()->route('admin.products.index')->with('success', "Product '{$product->name}' updated successfully.");
    }

    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;
        $product->delete();
        ActivityLog::log('deleted_product', "Deleted product '{$name}'");
        Cache::forget('home_featured_products');

        return redirect()->route('admin.products.index')->with('success', "Product '{$name}' deleted.");
    }

    public function destroyImage(int $imageId): RedirectResponse
    {
        $image = ProductImage::findOrFail($imageId);
        $productId = $image->product_id;
        $image->delete();

        return redirect()->route('admin.products.edit', $productId)->with('success', 'Image removed.');
    }
}
