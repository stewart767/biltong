@extends('layouts.admin')

@section('title', 'Add New Product')

@section('content')

<div class="max-w-4xl space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-display text-2xl font-bold text-white">Add New Biltong Cut</h2>
            <p class="text-xs text-stone-400">Create a new product cut with prices, weights, stock and image uploads.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs text-stone-400 hover:text-white">&larr; Back to Products</a>
    </div>

    @if($errors->any())
        <div class="p-4 rounded-xl bg-red-950/80 border border-red-500/60 text-red-300 text-xs">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-8 rounded-3xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-6">
        @csrf

        <!-- Primary Info -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Product Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. COY Original Beef Biltong"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Category *</label>
                <select name="category_id" required class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- SKU, Pack Size, Stock -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">SKU (e.g. COY-ORIG-100)</label>
                <input type="text" name="sku" value="{{ old('sku') }}" placeholder="Auto-generated if empty"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Default Pack Weight *</label>
                <input type="text" name="pack_size" value="{{ old('pack_size', '100g') }}" required placeholder="e.g. 100g"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Initial Stock Packs *</label>
                <input type="number" name="stock" value="{{ old('stock', 50) }}" required min="0"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>
        </div>

        <!-- Pricing in Tshs -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Price in Tshs *</label>
                <input type="number" name="price" value="{{ old('price', 22000) }}" required step="1" placeholder="e.g. 22000"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#E52E2E]">
                <span class="text-[10px] text-stone-500">Tanzanian Shillings</span>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Promo / Sale Price in Tshs</label>
                <input type="number" name="promo_price" value="{{ old('promo_price') }}" step="1" placeholder="e.g. 20000"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#E52E2E]">
                <span class="text-[10px] text-stone-500">Leave empty if not discounted</span>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Card Badge (Optional)</label>
                <select name="badge" class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#E52E2E]">
                    <option value="">No Badge</option>
                    <option value="Most Popular" {{ old('badge') == 'Most Popular' ? 'selected' : '' }}>Most Popular</option>
                    <option value="Hot Deals" {{ old('badge') == 'Hot Deals' ? 'selected' : '' }}>Hot Deals</option>
                    <option value="New" {{ old('badge') == 'New' ? 'selected' : '' }}>New</option>
                    <option value="Chef's Pick" {{ old('badge') == "Chef's Pick" ? 'selected' : '' }}>Chef's Pick</option>
                    <option value="Combo Pack" {{ old('badge') == 'Combo Pack' ? 'selected' : '' }}>Combo Pack</option>
                </select>
            </div>
        </div>

        <!-- Weight Variants (Format: Weight:Price) -->
        <div class="space-y-1.5">
            <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">
                Additional Weight Variants (Format: Weight:Price per line)
            </label>
            <textarea name="weight_options_raw" rows="3" placeholder="100g:10000&#10;250g:24000&#10;500g:45000&#10;1kg:85000"
                      class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs font-mono text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">{{ old('weight_options_raw', "250g:24000\n500g:45000\n1kg:85000") }}</textarea>
            <span class="text-[11px] text-stone-500">Example: 250g:24000 (one per line). Automatically creates product variants.</span>
        </div>

        <!-- Descriptions -->
        <div class="space-y-1.5">
            <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Short Teaser Description</label>
            <input type="text" name="short_description" value="{{ old('short_description') }}" placeholder="Brief overview for product cards"
                   class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
        </div>

        <div class="space-y-1.5">
            <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Full Product Description</label>
            <textarea name="description" rows="4" placeholder="Detailed story of the cut, flavor notes, and artisan craft..."
                      class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">{{ old('description') }}</textarea>
        </div>

        <!-- Ingredients & Storage -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Ingredients</label>
                <input type="text" name="ingredients" value="{{ old('ingredients', '100% Tanzanian Prime Beef, Cider Vinegar, Roasted Coriander, Sea Salt, Cracked Black Pepper.') }}"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Storage Instructions</label>
                <input type="text" name="storage_instructions" value="{{ old('storage_instructions', 'Store in a cool, dry place. Reseal after opening.') }}"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>
        </div>

        <!-- Image Upload (Supports Multiple) -->
        <div class="space-y-1.5">
            <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Upload Product Images (Multiple allowed)</label>
            <input type="file" name="images[]" multiple class="w-full text-xs text-stone-300">
            <span class="text-[11px] text-stone-500 block">First selected image will be used as the primary card image.</span>
        </div>

        <!-- Toggles -->
        <div class="flex items-center gap-6 pt-2">
            <label class="flex items-center gap-2 cursor-pointer text-xs text-stone-300">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 text-[#E52E2E] rounded">
                <span>Feature on Menu & Homepage Grid</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer text-xs text-stone-300">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 text-[#E52E2E] rounded">
                <span>Active & Available for Ordering</span>
            </label>
        </div>

        <button type="submit" class="w-full py-4 rounded-xl bg-[#E52E2E] hover:bg-[#C61A1A] text-white font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-red-500/25 border-2 border-white/20">
            Save Menu Item
        </button>
    </form>

</div>

@endsection
