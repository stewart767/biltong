@extends('layouts.admin')

@section('title', 'Edit ' . $product->name)
@section('page_title', 'Edit Beef Cut: ' . $product->name)

@section('content')

    <div class="max-w-4xl space-y-6">
        
        <div class="flex items-center justify-between">
            <h2 class="font-editorial text-2xl font-bold text-brand-cream">Edit: {{ $product->name }}</h2>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-brand-muted hover:text-white">&larr; Back to Products</a>
        </div>

        @if($errors->any())
            <div class="p-4 rounded-xl bg-red-950/80 border border-red-500/60 text-red-300 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-6">
            @csrf
            @method('PUT')

            <!-- Primary Info -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Category *</label>
                    <select name="category_id" required class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- SKU, Pack Size, Stock -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Pack Size Label *</label>
                    <input type="text" name="pack_size" value="{{ old('pack_size', $product->pack_size) }}" required
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Available Stock *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>
            </div>

            <!-- Pricing -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Regular Price (TZS) *</label>
                    <input type="number" name="price" value="{{ old('price', (float)$product->price) }}" required step="0.01"
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Promotional Price (TZS, Optional)</label>
                    <input type="number" name="promo_price" value="{{ old('promo_price', (float)$product->promo_price) }}" step="0.01"
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>
            </div>

            <!-- Weight Options Multi-Tiers -->
            @php
                $weightLines = '';
                if (!empty($product->weight_options)) {
                    foreach ($product->weight_options as $opt) {
                        $weightLines .= $opt['weight'] . ':' . $opt['price'] . "\n";
                    }
                }
            @endphp
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">
                    Pack Size / Weight Variants (Format: Weight:Price per line)
                </label>
                <textarea name="weight_options_raw" rows="3"
                          class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-xs font-mono text-brand-cream focus:border-brand-red focus:outline-none">{{ old('weight_options_raw', trim($weightLines)) }}</textarea>
                <span class="text-[11px] text-brand-muted">Example: 100g:10000 (one per line). First line is default.</span>
            </div>

            <!-- Descriptions -->
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Short Description</label>
                <input type="text" name="short_description" value="{{ old('short_description', $product->short_description) }}"
                       class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Full Product Description</label>
                <textarea name="description" rows="4"
                          class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Ingredients & Storage -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Ingredients List</label>
                    <textarea name="ingredients" rows="3"
                              class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">{{ old('ingredients', $product->ingredients) }}</textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Storage Instructions</label>
                    <textarea name="storage_instructions" rows="3"
                              class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">{{ old('storage_instructions', $product->storage_instructions) }}</textarea>
                </div>
            </div>

            <!-- Nutritional Facts -->
            <div class="p-4 rounded-xl bg-brand-dark border border-brand-border space-y-3">
                <span class="text-xs uppercase font-bold text-brand-red tracking-wider block">Nutritional Values (Per 100g)</span>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="space-y-1">
                        <label class="text-[11px] text-brand-muted block">Protein</label>
                        <input type="text" name="protein" value="{{ old('protein', $product->nutritional_info['protein_per_100g'] ?? '52.4g') }}" class="w-full px-3 py-2 rounded-lg bg-brand-card border border-brand-border text-xs text-brand-cream">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[11px] text-brand-muted block">Energy (kcal)</label>
                        <input type="text" name="energy" value="{{ old('energy', $product->nutritional_info['energy_kcal_per_100g'] ?? '274 kcal') }}" class="w-full px-3 py-2 rounded-lg bg-brand-card border border-brand-border text-xs text-brand-cream">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[11px] text-brand-muted block">Total Fat</label>
                        <input type="text" name="fat" value="{{ old('fat', $product->nutritional_info['total_fat_per_100g'] ?? '6.8g') }}" class="w-full px-3 py-2 rounded-lg bg-brand-card border border-brand-border text-xs text-brand-cream">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[11px] text-brand-muted block">Salt / Sodium</label>
                        <input type="text" name="salt" value="{{ old('salt', $product->nutritional_info['salt_sodium_per_100g'] ?? '4.2g') }}" class="w-full px-3 py-2 rounded-lg bg-brand-card border border-brand-border text-xs text-brand-cream">
                    </div>
                </div>
            </div>

            <!-- Current Image + Upload -->
            <div class="flex items-center gap-6 p-4 rounded-xl bg-brand-dark border border-brand-border">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-20 h-20 rounded-xl object-cover bg-brand-card border border-brand-border">
                <div class="space-y-1.5 flex-1">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Replace Product Photo</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full text-xs text-brand-muted file:mr-4 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-card file:text-brand-red hover:file:bg-brand-border">
                </div>
            </div>

            <!-- Toggles -->
            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="text-brand-red focus:ring-brand-red rounded">
                    <span class="text-xs text-brand-cream font-medium">Feature on Homepage Showcase</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="text-brand-red focus:ring-brand-red rounded">
                    <span class="text-xs text-brand-cream font-medium">Active (Visible in Catalogue)</span>
                </label>
            </div>

            <div class="pt-4 border-t border-brand-border/60 flex items-center justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-5 py-3 rounded-xl bg-brand-dark text-brand-muted hover:text-white text-xs font-semibold transition">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs font-bold uppercase tracking-wider hover:shadow-xl transition">
                    Update Product
                </button>
            </div>
        </form>

    </div>

@endsection
