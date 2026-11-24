@extends('layouts.app')

@section('title', 'INAS Premium Beef Biltong | REAL BEEF. REAL FLAVOUR. | Dar es Salaam')

@section('content')

    <!-- 1. Hero Section (Dark with Red Badge & Arched Curve Bottom Transition) -->
    <section class="relative bg-brand-black overflow-hidden pt-6 pb-20 sm:pb-28">
        <!-- Background Sizzling Image & Deep Vignette -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-biltong.jpg') }}" 
                 alt="INAS Artisanal Beef Biltong on Dark Slate" 
                 class="w-full h-full object-cover object-center opacity-35 scale-105">
            <div class="absolute inset-0 bg-gradient-to-b from-brand-black/90 via-brand-black/60 to-brand-black"></div>
            <div class="absolute inset-0 bg-radial from-transparent via-brand-black/50 to-brand-black"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-12">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Hero Left: Headline & Red CTA -->
                <div class="lg:col-span-7 space-y-6 text-left">
                    
                    <!-- Offer Pill matching the uploaded screenshot -->
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-brand-red/20 border border-brand-red text-white backdrop-blur-md">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-black bg-brand-red text-white uppercase tracking-wider">
                            {{ app()->getLocale() === 'sw' ? 'Ofa Maalum' : 'Special Offer' }}
                        </span>
                        <span class="text-xs font-bold tracking-wide">
                            {{ app()->getLocale() === 'sw' ? 'Usafirishaji BURE Dar & Punguzo la 10% kwa Oda zaidi ya TZS 50,000' : 'FREE Dar Delivery & 10% Off Orders Over TZS 50,000' }}
                        </span>
                    </div>

                    <!-- Main Bold Headline -->
                    <h1 class="font-editorial text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight text-white leading-[1.08]">
                        @if(app()->getLocale() === 'sw')
                            NYAMA HALISI.<br>
                            <span class="text-brand-red-light italic font-serif">LADHA HALISI.</span>
                        @else
                            REAL BEEF.<br>
                            <span class="text-brand-red-light italic font-serif">REAL FLAVOUR.</span>
                        @endif
                    </h1>

                    <!-- Subheadline -->
                    <p class="max-w-xl text-base sm:text-lg text-zinc-300 font-normal leading-relaxed">
                        @if(app()->getLocale() === 'sw')
                            Imetengenezwa kwa ufundi stadi Buguruni Malapa, Dar es Salaam. Asilimia 100 nyama ya ng'ombe wa malishoni Tanzania, giligilani iliyokaangwa, pilipili manga na ukaushaji wa asili wa upepo.
                        @else
                            Handcrafted in Buguruni Malapa, Dar es Salaam. 100% pasture-grazed Tanzanian beef steeped in crushed toasted coriander, black pepper and natural apple cider marinade. Air-dried slowly for tender, savory richness.
                        @endif
                    </p>

                    <!-- CTAs with vibrant Red Buttons -->
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="{{ route('shop') }}" 
                           class="px-8 py-4 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-extrabold text-sm uppercase tracking-wider shadow-[0_0_25px_rgba(220,38,38,0.4)] hover:scale-105 transition transform duration-200 flex items-center gap-2">
                            <span>{{ app()->getLocale() === 'sw' ? 'Nunua Sasa • Kuanzia TZS 10,000' : 'Shop Now • From TZS 10,000' }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="{{ route('about') }}" 
                           class="px-7 py-4 rounded-xl bg-brand-charcoal/90 border border-zinc-700 hover:border-white text-white font-semibold text-sm transition duration-200">
                            {{ app()->getLocale() === 'sw' ? 'Fahamu Simulizi Yetu' : 'Discover Our Story' }}
                        </a>
                    </div>

                    <!-- 4 Badges row -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6 border-t border-zinc-800 text-left">
                        <div>
                            <span class="block text-2xl font-black text-brand-red-light">52g</span>
                            <span class="text-[11px] text-zinc-400 uppercase tracking-wider font-semibold">Protein / 100g</span>
                        </div>
                        <div>
                            <span class="block text-2xl font-black text-white">100%</span>
                            <span class="text-[11px] text-zinc-400 uppercase tracking-wider font-semibold">Halal Certified</span>
                        </div>
                        <div>
                            <span class="block text-2xl font-black text-brand-red-light">0%</span>
                            <span class="text-[11px] text-zinc-400 uppercase tracking-wider font-semibold">Nitrates / MSG</span>
                        </div>
                        <div>
                            <span class="block text-2xl font-black text-white">72 hrs</span>
                            <span class="text-[11px] text-zinc-400 uppercase tracking-wider font-semibold">Natural Air Cure</span>
                        </div>
                    </div>

                </div>

                <!-- Hero Right: Sizzling Meat Plate Display with Discount Badge (Matching Uploaded Image) -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-3xl overflow-hidden border-2 border-zinc-800 shadow-2xl group">
                        <img src="{{ asset('images/hero-steak.jpg') }}" 
                             alt="Fresh Cured Meat Feast" 
                             class="w-full h-80 sm:h-96 object-cover object-center group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/30"></div>

                        <!-- Big Red Discount Callout (As shown in uploaded image: %10) -->
                        <div class="absolute top-4 right-4 bg-brand-red text-white p-4 rounded-2xl shadow-2xl text-center border-2 border-white/30 backdrop-blur-sm">
                            <span class="text-[10px] font-black uppercase tracking-wider block">Save</span>
                            <span class="text-3xl font-black leading-none block">10%</span>
                            <span class="text-[9px] font-bold uppercase tracking-wider block mt-0.5">Off 100g Packs</span>
                        </div>

                        <!-- Bottom Tag -->
                        <div class="absolute bottom-4 left-4 right-4 bg-brand-black/90 p-4 rounded-xl border border-zinc-700 backdrop-blur-md flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold text-white block">Buguruni Malapa Butcher Cut</span>
                                <span class="text-[11px] text-zinc-400">100% Tanzanian Grass-Fed Pasture Cattle</span>
                            </div>
                            <span class="text-xs font-black text-brand-red-light uppercase">In Stock</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Distinctive Arched Curve Transition to White Section (As seen in the screenshot!) -->
        <div class="relative -mb-1 w-full overflow-hidden leading-none z-20">
            <svg class="relative block w-full h-12 sm:h-16 text-white" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0 C300,90 900,90 1200,0 L1200,120 L0,120 Z" fill="currentColor"></path>
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
