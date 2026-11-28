@extends('layouts.app')

@section('title', 'Menu | Complete House Collection')
@section('meta_description', 'Browse our complete delicious menu: Burger House Special, Double Cheese Burgers, BBQ Bacon, Chicken Avocado, and Hot Deals Combos in Tanzanian Shillings.')

@section('content')

<!-- Header Banner -->
<div class="max-w-5xl mx-auto px-4 sm:px-6 pt-3 sm:pt-4 pb-3">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-[#E52E2E]">Burger House Menu</span>
            <h1 class="text-2xl sm:text-3xl font-black text-[#1E1E1E] mt-0.5">Explore Our Full Menu</h1>
            <p class="text-xs text-stone-500 mt-0.5">Served fresh from the kitchen with golden crisp fries and ice-cold drinks! All prices in Tshs.</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('order') }}" class="px-5 py-2.5 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] text-white text-xs font-bold shadow-md shadow-red-500/25 transition flex items-center gap-2 border border-white/30">
                <span>Start Order</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 pb-12 space-y-8"
     x-data="{
         selectedCategory: 'all',
         viewMode: 'scroll',
         matchesCategory(categorySlug) {
             if (this.selectedCategory === 'all') return true;
             if (!categorySlug) return false;
             return categorySlug === this.selectedCategory || categorySlug.includes(this.selectedCategory);
         },
         scrollLeft() {
             this.$refs.collectionScroller.scrollBy({ left: -320, behavior: 'smooth' });
         },
         scrollRight() {
             this.$refs.collectionScroller.scrollBy({ left: 320, behavior: 'smooth' });
         }
     }">

    <!-- Filter Category Pills with Classic Modified Borders -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
        <button type="button" 
                @click="selectedCategory = 'all'" 
                :class="selectedCategory === 'all' ? 'bg-[#E52E2E] text-white shadow-xs border-2 border-red-600/30' : 'bg-white border-2 border-stone-200/90 text-stone-700 hover:border-[#E52E2E]'" 
                class="px-5 py-2 rounded-full text-xs font-bold transition whitespace-nowrap">
            All Items
        </button>
        
        @if(isset($categories) && $categories->count() > 0)
            @foreach($categories as $cat)
                <button type="button" 
                        @click="selectedCategory = '{{ $cat->slug }}'" 
                        :class="selectedCategory === '{{ $cat->slug }}' ? 'bg-[#E52E2E] text-white shadow-xs border-2 border-red-600/30' : 'bg-white border-2 border-stone-200/90 text-stone-700 hover:border-[#E52E2E]'" 
                        class="px-5 py-2 rounded-full text-xs font-bold transition whitespace-nowrap">
                    {{ $cat->name }}
                </button>
            @endforeach
        @endif
    </div>

    <!-- =========================================================================
         COMPLETE HOUSE COLLECTION (Scrollable Showcase with Classic Modified Borders)
         ========================================================================= -->
    <div>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-[#1E1E1E] flex items-center gap-2">
                    <span>Complete House Collection</span>
                    <span class="w-2.5 h-2.5 rounded-full bg-[#E52E2E]"></span>
                </h2>
                <p class="text-xs text-stone-500 mt-0.5">Scroll horizontally through our complete menu. All prices in Tshs.</p>
            </div>

            <!-- View controls: Left/Right Arrow buttons & Grid Toggle -->
            <div class="flex items-center gap-2">
                <!-- Grid / Carousel Toggle -->
                <button type="button"
                        @click="viewMode = (viewMode === 'scroll' ? 'grid' : 'scroll')"
                        class="px-3.5 py-1.5 rounded-full bg-white border-2 border-stone-200/90 text-stone-700 text-xs font-bold hover:border-[#E52E2E] transition flex items-center gap-1.5 shadow-2xs">
                    <template x-if="viewMode === 'scroll'">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#E52E2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            <span>Show Grid</span>
                        </span>
                    </template>
                    <template x-if="viewMode === 'grid'">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#E52E2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                            <span>Show Scrollable</span>
                        </span>
                    </template>
                </button>

                <!-- Scroll Buttons (Visible in scroll mode) -->
                <div x-show="viewMode === 'scroll'" class="flex items-center gap-1.5">
                    <button type="button" 
                            @click="scrollLeft()" 
                            class="w-9 h-9 rounded-full bg-white hover:bg-[#E52E2E] text-stone-700 hover:text-white border-2 border-stone-200/90 hover:border-[#E52E2E] flex items-center justify-center transition shadow-2xs group"
                            title="Scroll left">
                        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button type="button" 
                            @click="scrollRight()" 
                            class="w-9 h-9 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] text-white border-2 border-red-600/30 flex items-center justify-center transition shadow-2xs group"
                            title="Scroll right">
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>

        @php
            $displayProducts = isset($products) ? $products : collect();
        @endphp

        <!-- 1. Scrollable Showcase (Horizontal Row with Snap & Classic Borders) -->
        <div x-show="viewMode === 'scroll'" 
             x-ref="collectionScroller"
             class="flex items-stretch gap-4 overflow-x-auto pb-4 pt-1 px-1 scroll-smooth snap-x snap-mandatory scrollbar-thin scrollbar-thumb-orange-300 scrollbar-track-orange-50 -mx-4 px-4 sm:mx-0 sm:px-1">
            
            @forelse($displayProducts as $product)
                <div x-show="matchesCategory('{{ $product->category?->slug }}')" 
                     class="flex-none w-[265px] sm:w-[285px] snap-start bg-white rounded-2xl p-4 shadow-xs border-2 border-stone-200/85 hover:border-[#E52E2E]/70 relative flex flex-col justify-between group hover:shadow-md transition-all duration-300">
                    
                    @if(!empty($product->badges) && is_array($product->badges))
                        <div class="absolute -top-3 right-3 bg-[#E52E2E] text-white text-[9px] font-extrabold px-2.5 py-0.5 rounded-full shadow-xs border border-white/60">
                            {{ $product->badges[0] }}
                        </div>
                    @elseif($product->is_featured)
                        <div class="absolute -top-3 right-3 bg-[#E52E2E] text-white text-[9px] font-extrabold px-2.5 py-0.5 rounded-full shadow-xs border border-white/60">
                            Featured
                        </div>
                    @endif

                    <div>
                        <div class="w-full h-36 rounded-xl overflow-hidden bg-stone-50 mb-3 border border-stone-200/70 relative">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @if($product->category)
                                <span class="absolute bottom-2 left-2 px-2 py-0.5 rounded-md text-[9px] font-bold bg-[#1E1E1E]/80 text-white backdrop-blur-xs">
                                    {{ $product->category->name }}
                                </span>
                            @endif
                        </div>
                        <h3 class="font-bold text-sm text-[#1E1E1E] truncate">{{ $product->name }}</h3>
                        <p class="text-[11px] text-stone-500 mt-1 leading-snug line-clamp-2">
                            {{ $product->short_description ?? 'Handcrafted fresh gourmet burger prepared with love and premium ingredients.' }}
                        </p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-stone-200/70 flex items-center justify-between">
                        <div>
                            <span class="font-black text-sm text-[#1E1E1E] block">{{ $product->formatted_price }}</span>
                            @if($product->is_on_sale)
                                <span class="text-[10px] text-stone-400 line-through block">{{ $product->formatted_regular_price }}</span>
                            @endif
                        </div>
                        <button type="button" 
                                @click="addToCart({{ $product->id }}, null, null, 1)"
                                class="px-3.5 py-1.5 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] text-white text-xs font-bold transition shadow-xs border border-red-400 flex items-center gap-1">
                            <span>+ Add</span>
                        </button>
                    </div>
                </div>
            @empty
                <div class="w-full py-8 text-center text-stone-500 text-xs">
                    No menu items available right now. Please check back shortly!
                </div>
            @endforelse
        </div>

        <!-- 2. Grid View (Toggled when user clicks 'Show Grid') -->
        <div x-show="viewMode === 'grid'" 
             class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-1">
            @foreach($displayProducts as $product)
                <div x-show="matchesCategory('{{ $product->category?->slug }}')" 
                     class="bg-white rounded-2xl p-4 shadow-xs border-2 border-stone-200/85 hover:border-[#E52E2E]/70 relative flex flex-col justify-between group hover:shadow-md transition-all duration-300">
                    
                    @if(!empty($product->badges) && is_array($product->badges))
                        <div class="absolute -top-3 right-3 bg-[#E52E2E] text-white text-[9px] font-extrabold px-2.5 py-0.5 rounded-full shadow-xs border border-white/60">
                            {{ $product->badges[0] }}
                        </div>
                    @elseif($product->is_featured)
                        <div class="absolute -top-3 right-3 bg-[#E52E2E] text-white text-[9px] font-extrabold px-2.5 py-0.5 rounded-full shadow-xs border border-white/60">
                            Featured
                        </div>
                    @endif

                    <div>
                        <div class="w-full h-32 rounded-xl overflow-hidden bg-stone-50 mb-3 border border-stone-200/70 relative">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @if($product->category)
                                <span class="absolute bottom-2 left-2 px-2 py-0.5 rounded-md text-[9px] font-bold bg-[#1E1E1E]/80 text-white backdrop-blur-xs">
                                    {{ $product->category->name }}
                                </span>
                            @endif
                        </div>
                        <h3 class="font-bold text-sm text-[#1E1E1E] truncate">{{ $product->name }}</h3>
                        <p class="text-[11px] text-stone-500 mt-1 leading-snug line-clamp-2">
                            {{ $product->short_description ?? 'Handcrafted fresh gourmet burger prepared with love and premium ingredients.' }}
                        </p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-stone-200/70 flex items-center justify-between">
                        <div>
                            <span class="font-black text-sm text-[#1E1E1E] block">{{ $product->formatted_price }}</span>
                            @if($product->is_on_sale)
                                <span class="text-[10px] text-stone-400 line-through block">{{ $product->formatted_regular_price }}</span>
                            @endif
                        </div>
                        <button type="button" 
                                @click="addToCart({{ $product->id }}, null, null, 1)"
                                class="px-3.5 py-1.5 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] text-white text-xs font-bold transition shadow-xs border border-red-400 flex items-center gap-1">
                            <span>+ Add</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <!-- =========================================================================
         HOT DEALS COMBO SPOTLIGHT BANNER (Prices in Tshs with Classic Modified Border)
         ========================================================================= -->
    @php
        $comboPack = \App\Models\Product::where('slug', 'super-burger-fries-combo-pack')->first()
            ?? \App\Models\Product::whereHas('category', fn($q) => $q->where('slug', 'hot-deals-combos'))->first();
    @endphp
    <div x-show="selectedCategory === 'all' || selectedCategory === 'hot-deals-combos' || selectedCategory === 'combos'" 
         class="bg-gradient-to-b from-[#FFF5EE] via-[#FFF8F2] to-[#FFF0E6] rounded-3xl p-6 sm:p-8 border-2 border-red-200/90 shadow-sm ring-4 ring-red-100/40">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
            <div class="md:col-span-7 space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white text-[#D32F2F] text-[10px] font-black border-2 border-red-200 shadow-xs">
                    <span>★ Free Delivery Included</span>
                </div>
                <h3 class="text-2xl sm:text-3xl font-black text-[#1E1E1E]">
                    {{ $comboPack ? $comboPack->name : 'Super Burger & Fries Combo Pack' }}
                </h3>
                <p class="text-xs sm:text-sm text-stone-600 leading-relaxed">
                    {{ $comboPack ? $comboPack->short_description : 'Includes Double Gourmet Beef Burger, large carton of golden crispy fries, and your choice of chilled soda with ice.' }}
                </p>
                <div class="pt-2 flex items-center gap-4">
                    <span class="text-2xl font-black text-[#E52E2E]">
                        {{ $comboPack ? $comboPack->formatted_price : 'Tshs 30,000' }}
                    </span>
                    <button type="button" 
                            @click="addToCart({{ $comboPack ? $comboPack->id : 1 }}, null, null, 1)"
                            class="px-6 py-2.5 rounded-full bg-[#D32F2F] hover:bg-red-700 text-white font-bold text-xs shadow-md border border-red-400 transition">
                        Order Combo Pack
                    </button>
                </div>
            </div>
            <div class="md:col-span-5 flex justify-center">
                <div class="w-full max-w-xs rounded-2xl overflow-hidden shadow-lg border-2 border-white ring-2 ring-red-200/50">
                    <img src="{{ $comboPack ? $comboPack->image_url : asset('images/burger-house/hot-deals-combo.jpg') }}" alt="Super Combo Pack" class="w-full h-48 object-cover">
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
