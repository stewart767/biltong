@extends('layouts.app')

@section('title', 'INAS Premium Beef Biltong | Crave It. Order It. Get It Fast! | Dar es Salaam')

@section('content')

    @php
        $heroSlides = [
            [
                'image' => asset(\App\Models\SiteSetting::get('hero_slide_1_image', 'images/hero-biltong.jpg')),
                'tag' => \App\Models\SiteSetting::get('hero_slide_1_tag', 'SIGNATURE 100G'),
                'dishName' => \App\Models\SiteSetting::get('hero_slide_1_title', 'Biltong Original 100g'),
                'dishSub' => \App\Models\SiteSetting::get('hero_slide_1_sub', '100% pasture-grazed Tanzanian beef'),
                'dishPrice' => \App\Models\SiteSetting::get('hero_slide_1_price', 'TZS 10,000'),
                'dishLink' => \App\Models\SiteSetting::get('hero_slide_1_link', route('shop')),
            ],
            [
                'image' => asset(\App\Models\SiteSetting::get('hero_slide_2_image', 'images/chilli-biltong.jpg')),
                'tag' => \App\Models\SiteSetting::get('hero_slide_2_tag', 'SPICY PERI-PERI'),
                'dishName' => \App\Models\SiteSetting::get('hero_slide_2_title', 'Chilli Biltong Bites'),
                'dishSub' => \App\Models\SiteSetting::get('hero_slide_2_sub', 'Warm lingering spice kick'),
                'dishPrice' => \App\Models\SiteSetting::get('hero_slide_2_price', 'TZS 11,000'),
                'dishLink' => \App\Models\SiteSetting::get('hero_slide_2_link', route('shop')),
            ],
            [
                'image' => asset(\App\Models\SiteSetting::get('hero_slide_3_image', 'images/droewors.jpg')),
                'tag' => \App\Models\SiteSetting::get('hero_slide_3_tag', 'AIR-DRIED SAUSAGE'),
                'dishName' => \App\Models\SiteSetting::get('hero_slide_3_title', 'Traditional Droëwors'),
                'dishSub' => \App\Models\SiteSetting::get('hero_slide_3_sub', 'Spiced beef & roasted coriander'),
                'dishPrice' => \App\Models\SiteSetting::get('hero_slide_3_price', 'TZS 12,000'),
                'dishLink' => \App\Models\SiteSetting::get('hero_slide_3_link', route('shop')),
            ],
            [
                'image' => asset(\App\Models\SiteSetting::get('hero_slide_4_image', 'images/carvers-slab.jpg')),
                'tag' => \App\Models\SiteSetting::get('hero_slide_4_tag', 'CHEF SPECIAL'),
                'dishName' => \App\Models\SiteSetting::get('hero_slide_4_title', 'Carvers Whole Slab'),
                'dishSub' => \App\Models\SiteSetting::get('hero_slide_4_sub', 'Prime dry-aged whole beef slab'),
                'dishPrice' => \App\Models\SiteSetting::get('hero_slide_4_price', 'TZS 24,000'),
                'dishLink' => \App\Models\SiteSetting::get('hero_slide_4_link', route('shop')),
            ],
        ];

        $testimonials = [
            [
                'name' => 'Amina Hassan',
                'role' => 'Masaki, Dar es Salaam',
                'quote' => 'Amazing biltong, super fast delivery in Dar, and always fresh! My go-to place for high-protein beef snacks.',
                'avatar' => asset('images/hero-biltong.jpg'),
            ],
            [
                'name' => 'David Mushi',
                'role' => 'Mikocheni, Dar es Salaam',
                'quote' => 'The Chilli Biltong Bites have the perfect heat and authentic toasted coriander crunch. Unmatched quality.',
                'avatar' => asset('images/chilli-biltong.jpg'),
            ],
            [
                'name' => 'Sarah Kimaro',
                'role' => 'Oysterbay, Dar es Salaam',
                'quote' => 'We stock INAS 10-packs for our office pantry every week. Zero preservatives, 100% Halal, and everyone loves it.',
                'avatar' => asset('images/droewors.jpg'),
            ],
        ];
    @endphp

    <!-- 1. HERO SECTION (FastBite Layout in Red, White & Cream) -->
    <section class="rounded-[32px] bg-gradient-to-br from-[#FAF5EE] via-[#FFFDF9] to-[#F6E4DE]/60 border border-[#E8DDD0] p-6 sm:p-10 lg:p-14 relative overflow-hidden shadow-sm"
             x-data="{
                 activeSlide: 0,
                 timer: null,
                 slides: {{ \Illuminate\Support\Js::from($heroSlides) }},
                 next() {
                     this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                 },
                 prev() {
                     this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
                 },
                 start() {
                     this.stop();
                     this.timer = setInterval(() => { this.next() }, 4500);
                 },
                 stop() {
                     if (this.timer) {
                         clearInterval(this.timer);
                         this.timer = null;
                     }
                 }
             }"
             x-init="start()"
             @mouseenter="stop()"
             @mouseleave="start()">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
            
            <!-- Hero Left: Stacked Bold Headline, CTAs & Inline Feature Badges -->
            <div class="lg:col-span-6 space-y-6 text-left z-10">
                
                <!-- Pill Tag -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-red-200 text-red-600 text-xs font-extrabold tracking-wide shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-red-600 animate-pulse"></span>
                    <span>
                        @if(app()->getLocale() === 'sw')
                            Tafuna nyama, Kula maisha! • Est. 2016
                        @else
                            {{ \App\Models\SiteSetting::get('hero_badge', 'Est. 2016 • Tafuna nyama, Kula maisha!') }}
                        @endif
                    </span>
                </div>

                <!-- 3-Line Bold Stacked Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-[54px] font-black text-zinc-900 tracking-tight leading-[1.06]">
                    @if(app()->getLocale() === 'sw')
                        <span class="block">NYAMA HALISI.</span>
                        <span class="block">LADHA HALISI.</span>
                        <span class="block text-red-600 relative inline-block">
                            PATA HARAKA!
                            <svg class="w-full h-3 text-red-500/40 -mt-1" viewBox="0 0 200 12" fill="none"><path d="M2 9C60 2 140 2 198 9" stroke="currentColor" stroke-width="4" stroke-linecap="round"/></svg>
                        </span>
                    @else
                        @php
                            $headline = \App\Models\SiteSetting::get('hero_headline', 'REAL BEEF. REAL FLAVOUR. Delivered Fast!');
                            $parts = preg_split('/(?<=[.!])\s+/', trim($headline), -1, PREG_SPLIT_NO_EMPTY);
                        @endphp
                        @if(count($parts) >= 3)
                            <span class="block">{{ $parts[0] }}</span>
                            <span class="block">{{ $parts[1] }}</span>
                            <span class="block text-red-600 relative inline-block">
                                {{ implode(' ', array_slice($parts, 2)) }}
                                <svg class="w-full h-3 text-red-500/35 -mt-1" viewBox="0 0 200 12" fill="none"><path d="M2 9C60 2 140 2 198 9" stroke="currentColor" stroke-width="4" stroke-linecap="round"/></svg>
                            </span>
                        @elseif(count($parts) === 2)
                            <span class="block">{{ $parts[0] }}</span>
                            <span class="block text-red-600 relative inline-block">
                                {{ $parts[1] }}
                                <svg class="w-full h-3 text-red-500/35 -mt-1" viewBox="0 0 200 12" fill="none"><path d="M2 9C60 2 140 2 198 9" stroke="currentColor" stroke-width="4" stroke-linecap="round"/></svg>
                            </span>
                        @else
                            <span class="block">{{ $headline }}</span>
                        @endif
                    @endif
                </h1>

                <!-- Subtitle -->
                <p class="text-zinc-600 text-sm sm:text-base font-normal max-w-md leading-relaxed">
                    @if(app()->getLocale() === 'sw')
                        Biltong East Africa Corporation (BEAC) — Nyama halisi ya ng'ombe iliyokaushwa kwa saa 72–84 Buguruni Malapa, Dar es Salaam.
                    @else
                        {{ \App\Models\SiteSetting::get('hero_subheadline', 'Biltong East Africa Corporation (BEAC) — 72–84 hour air-cured silverside & topside beef snacks from Dar es Salaam, delivered fast to your doorstep.') }}
                    @endif
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-1">
                    <a href="{{ route('shop') }}" 
                       class="px-7 py-3.5 rounded-full bg-red-600 hover:bg-red-700 text-white font-bold text-xs sm:text-sm shadow-lg shadow-red-600/30 hover:scale-105 transition transform duration-200 flex items-center gap-2 cursor-pointer">
                        <span>{{ app()->getLocale() === 'sw' ? 'Duka la Biltong' : 'Order Online' }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>

                    <a href="{{ route('craft') }}" 
                       class="px-6 py-3.5 rounded-full bg-white hover:bg-[#FAF5EE] text-zinc-800 font-bold text-xs sm:text-sm border border-[#E2D6C8] hover:border-red-300 transition shadow-sm flex items-center gap-2.5">
                        <span class="w-5 h-5 rounded-full border border-red-600 text-red-600 flex items-center justify-center">
                            <svg class="w-2.5 h-2.5 translate-x-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                        <span>{{ app()->getLocale() === 'sw' ? 'Angalia Menyu' : 'Explore Menu' }}</span>
                    </a>
                </div>

                <!-- 3 Inline Mini Feature Badges (FastBite Style) -->
                <div class="pt-4 border-t border-[#E8DDD0]/80 flex flex-wrap items-center gap-5 sm:gap-7 text-xs font-semibold text-zinc-700">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-red-50 text-red-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </span>
                        <span class="leading-tight">{{ \App\Models\SiteSetting::get('badge_1_title', 'Same-Day Delivery') }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-red-50 text-red-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                        </span>
                        <span class="leading-tight">{{ \App\Models\SiteSetting::get('badge_2_title', '100% Pure Beef') }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-red-50 text-red-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <span class="leading-tight">Premium Quality</span>
                    </div>
                </div>

            </div>

            <!-- Hero Right: Glowing Red/Cream Arc + Unconstrained Product Slider -->
            <div class="lg:col-span-6 relative flex items-center justify-center h-[320px] sm:h-[390px] lg:h-[440px]">
                
                <!-- Glowing Circular Red/Cream Arc Behind Product (FastBite Ring) -->
                <div class="absolute w-64 h-64 sm:w-80 sm:h-80 lg:w-[410px] lg:h-[410px] rounded-full border-[3px] border-red-500/45 shadow-[0_0_60px_rgba(220,38,38,0.16)] bg-gradient-to-tr from-red-100/40 via-[#FFF8F2] to-transparent pointer-events-none"></div>

                <!-- Spark Accent Lines (Top-left of Ring) -->
                <svg class="absolute top-6 left-10 sm:left-16 w-10 h-10 text-red-500/70 pointer-events-none hidden sm:block" viewBox="0 0 40 40" fill="none">
                    <path d="M8 28L2 22M14 16L10 6M26 10L28 2" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                </svg>

                <!-- Pre-rendered Unconstrained Product Slides -->
                @foreach($heroSlides as $idx => $s)
                    <div class="absolute inset-0 flex items-center justify-center transition-all duration-700 ease-in-out"
                         :class="activeSlide === {{ $idx }} ? 'opacity-100 scale-100 z-10 pointer-events-auto' : 'opacity-0 scale-95 pointer-events-none z-0'"
                         @if($idx === 0) style="opacity: 1;" @else style="opacity: 0;" @endif>
                        <img src="{{ $s['image'] }}" 
                             alt="{{ $s['dishName'] }}" 
                             class="max-h-[280px] sm:max-h-[340px] lg:max-h-[395px] w-auto max-w-full object-contain filter drop-shadow-[0_22px_30px_rgba(0,0,0,0.2)] hover:scale-105 transition-transform duration-500 rounded-2xl">
                    </div>
                @endforeach

                <!-- Floating Dish Price Pill -->
                <div class="absolute bottom-3 left-2 sm:bottom-6 sm:left-0 z-20 bg-white/95 backdrop-blur-md rounded-2xl px-4 py-3 border border-[#E8DDD0] shadow-xl max-w-[205px] text-left">
                    <div class="text-[10px] font-black uppercase tracking-wider text-red-600" x-text="slides[activeSlide]?.tag">{{ $heroSlides[0]['tag'] }}</div>
                    <h4 class="font-extrabold text-xs sm:text-sm text-zinc-900 truncate" x-text="slides[activeSlide]?.dishName">{{ $heroSlides[0]['dishName'] }}</h4>
                    <div class="mt-0.5 font-black text-xs sm:text-sm text-red-600" x-text="slides[activeSlide]?.dishPrice">{{ $heroSlides[0]['dishPrice'] }}</div>
                </div>

                <!-- Carousel Controls -->
                <div class="absolute bottom-3 right-2 sm:bottom-6 sm:right-0 flex items-center gap-2 z-20">
                    <button @click="prev()" 
                            class="w-8 h-8 rounded-full bg-white hover:bg-red-600 hover:text-white text-zinc-700 flex items-center justify-center shadow-md border border-[#E8DDD0] transition cursor-pointer"
                            aria-label="Previous">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button @click="next()" 
                            class="w-8 h-8 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-md transition cursor-pointer"
                            aria-label="Next">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>

            </div>

        </div>
    </section>


    <!-- 2. HORIZONTAL CATEGORY BAR (FastBite Clean Category Strip) -->
    <section class="-mt-4 relative z-20 px-2 sm:px-6">
        <div class="bg-white rounded-3xl border border-[#E8DDD0] shadow-lg p-3 sm:p-4">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                @forelse($categories as $index => $category)
                    <a href="{{ route('shop', ['category' => $category->slug]) }}" 
                       class="group flex flex-col items-center justify-center text-center p-3.5 rounded-2xl transition-all duration-200 {{ $index === 0 ? 'border-2 border-red-600 bg-[#FFF5F5] shadow-sm' : 'border border-transparent hover:border-red-300 hover:bg-[#FAF5EE]' }}">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl overflow-hidden mb-2.5 shadow-sm group-hover:scale-105 transition duration-300 bg-[#FAF5EE]">
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                        </div>
                        <span class="font-extrabold text-xs sm:text-sm {{ $index === 0 ? 'text-red-600' : 'text-zinc-800 group-hover:text-red-600' }} transition">
                            {{ $category->name }}
                        </span>
                    </a>
                @empty
                    <a href="{{ route('shop') }}" class="flex flex-col items-center justify-center text-center p-3.5 rounded-2xl border-2 border-red-600 bg-[#FFF5F5]">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden mb-2.5">
                            <img src="{{ asset('images/biltong-original-1.jpg') }}" alt="Traditional" class="w-full h-full object-cover">
                        </div>
                        <span class="font-extrabold text-xs sm:text-sm text-red-600">Traditional Biltong</span>
                    </a>
                @endforelse
            </div>
        </div>
    </section>


    <!-- 3. SPECIAL COMBO DEALS / FEATURED CUTS (FastBite Left Intro + 3 White Cards) -->
    <section class="mt-10 rounded-[32px] bg-[#F4ECE1]/90 border border-[#E8DDD0] p-6 sm:p-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left Column: Intro & CTA -->
            <div class="lg:col-span-3 space-y-4 text-left">
                <span class="inline-block px-3.5 py-1 rounded-full bg-red-600 text-white text-[11px] font-extrabold uppercase tracking-wider shadow-xs">
                    {{ app()->getLocale() === 'sw' ? 'Wiki Hii Tu' : 'This Week Only' }}
                </span>

                <h2 class="text-3xl sm:text-4xl font-black text-zinc-900 leading-[1.1] tracking-tight">
                    {{ app()->getLocale() === 'sw' ? 'Ofa Maalum za Biltong' : 'Best Beef' }}<br>
                    <span class="text-red-600">{{ app()->getLocale() === 'sw' ? 'Na Punguzo' : 'Biltong Bites' }}</span>
                </h2>

                <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed">
                    {{ app()->getLocale() === 'sw' ? 'Okoa zaidi na pakiti zetu bora za nyama iliyokaushwa.' : 'Save more with our handcrafted biltong packs & combo offers!' }}
                </p>

                <div class="pt-1">
                    <a href="{{ route('shop') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-md shadow-red-600/25 transition transform hover:scale-105">
                        <span>{{ app()->getLocale() === 'sw' ? 'Angalia Ofa Zote' : 'View All Deals' }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Right Columns: 3 Crisp White Product Cards -->
            <div class="lg:col-span-9 grid grid-cols-1 sm:grid-cols-3 gap-5">
                @forelse($featuredProducts->take(3) as $pIndex => $product)
                    <div class="bg-white rounded-3xl p-5 border border-[#E8DDD0] shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group relative">
                        
                        <!-- Top Badge (Save % or Most Popular) -->
                        <div class="mb-3">
                            @if($product->promo_price && $product->promo_price < $product->price)
                                <span class="inline-block px-3 py-1 rounded-full text-[11px] font-extrabold bg-red-600 text-white">
                                    Save {{ round((($product->price - $product->promo_price) / $product->price) * 100) }}%
                                </span>
                            @elseif($pIndex === 1)
                                <span class="inline-block px-3 py-1 rounded-full text-[11px] font-extrabold bg-amber-100 text-red-700 border border-amber-300">
                                    ★ Most Popular
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 rounded-full text-[11px] font-extrabold bg-red-600 text-white">
                                    Best Seller
                                </span>
                            @endif
                        </div>

                        <!-- Product Image -->
                        <a href="{{ route('product.show', $product->slug) }}" class="block h-36 sm:h-40 rounded-2xl overflow-hidden bg-[#FAF5EE] mb-4">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </a>

                        <!-- Product Info -->
                        <div class="space-y-1 text-left">
                            <a href="{{ route('product.show', $product->slug) }}">
                                <h3 class="font-extrabold text-base text-zinc-900 group-hover:text-red-600 transition truncate">
                                    {{ $product->name }}
                                </h3>
                            </a>
                            <p class="text-xs text-zinc-500 truncate">
                                {{ $product->short_description ?? ($product->category ? $product->category->name : '100% Pure Tanzanian Beef') }}
                            </p>
                        </div>

                        <!-- Price + Add (+) Button -->
                        <div class="pt-4 mt-3 border-t border-stone-100 flex items-center justify-between">
                            <div class="flex items-baseline gap-2">
                                <span class="font-black text-base text-red-600">{{ $product->formatted_price }}</span>
                                @if($product->formatted_original_price)
                                    <span class="line-through text-xs text-zinc-400">{{ $product->formatted_original_price }}</span>
                                @endif
                            </div>

                            <button @click="$store.cart.add({ id: {{ $product->id }}, name: '{{ addslashes($product->name) }}', price: {{ (int)$product->effective_price }}, weight: '{{ $product->pack_size ?? '100g' }}', image: '{{ $product->image_url }}', quantity: 1 })"
                                    class="w-9 h-9 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-md shadow-red-600/30 transition transform hover:scale-110 cursor-pointer"
                                    aria-label="Add to cart">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-10 text-center text-zinc-500">
                        No products available yet.
                    </div>
                @endforelse
            </div>

        </div>
    </section>


    <!-- 4. FAST & RELIABLE DELIVERY BANNER (Crisp White Split Card) -->
    <section class="mt-10 rounded-[32px] bg-white border border-[#E8DDD0] p-6 sm:p-8 lg:p-10 shadow-sm">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
            
            <!-- Left: Red & Cream Delivery Illustration -->
            <div class="lg:col-span-3 flex items-center justify-center">
                <div class="w-44 h-36 rounded-2xl bg-[#FAF5EE] border border-red-100 flex items-center justify-center p-4">
                    <svg class="w-28 h-28 text-red-600" viewBox="0 0 120 120" fill="none">
                        <!-- Stylized Red & Cream Delivery Scooter -->
                        <circle cx="32" cy="90" r="14" stroke="#18181B" stroke-width="5" fill="#FAF5EE"/>
                        <circle cx="88" cy="90" r="14" stroke="#18181B" stroke-width="5" fill="#FAF5EE"/>
                        <path d="M18 68H48L58 84H86C90 84 94 80 92 74L84 52H68" stroke="#DC2626" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                        <rect x="16" y="42" width="28" height="24" rx="5" fill="#DC2626"/>
                        <path d="M24 54H36M30 48V60" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round"/>
                        <circle cx="72" cy="34" r="9" fill="#DC2626"/>
                        <path d="M58 56L72 44L82 54" stroke="#18181B" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 80H14M6 90H12" stroke="#DC2626" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>

            <!-- Middle: Headline & Description -->
            <div class="lg:col-span-5 text-center lg:text-left space-y-2">
                <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 leading-tight tracking-tight">
                    Fast &amp; Reliable<br>
                    <span class="text-red-600">Biltong Delivery</span>
                </h2>
                <p class="text-xs sm:text-sm text-zinc-600 max-w-md mx-auto lg:mx-0">
                    Freshly sliced and vacuum-sealed in Buguruni Malapa — delivered fast to your home, office, or gym across Dar es Salaam.
                </p>
            </div>

            <!-- Right: 3 Feature Pillars -->
            <div class="lg:col-span-4 grid grid-cols-3 gap-3 text-center">
                <div class="p-3 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] flex flex-col items-center justify-center space-y-1.5">
                    <span class="w-9 h-9 rounded-full bg-white text-red-600 flex items-center justify-center shadow-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <span class="text-[11px] font-bold text-zinc-800 leading-tight">Same-Day<br>Delivery</span>
                </div>

                <div class="p-3 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] flex flex-col items-center justify-center space-y-1.5">
                    <span class="w-9 h-9 rounded-full bg-white text-red-600 flex items-center justify-center shadow-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </span>
                    <span class="text-[11px] font-bold text-zinc-800 leading-tight">WhatsApp<br>Tracking</span>
                </div>

                <div class="p-3 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] flex flex-col items-center justify-center space-y-1.5">
                    <span class="w-9 h-9 rounded-full bg-white text-red-600 flex items-center justify-center shadow-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </span>
                    <span class="text-[11px] font-bold text-zinc-800 leading-tight">100% Halal<br>&amp; Secure</span>
                </div>
            </div>

        </div>
    </section>


    <!-- 5. WHAT OUR CUSTOMERS SAY (Testimonials Carousel in Red, White & Cream) -->
    <section class="mt-10 rounded-[32px] bg-gradient-to-r from-[#F4ECE1] to-[#FAF5EE] border border-[#E8DDD0] p-6 sm:p-10"
             x-data="{
                 activeReview: 0,
                 reviews: {{ \Illuminate\Support\Js::from($testimonials) }},
                 nextReview() {
                     this.activeReview = (this.activeReview + 1) % this.reviews.length;
                 },
                 prevReview() {
                     this.activeReview = (this.activeReview - 1 + this.reviews.length) % this.reviews.length;
                 }
             }">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
            
            <!-- Left Rating Summary -->
            <div class="lg:col-span-4 space-y-2 text-left">
                <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 leading-tight">
                    What Our<br>
                    <span class="text-red-600">Customers Say</span>
                </h2>
                <div class="flex items-center gap-2 pt-1">
                    <span class="text-amber-500 text-base tracking-tight">★★★★★</span>
                    <span class="font-black text-zinc-900 text-sm">4.9/5</span>
                </div>
                <p class="text-xs text-zinc-500 font-medium">
                    {{ \App\Models\SiteSetting::get('social_proof_count', 'from 1,500+ happy customers in Dar es Salaam') }}
                </p>
            </div>

            <!-- Middle Testimonial Card -->
            <div class="lg:col-span-6">
                <div class="bg-white rounded-2xl p-6 border border-red-100 shadow-md flex items-start gap-4">
                    <img :src="reviews[activeReview].avatar" 
                         :alt="reviews[activeReview].name" 
                         class="w-14 h-14 rounded-full object-cover border-2 border-red-100 flex-shrink-0">
                    <div class="space-y-2 text-left">
                        <p class="text-xs sm:text-sm text-zinc-700 leading-relaxed italic">
                            <span class="text-red-600 font-black text-lg leading-none mr-1">“</span>
                            <span x-text="reviews[activeReview].quote"></span>
                        </p>
                        <div class="flex items-center justify-between pt-1">
                            <div>
                                <div class="font-bold text-xs text-zinc-900" x-text="reviews[activeReview].name"></div>
                                <div class="text-[10px] text-zinc-400" x-text="reviews[activeReview].role"></div>
                            </div>
                            <span class="text-amber-500 text-xs">★★★★★</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Arrow Controls -->
            <div class="lg:col-span-2 flex items-center justify-start lg:justify-end gap-3">
                <button @click="prevReview()" 
                        class="w-10 h-10 rounded-full bg-white hover:bg-stone-100 text-zinc-700 border border-[#E8DDD0] shadow-sm flex items-center justify-center transition cursor-pointer"
                        aria-label="Previous Review">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="nextReview()" 
                        class="w-10 h-10 rounded-full bg-red-600 hover:bg-red-700 text-white shadow-md shadow-red-600/25 flex items-center justify-center transition cursor-pointer"
                        aria-label="Next Review">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

        </div>
    </section>

    <!-- 6. USES OF BEEF BILTONG & BRAND INFLUENCERS (BEAC Company Profile Highlights) -->
    <section class="mt-10 grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left: Culinary & Lifestyle Uses of Beef Biltong -->
        <div class="lg:col-span-7 bg-white rounded-[32px] border border-[#E8DDD0] p-6 sm:p-8 shadow-sm space-y-5">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[11px] font-black uppercase tracking-wider text-red-600">Versatile Protein</span>
                    <h2 class="text-xl sm:text-2xl font-black text-zinc-900">Uses of Beef Biltong</h2>
                </div>
                <a href="{{ route('craft') }}" class="text-xs font-bold text-red-600 hover:underline">Learn More &rarr;</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div class="p-3.5 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0]">
                    <span class="font-extrabold text-zinc-900 block">High-Protein Snack</span>
                    <span class="text-[11px] text-zinc-500">Chewy, flavorful fuel between meals or outdoors.</span>
                </div>
                <div class="p-3.5 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0]">
                    <span class="font-extrabold text-zinc-900 block">Salads &amp; Wraps</span>
                    <span class="text-[11px] text-zinc-500">Sprinkle over fresh salads, sandwiches, or rolls.</span>
                </div>
                <div class="p-3.5 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0]">
                    <span class="font-extrabold text-zinc-900 block">Pizza &amp; Stews</span>
                    <span class="text-[11px] text-zinc-500">Savory gourmet topping or rich stew enhancer.</span>
                </div>
                <div class="p-3.5 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0]">
                    <span class="font-extrabold text-zinc-900 block">Charcuterie Boards</span>
                    <span class="text-[11px] text-zinc-500">Pair with cheeses, fruits, nuts, wine &amp; spirits.</span>
                </div>
                <div class="p-3.5 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0]">
                    <span class="font-extrabold text-zinc-900 block">Travel &amp; Camping</span>
                    <span class="text-[11px] text-zinc-500">Natural preservation with zero refrigeration needed.</span>
                </div>
                <div class="p-3.5 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0]">
                    <span class="font-extrabold text-zinc-900 block">Gourmet Gifts</span>
                    <span class="text-[11px] text-zinc-500">Curated ribboned gift hampers for special occasions.</span>
                </div>
            </div>
        </div>

        <!-- Right: Strategic Travel Partners with Official Logos (TRC / SGR, Air Tanzania, Precision Air) -->
        <div class="lg:col-span-5 bg-white rounded-[32px] border border-[#E8DDD0] p-6 sm:p-8 shadow-sm space-y-5 flex flex-col justify-between">
            <div>
                <span class="text-[11px] font-black uppercase tracking-wider text-red-600">Future Outlook</span>
                <h2 class="text-xl sm:text-2xl font-black text-zinc-900">Strategic Travel Partners</h2>
                <p class="text-xs text-zinc-500 mt-1">Bringing BEAC premium beef biltong snacks to passengers across Tanzania's leading transit networks.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-1 gap-3">
                <div class="p-3 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] flex items-center gap-4">
                    <div class="h-14 w-32 rounded-xl bg-white p-1 border border-[#E8DDD0] flex items-center justify-center flex-shrink-0">
                        @include('partials.partner-logo', ['partner' => 'trc', 'class' => 'w-full h-full'])
                    </div>
                    <div>
                        <div class="font-extrabold text-xs text-zinc-900">TRC / SGR</div>
                        <div class="text-[11px] text-zinc-500">Standard Gauge Railway Passengers</div>
                    </div>
                </div>
                <div class="p-3 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] flex items-center gap-4">
                    <div class="h-14 w-32 rounded-xl bg-white p-1 border border-[#E8DDD0] flex items-center justify-center flex-shrink-0">
                        @include('partials.partner-logo', ['partner' => 'air_tanzania', 'class' => 'w-full h-full'])
                    </div>
                    <div>
                        <div class="font-extrabold text-xs text-zinc-900">Air Tanzania</div>
                        <div class="text-[11px] text-zinc-500">Domestic &amp; International Flights</div>
                    </div>
                </div>
                <div class="p-3 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] flex items-center gap-4">
                    <div class="h-14 w-32 rounded-xl bg-white p-1 border border-[#E8DDD0] flex items-center justify-center flex-shrink-0">
                        @include('partials.partner-logo', ['partner' => 'precision_air', 'class' => 'w-full h-full'])
                    </div>
                    <div>
                        <div class="font-extrabold text-xs text-zinc-900">Precision Air</div>
                        <div class="text-[11px] text-zinc-500">Domestic &amp; Regional Flyers</div>
                    </div>
                </div>
            </div>

            <div class="pt-2 border-t border-[#F0E6D8] flex items-center justify-between gap-3">
                <span class="text-[11px] font-bold text-zinc-500">Want to stock BEAC?</span>
                <a href="{{ route('wholesale') }}#enquiry-form" class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-sm transition">
                    <span>Partnership</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

    </section>

@endsection
