@extends('layouts.admin')

@section('title', 'Edit Product: ' . $product->name)

@section('content')

<div class="max-w-4xl space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-display text-2xl font-bold text-white">Edit: {{ $product->name }}</h2>
            <p class="text-xs text-stone-400">Modify cut details, stock levels, upload additional images, or update prices.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs text-stone-400 hover:text-white">&larr; Back to Products</a>
    </div>

    @if($errors->any())
        <div class="p-4 rounded-xl bg-red-950/80 border border-red-500/60 text-red-300 text-xs">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Existing Gallery Images with Delete Buttons -->
    @if($product->images->count() > 0)
        <div class="p-6 rounded-3xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-3">
            <span class="text-xs font-semibold uppercase tracking-wider text-stone-400 block">Existing Images</span>
            <div class="flex flex-wrap gap-4">
                @foreach($product->images as $img)
                    <div class="relative w-24 h-24 rounded-2xl overflow-hidden border border-[#333333] group bg-[#171717]">
                        <img src="{{ str_starts_with($img->image_path, 'http') ? $img->image_path : (str_starts_with($img->image_path, 'images/') ? asset($img->image_path) : asset('storage/' . $img->image_path)) }}" alt="" class="w-full h-full object-cover">
                        @if($img->is_primary)
                            <span class="absolute bottom-1 left-1 bg-[#B77B3B] text-white text-[9px] font-bold px-1.5 rounded">Primary</span>
                        @endif
                        <form action="{{ route('admin.products.image.destroy', $img->id) }}" method="POST" class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white rounded-full p-1" title="Delete Image">
                                <i data-lucide="x" class="w-3 h-3"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="p-8 rounded-3xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-6">
        @csrf
        @method('PUT')

        <!-- Primary Info -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Product Name *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Category *</label>
                <select name="category_id" required class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
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
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">SKU</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Default Pack Weight *</label>
                <input type="text" name="pack_size" value="{{ old('pack_size', $product->pack_size) }}" required
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Available Stock Packs *</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>
        </div>

        <!-- Pricing in Tshs -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Price in Tshs *</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required step="1"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#E52E2E]">
                <span class="text-[10px] text-stone-500">Tanzanian Shillings</span>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Promo / Sale Price in Tshs</label>
                <input type="number" name="promo_price" value="{{ old('promo_price', $product->promo_price) }}" step="1" placeholder="Leave empty if not on sale"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#E52E2E]">
                <span class="text-[10px] text-stone-500">Leave empty if not discounted</span>
            </div>

            <div class="space-y-1.5">
                @php $currentBadge = !empty($product->badges) ? $product->badges[0] : ''; @endphp
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Card Badge (Optional)</label>
                <select name="badge" class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#E52E2E]">
                    <option value="">No Badge</option>
                    <option value="Most Popular" {{ old('badge', $currentBadge) == 'Most Popular' ? 'selected' : '' }}>Most Popular</option>
                    <option value="Hot Deals" {{ old('badge', $currentBadge) == 'Hot Deals' ? 'selected' : '' }}>Hot Deals</option>
                    <option value="New" {{ old('badge', $currentBadge) == 'New' ? 'selected' : '' }}>New</option>
                    <option value="Chef's Pick" {{ old('badge', $currentBadge) == "Chef's Pick" ? 'selected' : '' }}>Chef's Pick</option>
                    <option value="Combo Pack" {{ old('badge', $currentBadge) == 'Combo Pack' ? 'selected' : '' }}>Combo Pack</option>
                </select>
            </div>
        </div>

        <!-- Descriptions -->
        <div class="space-y-1.5">
            <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Short Teaser Description</label>
            <input type="text" name="short_description" value="{{ old('short_description', $product->short_description) }}"
                   class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
        </div>

        <div class="space-y-1.5">
            <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Full Product Description</label>
            <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Ingredients & Storage -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Ingredients</label>
                <input type="text" name="ingredients" value="{{ old('ingredients', $product->ingredients) }}"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Storage Instructions</label>
                <input type="text" name="storage_instructions" value="{{ old('storage_instructions', $product->storage_instructions) }}"
                       class="w-full px-4 py-3 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>
        </div>

        <!-- Add More Images -->
        <div class="space-y-1.5">
            <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Upload Additional Images</label>
            <input type="file" name="images[]" multiple class="w-full text-xs text-stone-300">
        </div>

        <!-- Toggles -->
        <div class="flex items-center gap-6 pt-2">
            <label class="flex items-center gap-2 cursor-pointer text-xs text-stone-300">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-4 h-4 text-[#E52E2E] rounded">
                <span>Feature on Menu & Homepage Grid</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer text-xs text-stone-300">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-4 h-4 text-[#E52E2E] rounded">
                <span>Active & Available for Ordering</span>
            </label>
        </div>

        <button type="submit" class="w-full py-4 rounded-xl bg-[#E52E2E] hover:bg-[#C61A1A] text-white font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-red-500/25 border-2 border-white/20">
            Save Menu Item Changes
        </button>
    </form>

</div>

@endsection
