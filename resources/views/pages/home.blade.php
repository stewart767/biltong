@extends('layouts.app')

@section('title', 'INAS Premium Beef Biltong | REAL BEEF. REAL FLAVOUR. | Dar es Salaam')

@section('content')

    <!-- 1. HERO SECTION (Exact TasteHouse Layout: Warm Cream Card + Dish Carousel + Floating Tag) -->
    <section class="rounded-3xl bg-white border border-stone-200/90 p-6 sm:p-10 lg:p-12 relative overflow-hidden shadow-sm"
             x-data="{
                 activeSlide: 0,
                 timer: null,
                 slides: [
                     {
                         image: '{{ asset('images/bbq-biltong.jpg') }}',
                         tag: '{{ app()->getLocale() === 'sw' ? 'MFALME WA BILTONG' : 'SIGNATURE 100G' }}',
                         dishName: 'Biltong Original 100g',
                         dishSub: '{{ app()->getLocale() === 'sw' ? 'Minofu mikavu ya malishoni' : 'Pasture-grazed Tanzanian beef' }}',
                         dishPrice: 'TZS 10,000',
                         dishLink: '{{ route('product.show', 'biltong-original-100g') }}'
                     },
                     {
                         image: '{{ asset('images/chilli-biltong.jpg') }}',
                         tag: '{{ app()->getLocale() === 'sw' ? 'PILIPILI MANGA & CAYENNE' : 'SPICY PERI-PERI' }}',
                         dishName: 'Chilli Biltong Bites',
                         dishSub: '{{ app()->getLocale() === 'sw' ? 'Ladha kali ya kukaangwa' : 'Warm lingering spice kick' }}',
                         dishPrice: 'TZS 11,000',
                         dishLink: '{{ route('product.show', 'chilli-biltong-bites-100g') }}'
                     },
                     {
                         image: '{{ asset('images/droewors.jpg') }}',
                         tag: '{{ app()->getLocale() === 'sw' ? 'SAUSAGE YA ASILI' : 'AIR-DRIED SAUSAGE' }}',
                         dishName: 'Traditional Droëwors',
                         dishSub: '{{ app()->getLocale() === 'sw' ? 'Iliyosagwa na viungo safi' : 'Spiced beef & roasted coriander' }}',
                         dishPrice: 'TZS 12,000',
                         dishLink: '{{ route('product.show', 'traditional-droewors-100g') }}'
                     },
                     {
                         image: '{{ asset('images/craft-spices.jpg') }}',
                         tag: '{{ app()->getLocale() === 'sw' ? 'VIUNGO ASILIA' : 'ARTISANAL SPICES' }}',
                         dishName: 'Skillet-Toasted Spices',
                         dishSub: '{{ app()->getLocale() === 'sw' ? 'Giligilani & Tellicherry' : 'Tellicherry & cast iron roasted' }}',
                         dishPrice: 'Fresh Daily',
                         dishLink: '{{ route('craft') }}'
                     }
                 ],
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
            
            <!-- Hero Left: Typography & CTAs -->
            <div class="lg:col-span-7 space-y-5 text-left">
                
                <!-- Pill Tag -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/90 border border-red-200 text-red-600 text-[11px] font-extrabold uppercase tracking-wider shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                    <span>{{ app()->getLocale() === 'sw' ? 'NYAMA HALISI • DAR ES SALAAM' : 'GOOD FOOD, GOOD MOOD' }}</span>
                </div>

                <!-- Main Bold Headline (Exact TasteHouse styling) -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-zinc-900 tracking-tight leading-[1.08]">
                    <span>{{ app()->getLocale() === 'sw' ? 'NYAMA HALISI.' : 'REAL BEEF.' }}</span><br>
                    <span class="text-red-600">{{ app()->getLocale() === 'sw' ? 'LADHA HALISI.' : 'REAL FLAVOUR.' }}</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-zinc-600 text-sm sm:text-base font-normal max-w-xl leading-relaxed">
                    {{ app()->getLocale() === 'sw' 
                        ? 'Imetengenezwa kwa ufundi stadi Buguruni Malapa, Dar es Salaam. 100% pasture-grazed Tanzanian beef steeped in crushed toasted coriander and slow air convection.'
                        : 'Handcrafted in Buguruni Malapa, Dar es Salaam. Discover 100% pasture-grazed Tanzanian beef cured with skillet-toasted coriander and natural air drying. Tender, savoury, authentic.'
                    }}
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ route('shop') }}" 
                       class="px-8 py-3.5 rounded-full bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-wider shadow-lg shadow-red-600/30 hover:scale-105 transition transform duration-200 flex items-center gap-2 cursor-pointer">
                        <span>{{ app()->getLocale() === 'sw' ? 'Duka la Biltong' : 'Order Now' }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>

                    <a href="{{ route('craft') }}" 
                       class="px-6 py-3.5 rounded-full bg-white hover:bg-stone-50 text-zinc-800 font-bold text-xs uppercase tracking-wider border border-stone-200/90 hover:border-red-300 transition shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        <span>{{ app()->getLocale() === 'sw' ? 'Fahamu Ukaushaji' : 'Explore Menu' }}</span>
                    </a>
                </div>

                <!-- Social Proof: Happy Customers Avatars -->
                <div class="pt-4 flex items-center gap-3">
                    <div class="flex -space-x-2 overflow-hidden">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white object-cover" src="{{ asset('images/biltong-original-1.jpg') }}" alt="User">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white object-cover" src="{{ asset('images/chilli-biltong.jpg') }}" alt="User">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white object-cover" src="{{ asset('images/droewors.jpg') }}" alt="User">
                        <div class="h-8 w-8 rounded-full bg-red-600 text-white font-bold text-[10px] flex items-center justify-center ring-2 ring-white">
                            +1k
                        </div>
                    </div>
                    <div class="text-xs">
                        <div class="font-extrabold text-zinc-900">1,500+ Happy Food Lovers</div>
                        <div class="text-zinc-500 text-[11px] flex items-center gap-1">
                            <span class="text-amber-500">★★★★★</span>
                            <span>in Dar es Salaam</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Hero Right: Food Photography Showcase with Floating Dish Card -->
            <div class="lg:col-span-5 relative flex items-center justify-center">
                
                <!-- Circular Dish Container with Warm Ambient Glow -->
                <div class="relative w-64 h-64 sm:w-80 sm:h-80 lg:w-96 lg:h-96 rounded-full p-3 bg-gradient-to-tr from-red-100/60 via-white to-stone-100 shadow-2xl flex items-center justify-center">
                    
                    <!-- Sliding Image -->
                    <template x-for="(slide, index) in slides" :key="index">
                        <div class="absolute inset-4 rounded-full overflow-hidden transition-opacity duration-700 ease-in-out"
                             :class="activeSlide === index ? 'opacity-100 scale-100 z-10' : 'opacity-0 scale-95 pointer-events-none z-0'">
                            <img :src="slide.image" 
                                 :alt="slide.dishName" 
                                 class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                        </div>
                    </template>

                    <!-- Floating Dish Card (Exact TasteHouse dish price tag) -->
                    <div class="absolute -bottom-2 -left-2 sm:bottom-4 sm:left-0 z-20 bg-white/95 backdrop-blur-md rounded-2xl p-3.5 border border-stone-200 shadow-xl max-w-[200px] text-left">
                        <div class="text-[10px] font-black uppercase tracking-wider text-red-600" x-text="slides[activeSlide].tag"></div>
                        <h4 class="font-bold text-xs text-zinc-900 truncate" x-text="slides[activeSlide].dishName"></h4>
                        <p class="text-[10px] text-zinc-500 truncate" x-text="slides[activeSlide].dishSub"></p>
                        <div class="mt-1 font-black text-xs text-red-600" x-text="slides[activeSlide].dishPrice"></div>
                    </div>

                </div>

                <!-- Carousel Navigation Buttons (< >) on Bottom Right -->
                <div class="absolute bottom-0 right-0 flex items-center gap-2 z-20">
                    <button @click="prev()" 
                            class="w-8 h-8 rounded-full bg-white hover:bg-red-600 hover:text-white text-zinc-700 border border-stone-200 flex items-center justify-center shadow-md transition cursor-pointer"
                            aria-label="Previous">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    
                    <!-- Progress Dots -->
                    <div class="flex items-center gap-1.5 px-2">
                        <template x-for="(slide, i) in slides" :key="i">
                            <span class="rounded-full transition-all duration-300"
                                  :class="activeSlide === i ? 'w-4 h-1.5 bg-red-600' : 'w-1.5 h-1.5 bg-stone-300'"></span>
                        </template>
                    </div>

                    <button @click="next()" 
                            class="w-8 h-8 rounded-full bg-white hover:bg-red-600 hover:text-white text-zinc-700 border border-stone-200 flex items-center justify-center shadow-md transition cursor-pointer"
                            aria-label="Next">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>

            </div>

        </div>

    </section>


    <!-- 2. FOUR FEATURE BADGES STRIP (Exact TasteHouse Horizontal 4-Card Row) -->
    <section class="mt-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- Badge 1: Free Delivery -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-stone-200/70 shadow-sm flex items-center gap-3.5 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-xs text-zinc-900">{{ app()->getLocale() === 'sw' ? 'Usafirishaji Bure' : 'Free Delivery' }}</h4>
                    <p class="text-[11px] text-zinc-500">{{ app()->getLocale() === 'sw' ? 'Oda zaidi ya TZS 50,000' : 'On orders over TZS 50,000' }}</p>
                </div>
            </div>

            <!-- Badge 2: 100% Halal & Fresh -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-stone-200/70 shadow-sm flex items-center gap-3.5 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-xs text-zinc-900">{{ app()->getLocale() === 'sw' ? '100% Halal na Asili' : '100% Halal & Pure' }}</h4>
                    <p class="text-[11px] text-zinc-500">{{ app()->getLocale() === 'sw' ? 'Bila MSG wala kemikali' : 'Zero nitrates & no MSG' }}</p>
                </div>
            </div>

            <!-- Badge 3: Secure Payment -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-stone-200/70 shadow-sm flex items-center gap-3.5 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-xs text-zinc-900">{{ app()->getLocale() === 'sw' ? 'Malipo Salama ya TZ' : 'Secure Payment' }}</h4>
                    <p class="text-[11px] text-zinc-500">{{ app()->getLocale() === 'sw' ? 'M-Pesa, Tigo, Airtel, Cash' : 'M-Pesa, Tigo, Airtel, Halopesa' }}</p>
                </div>
            </div>

            <!-- Badge 4: 24/7 Support -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-stone-200/70 shadow-sm flex items-center gap-3.5 hover:shadow-md transition">
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-xs text-zinc-900">{{ app()->getLocale() === 'sw' ? 'Huduma ya Haraka' : '24/7 Support' }}</h4>
                    <p class="text-[11px] text-zinc-500">{{ app()->getLocale() === 'sw' ? 'WhatsApp Desk tayari' : '+255 682 869 629' }}</p>
                </div>
            </div>

        </div>
    </section>


    <!-- 3. EXPLORE BY CUISINE / CATEGORIES (Exact TasteHouse 5 Pastel Cards) -->
    <section class="mt-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-xl sm:text-2xl font-black text-zinc-900 tracking-tight">
                    {{ app()->getLocale() === 'sw' ? 'Chagua Aina ya Biltong' : 'Explore by Cut & Craft' }}
                </h3>
                <p class="text-xs text-zinc-500 mt-0.5">
                    {{ app()->getLocale() === 'sw' ? 'Vyakula bora vya nyama iliyokaushwa kwa asili' : 'Hand-curated prime pasture cuts and artisanal specialties' }}
                </p>
            </div>
            <a href="{{ route('shop') }}" class="inline-flex items-center gap-1 text-xs font-bold text-red-600 hover:text-red-700 transition">
                <span>View All</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            
            <!-- Category 1: Traditional Biltong (Light Mint) -->
            <a href="{{ route('shop') }}" class="group bg-white hover:bg-red-50/40 border border-stone-200 hover:border-red-300 shadow-sm rounded-3xl p-5 text-center flex flex-col items-center justify-between space-y-3 transition duration-200 border border-emerald-100">
                <div class="w-24 h-24 rounded-full overflow-hidden shadow-md group-hover:scale-105 transition transform duration-300 border-2 border-white">
                    <img src="{{ asset('images/biltong-original-1.jpg') }}" alt="Traditional Biltong" class="w-full h-full object-cover">
                </div>
                <div>
                    <h4 class="font-extrabold text-sm text-zinc-900 group-hover:text-emerald-800 transition">Traditional</h4>
                    <span class="text-[11px] text-zinc-500 font-medium">100g & 250g Cuts</span>
                </div>
            </a>

            <!-- Category 2: Spiced Chilli (Light Peach) -->
            <a href="{{ route('shop') }}" class="group bg-white hover:bg-red-50/40 border border-stone-200 hover:border-red-300 shadow-sm rounded-3xl p-5 text-center flex flex-col items-center justify-between space-y-3 transition duration-200 border border-red-100">
                <div class="w-24 h-24 rounded-full overflow-hidden shadow-md group-hover:scale-105 transition transform duration-300 border-2 border-white">
                    <img src="{{ asset('images/chilli-biltong.jpg') }}" alt="Chilli Biltong Bites" class="w-full h-full object-cover">
                </div>
                <div>
                    <h4 class="font-extrabold text-sm text-zinc-900 group-hover:text-red-800 transition">Chilli Bites</h4>
                    <span class="text-[11px] text-zinc-500 font-medium">Spicy Peri-Peri</span>
                </div>
            </a>

            <!-- Category 3: Droewors (Light Gold) -->
            <a href="{{ route('shop') }}" class="group bg-white hover:bg-red-50/40 border border-stone-200 hover:border-red-300 shadow-sm rounded-3xl p-5 text-center flex flex-col items-center justify-between space-y-3 transition duration-200 border border-amber-100">
                <div class="w-24 h-24 rounded-full overflow-hidden shadow-md group-hover:scale-105 transition transform duration-300 border-2 border-white">
                    <img src="{{ asset('images/droewors.jpg') }}" alt="Droewors" class="w-full h-full object-cover">
                </div>
                <div>
                    <h4 class="font-extrabold text-sm text-zinc-900 group-hover:text-amber-800 transition">Droëwors</h4>
                    <span class="text-[11px] text-zinc-500 font-medium">Dried Beef Sausage</span>
                </div>
            </a>

            <!-- Category 4: Carver's Slab (Light Rose) -->
            <a href="{{ route('shop') }}" class="group bg-white hover:bg-red-50/40 border border-stone-200 hover:border-red-300 shadow-sm rounded-3xl p-5 text-center flex flex-col items-center justify-between space-y-3 transition duration-200 border border-rose-100">
                <div class="w-24 h-24 rounded-full overflow-hidden shadow-md group-hover:scale-105 transition transform duration-300 border-2 border-white">
                    <img src="{{ asset('images/carvers-slab.jpg') }}" alt="Carver's Slab" class="w-full h-full object-cover">
                </div>
                <div>
                    <h4 class="font-extrabold text-sm text-zinc-900 group-hover:text-rose-800 transition">Carver's Slab</h4>
                    <span class="text-[11px] text-zinc-500 font-medium">Whole Cured Beef</span>
                </div>
            </a>

            <!-- Category 5: Wholesale (Light Lavender) -->
            <a href="{{ route('wholesale') }}" class="group bg-white hover:bg-red-50/40 border border-stone-200 hover:border-red-300 shadow-sm rounded-3xl p-5 text-center flex flex-col items-center justify-between space-y-3 transition duration-200 border border-purple-100">
                <div class="w-24 h-24 rounded-full overflow-hidden shadow-md group-hover:scale-105 transition transform duration-300 border-2 border-white">
                    <img src="{{ asset('images/wholesale-box.jpg') }}" alt="Wholesale Cartons" class="w-full h-full object-cover">
                </div>
                <div>
                    <h4 class="font-extrabold text-sm text-zinc-900 group-hover:text-purple-800 transition">Wholesale</h4>
                    <span class="text-[11px] text-zinc-500 font-medium">10x Packs for Retail</span>
                </div>
            </a>

        </div>
    </section>


    <!-- 4. POPULAR DISHES / POPULAR PRODUCTS (Exact TasteHouse 5 Product Cards Grid) -->
    <section class="mt-14">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-xl sm:text-2xl font-black text-zinc-900 tracking-tight">
                    {{ app()->getLocale() === 'sw' ? 'Vyakula Maarufu Zaidi' : 'Popular Dishes' }}
                </h3>
                <p class="text-xs text-zinc-500 mt-0.5">
                    {{ app()->getLocale() === 'sw' ? 'Biltong zilizopendwa zaidi na wateja wetu Dar es Salaam' : 'Our highest-rated artisanal cuts and chef-curated beef biltong packs' }}
                </p>
            </div>
            <a href="{{ route('shop') }}" class="inline-flex items-center gap-1 text-xs font-bold text-red-600 hover:text-red-700 transition">
                <span>View All</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
            
            <!-- Product Card 1: Biltong Original 100g -->
            <div class="bg-white rounded-3xl p-4 border border-stone-200/80 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group relative">
                
                <!-- Badge: Bestseller -->
                <div class="absolute top-4 left-4 z-10">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-500 text-white shadow-sm">
                        Bestseller
                    </span>
                </div>

                <!-- Product Image (Circular Plate with zoom) -->
                <div class="pt-4 pb-2 flex items-center justify-center">
                    <div class="w-32 h-32 rounded-full overflow-hidden shadow-md group-hover:scale-105 transition transform duration-300 border border-stone-100">
                        <img src="{{ asset('images/biltong-original-1.jpg') }}" alt="Biltong Original 100g" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Title & Meta -->
                <div class="space-y-1 text-left pt-2">
                    <h4 class="font-extrabold text-sm text-zinc-900 group-hover:text-red-600 transition truncate">
                        Biltong Original
                    </h4>
                    <p class="text-[11px] text-zinc-500 truncate">Classic Coriander & Pepper</p>
                </div>

                <!-- Price + Rating + Add to Cart (+) Button -->
                <div class="pt-4 flex items-center justify-between border-t border-stone-100 mt-3">
                    <div>
                        <span class="block font-black text-sm text-zinc-900">TZS 10,000</span>
                        <span class="text-[10px] text-amber-500 font-bold flex items-center gap-0.5">
                            ★ <span class="text-zinc-600">4.9</span>
                        </span>
                    </div>

                    <button @click="$store.cart.add({ id: 1, name: 'Biltong Original', price: 10000, weight: '100g', image: '{{ asset('images/biltong-original-1.jpg') }}', quantity: 1 })"
                            class="w-8 h-8 rounded-xl bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-md shadow-red-600/30 transition transform hover:scale-110 cursor-pointer"
                            aria-label="Add to cart">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>

            </div>

            <!-- Product Card 2: Chilli Biltong Bites -->
            <div class="bg-white rounded-3xl p-4 border border-stone-200/80 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group relative">
                
                <!-- Badge: 10% OFF -->
                <div class="absolute top-4 left-4 z-10">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-600 text-white shadow-sm">
                        10% OFF
                    </span>
                </div>

                <div class="pt-4 pb-2 flex items-center justify-center">
                    <div class="w-32 h-32 rounded-full overflow-hidden shadow-md group-hover:scale-105 transition transform duration-300 border border-stone-100">
                        <img src="{{ asset('images/chilli-biltong.jpg') }}" alt="Chilli Biltong Bites" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="space-y-1 text-left pt-2">
                    <h4 class="font-extrabold text-sm text-zinc-900 group-hover:text-red-600 transition truncate">
                        Chilli Biltong Bites
                    </h4>
                    <p class="text-[11px] text-zinc-500 truncate">Spicy Bird's Eye Cayenne</p>
                </div>

                <div class="pt-4 flex items-center justify-between border-t border-stone-100 mt-3">
                    <div>
                        <span class="block font-black text-sm text-zinc-900">TZS 11,000</span>
                        <span class="text-[10px] text-amber-500 font-bold flex items-center gap-0.5">
                            ★ <span class="text-zinc-600">4.8</span>
                        </span>
                    </div>

                    <button @click="$store.cart.add({ id: 2, name: 'Chilli Biltong Bites', price: 11000, weight: '100g', image: '{{ asset('images/chilli-biltong.jpg') }}', quantity: 1 })"
                            class="w-8 h-8 rounded-xl bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-md shadow-red-600/30 transition transform hover:scale-110 cursor-pointer"
                            aria-label="Add to cart">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>

            </div>

            <!-- Product Card 3: Traditional Droëwors -->
            <div class="bg-white rounded-3xl p-4 border border-stone-200/80 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group relative">
                
                <div class="absolute top-4 left-4 z-10">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-500 text-white shadow-sm">
                        Bestseller
                    </span>
                </div>

                <div class="pt-4 pb-2 flex items-center justify-center">
                    <div class="w-32 h-32 rounded-full overflow-hidden shadow-md group-hover:scale-105 transition transform duration-300 border border-stone-100">
                        <img src="{{ asset('images/droewors.jpg') }}" alt="Traditional Droëwors" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="space-y-1 text-left pt-2">
                    <h4 class="font-extrabold text-sm text-zinc-900 group-hover:text-red-600 transition truncate">
                        Traditional Droëwors
                    </h4>
                    <p class="text-[11px] text-zinc-500 truncate">Spiced Dried Beef Sausage</p>
                </div>

                <div class="pt-4 flex items-center justify-between border-t border-stone-100 mt-3">
                    <div>
                        <span class="block font-black text-sm text-zinc-900">TZS 12,000</span>
                        <span class="text-[10px] text-amber-500 font-bold flex items-center gap-0.5">
                            ★ <span class="text-zinc-600">4.9</span>
                        </span>
                    </div>

                    <button @click="$store.cart.add({ id: 3, name: 'Traditional Droëwors', price: 12000, weight: '100g', image: '{{ asset('images/droewors.jpg') }}', quantity: 1 })"
                            class="w-8 h-8 rounded-xl bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-md shadow-red-600/30 transition transform hover:scale-110 cursor-pointer"
                            aria-label="Add to cart">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>

            </div>

            <!-- Product Card 4: Carver's Whole Biltong Slab -->
            <div class="bg-white rounded-3xl p-4 border border-stone-200/80 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group relative">
                
                <div class="absolute top-4 left-4 z-10">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-600 text-white shadow-sm">
                        Chef's Cut
                    </span>
                </div>

                <div class="pt-4 pb-2 flex items-center justify-center">
                    <div class="w-32 h-32 rounded-full overflow-hidden shadow-md group-hover:scale-105 transition transform duration-300 border border-stone-100">
                        <img src="{{ asset('images/carvers-slab.jpg') }}" alt="Carver's Whole Biltong Slab" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="space-y-1 text-left pt-2">
                    <h4 class="font-extrabold text-sm text-zinc-900 group-hover:text-red-600 transition truncate">
                        Carver's Whole Slab
                    </h4>
                    <p class="text-[11px] text-zinc-500 truncate">250g Prime Cured Beef</p>
                </div>

                <div class="pt-4 flex items-center justify-between border-t border-stone-100 mt-3">
                    <div>
                        <span class="block font-black text-sm text-zinc-900">TZS 24,000</span>
                        <span class="text-[10px] text-amber-500 font-bold flex items-center gap-0.5">
                            ★ <span class="text-zinc-600">5.0</span>
                        </span>
                    </div>

                    <button @click="$store.cart.add({ id: 4, name: 'Carver's Biltong Slab', price: 24000, weight: '250g', image: '{{ asset('images/carvers-slab.jpg') }}', quantity: 1 })"
                            class="w-8 h-8 rounded-xl bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-md shadow-red-600/30 transition transform hover:scale-110 cursor-pointer"
                            aria-label="Add to cart">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>

            </div>

            <!-- Product Card 5: Wholesale Starter Carton -->
            <div class="bg-white rounded-3xl p-4 border border-stone-200/80 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group relative">
                
                <div class="absolute top-4 left-4 z-10">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-purple-600 text-white shadow-sm">
                        Wholesale
                    </span>
                </div>

                <div class="pt-4 pb-2 flex items-center justify-center">
                    <div class="w-32 h-32 rounded-full overflow-hidden shadow-md group-hover:scale-105 transition transform duration-300 border border-stone-100">
                        <img src="{{ asset('images/wholesale-box.jpg') }}" alt="Wholesale Starter Carton" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="space-y-1 text-left pt-2">
                    <h4 class="font-extrabold text-sm text-zinc-900 group-hover:text-red-600 transition truncate">
                        Wholesale Carton
                    </h4>
                    <p class="text-[11px] text-zinc-500 truncate">10x 100g Retail Display Box</p>
                </div>

                <div class="pt-4 flex items-center justify-between border-t border-stone-100 mt-3">
                    <div>
                        <span class="block font-black text-sm text-zinc-900">TZS 85,000</span>
                        <span class="text-[10px] text-amber-500 font-bold flex items-center gap-0.5">
                            ★ <span class="text-zinc-600">4.9</span>
                        </span>
                    </div>

                    <button @click="$store.cart.add({ id: 5, name: 'Wholesale Starter Carton', price: 85000, weight: '10x 100g', image: '{{ asset('images/wholesale-box.jpg') }}', quantity: 1 })"
                            class="w-8 h-8 rounded-xl bg-red-600 hover:bg-red-700 text-white flex items-center justify-center shadow-md shadow-red-600/30 transition transform hover:scale-110 cursor-pointer"
                            aria-label="Add to cart">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>

            </div>

        </div>
    </section>


    <!-- 5. DUAL PROMO BANNERS (Exact TasteHouse Side-by-Side Cards) -->
    <section class="mt-14">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Banner 1: Limited Time Offer (Soft Mint Gradient) -->
            <div class="bg-white border border-red-200 rounded-3xl p-6 sm:p-8 flex items-center justify-between overflow-hidden shadow-sm hover:shadow-md transition">
                <div class="space-y-3 max-w-xs text-left">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-600 text-white">
                        Limited Time Offer
                    </span>
                    <h3 class="font-extrabold text-xl sm:text-2xl text-zinc-900 leading-tight">
                        Flat 10% OFF<br>On Your First Order!
                    </h3>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        Use code <strong class="text-red-700">INAS10</strong> at checkout and enjoy real artisanal biltong.
                    </p>
                    <a href="{{ route('shop') }}" 
                       class="inline-flex items-center gap-1.5 px-6 py-2.5 rounded-full bg-red-700 hover:bg-red-800 text-white font-bold text-xs shadow-md transition transform hover:scale-105">
                        <span>Order Now</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="w-28 h-28 sm:w-36 sm:h-36 rounded-full overflow-hidden shadow-xl border-4 border-white flex-shrink-0">
                    <img src="{{ asset('images/bbq-biltong.jpg') }}" alt="Promo Dish" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Banner 2: Weekend Special / Family Combos (Soft Orange Gradient) -->
            <div class="bg-white border border-stone-200 rounded-3xl p-6 sm:p-8 flex items-center justify-between overflow-hidden shadow-sm hover:shadow-md transition">
                <div class="space-y-3 max-w-xs text-left">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-600 text-white">
                        Weekend Special
                    </span>
                    <h3 class="font-extrabold text-xl sm:text-2xl text-zinc-900 leading-tight">
                        Family & Party<br>Combo Packs
                    </h3>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        Feed your gathering or stock your bar with our 10-pack cartons.
                    </p>
                    <a href="{{ route('wholesale') }}" 
                       class="inline-flex items-center gap-1.5 px-6 py-2.5 rounded-full bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-md transition transform hover:scale-105">
                        <span>Order Now</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="w-28 h-28 sm:w-36 sm:h-36 rounded-full overflow-hidden shadow-xl border-4 border-white flex-shrink-0">
                    <img src="{{ asset('images/hero-steak.jpg') }}" alt="Combo Pack" class="w-full h-full object-cover">
                </div>
            </div>

        </div>
    </section>


    <!-- 6. TRUSTED BY / PARTNERS & TANZANIAN PAYMENT METHODS -->
    <section class="mt-14 pt-8 border-t border-stone-200">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-left">
            <span class="text-xs font-bold text-zinc-400 uppercase tracking-widest">
                {{ app()->getLocale() === 'sw' ? 'Malipo Salama Tanzania:' : 'Supported Tanzanian Payments:' }}
            </span>
            <div class="flex flex-wrap items-center justify-center gap-4 text-xs font-bold text-zinc-600">
                <span class="px-3.5 py-1.5 rounded-xl bg-white border border-stone-200 shadow-sm flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-red-600"></span> M-Pesa
                </span>
                <span class="px-3.5 py-1.5 rounded-xl bg-white border border-stone-200 shadow-sm flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span> Tigo Pesa
                </span>
                <span class="px-3.5 py-1.5 rounded-xl bg-white border border-stone-200 shadow-sm flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span> Airtel Money
                </span>
                <span class="px-3.5 py-1.5 rounded-xl bg-white border border-stone-200 shadow-sm flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span> Halopesa
                </span>
                <span class="px-3.5 py-1.5 rounded-xl bg-white border border-stone-200 shadow-sm flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-red-600"></span> 100% Halal
                </span>
            </div>
        </div>
    </section>

@endsection
