@extends('layouts.app')

@section('title', $product->name . ' (' . $product->pack_size . ') | INAS Premium Beef Biltong')
@section('meta_description', $product->short_description ?? 'Handcrafted Tanzanian beef biltong from Buguruni Malapa. 100% pasture beef, 52g protein.')

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-stone-200 py-3 px-4">
        <div class="max-w-7xl mx-auto flex items-center gap-2 text-xs text-zinc-500">
            <a href="{{ route('home') }}" class="hover:text-red-600">Home</a>
            <span>/</span>
            <a href="{{ route('shop') }}" class="hover:text-red-600">Shop</a>
            <span>/</span>
            <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="hover:text-red-600">
                {{ $product->category->name }}
            </a>
            <span>/</span>
            <span class="text-red-600 font-bold truncate">{{ $product->name }}</span>
        </div>
    </div>

    <!-- Product Details Section (Clean White Area) -->
    <section class="py-16 bg-white text-zinc-900" x-data="{
        selectedImage: '{{ $product->image_url }}',
        selectedWeight: '{{ $product->pack_size }}',
        currentPrice: {{ (float) $product->effective_price }},
        quantity: 1,
        weightOptions: {{ json_encode($product->weight_options ?? []) }},

        init() {
            if (this.weightOptions.length > 0) {
                const defaultOption = this.weightOptions.find(o => o.is_default) || this.weightOptions[0];
                this.selectedWeight = defaultOption.weight;
                this.currentPrice = defaultOption.price;
            }
        },

        selectWeight(option) {
            this.selectedWeight = option.weight;
            this.currentPrice = option.price;
        },

        get formattedPrice() {
            return 'TZS ' + Number(this.currentPrice * this.quantity).toLocaleString();
        },

        get singleFormattedPrice() {
            return 'TZS ' + Number(this.currentPrice).toLocaleString();
        },

        getWhatsAppOrderUrl() {
            const phone = '255682869629';
            const total = this.currentPrice * this.quantity;
            const text = `Hello INAS Biltong! I would like to order:\n\n` +
                         `*Product:* {{ $product->name }}\n` +
                         `*Pack Size:* ${this.selectedWeight}\n` +
                         `*Quantity:* ${this.quantity}\n` +
                         `*Total:* TZS ${Number(total).toLocaleString()}\n\n` +
                         `Please let me know how soon it can be delivered in Dar es Salaam!`;
            return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left: Multi-Image Gallery -->
                <div class="lg:col-span-6 space-y-4">
                    <!-- Main Large Image View -->
                    <div class="relative rounded-3xl overflow-hidden bg-zinc-100 border border-zinc-200 shadow-xl aspect-[4/3] group">
                        <img :src="selectedImage" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-500">
                        
                        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                            @if(!empty($product->badges))
                                @foreach($product->badges as $badge)
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-600 text-white shadow-md">
                                        {{ $badge }}
                                    </span>
                                @endforeach
                            @endif
                        </div>

                        <div class="absolute bottom-4 right-4 bg-red-600 px-3.5 py-1.5 rounded-lg text-xs text-white font-bold">
                            Buguruni Malapa Cured
                        </div>
                    </div>

                    <!-- Thumbnails row -->
                    @if($product->images->count() > 1)
                        <div class="flex items-center gap-3 overflow-x-auto pb-2">
                            @foreach($product->images as $img)
                                <button type="button" 
                                        @click="selectedImage = '{{ asset($img->image_path) }}'"
                                        class="w-20 h-20 rounded-xl overflow-hidden border-2 transition flex-shrink-0"
                                        :class="selectedImage === '{{ asset($img->image_path) }}' ? 'border-brand-red ring-2 ring-brand-red/30' : 'border-zinc-200 opacity-70 hover:opacity-100'">
                                    <img src="{{ asset($img->image_path) }}" alt="{{ $img->alt_text }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right: Product Purchase & Attributes Panel -->
                <div class="lg:col-span-6 space-y-6">
                    
                    <!-- Header info -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs uppercase tracking-widest text-brand-red font-black">
                                {{ $product->category->name }}
                            </span>
                            <span class="text-xs text-emerald-600 font-bold flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Fresh Batch in Stock (Buguruni Malapa)
                            </span>
                        </div>

                        <h1 class="font-editorial text-3xl sm:text-4xl lg:text-5xl font-black text-zinc-900">
                            {{ $product->name }}
                        </h1>

                        <div class="flex items-center gap-4 text-xs text-zinc-500 font-medium">
                            <span>SKU: <strong class="text-zinc-900">{{ $product->sku }}</strong></span>
                            <span>•</span>
                            <span>Pack Size: <strong class="text-zinc-900">{{ $product->pack_size }}</strong></span>
                            <span>•</span>
                            <span>100% Halal Certified</span>
                        </div>
                    </div>

                    <!-- Price Block -->
                    <div class="p-5 rounded-2xl bg-zinc-50 border border-zinc-200 flex items-baseline justify-between">
                        <div>
                            <span class="text-xs text-zinc-500 block font-semibold">Unit Price</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl sm:text-4xl font-black text-brand-red" x-text="singleFormattedPrice"></span>
                                @if($product->promo_price)
                                    <span class="text-sm text-zinc-500 line-through">
                                        TZS {{ number_format($product->price, 0) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <span class="text-xs text-brand-red font-bold uppercase tracking-wider bg-white px-3 py-1.5 rounded-lg border border-zinc-200">
                            Grass-Fed Beef
                        </span>
                    </div>

                    <!-- Short Description -->
                    <p class="text-sm text-zinc-700 leading-relaxed">
                        {{ $product->short_description }}
                    </p>

                    <!-- Weight / Pack Size Selector -->
                    @if(!empty($product->weight_options))
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                                Select Pack Size / Weight:
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                                <template x-for="opt in weightOptions" :key="opt.weight">
                                    <button type="button" 
                                            @click="selectWeight(opt)"
                                            class="p-3 rounded-xl border text-center transition flex flex-col items-center justify-center gap-1"
                                            :class="selectedWeight === opt.weight 
                                                ? 'bg-red-600 text-white border-brand-red shadow-md font-bold' 
                                                : 'bg-white border-zinc-300 text-zinc-800 hover:border-zinc-500'">
                                        <span class="text-xs font-bold" x-text="opt.weight"></span>
                                        <span class="text-[11px]" :class="selectedWeight === opt.weight ? 'text-white/90' : 'text-zinc-500'" x-text="'TZS ' + Number(opt.price).toLocaleString()"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    @endif

                    <!-- Quantity Stepper & CTAs -->
                    <div class="space-y-4 pt-2">
                        <div class="flex items-center gap-4">
                            <!-- Stepper -->
                            <div class="flex items-center border border-zinc-300 rounded-xl bg-zinc-50 p-1">
                                <button type="button" 
                                        @click="if(quantity > 1) quantity--" 
                                        class="w-10 h-10 flex items-center justify-center text-zinc-600 hover:text-black font-black text-lg">
                                    −
                                </button>
                                <span class="w-10 text-center font-bold text-zinc-900 text-sm" x-text="quantity"></span>
                                <button type="button" 
                                        @click="quantity++" 
                                        class="w-10 h-10 flex items-center justify-center text-zinc-600 hover:text-black font-black text-lg">
                                    +
                                </button>
                            </div>

                            <!-- Add to Bag Button (Vibrant Red) -->
                            <button type="button"
                                    @click="$store.cart.addItem({
                                        id: {{ $product->id }},
                                        name: '{{ addslashes($product->name) }}',
                                        slug: '{{ $product->slug }}',
                                        image: selectedImage,
                                        pack_size: selectedWeight,
                                        price: currentPrice,
                                        quantity: quantity
                                    })"
                                    class="flex-1 py-4 px-6 rounded-xl bg-red-600 hover:bg-red-600-dark text-white font-black text-sm uppercase tracking-wider hover:shadow-xl transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                <span>Add to Cart &bull; <span x-text="formattedPrice"></span></span>
                            </button>
                        </div>

                        <!-- Direct WhatsApp Instant Order Button -->
                        <div>
                            <button type="button" 
                                    @click="window.open(getWhatsAppOrderUrl(), '_blank')"
                                    class="w-full py-3.5 px-6 rounded-xl bg-zinc-900 hover:bg-zinc-800 text-white font-bold text-xs uppercase tracking-wider transition flex items-center justify-center gap-2.5">
                                <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                <span>1-Click Order via WhatsApp (+255 682 869 629)</span>
                            </button>
                        </div>
                    </div>

                    <!-- Dispatch Assurance -->
                    <div class="grid grid-cols-2 gap-3 pt-4 border-t border-zinc-200 text-xs text-zinc-600 font-medium">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-brand-red flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Dar Express Same-Day Dispatch</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-brand-red flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Pickup at Buguruni Malapa</span>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Detailed Tabs: Full Narrative, Nutritional Panel, Ingredients, Storage -->
            <div class="mt-20 pt-12 border-t border-zinc-200" x-data="{ activeTab: 'nutrition' }">
                <!-- Tab Buttons -->
                <div class="flex flex-wrap items-center gap-3 border-b border-zinc-200 pb-4">
                    <button type="button" @click="activeTab = 'nutrition'" 
                            class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition"
                            :class="activeTab === 'nutrition' ? 'bg-red-600 text-white shadow-md' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200'">
                        Nutritional Facts
                    </button>
                    <button type="button" @click="activeTab = 'ingredients'" 
                            class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition"
                            :class="activeTab === 'ingredients' ? 'bg-red-600 text-white shadow-md' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200'">
                        Ingredients & Marinade
                    </button>
                    <button type="button" @click="activeTab = 'story'" 
                            class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition"
                            :class="activeTab === 'story' ? 'bg-red-600 text-white shadow-md' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200'">
                        Butcher’s Description
                    </button>
                    <button type="button" @click="activeTab = 'storage'" 
                            class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition"
                            :class="activeTab === 'storage' ? 'bg-red-600 text-white shadow-md' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200'">
                        Storage & Freshness
                    </button>
                </div>

                <!-- Tab 1: Nutritional Breakdown Table -->
                <div x-show="activeTab === 'nutrition'" class="py-8 max-w-3xl space-y-6">
                    <div>
                        <h3 class="font-editorial text-2xl font-bold text-zinc-900">Nutritional Information (Per 100g)</h3>
                        <p class="text-xs text-zinc-500 mt-1">High protein dried beef cured naturally without artificial bulking agents.</p>
                    </div>

                    <div class="rounded-2xl bg-zinc-50 border border-zinc-200 overflow-hidden">
                        <table class="w-full text-left text-xs sm:text-sm">
                            <tbody class="divide-y divide-zinc-200">
                                @if(!empty($product->nutritional_info))
                                    @foreach($product->nutritional_info as $label => $val)
                                        <tr class="hover:bg-zinc-100 transition">
                                            <td class="py-3.5 px-6 font-semibold text-zinc-800 capitalize">
                                                {{ str_replace('_', ' ', $label) }}
                                            </td>
                                            <td class="py-3.5 px-6 text-brand-red font-black text-right">
                                                {{ $val }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab 2: Ingredients -->
                <div x-show="activeTab === 'ingredients'" class="py-8 max-w-3xl space-y-4" style="display: none;">
                    <h3 class="font-editorial text-2xl font-bold text-zinc-900">Natural Ingredients</h3>
                    <div class="p-6 rounded-2xl bg-zinc-50 border border-zinc-200 space-y-3">
                        <p class="text-sm text-zinc-800 leading-relaxed font-mono">
                            {{ $product->ingredients ?? 'Selected Tanzanian Pasture Beef, Cider Vinegar, Coarse Sea Salt, Toasted Whole Coriander, Cracked Black Pepper, Brown Cane Sugar, Natural Spices.' }}
                        </p>
                        <div class="pt-3 border-t border-zinc-200 text-xs text-zinc-600 space-y-1">
                            <p>&bull; <strong>No artificial preservatives</strong>: Free of sodium nitrites, potassium sorbate, and MSG.</p>
                            <p>&bull; <strong>Halal compliance</strong>: 100% Halal certified cattle and slaughter methods.</p>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Description -->
                <div x-show="activeTab === 'story'" class="py-8 max-w-3xl space-y-4 text-sm text-zinc-700 leading-relaxed" style="display: none;">
                    <h3 class="font-editorial text-2xl font-bold text-zinc-900">About This Cut</h3>
                    <div class="whitespace-pre-line space-y-4">
                        {{ $product->description }}
                    </div>
                </div>

                <!-- Tab 4: Storage -->
                <div x-show="activeTab === 'storage'" class="py-8 max-w-3xl space-y-4" style="display: none;">
                    <h3 class="font-editorial text-2xl font-bold text-zinc-900">Storage & Freshness Care</h3>
                    <div class="p-6 rounded-2xl bg-zinc-50 border border-zinc-200 text-xs sm:text-sm text-zinc-700 space-y-3">
                        <p>{{ $product->storage_instructions ?? 'Store in a cool, dry pantry away from direct sunlight. Once opened, consume within 4 days or keep in an airtight container or refrigerated.' }}</p>
                        <p class="text-xs text-zinc-500">Because our biltong contains no chemical antimycotics, do not leave open bags in high-humidity tropical conditions.</p>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if(isset($relatedProducts) && $relatedProducts->count() > 0)
                <div class="mt-20 pt-16 border-t border-zinc-200">
                    <h3 class="font-editorial text-2xl sm:text-3xl font-bold text-zinc-900 mb-8">
                        More from the Butcher’s Range
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($relatedProducts as $rel)
                            <div class="p-4 rounded-2xl bg-zinc-50 border border-zinc-200 hover:border-brand-red transition flex items-center gap-4">
                                <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="w-16 h-16 rounded-xl object-cover bg-zinc-200 flex-shrink-0">
                                <div class="flex-1 overflow-hidden">
                                    <h4 class="font-bold text-zinc-900 text-sm truncate hover:text-brand-red">
                                        <a href="{{ route('product.show', $rel->slug) }}">{{ $rel->name }}</a>
                                    </h4>
                                    <span class="text-xs text-brand-red font-black">{{ $rel->formatted_price }}</span>
                                    <span class="text-[10px] text-zinc-500 block">Pack: {{ $rel->pack_size }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

@endsection
