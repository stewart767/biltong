@extends('layouts.app')

@section('title', $product->name . ' | COY BILTONG')
@section('meta_description', Str::limit(strip_tags($product->short_description ?? $product->description), 160))

@section('content')

<!-- Breadcrumb Header -->
<div class="bg-[#171717] text-white py-6 border-b border-[#262626]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-stone-400">
            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
            <span>/</span>
            <a href="{{ route('shop') }}" class="hover:text-white transition">Shop</a>
            <span>/</span>
            <a href="{{ route('shop', ['category' => $product->category?->slug]) }}" class="hover:text-white transition">
                {{ $product->category?->name ?? 'Category' }}
            </a>
            <span>/</span>
            <span class="text-[#B77B3B] font-semibold truncate">{{ $product->name }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"
     x-data="{
         selectedImage: '{{ $product->image_url }}',
         selectedVariantId: {{ $product->variants->firstWhere('is_default', true)?->id ?? 'null' }},
         selectedWeight: '{{ $product->pack_size }}',
         unitPrice: {{ $product->effective_price }},
         regularPrice: {{ $product->price }},
         isOnSale: {{ $product->is_on_sale ? 'true' : 'false' }},
         quantity: 1,
         get totalFormatted() {
             return 'TZS ' + (this.unitPrice * this.quantity).toLocaleString();
         },
         updateVariant(id, weight, price, promoPrice) {
             this.selectedVariantId = id;
             this.selectedWeight = weight;
             this.regularPrice = price;
             if (promoPrice && promoPrice > 0 && promoPrice < price) {
                 this.unitPrice = promoPrice;
                 this.isOnSale = true;
             } else {
                 this.unitPrice = price;
                 this.isOnSale = false;
             }
         },
         buyNow() {
             fetch('{{ route('cart.add') }}', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content'),
                     'Accept': 'application/json'
                 },
                 body: JSON.stringify({
                     product_id: {{ $product->id }},
                     variant_id: this.selectedVariantId,
                     weight: this.selectedWeight,
                     quantity: this.quantity
                 })
             })
             .then(() => {
                 window.location.href = '{{ route('checkout') }}';
             });
         }
     }">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
        
        <!-- =========================================================================
             GALLERY (Left Column - 6 cols)
             ========================================================================= -->
        <div class="lg:col-span-6 flex flex-col gap-4">
            <!-- Large Primary Image Viewer -->
            <div class="bg-white rounded-3xl border border-[#ECE2D2] overflow-hidden p-4 shadow-sm">
                <img :src="selectedImage" 
                     alt="{{ $product->name }}" 
                     class="w-full h-[400px] sm:h-[500px] object-cover rounded-2xl">
            </div>

            <!-- Thumbnail Selector -->
            @if($product->images->count() > 1)
                <div class="flex items-center gap-3 overflow-x-auto pb-2">
                    @foreach($product->images as $img)
                        @php
                            $path = str_starts_with($img->image_path, 'http') ? $img->image_path : (str_starts_with($img->image_path, 'images/') ? asset($img->image_path) : asset('storage/' . $img->image_path));
                        @endphp
                        <button type="button" 
                                @click="selectedImage = '{{ $path }}'" 
                                :class="selectedImage === '{{ $path }}' ? 'border-[#B77B3B] ring-2 ring-[#B77B3B]/40' : 'border-[#ECE2D2]'" 
                                class="w-20 h-20 rounded-xl overflow-hidden border-2 bg-white flex-shrink-0 transition">
                            <img src="{{ $path }}" alt="Thumbnail" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif

            <!-- Trust Highlights Grid -->
            <div class="mt-4 grid grid-cols-3 gap-3 text-center text-xs text-stone-600 bg-white p-4 rounded-2xl border border-[#ECE2D2]">
                <div class="flex flex-col items-center gap-1.5 p-2">
                    <i data-lucide="shield-check" class="w-5 h-5 text-[#B77B3B]"></i>
                    <span class="font-bold text-[#171717]">100% Halal</span>
                    <span class="text-[10px] text-stone-400">Certified Butchery</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 p-2 border-x border-[#ECE2D2]">
                    <i data-lucide="truck" class="w-5 h-5 text-[#B77B3B]"></i>
                    <span class="font-bold text-[#171717]">Express Delivery</span>
                    <span class="text-[10px] text-stone-400">Dar & Upcountry</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 p-2">
                    <i data-lucide="refresh-cw" class="w-5 h-5 text-[#B77B3B]"></i>
                    <span class="font-bold text-[#171717]">Fresh Batch</span>
                    <span class="text-[10px] text-stone-400">Sliced Weekly</span>
                </div>
            </div>
        </div>

        <!-- =========================================================================
             DETAILS & PURCHASE (Right Column - 6 cols)
             ========================================================================= -->
        <div class="lg:col-span-6 flex flex-col justify-between">
            <div>
                <!-- Category and Stock Badge -->
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#68734B]">
                        {{ $product->category?->name ?? 'Artisanal Cut' }}
                    </span>
                    @if($product->isInStock())
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-bold border border-emerald-200">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            In Stock ({{ $product->stock }} packs ready)
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full bg-red-50 text-red-800 text-xs font-bold border border-red-200">
                            Temporarily Sold Out
                        </span>
                    @endif
                </div>

                <!-- Product Name -->
                <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-[#171717] mt-2">
                    {{ $product->name }}
                </h1>

                <!-- Price Presentation -->
                <div class="mt-4 flex items-baseline gap-3">
                    <span class="font-display font-extrabold text-3xl text-[#171717]" x-text="'TZS ' + unitPrice.toLocaleString()">
                        {{ $product->formatted_price }}
                    </span>
                    <span x-show="isOnSale" class="text-sm text-stone-400 line-through" x-text="'TZS ' + regularPrice.toLocaleString()">
                        {{ $product->formatted_regular_price }}
                    </span>
                    <span x-show="isOnSale" class="px-2 py-0.5 bg-[#B77B3B] text-white text-[10px] font-black uppercase rounded-sm">
                        Discounted Cut
                    </span>
                </div>

                <!-- Short Description -->
                <p class="mt-4 text-sm text-stone-600 leading-relaxed">
                    {{ $product->short_description }}
                </p>

                <!-- Weight / Pack Variants Selector -->
                @if($product->variants->count() > 0)
                    <div class="mt-6 pt-6 border-t border-[#ECE2D2]">
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">
                            Select Pack Size / Weight:
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                            @foreach($product->variants as $variant)
                                <button type="button" 
                                        @click="updateVariant({{ $variant->id }}, '{{ $variant->weight }}', {{ $variant->price }}, {{ $variant->promo_price ?? 'null' }})" 
                                        :class="selectedVariantId === {{ $variant->id }} ? 'bg-[#171717] text-white border-[#171717] shadow-sm' : 'bg-white text-stone-700 border-[#ECE2D2] hover:border-[#B77B3B]'"
                                        class="p-3 rounded-xl border text-center transition flex flex-col items-center">
                                    <span class="text-xs font-bold">{{ $variant->weight }}</span>
                                    <span class="text-[11px] opacity-80 mt-0.5">Tshs {{ number_format($variant->effective_price, 0) }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Quantity Selector -->
                <div class="mt-6 flex items-center gap-4">
                    <label class="text-xs font-bold uppercase tracking-wider text-stone-700">Quantity:</label>
                    <div class="flex items-center border border-[#ECE2D2] rounded-xl bg-white overflow-hidden shadow-xs">
                        <button type="button" 
                                @click="if (quantity > 1) quantity--" 
                                class="px-3.5 py-2 text-stone-600 hover:bg-[#F6F0E6] transition font-bold">
                            -
                        </button>
                        <span x-text="quantity" class="px-4 py-2 text-sm font-bold text-[#171717] w-12 text-center"></span>
                        <button type="button" 
                                @click="quantity++" 
                                class="px-3.5 py-2 text-stone-600 hover:bg-[#F6F0E6] transition font-bold">
                            +
                        </button>
                    </div>
                    <span class="text-xs text-stone-500">
                        Total: <strong class="text-[#171717]" x-text="totalFormatted"></strong>
                    </span>
                </div>

                <!-- Purchase Buttons -->
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <button type="button" 
                            @click="addToCart({{ $product->id }}, selectedVariantId, selectedWeight, quantity)" 
                            class="w-full bg-[#171717] hover:bg-[#B77B3B] text-white py-4 rounded-xl font-bold text-sm tracking-wide uppercase transition shadow-md flex items-center justify-center gap-2">
                        <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                        <span>Add to Cart</span>
                    </button>

                    <button type="button" 
                            @click="buyNow()" 
                            class="w-full bg-[#B77B3B] hover:bg-[#C98E4F] text-white py-4 rounded-xl font-bold text-sm tracking-wide uppercase transition shadow-lg shadow-[#B77B3B]/25 flex items-center justify-center gap-2">
                        <i data-lucide="zap" class="w-4 h-4"></i>
                        <span>Buy Now</span>
                    </button>
                </div>

                <!-- WhatsApp Direct Order Button -->
                <div class="mt-4">
                    <a :href="'https://wa.me/{{ \App\Models\SiteSetting::get('company_whatsapp', '255768123456') }}?text=' + encodeURIComponent('Hello COY BILTONG, I would like to order: {{ $product->name }} (' + selectedWeight + ') x' + quantity)" 
                       target="_blank" 
                       class="w-full bg-[#25D366]/15 hover:bg-[#25D366]/25 text-[#128C7E] border border-[#25D366]/40 py-3 rounded-xl font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>Order Directly on WhatsApp</span>
                    </a>
                </div>

            </div>

            <!-- SKU & Meta details -->
            <div class="mt-8 pt-6 border-t border-[#ECE2D2] text-xs text-stone-500 flex flex-wrap gap-4">
                <span>SKU: <strong class="text-[#171717]">{{ $product->sku }}</strong></span>
                <span>Category: <strong class="text-[#171717]">{{ $product->category?->name }}</strong></span>
                <span>Default Size: <strong class="text-[#171717]">{{ $product->pack_size }}</strong></span>
            </div>

        </div>

    </div>

    <!-- =========================================================================
         DETAILED PRODUCT SPECS: Ingredients, Nutritional Info, Storage
         ========================================================================= -->
    <div class="mt-16 pt-12 border-t border-[#ECE2D2]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Long Description -->
            <div class="lg:col-span-7">
                <h3 class="font-display font-bold text-2xl text-[#171717] mb-4">
                    Artisanal Craft & Preparation
                </h3>
                <div class="prose prose-stone max-w-none text-sm text-stone-600 leading-relaxed space-y-4">
                    {!! nl2br(e($product->description ?? $product->short_description)) !!}
                </div>

                @if($product->ingredients)
                    <div class="mt-8 bg-white p-6 rounded-2xl border border-[#ECE2D2]">
                        <h4 class="font-display font-bold text-base text-[#171717] mb-2">Ingredients</h4>
                        <p class="text-xs text-stone-600 leading-relaxed">{{ $product->ingredients }}</p>
                    </div>
                @endif
            </div>

            <!-- Nutritional & Storage Sidebar -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- Nutritional Facts Table -->
                <div class="bg-white p-6 rounded-2xl border border-[#ECE2D2] shadow-xs">
                    <h4 class="font-display font-bold text-base text-[#171717] pb-3 border-b border-[#ECE2D2]">
                        Nutritional Facts (Per 50g Serving)
                    </h4>
                    <div class="divide-y divide-[#ECE2D2] text-xs">
                        <div class="py-2.5 flex justify-between">
                            <span class="text-stone-500">Protein</span>
                            <span class="font-bold text-[#171717]">{{ $product->nutritional_info['protein'] ?? $product->nutritional_info['protein_per_100g'] ?? '28g' }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <span class="text-stone-500">Calories</span>
                            <span class="font-bold text-[#171717]">{{ $product->nutritional_info['calories'] ?? $product->nutritional_info['energy_kcal_per_100g'] ?? '155 kcal' }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <span class="text-stone-500">Total Fat</span>
                            <span class="font-bold text-[#171717]">{{ $product->nutritional_info['fat'] ?? '4g' }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <span class="text-stone-500">Carbohydrates</span>
                            <span class="font-bold text-[#171717]">{{ $product->nutritional_info['carbs'] ?? '1.5g' }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <span class="text-stone-500">Sugars</span>
                            <span class="font-bold text-emerald-700">0.0g (Zero Added Sugar)</span>
                        </div>
                    </div>
                </div>

                <!-- Storage Instructions -->
                <div class="bg-white p-6 rounded-2xl border border-[#ECE2D2] shadow-xs">
                    <div class="flex items-center gap-2 mb-2 text-[#68734B]">
                        <i data-lucide="thermometer" class="w-4 h-4"></i>
                        <h4 class="font-display font-bold text-base text-[#171717]">Storage & Freshness</h4>
                    </div>
                    <p class="text-xs text-stone-600 leading-relaxed">
                        {{ $product->storage_instructions ?? 'Store in a cool, dry place away from heat. Reseal airtight bag after opening or refrigerate to retain maximum moisture.' }}
                    </p>
                </div>

            </div>

        </div>
    </div>

    <!-- =========================================================================
         RELATED PRODUCTS
         ========================================================================= -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="mt-20 pt-12 border-t border-[#ECE2D2]">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-[#68734B]">More Recommendations</span>
                    <h3 class="font-display font-bold text-2xl text-[#171717]">You May Also Enjoy</h3>
                </div>
                <a href="{{ route('shop') }}" class="text-xs font-bold text-[#B77B3B] hover:underline">
                    View All Cuts →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $rel)
                    <div class="bg-white rounded-2xl border border-[#ECE2D2] overflow-hidden p-4 shadow-xs hover:shadow-lg transition">
                        <a href="{{ route('product.show', $rel->slug) }}" class="block aspect-square rounded-xl overflow-hidden mb-3 bg-[#F6F0E6]">
                            <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="w-full h-full object-cover">
                        </a>
                        <span class="text-[10px] font-bold uppercase text-[#68734B]">{{ $rel->pack_size }}</span>
                        <a href="{{ route('product.show', $rel->slug) }}" class="block font-display font-bold text-sm text-[#171717] hover:text-[#B77B3B] truncate mt-1">
                            {{ $rel->name }}
                        </a>
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-sm font-black text-[#171717]">{{ $rel->formatted_price }}</span>
                            <button @click="addToCart({{ $rel->id }}, null, '{{ $rel->pack_size }}', 1)" 
                                    class="p-1.5 rounded-lg bg-[#F6F0E6] hover:bg-[#B77B3B] hover:text-white transition">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>

@endsection
