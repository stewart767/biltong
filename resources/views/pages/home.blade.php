@extends('layouts.app')

@section('title', 'INAS Premium Beef Biltong | REAL BEEF. REAL FLAVOUR. | Dar es Salaam')

@section('content')

    <!-- 1. Hero Full-Bleed Clear Automated Image Slider -->
    <section class="relative bg-zinc-950 overflow-hidden pt-12 pb-24 sm:pb-32 min-h-[580px] sm:min-h-[660px] lg:min-h-[720px] flex items-center justify-center text-center"
             x-data="{
                 activeSlide: 0,
                 timer: null,
                 slides: [
                     {
                         image: '{{ asset("images/bbq-biltong.jpg") }}',
                         tag: 'BUGURUNI MALAPA • DAR ES SALAAM',
                         title: '{{ app()->getLocale() === "sw" ? "NYAMA HALISI." : "REAL BEEF." }}',
                         subtitle: '{{ app()->getLocale() === "sw" ? "LADHA HALISI." : "REAL FLAVOUR." }}',
                         desc: '{{ app()->getLocale() === "sw" ? "Nyama halisi ya ng\'ombe wa malishoni Tanzania iliyokaushwa kwa asili na viungo vya giligilani vilivyokaangwa." : "100% pasture-grazed Tanzanian beef cured with skillet-toasted coriander and natural air drying. Tender, savoury, authentic." }}',
                         ctaText: '{{ app()->getLocale() === "sw" ? "Nunua Biltong Sasa" : "Shop Biltong Cuts" }}',
                         ctaLink: '{{ route("shop") }}'
                     },
                     {
                         image: '{{ asset("images/hero-biltong.jpg") }}',
                         tag: '{{ app()->getLocale() === "sw" ? "PAKITI YA 100G YA ASILI" : "ORIGINAL 100G FLAGSHIP PACK" }}',
                         title: 'BILTONG ORIGINAL.',
                         subtitle: '52G PROTEIN.',
                         desc: '{{ app()->getLocale() === "sw" ? "Minofu mikavu iliyokatwa kwa ufundi. Protini safi 52g, 100% Halal, haina kemikali wala nitrati." : "Clean gourmet protein packed with 52.4g protein per 100g. 100% Halal certified, zero nitrates, zero artificial salts." }}',
                         ctaText: '{{ app()->getLocale() === "sw" ? "Agiza Biltong Original" : "Order Biltong Original" }}',
                         ctaLink: '{{ route("product.show", "biltong-original-100g") }}'
                     },
                     {
                         image: '{{ asset("images/biltong-original-2.jpg") }}',
                         tag: '{{ app()->getLocale() === "sw" ? "UKAUSHAJI WA ASILI WA MASAA 72" : "72-HOUR ARTISAN AIR CURE" }}',
                         title: 'SLOW CURED.',
                         subtitle: 'PURE TENDER.',
                         desc: '{{ app()->getLocale() === "sw" ? "Haikupikwa wala kuchomwa moshi. Ukaushaji wa upepo wa asili huweka virutubisho na ladha halisi ya nyama." : "Never cooked, never heat-dried. Slow air convection locks in natural juices, deep umami notes and tender texture." }}',
                         ctaText: '{{ app()->getLocale() === "sw" ? "Fahamu Ukaushaji Wetu" : "Discover Air-Cure Craft" }}',
                         ctaLink: '{{ route("craft") }}'
                     },
                     {
                         image: '{{ asset("images/craft-spices.jpg") }}',
                         tag: '{{ app()->getLocale() === "sw" ? "VIUNGO ASILIA VILIVYOKAANGWA" : "SKILLET-TOASTED SPICES" }}',
                         title: 'WHOLE SPICES.',
                         subtitle: 'ZERO MSG.',
                         desc: '{{ app()->getLocale() === "sw" ? "Mbegu za giligilani, pilipili manga ya Tellicherry na siki ya tofaa kwa ukaukaji safi na ladha murua." : "Crushed coriander toasted in cast iron, Tellicherry black peppercorns and pure apple cider marinade." }}',
                         ctaText: '{{ app()->getLocale() === "sw" ? "Tazama Bidhaa Zote" : "Explore All Products" }}',
                         ctaLink: '{{ route("shop") }}'
                     }
                 ],
                 next() {
                     this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                 },
                 prev() {
                     this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
                 },
                 startAuto() {
                     this.stopAuto();
                     this.timer = setInterval(() => { this.next() }, 4500);
                 },
                 stopAuto() {
                     if (this.timer) {
                         clearInterval(this.timer);
                         this.timer = null;
                     }
                 }
             }"
             x-init="startAuto()"
             @mouseenter="stopAuto()"
             @mouseleave="startAuto()">

        <!-- FULL BACKGROUND CLEAR IMAGES (Edge-to-Edge, Vivid, Bright, Automated) -->
        <div class="absolute inset-0 z-0">
            <template x-for="(slide, index) in slides" :key="index">
                <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
                     :class="activeSlide === index ? 'opacity-100 z-10' : 'opacity-0 pointer-events-none z-0'">
                    <img :src="slide.image" 
                         :alt="slide.title" 
                         class="w-full h-full object-cover object-center brightness-95 contrast-105">
                </div>
            </template>
            
            <!-- Soft readable vignette (Bright & Clear: photos stay visible and colorful) -->
            <div class="absolute inset-0 z-10 bg-gradient-to-t from-black/85 via-black/40 to-black/35 pointer-events-none"></div>
            <div class="absolute inset-0 z-10 bg-black/20 pointer-events-none"></div>
        </div>

        <!-- Slider Navigation Arrows (Left / Right) -->
        <button @click="prev()" 
                class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-13 sm:h-13 rounded-full bg-black/55 hover:bg-brand-red text-white border border-white/25 flex items-center justify-center transition-all duration-200 backdrop-blur-md cursor-pointer shadow-xl hover:scale-110"
                aria-label="Previous Slide">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button @click="next()" 
                class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-13 sm:h-13 rounded-full bg-black/55 hover:bg-brand-red text-white border border-white/25 flex items-center justify-center transition-all duration-200 backdrop-blur-md cursor-pointer shadow-xl hover:scale-110"
                aria-label="Next Slide">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
        </button>

        <!-- Clean Main Centered Content (No Boxes, No Half-Image Designs) -->
        <div class="relative z-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col items-center">
            
            <!-- Category / Location Pill -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-black/60 border border-brand-red/80 text-white backdrop-blur-md shadow-lg mb-4">
                <span class="w-2 h-2 rounded-full bg-brand-red animate-ping"></span>
                <span class="text-xs font-bold tracking-widest text-zinc-100 uppercase" x-text="slides[activeSlide].tag">
                    BUGURUNI MALAPA • DAR ES SALAAM
                </span>
            </div>

            <!-- Big Bold Dynamic Headline -->
            <h1 class="font-editorial text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight text-white leading-[1.05] drop-shadow-[0_4px_12px_rgba(0,0,0,0.9)]">
                <span x-text="slides[activeSlide].title">{{ app()->getLocale() === 'sw' ? 'NYAMA HALISI.' : 'REAL BEEF.' }}</span> 
                <span class="text-brand-red italic font-serif" x-text="slides[activeSlide].subtitle">{{ app()->getLocale() === 'sw' ? 'LADHA HALISI.' : 'REAL FLAVOUR.' }}</span>
            </h1>

            <!-- Dynamic Description -->
            <p class="mt-4 max-w-2xl text-base sm:text-xl text-zinc-100 font-medium leading-relaxed drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)]" 
               x-text="slides[activeSlide].desc">
                Handcrafted in Buguruni Malapa, Dar es Salaam. 100% pasture-grazed Tanzanian beef cured with skillet-toasted coriander and cracked black pepper.
            </p>

            <!-- Clean Direct CTAs -->
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a :href="slides[activeSlide].ctaLink" 
                   class="px-8 py-4 rounded-full bg-brand-red hover:bg-brand-red-dark text-white font-black text-sm uppercase tracking-wider shadow-[0_0_35px_rgba(220,38,38,0.7)] hover:scale-105 transition transform duration-200 flex items-center gap-2 cursor-pointer border border-red-500/50">
                    <span x-text="slides[activeSlide].ctaText">{{ app()->getLocale() === 'sw' ? 'Nunua Biltong Sasa' : 'Shop Biltong Cuts' }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>

                <a href="https://wa.me/255682869629?text={{ urlencode('Habari INAS Biltong, nataka kuagiza Biltong...') }}"
                   target="_blank"
                   rel="noopener"
                   class="px-7 py-4 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm tracking-wide transition transform hover:scale-105 duration-200 shadow-lg flex items-center gap-2 cursor-pointer border border-emerald-400/40">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>{{ app()->getLocale() === 'sw' ? 'Agiza Kupitia WhatsApp' : 'Order via WhatsApp' }}</span>
                </a>
            </div>

            <!-- 4 Trust Badges (Clean, Minimalist Horizontal Row) -->
            <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-6 w-full max-w-3xl">
                <div class="bg-black/50 backdrop-blur-md py-3 px-4 rounded-2xl border border-white/20 text-center shadow-lg">
                    <span class="block text-2xl font-black text-brand-red">52g</span>
                    <span class="text-[11px] text-zinc-200 uppercase tracking-wider font-bold">Protein / 100g</span>
                </div>
                <div class="bg-black/50 backdrop-blur-md py-3 px-4 rounded-2xl border border-white/20 text-center shadow-lg">
                    <span class="block text-2xl font-black text-white">100%</span>
                    <span class="text-[11px] text-zinc-200 uppercase tracking-wider font-bold">Halal Certified</span>
                </div>
                <div class="bg-black/50 backdrop-blur-md py-3 px-4 rounded-2xl border border-white/20 text-center shadow-lg">
                    <span class="block text-2xl font-black text-brand-red">0%</span>
                    <span class="text-[11px] text-zinc-200 uppercase tracking-wider font-bold">Nitrates / MSG</span>
                </div>
                <div class="bg-black/50 backdrop-blur-md py-3 px-4 rounded-2xl border border-white/20 text-center shadow-lg">
                    <span class="block text-2xl font-black text-white">72 hrs</span>
                    <span class="text-[11px] text-zinc-200 uppercase tracking-wider font-bold">Natural Air Cure</span>
                </div>
            </div>

            <!-- Automated Slide Indicator Dots / Progress Pills -->
            <div class="flex items-center justify-center gap-3 mt-8">
                <template x-for="(slide, i) in slides" :key="i">
                    <button @click="activeSlide = i" 
                            class="transition-all duration-300 rounded-full cursor-pointer shadow-md"
                            :class="activeSlide === i ? 'w-10 h-3 bg-brand-red border border-white/60' : 'w-3 h-3 bg-white/50 hover:bg-white'"
                            :aria-label="'Go to slide ' + (i + 1)">
                    </button>
                </template>
            </div>

        </div>

        <!-- Distinctive Arched Curve Transition to White Section (Smooth & Crisp) -->
        <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-30 pointer-events-none">
            <svg class="relative block w-full h-10 sm:h-14 text-white" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0 C300,85 900,85 1200,0 L1200,120 L0,120 Z" fill="currentColor"></path>
            </svg>
        </div>
    </section>

    <!-- 2. White Body Area: Category Showcase (Matching Banner & 3 Sub-Cards from User Image) -->
    <section class="bg-white text-zinc-900 pt-8 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <!-- A. Big Butcher Red Banner (Matching the horizontal red banner in the image) -->
            <div class="relative rounded-3xl bg-gradient-to-r from-brand-red-dark via-brand-red to-brand-red-dark text-white p-6 sm:p-10 overflow-hidden shadow-xl">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                    
                    <div class="md:col-span-7 space-y-3 z-10">
                        <span class="px-3 py-1 rounded-full text-xs font-black bg-white/20 text-white uppercase tracking-wider inline-block">
                            Fresh Production Batches
                        </span>
                        <h2 class="font-editorial text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                            Fresh Handcrafted Beef Biltong
                        </h2>
                        <p class="text-sm text-white/90 max-w-lg leading-relaxed">
                            Cured daily at our Buguruni Malapa production facility. Whole muscle silverside and topside trimmed to perfection with toasted whole spices.
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-brand-red font-black text-xs uppercase tracking-wider shadow-md hover:bg-zinc-100 transition">
                                <span>Shop All Varieties</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>

                    <div class="md:col-span-5 relative flex justify-center">
                        <img src="{{ asset('images/biltong-original-1.jpg') }}" alt="Fresh Biltong Slices" class="w-full max-w-xs h-56 object-cover rounded-2xl shadow-2xl border-2 border-white/20">
                    </div>

                </div>
            </div>

            <!-- B. 3 Featured Sub-Category Cards (Dark with Red Buttons as in Image) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Category 1 -->
                <div class="rounded-2xl bg-zinc-900 border border-zinc-800 p-5 text-white flex flex-col justify-between space-y-4 hover:border-brand-red transition shadow-lg group">
                    <div class="relative h-44 rounded-xl overflow-hidden bg-black">
                        <img src="{{ asset('images/biltong-original-2.jpg') }}" alt="Traditional Biltong" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 left-3 text-sm font-bold text-white">Traditional Slices</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-zinc-300">Classic Coriander & Salt</span>
                        <a href="{{ route('shop', ['category' => 'traditional-biltong']) }}" class="px-4 py-2 rounded-lg bg-brand-red hover:bg-brand-red-dark text-white text-xs font-bold transition">
                            Explore
                        </a>
                    </div>
                </div>

                <!-- Category 2 -->
                <div class="rounded-2xl bg-zinc-900 border border-zinc-800 p-5 text-white flex flex-col justify-between space-y-4 hover:border-brand-red transition shadow-lg group">
                    <div class="relative h-44 rounded-xl overflow-hidden bg-black">
                        <img src="{{ asset('images/chilli-biltong.jpg') }}" alt="Chilli Biltong" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 left-3 text-sm font-bold text-white">Spiced & Chilli</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-zinc-300">African Bird's Eye Heat</span>
                        <a href="{{ route('shop', ['category' => 'spiced-and-chilli']) }}" class="px-4 py-2 rounded-lg bg-brand-red hover:bg-brand-red-dark text-white text-xs font-bold transition">
                            Explore
                        </a>
                    </div>
                </div>

                <!-- Category 3 -->
                <div class="rounded-2xl bg-zinc-900 border border-zinc-800 p-5 text-white flex flex-col justify-between space-y-4 hover:border-brand-red transition shadow-lg group">
                    <div class="relative h-44 rounded-xl overflow-hidden bg-black">
                        <img src="{{ asset('images/droewors.jpg') }}" alt="Droëwors Sausage" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-3 left-3 text-sm font-bold text-white">Droëwors Sausage</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-zinc-300">Snap-Tender Dried Beef</span>
                        <a href="{{ route('shop', ['category' => 'droewors-sausage']) }}" class="px-4 py-2 rounded-lg bg-brand-red hover:bg-brand-red-dark text-white text-xs font-bold transition">
                            Explore
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- 3. Bestsellers Showcase (Exact White Card with Full-Width Red Add-to-Bag Bar from Image) -->
    <section class="bg-zinc-50 py-16 border-t border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <!-- Section Title with Red Ornamental Accent (Matching uploaded image style) -->
            <div class="text-center space-y-2">
                <div class="flex items-center justify-center gap-3">
                    <span class="h-0.5 w-12 bg-brand-red"></span>
                    <span class="text-xs font-black uppercase tracking-widest text-brand-red">Bestsellers &bull; الأكثر طلباً</span>
                    <span class="h-0.5 w-12 bg-brand-red"></span>
                </div>
                <h2 class="font-editorial text-3xl sm:text-4xl font-extrabold text-zinc-900">
                    Most Popular Gourmet Cuts
                </h2>
                <p class="text-xs sm:text-sm text-zinc-500 max-w-lg mx-auto">
                    Hand-trimmed grass-fed beef cured in small batches for consistent tenderness.
                </p>
            </div>

            <!-- Product Cards Grid (Matching the White & Red Card Layout from the screenshot!) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <div class="bg-white rounded-2xl border border-zinc-200 overflow-hidden shadow-sm hover:shadow-xl hover:border-brand-red transition duration-300 flex flex-col justify-between group">
                        
                        <!-- Top Image with Floating Badges -->
                        <div class="relative h-56 bg-zinc-100 overflow-hidden">
                            <a href="{{ route('product.show', $product->slug) }}">
                                <img src="{{ $product->image_url }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-500">
                            </a>

                            <!-- Favorite / Quick View Floating Icons (As shown in screenshot) -->
                            <div class="absolute top-2.5 right-2.5 flex flex-col gap-1.5">
                                <span class="w-7 h-7 rounded-full bg-white/90 text-brand-red flex items-center justify-center shadow-md">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                                </span>
                            </div>

                            <!-- Pack Size Badge -->
                            <div class="absolute top-2.5 left-2.5">
                                <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-zinc-900 text-white">
                                    {{ $product->pack_size }}
                                </span>
                            </div>
                        </div>

                        <!-- Full-Width Red Button: "Add to Bag / إضافة للسلة" (Exact style from screenshot!) -->
                        <button @click="$store.cart.addItem({
                                    id: {{ $product->id }},
                                    name: '{{ addslashes($product->name) }}',
                                    slug: '{{ $product->slug }}',
                                    image: '{{ $product->image_url }}',
                                    pack_size: '{{ $product->pack_size }}',
                                    price: {{ $product->effective_price }},
                                    quantity: 1
                                })"
                                class="w-full py-2.5 bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition duration-150 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span>{{ app()->getLocale() === 'sw' ? 'Weka Kwenye Mfuko' : 'Add to Cart' }}</span>
                        </button>

                        <!-- Bottom Info: Title, Pack Size, Price -->
                        <div class="p-4 text-center space-y-1.5 bg-white">
                            <h3 class="font-bold text-sm text-zinc-900 line-clamp-1 group-hover:text-brand-red transition">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-base font-black text-brand-red">
                                    {{ $product->formatted_price }}
                                </span>
                                @if($product->formatted_original_price)
                                    <span class="text-xs text-zinc-400 line-through">
                                        {{ $product->formatted_original_price }}
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </section>


    <!-- 4. Secondary Dark Butcher Section (As featured in the screenshot's lower half) -->
    <section class="bg-brand-black text-white py-20 border-t border-brand-charcoal relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-8 space-y-3">
                    <span class="text-xs uppercase font-black tracking-widest text-brand-red">Artisan Curing Room</span>
                    <h2 class="font-editorial text-3xl sm:text-5xl font-extrabold text-white">
                        Whole Slabs & Spiced BBQ Cuts
                    </h2>
                    <p class="text-zinc-400 text-sm sm:text-base max-w-2xl leading-relaxed">
                        Prefer to carve your own slices at home? Our uncut biltong slabs and dry-rubbed BBQ smoked strips offer full control over moisture and thickness.
                    </p>
                </div>
                <div class="lg:col-span-4 flex lg:justify-end">
                    <a href="{{ route('shop') }}" class="px-6 py-3.5 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs uppercase tracking-wider transition shadow-lg">
                        View All Specialty Cuts
                    </a>
                </div>
            </div>

            <!-- Spotlight Card in Dark Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="p-6 rounded-2xl bg-zinc-900 border border-zinc-800 space-y-3">
                    <span class="text-brand-red text-xl font-black">01</span>
                    <h3 class="font-editorial text-lg font-bold text-white">100% Grass-Fed Tanzanian Beef</h3>
                    <p class="text-xs text-zinc-400 leading-relaxed">
                        Sourced exclusively from local cattle grazing on natural grasslands. Lean, dense protein with authentic beef sweetness.
                    </p>
                </div>
                <!-- Feature 2 -->
                <div class="p-6 rounded-2xl bg-zinc-900 border border-zinc-800 space-y-3">
                    <span class="text-brand-red text-xl font-black">02</span>
                    <h3 class="font-editorial text-lg font-bold text-white">Cider & Whole Toasted Coriander</h3>
                    <p class="text-xs text-zinc-400 leading-relaxed">
                        Our marinade releases roasted citrus notes and peppery punch without chemical curing salts or artificial smoke.
                    </p>
                </div>
                <!-- Feature 3 -->
                <div class="p-6 rounded-2xl bg-zinc-900 border border-zinc-800 space-y-3">
                    <span class="text-brand-red text-xl font-black">03</span>
                    <h3 class="font-editorial text-lg font-bold text-white">Buguruni Malapa Climate Drying</h3>
                    <p class="text-xs text-zinc-400 leading-relaxed">
                        Slow air movement over 72 hours removes moisture naturally, preserving essential micronutrients and tender bite.
                    </p>
                </div>
            </div>

        </div>
    </section>


    <!-- 5. Wholesale & B2B Distribution Banner (Red & Black) -->
    <section class="bg-zinc-100 py-16 border-t border-zinc-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-zinc-900 border-2 border-brand-red text-white p-8 sm:p-12 shadow-2xl">
                <div class="max-w-3xl space-y-4">
                    <span class="px-3 py-1 rounded-full text-xs font-black bg-brand-red text-white uppercase tracking-wider inline-block">
                        Commercial Supply & Distribution
                    </span>
                    <h2 class="font-editorial text-3xl sm:text-4xl font-extrabold text-white">
                        Supply INAS Biltong in Your Supermarket, Safari Lodge or Gym
                    </h2>
                    <p class="text-sm text-zinc-300 leading-relaxed">
                        We supply retail chains, safari camps across Serengeti & Ngorongoro, high-end hotel minibars, and premier fitness clubs with wholesale bulk tiers and shelf-ready retail display packaging.
                    </p>
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="{{ route('wholesale') }}" class="px-7 py-3.5 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs uppercase tracking-wider transition shadow-lg">
                            Open Wholesale Inquiry
                        </a>
                        <a href="https://wa.me/255682869629?text=Hello%20INAS!%20We%20would%20like%20to%20discuss%20wholesale%20distribution." target="_blank" class="px-6 py-3.5 rounded-xl bg-white text-zinc-900 hover:bg-zinc-200 font-bold text-xs uppercase tracking-wider transition">
                            Chat on WhatsApp (+255 682 869 629)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- 6. Verified Customer Testimonials with Red Star Ratings -->
    <section class="bg-white py-16 border-t border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="text-center space-y-2">
                <span class="text-xs uppercase font-black tracking-widest text-brand-red">Verified Reviews</span>
                <h2 class="font-editorial text-3xl font-extrabold text-zinc-900">What Our Customers Say</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Review 1 -->
                <div class="p-6 rounded-2xl bg-zinc-50 border border-zinc-200 space-y-3">
                    <div class="flex text-brand-red">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-xs text-zinc-700 leading-relaxed italic">
                        "The 100g Original pack has just the right snap and tenderness with toasted coriander notes. It puts imported jerky to shame."
                    </p>
                    <div class="pt-3 border-t border-zinc-200">
                        <span class="block text-xs font-bold text-zinc-900">Juma Rashidi</span>
                        <span class="text-[10px] text-zinc-500">Masaki, Dar es Salaam</span>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="p-6 rounded-2xl bg-zinc-50 border border-zinc-200 space-y-3">
                    <div class="flex text-brand-red">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-xs text-zinc-700 leading-relaxed italic">
                        "We order wholesale cartons for our luxury safari tented camps in Serengeti. Our international guests constantly rave about the flavor."
                    </p>
                    <div class="pt-3 border-t border-zinc-200">
                        <span class="block text-xs font-bold text-zinc-900">David M.</span>
                        <span class="text-[10px] text-zinc-500">Safari Lodge Manager, Arusha</span>
                    </div>
                </div>

                <!-- Review 3 -->
                <div class="p-6 rounded-2xl bg-zinc-50 border border-zinc-200 space-y-3">
                    <div class="flex text-brand-red">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-xs text-zinc-700 leading-relaxed italic">
                        "52 grams of clean protein per 100g pack. The Chilli Biltong Bites are our gym members' favorite post-workout snack."
                    </p>
                    <div class="pt-3 border-t border-zinc-200">
                        <span class="block text-xs font-bold text-zinc-900">Amina Hassan</span>
                        <span class="text-[10px] text-zinc-500">Fitness Coach, Oysterbay</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
