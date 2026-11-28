<!DOCTYPE html>
<html lang="en" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Burger House | Delicious Burgers Made Fresh</title>
    <meta name="description" content="Discover the best gourmet burgers made fresh with prime beef, crisp lettuce, melted cheese and golden fries. Order now for fast delivery.">

    @php 
        $siteFavicon = \App\Models\SiteSetting::get('site_favicon'); 
        $siteLogo = \App\Models\SiteSetting::get('site_logo');
    @endphp
    @if($siteFavicon && file_exists(public_path($siteFavicon)))
        <link rel="icon" href="{{ asset($siteFavicon) }}">
    @endif

    <!-- Fonts: Inter for crisp interface text -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Responsive Viewport Fitting */
        .hero-viewport-fit {
            min-height: calc(100vh - 4.5rem);
            max-height: 820px;
        }
        @media (max-width: 768px), (max-height: 720px) {
            .hero-viewport-fit {
                min-height: auto;
                max-height: none;
                padding-top: 1rem;
                padding-bottom: 2rem;
            }
        }
    </style>

    <script>
        function homeStore() {
            return {
                mobileDrawerOpen: false,
                cartCount: {{ app(\App\Services\CartService::class)->getSummary()['items_count'] }},
                toastVisible: false,
                toastMessage: '',
                showToast(msg) {
                    this.toastMessage = msg;
                    this.toastVisible = true;
                    setTimeout(() => { this.toastVisible = false; }, 3500);
                },
                addToCart(productId, name, price) {
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    fetch('{{ route('cart.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ product_id: productId, quantity: 1 })
                    }).then(res => res.json()).then(data => {
                        this.cartCount = data.cart_count || (this.cartCount + 1);
                        this.showToast('Added ' + name + ' to your order bag!');
                    }).catch(() => {
                        this.cartCount++;
                        this.showToast('Added ' + name + ' to your order bag!');
                    });
                }
            };
        }

        function heroSlider(slidesData) {
            return {
                slides: (slidesData && slidesData.length > 0) ? slidesData : [
                    {
                        id: 1,
                        title: "Burger\nHouse",
                        subtitle: "Delicious Burgers\nMade Fresh",
                        badge: "Signature Gourmet",
                        image: "{{ asset('images/burger-house/hero-burger-transparent.png') }}",
                        cta_text: "Order Now",
                        cta_url: "{{ route('order') }}"
                    }
                ],
                currentIndex: 0,
                autoplayTimer: null,
                isPaused: false,
                init() {
                    this.startAutoplay();
                },
                startAutoplay() {
                    if (this.slides.length <= 1) return;
                    this.stopAutoplay();
                    this.autoplayTimer = setInterval(() => {
                        if (!this.isPaused) {
                            this.next();
                        }
                    }, 5000);
                },
                stopAutoplay() {
                    if (this.autoplayTimer) {
                        clearInterval(this.autoplayTimer);
                        this.autoplayTimer = null;
                    }
                },
                pause() {
                    this.isPaused = true;
                },
                resume() {
                    this.isPaused = false;
                },
                goTo(index) {
                    this.currentIndex = index;
                    this.startAutoplay();
                },
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.slides.length;
                },
                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
                }
            };
        }
    </script>
</head>
<body class="bg-[#FAF6F0] text-[#1E1E1E] font-sans antialiased selection:bg-[#E52E2E] selection:text-white min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full pb-20 md:pb-0"
      x-data="homeStore()">

    <!-- Toast Notification -->
    <div x-show="toastVisible"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="fixed bottom-24 md:bottom-6 right-6 z-50 bg-[#1E1E1E] text-white px-5 py-3 rounded-2xl shadow-2xl flex items-center gap-3 border border-red-500/30 text-xs font-semibold"
         style="display: none;">
        <span class="w-6 h-6 rounded-full bg-[#E52E2E] flex items-center justify-center text-white text-xs">✓</span>
        <span x-text="toastMessage"></span>
    </div>

    <!-- =========================================================================
         NAVIGATION HEADER:
         - Desktop: Classic Top Floating Pill with Logo left, Links center, Cart right
         - Mobile: Large Logo centered, Left: Hamburger & Cart icons
         ========================================================================= -->
    <header class="w-full px-3 sm:px-4 pt-2 sm:pt-3 pb-1 sticky top-0 z-40">
        <!-- DESKTOP NAVIGATION PILL (hidden on mobile, md:flex) -->
        <nav class="hidden md:flex max-w-4xl mx-auto bg-white/95 backdrop-blur-md rounded-full px-5 lg:px-7 py-2.5 shadow-[0_4px_24px_rgba(0,0,0,0.06)] border-2 border-red-200/90 items-center justify-between transition-all">
            <!-- Left: Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group flex-shrink-0">
                @php $siteLogo = \App\Models\SiteSetting::get('site_logo'); @endphp
                @if($siteLogo && file_exists(public_path($siteLogo)))
                    <img src="{{ asset($siteLogo) }}" alt="Burger House" class="h-9 lg:h-10 w-auto object-contain group-hover:scale-105 transition-transform">
                @else
                    <div class="w-9 lg:w-10 h-9 lg:h-10 rounded-full bg-gradient-to-tr from-[#DC2626] to-[#EF4444] flex items-center justify-center text-white shadow-sm border border-white/50 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4c-4.418 0-8 2.239-8 5v1h16V9c0-2.761-3.582-5-8-5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 14h16v1c0 2.761-3.582 5-8 5s-8-2.239-8-5v-1z" />
                            <line x1="3" y1="12" x2="21" y2="12" stroke-linecap="round" />
                        </svg>
                    </div>
                @endif
            </a>

            <!-- Center: Navigation Links -->
            <div class="flex items-center gap-6 lg:gap-8 text-xs lg:text-sm font-medium text-stone-600">
                <a href="{{ route('home') }}" class="relative text-[#1E1E1E] font-semibold flex flex-col items-center">
                    <span>Home</span>
                    <span class="w-5 h-0.5 bg-[#E52E2E] rounded-full mt-0.5"></span>
                </a>
                <a href="{{ route('menu') }}" class="hover:text-[#E52E2E] transition">Menu</a>
                <a href="{{ route('about') }}" class="hover:text-[#E52E2E] transition">About Us</a>
                <a href="{{ route('order') }}" class="hover:text-[#E52E2E] transition">Order</a>
            </div>

            <!-- Right: Cart Icon Badge with Classic Border -->
            <a href="{{ route('cart') }}" class="relative w-10 h-10 rounded-full border-2 border-red-200 hover:border-[#E52E2E] bg-red-50/40 hover:bg-red-50 flex items-center justify-center text-stone-700 transition flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-[#E52E2E] text-white text-[10px] font-bold flex items-center justify-center shadow-xs border border-white" x-text="cartCount">0</span>
            </a>
        </nav>

        <!-- MOBILE TOP BAR (visible on mobile only, md:hidden) -->
        <!-- Requirement: Large logo clearly visible in the Center, Left side has two elements: Cart + Hamburger Menu -->
        <nav class="md:hidden max-w-lg mx-auto bg-white/95 backdrop-blur-md rounded-2xl px-3 py-2 shadow-sm border-2 border-red-200/90 relative flex items-center justify-between min-h-[58px]">
            <!-- Left: Two Elements (Hamburger Drawer Button & Cart Icon) -->
            <div class="flex items-center gap-1.5 z-10">
                <!-- 1. Hamburger Menu Button -->
                <button type="button" 
                        @click="mobileDrawerOpen = true" 
                        aria-label="Open Navigation Menu"
                        class="w-10 h-10 rounded-xl bg-red-50 hover:bg-red-100 text-[#E52E2E] border border-red-200 flex items-center justify-center transition active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- 2. Cart Icon Button -->
                <a href="{{ route('cart') }}" 
                   aria-label="Shopping Cart"
                   class="relative w-10 h-10 rounded-xl bg-red-50 hover:bg-red-100 text-[#E52E2E] border border-red-200 flex items-center justify-center transition active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span class="absolute -top-1 -right-1 min-w-4 h-4 px-1 rounded-full bg-[#E52E2E] text-white text-[10px] font-extrabold flex items-center justify-center shadow-xs border border-white" x-text="cartCount">0</span>
                </a>
            </div>

            <!-- Center: Large Brand Logo prominently displayed -->
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <a href="{{ route('home') }}" class="pointer-events-auto flex items-center justify-center group">
                    @php $siteLogo = \App\Models\SiteSetting::get('site_logo'); @endphp
                    @if($siteLogo && file_exists(public_path($siteLogo)))
                        <img src="{{ asset($siteLogo) }}" alt="Burger House" class="h-11 sm:h-12 max-w-[170px] w-auto object-contain group-hover:scale-105 transition-transform">
                    @else
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#DC2626] to-[#EF4444] flex items-center justify-center text-white shadow-sm border border-white/50">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4c-4.418 0-8 2.239-8 5v1h16V9c0-2.761-3.582-5-8-5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 14h16v1c0 2.761-3.582 5-8 5s-8-2.239-8-5v-1z" />
                                    <line x1="3" y1="12" x2="21" y2="12" stroke-linecap="round" />
                                </svg>
                            </div>
                            <span class="font-black text-sm text-[#1E1E1E] tracking-tight">BURGER HOUSE</span>
                        </div>
                    @endif
                </a>
            </div>

            <!-- Right Spacer for balanced centering -->
            <div class="w-20 z-10 flex justify-end">
                @auth
                    <a href="{{ route('account.dashboard') }}" class="w-9 h-9 rounded-xl bg-stone-100 text-stone-700 flex items-center justify-center text-xs font-bold border border-stone-200" title="{{ Auth::user()->name }}">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-2.5 py-1 rounded-lg text-[11px] font-bold text-stone-600 hover:text-[#E52E2E]">Login</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- =========================================================================
         MOBILE HAMBURGER SLIDE-OVER DRAWER
         Menus required: About us, Contact, Our shops, Refund Policy
         ========================================================================= -->
    <div x-show="mobileDrawerOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 md:hidden" 
         style="display: none;"
         @keydown.escape.window="mobileDrawerOpen = false">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity" @click="mobileDrawerOpen = false"></div>

        <!-- Drawer Panel (Slides in from Left) -->
        <div x-show="mobileDrawerOpen"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 max-w-xs w-full bg-white shadow-2xl flex flex-col justify-between border-r-2 border-red-200/90 z-50">
            
            <div class="p-5 space-y-6">
                <!-- Drawer Header -->
                <div class="flex items-center justify-between pb-4 border-b border-stone-100">
                    <div class="flex items-center gap-2.5">
                        @if($siteLogo && file_exists(public_path($siteLogo)))
                            <img src="{{ asset($siteLogo) }}" alt="Burger House" class="h-9 w-auto object-contain">
                        @else
                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#DC2626] to-[#EF4444] flex items-center justify-center text-white">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4c-4.418 0-8 2.239-8 5v1h16V9c0-2.761-3.582-5-8-5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 14h16v1c0 2.761-3.582 5-8 5s-8-2.239-8-5v-1z" />
                                    <line x1="3" y1="12" x2="21" y2="12" stroke-linecap="round" />
                                </svg>
                            </div>
                        @endif
                        <span class="font-bold text-xs uppercase tracking-wider text-stone-800">Explore</span>
                    </div>
                    <button type="button" 
                            @click="mobileDrawerOpen = false"
                            class="w-8 h-8 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-600 flex items-center justify-center transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Drawer Navigation Links -->
                <div class="space-y-1 text-sm font-semibold">
                    <a href="{{ route('about') }}" 
                       @click="mobileDrawerOpen = false"
                       class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-red-50 text-stone-700 hover:text-[#E52E2E] transition border border-transparent hover:border-red-200">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-[#E52E2E]"></span>
                            <span>About us</span>
                        </div>
                        <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('contact') }}" 
                       @click="mobileDrawerOpen = false"
                       class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-red-50 text-stone-700 hover:text-[#E52E2E] transition border border-transparent hover:border-red-200">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-[#E52E2E]"></span>
                            <span>Contact</span>
                        </div>
                        <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('shops') }}" 
                       @click="mobileDrawerOpen = false"
                       class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-red-50 text-stone-700 hover:text-[#E52E2E] transition border border-transparent hover:border-red-200">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-[#E52E2E]"></span>
                            <span>Our shops</span>
                        </div>
                        <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('refund') }}" 
                       @click="mobileDrawerOpen = false"
                       class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-red-50 text-stone-700 hover:text-[#E52E2E] transition border border-transparent hover:border-red-200">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-[#E52E2E]"></span>
                            <span>Refund Policy</span>
                        </div>
                        <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Drawer Footer Contact Details -->
            <div class="p-5 bg-[#FAF6F0] border-t border-red-200/90 space-y-3">
                <div class="text-xs text-stone-600 space-y-1">
                    <div class="font-bold text-stone-800 uppercase tracking-wider text-[10px]">Kitchen Hotline</div>
                    <div><a href="tel:06621990" class="font-mono font-bold text-[#E52E2E]">06621990</a></div>
                    <div>WhatsApp: <a href="https://wa.me/2556621990" target="_blank" class="font-mono text-emerald-600 font-bold">+255 662 1990</a></div>
                </div>
                <div class="pt-1 text-[10px] text-stone-400">
                    &copy; {{ date('Y') }} {{ \App\Models\SiteSetting::get('company_name', 'Burger House') }}
                </div>
            </div>
        </div>
    </div>

    <main class="flex-1">

        <!-- =========================================================================
             HERO SECTION: Viewport-Fitted, Cutout Gourmet Burger & Dynamic Hero Slider
             ========================================================================= -->
        @php
            $heroSlidesData = ($heroSlides ?? collect())->map(function($slide) {
                $img = $slide->image_url;
                if ($img && !str_starts_with($img, 'http://') && !str_starts_with($img, 'https://')) {
                    $img = asset($img);
                }
                return [
                    'id' => $slide->id,
                    'title' => $slide->title,
                    'subtitle' => $slide->subtitle ?? '',
                    'badge' => $slide->badge ?? '',
                    'image' => $img ?: asset('images/burger-house/hero-burger-transparent.png'),
                    'cta_text' => $slide->cta_text ?: 'Order Now',
                    'cta_url' => $slide->cta_url ?: route('order'),
                ];
            })->values();
        @endphp

        <section class="max-w-6xl mx-auto px-4 sm:px-6 hero-viewport-fit flex flex-col justify-center py-4 sm:py-6 border-b border-red-200/60"
                 x-data="heroSlider({{ Js::from($heroSlidesData) }})"
                 @mouseenter="pause()"
                 @mouseleave="resume()">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-center my-auto min-h-[380px] sm:min-h-[430px]">
                
                <!-- Left Column: Title & Subtitle & Classic Border Dots -->
                <div class="md:col-span-4 flex flex-col justify-between items-center md:items-start text-center md:text-left space-y-4 sm:space-y-6">
                    <div class="relative min-h-[140px] sm:min-h-[190px] flex flex-col justify-center items-center md:items-start">
                        <template x-for="(slide, idx) in slides" :key="'text-' + slide.id">
                            <div x-show="currentIndex === idx"
                                 x-transition:enter="transition ease-out duration-400"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-200 absolute inset-0 pointer-events-none"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 translate-y-2">
                                <template x-if="slide.badge">
                                    <span class="inline-block px-3 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest bg-red-100 text-[#E52E2E] border border-red-300 shadow-xs mb-2" x-text="slide.badge"></span>
                                </template>
                                <h1 class="text-3xl xs:text-4xl sm:text-5xl lg:text-6xl font-black text-[#1E1E1E] tracking-tight leading-[1.05] whitespace-pre-line"
                                    x-text="slide.title">
                                </h1>
                                <p class="mt-2.5 sm:mt-3 text-sm sm:text-lg lg:text-xl font-bold text-[#E52E2E] leading-snug whitespace-pre-line"
                                   x-text="slide.subtitle">
                                </p>
                            </div>
                        </template>
                    </div>

                    <!-- Carousel Dots with Classic Borders -->
                    <div class="pt-2 sm:pt-4 flex items-center justify-center md:justify-start gap-2">
                        <template x-for="(slide, idx) in slides" :key="'dot-' + slide.id">
                            <button type="button" 
                                    @click="goTo(idx)" 
                                    class="transition-all duration-300 cursor-pointer focus:outline-none"
                                    :class="currentIndex === idx 
                                        ? 'w-3 h-3 rounded-full bg-[#E52E2E] border border-red-600/30 shadow-xs scale-110' 
                                        : 'w-3 h-3 rounded-full bg-red-50 hover:bg-red-100/60 border-2 border-red-300'"
                                    :title="'Go to slide ' + (idx + 1)">
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Center Column: Solid Red Circle Disc with Cutout Transparent Gourmet Burger -->
                <div class="md:col-span-5 flex justify-center items-center relative py-2">
                    <div class="relative w-52 h-52 xs:w-60 xs:h-60 sm:w-72 sm:h-72 md:w-80 md:h-80 lg:w-[350px] lg:h-[350px] xl:w-[380px] xl:h-[380px] rounded-full bg-gradient-to-b from-[#E52E2E] to-[#C61A1A] flex items-center justify-center shadow-[0_20px_50px_rgba(229,46,46,0.38)] border-4 border-white/60 ring-2 ring-red-300/40">
                        <template x-for="(slide, idx) in slides" :key="'img-' + slide.id">
                            <img x-show="currentIndex === idx"
                                 x-transition:enter="transition ease-out duration-500"
                                 x-transition:enter-start="opacity-0 scale-90 rotate-[-3deg]"
                                 x-transition:enter-end="opacity-100 scale-100 rotate-0"
                                 x-transition:leave="transition ease-in duration-300 absolute"
                                 x-transition:leave-start="opacity-100 scale-100 rotate-0"
                                 x-transition:leave-end="opacity-0 scale-90 rotate-[3deg]"
                                 :src="slide.image" 
                                 :alt="slide.title" 
                                 class="w-[106%] sm:w-[110%] max-w-none transform -translate-y-2 hover:scale-105 transition-transform duration-500 drop-shadow-[0_20px_25px_rgba(0,0,0,0.35)] select-none pointer-events-none absolute">
                        </template>
                    </div>
                </div>

                <!-- Right Column: Order Now CTA Button with Classic Modified Border -->
                <div class="md:col-span-3 flex justify-center md:justify-end items-center">
                    <div class="relative min-h-[50px] flex items-center">
                        <template x-for="(slide, idx) in slides" :key="'cta-' + slide.id">
                            <a x-show="currentIndex === idx"
                               x-transition:enter="transition ease-out duration-300"
                               x-transition:enter-start="opacity-0 translate-x-2"
                               x-transition:enter-end="opacity-100 translate-x-0"
                               x-transition:leave="transition ease-in duration-200 absolute"
                               x-transition:leave-start="opacity-100 translate-x-0"
                               x-transition:leave-end="opacity-0 translate-x-2"
                               :href="slide.cta_url" 
                               class="inline-flex items-center gap-2.5 px-7 sm:px-8 py-3 sm:py-3.5 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] text-white font-semibold text-xs sm:text-sm shadow-lg shadow-red-500/30 border-2 border-white/50 ring-2 ring-red-400/30 transition-transform duration-300 hover:scale-105 active:scale-95">
                                <span x-text="slide.cta_text"></span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M17 7H7M17 7V17"/>
                                </svg>
                            </a>
                        </template>
                    </div>
                </div>

            </div>
        </section>


        <!-- =========================================================================
             SECTION 2: MENU & HOT DEALS COMBO SPOTLIGHT (Classic Modified Borders)
             ========================================================================= -->
        <section id="menu" class="max-w-6xl mx-auto px-4 sm:px-6 py-8 sm:py-12 border-b border-red-200/60">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Area: Menu Header + 4 Product Cards (7 Cols) -->
                <div class="lg:col-span-7 space-y-5">
                    
                    <!-- Section Heading & Scroll Controls -->
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-red-100/70 border border-red-200 text-[#E52E2E] text-[10px] font-bold uppercase tracking-wider mb-1.5">
                                <span>Fresh From The Kitchen</span>
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1E1E1E]">Menu</h2>
                            <p class="text-xs text-stone-500 mt-0.5">Served with Golden Crisp fries and a Drink! All prices in Tshs.</p>
                        </div>

                        <!-- Scroll Arrows -->
                        <div class="flex items-center gap-1.5">
                            <button type="button" 
                                    @click="$refs.homeMenuScroller.scrollBy({ left: -220, behavior: 'smooth' })" 
                                    class="w-7 h-7 rounded-full bg-white hover:bg-[#E52E2E] text-stone-600 hover:text-white border border-stone-200/90 flex items-center justify-center transition shadow-2xs group"
                                    title="Scroll left">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button type="button" 
                                    @click="$refs.homeMenuScroller.scrollBy({ left: 220, behavior: 'smooth' })" 
                                    class="w-7 h-7 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] text-white border border-red-600/30 flex items-center justify-center transition shadow-2xs group"
                                    title="Scroll right">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Scrollable Product Cards with Classic Modified Borders -->
                    <div x-ref="homeMenuScroller"
                         class="flex items-stretch gap-3 sm:gap-3.5 overflow-x-auto pb-3 pt-1 px-0.5 scroll-smooth snap-x snap-mandatory scrollbar-none">
                        @php
                            $homeProducts = (isset($featuredProducts) && $featuredProducts->count() > 0)
                                ? $featuredProducts
                                : \App\Models\Product::with(['category', 'images'])->where('is_active', true)->take(6)->get();
                        @endphp

                        @foreach($homeProducts as $prod)
                            <div class="flex-none w-[175px] sm:w-[195px] snap-start bg-white rounded-2xl p-3 sm:p-3.5 shadow-xs border-2 border-stone-200/85 hover:border-[#E52E2E]/70 relative flex flex-col justify-between group hover:shadow-md transition-all duration-300">
                                @if(!empty($prod->badges) && is_array($prod->badges))
                                    <div class="absolute -top-2.5 right-2 bg-[#E52E2E] text-white text-[8px] sm:text-[9px] font-extrabold px-2 py-0.5 rounded-full shadow-xs border border-white/60 tracking-tight">
                                        {{ $prod->badges[0] }}
                                    </div>
                                @elseif($prod->is_featured)
                                    <div class="absolute -top-2.5 right-2 bg-[#E52E2E] text-white text-[8px] sm:text-[9px] font-extrabold px-2 py-0.5 rounded-full shadow-xs border border-white/60 tracking-tight">
                                        Popular
                                    </div>
                                @endif

                                <div>
                                    <div class="w-full h-24 sm:h-28 rounded-xl overflow-hidden bg-stone-50 mb-2 border border-stone-200/70">
                                        <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <h3 class="font-bold text-xs text-[#1E1E1E] leading-snug truncate">{{ $prod->name }}</h3>
                                    <p class="text-[10px] text-stone-500 mt-1 leading-snug line-clamp-2">
                                        {{ $prod->short_description ?? 'Handcrafted fresh gourmet burger with premium ingredients.' }}
                                    </p>
                                </div>

                                <div class="mt-3 pt-2 border-t border-stone-200/70 flex items-center justify-between">
                                    <span class="font-extrabold text-xs text-[#1E1E1E]">{{ $prod->formatted_price }}</span>
                                    <button type="button" 
                                            @click="addToCart({{ $prod->id }}, '{{ addslashes($prod->name) }}', {{ $prod->effective_price }})"
                                            class="px-2.5 py-1 rounded-full bg-red-50 hover:bg-[#E52E2E] text-[#E52E2E] hover:text-white border border-red-200 hover:border-[#E52E2E] flex items-center justify-center transition shadow-2xs text-[11px] font-bold">
                                        <span>+ Add</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- 5 Carousel Dots with Classic Borders -->
                    <div class="flex justify-center items-center gap-1.5 pt-1">
                        <span class="w-2.5 h-2.5 rounded-full border-2 border-red-300 bg-red-50"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-[#E52E2E] border border-red-600/30"></span>
                        <span class="w-2.5 h-2.5 rounded-full border-2 border-red-300 bg-red-50"></span>
                        <span class="w-2.5 h-2.5 rounded-full border-2 border-red-300 bg-red-50"></span>
                        <span class="w-2.5 h-2.5 rounded-full border-2 border-red-300 bg-red-50"></span>
                    </div>

                </div>

                <!-- Right Area: Hot Deals / Combo Pack Spotlight Circle with Classic Modified Border (5 Cols) -->
                @php
                    $combo = $comboBanner ?? \App\Models\Banner::where('type', 'combo_pack')->first();
                    $comboTitle = $combo->title ?? 'Hot Deals';
                    $comboBadge = $combo->badge ?? 'Free Delivery';
                    $comboImg = $combo->image_url ?? 'images/burger-house/hot-deals-combo.jpg';
                    if ($comboImg && !str_starts_with($comboImg, 'http://') && !str_starts_with($comboImg, 'https://')) {
                        $comboImg = asset($comboImg);
                    }
                    $comboCtaText = $combo->cta_text ?? 'Combo Pack';
                    $comboCtaUrl = $combo->cta_url ?? route('order');
                    $comboRating = is_numeric($combo->secondary_cta_text ?? null) ? (int)$combo->secondary_cta_text : 5;
                    $comboIsActive = $combo ? $combo->is_active : true;
                @endphp

                @if($comboIsActive)
                <div class="lg:col-span-5 relative flex justify-center w-full">
                    <div class="w-[280px] xs:w-[310px] sm:w-[350px] md:w-[380px] max-w-full aspect-square rounded-full bg-gradient-to-b from-[#FFF5F2] via-[#FAF6F0] to-[#FDF2F0] relative p-4 xs:p-5 sm:p-6 flex flex-col items-center justify-between overflow-hidden shadow-[0_12px_35px_rgba(229,46,46,0.12)] border-2 border-red-200/90 ring-4 ring-red-100/50 mx-auto">
                        
                        <!-- Top Row: Title + Ribbon Badge (With safe inset padding so circular border never clips text) -->
                        <div class="w-full px-5 xs:px-6 sm:px-8 pt-2 flex items-start justify-between z-10">
                            <div>
                                <h3 class="font-bold text-base xs:text-lg sm:text-xl text-[#B77B3B] leading-tight">{{ $comboTitle }}</h3>
                                <svg class="w-10 xs:w-12 h-2 text-[#E52E2E] mt-0.5" viewBox="0 0 60 8" fill="none">
                                    <path d="M2 6C15 2 40 2 58 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>

                            <!-- Ribbon Badge with Classic Border -->
                            @if($comboBadge)
                            <div class="relative">
                                <div class="bg-white/95 border-2 border-red-300 text-[#D32F2F] text-[8px] xs:text-[9px] font-black px-2.5 py-0.5 rounded-full shadow-xs flex items-center gap-1 text-center leading-tight">
                                    <span>{!! nl2br(e($comboBadge)) !!}</span>
                                </div>
                                <div class="absolute -bottom-1 right-2 flex gap-1">
                                    <div class="w-1 h-1 bg-[#D32F2F] rotate-45"></div>
                                    <div class="w-1 h-1 bg-[#D32F2F] rotate-45"></div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Floating Ingredients (Decorative SVGs in mid-air) -->
                        <div class="absolute inset-0 pointer-events-none">
                            <div class="absolute top-10 right-16 w-6 xs:w-7 h-6 xs:h-7 rounded-full bg-red-500/80 border-2 border-red-600/90 shadow-sm transform rotate-12"></div>
                            <div class="absolute top-16 left-12 w-7 xs:w-8 h-7 xs:h-8 rounded-full border-4 border-purple-200/90 transform -rotate-12"></div>
                            <div class="absolute top-24 left-6 w-8 xs:w-9 h-2.5 bg-amber-800/80 rounded-full transform rotate-45 border border-amber-900/40"></div>
                            <div class="absolute top-20 right-8 w-7 xs:w-8 h-5 xs:h-6 bg-amber-400 rounded-sm transform rotate-45 shadow-xs border border-amber-500/50"></div>
                        </div>

                        <!-- Center Meal: Burger + Fries + Drink with Classic Border -->
                        <a href="{{ $comboCtaUrl }}" class="relative z-10 w-full max-w-[200px] xs:max-w-[230px] sm:max-w-[260px] rounded-2xl overflow-hidden shadow-lg border-2 border-white my-auto block hover:scale-105 transition-transform duration-300 ring-2 ring-red-200/40">
                            <img src="{{ $comboImg }}" alt="{{ $comboTitle }}" class="w-full h-32 xs:h-36 sm:h-40 object-cover">
                        </a>

                        <!-- Bottom: Rating & Combo Pack Pill with Classic Border -->
                        <div class="w-full flex flex-col items-center z-10 -mt-1 pb-1">
                            <div class="flex items-center gap-0.5 text-amber-500 text-xs">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $comboRating ? 'text-amber-500' : 'text-stone-300' }}">★</span>
                                @endfor
                            </div>
                            <a href="{{ $comboCtaUrl }}" class="mt-1 bg-[#D32F2F] hover:bg-red-700 text-white text-[9px] font-bold px-3.5 py-0.5 rounded-full shadow-xs border border-white/50 transition tracking-wide">
                                {{ $comboCtaText }}
                            </a>
                        </div>

                    </div>
                </div>
                @endif

            </div>
        </section>


        @if(isset($testimonials) && $testimonials->count() > 0)
        <!-- =========================================================================
             SECTION 3: REVIEWS (Classic Modified Borders)
             ========================================================================= -->
        <section class="max-w-5xl mx-auto px-4 sm:px-6 py-8 sm:py-10 border-b border-red-200/60">
            
            <!-- Reviews Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1E1E1E]">Reviews</h2>
                    <div class="w-10 h-0.5 bg-[#E52E2E] rounded-full mt-1.5"></div>
                </div>

                <button type="button" 
                        @click="showToast('Share your experience on WhatsApp!')"
                        class="px-4 py-1.5 rounded-full border-2 border-red-300/90 hover:border-[#E52E2E] text-stone-700 hover:text-[#E52E2E] bg-white text-xs font-semibold flex items-center gap-1.5 shadow-xs transition">
                    <svg class="w-3.5 h-3.5 text-[#E52E2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    <span>Write a review</span>
                </button>
            </div>

            <!-- Dynamic Customer Reviews Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5 sm:gap-4">
                @foreach($testimonials as $test)
                    <div class="bg-white rounded-2xl p-3.5 sm:p-4 shadow-xs border-2 border-stone-200/85 hover:border-red-300/90 flex items-center gap-3.5 hover:shadow-md transition-all duration-300">
                        <div class="w-11 h-11 rounded-full bg-red-100 border-2 border-red-200 text-[#E52E2E] font-bold flex items-center justify-center flex-shrink-0 text-sm">
                            {{ substr($test->customer_name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h4 class="font-bold text-xs text-[#1E1E1E] truncate">{{ $test->customer_name }}</h4>
                                <div class="flex items-center gap-1 text-[11px] font-bold text-[#E52E2E]">
                                    <span>{{ str_repeat('★', (int)$test->rating) }}</span>
                                    <span class="text-stone-700 ml-0.5">{{ number_format($test->rating, 1) }}</span>
                                </div>
                            </div>
                            <p class="text-xs text-stone-500 mt-0.5 line-clamp-2">{{ $test->comment }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @endif


        <!-- =========================================================================
             SECTION 4: SOCIAL MEDIA (Classic Modified Borders)
             ========================================================================= -->
        @php
            $socialTitle = \App\Models\SiteSetting::get('social_section_title', 'Social Media');
            $socialSubtitle = \App\Models\SiteSetting::get('social_section_subtitle', 'Follow us for updates and more!');
            $facebookUrl = \App\Models\SiteSetting::get('facebook_url', 'https://facebook.com');
            $instagramUrl = \App\Models\SiteSetting::get('instagram_url', 'https://instagram.com');
            $twitterUrl = \App\Models\SiteSetting::get('twitter_url', 'https://twitter.com');
            $socialImg1 = \App\Models\SiteSetting::get('social_img_1', 'images/burger-house/social-1.jpg');
            $socialImg2 = \App\Models\SiteSetting::get('social_img_2', 'images/burger-house/social-2.jpg');
            $socialImg3 = \App\Models\SiteSetting::get('social_img_3', 'images/burger-house/social-3.jpg');
            $socialImg4 = \App\Models\SiteSetting::get('social_img_4', 'images/burger-house/social-4.jpg');
        @endphp
        <section class="max-w-5xl mx-auto px-4 sm:px-6 py-8 sm:py-10">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1E1E1E]">{{ $socialTitle }}</h2>
                <p class="text-xs text-stone-500 mt-0.5">{{ $socialSubtitle }}</p>
            </div>

            <div class="mt-5 flex flex-col md:flex-row items-center gap-5">
                <!-- 4 Food Photos with Classic Borders -->
                <div class="flex-1 grid grid-cols-2 sm:grid-cols-4 gap-3 w-full">
                    <div class="aspect-4/3 rounded-2xl overflow-hidden shadow-xs hover:shadow-md transition-all duration-300 border-2 border-stone-200/85 hover:border-[#E52E2E]/80 group">
                        <img src="{{ asset($socialImg1) }}" alt="Social photo 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="aspect-4/3 rounded-2xl overflow-hidden shadow-xs hover:shadow-md transition-all duration-300 border-2 border-stone-200/85 hover:border-[#E52E2E]/80 group">
                        <img src="{{ asset($socialImg2) }}" alt="Social photo 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="aspect-4/3 rounded-2xl overflow-hidden shadow-xs hover:shadow-md transition-all duration-300 border-2 border-stone-200/85 hover:border-[#E52E2E]/80 group">
                        <img src="{{ asset($socialImg3) }}" alt="Social photo 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="aspect-4/3 rounded-2xl overflow-hidden shadow-xs hover:shadow-md transition-all duration-300 border-2 border-stone-200/85 hover:border-[#E52E2E]/80 group">
                        <img src="{{ asset($socialImg4) }}" alt="Social photo 4" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                </div>

                <!-- 3 Circular Social Media Buttons with Classic Borders -->
                <div class="flex md:flex-col items-center gap-3">
                    @if($facebookUrl)
                    <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white hover:bg-[#E52E2E] text-[#E52E2E] hover:text-white border-2 border-red-300/80 hover:border-[#E52E2E] flex items-center justify-center shadow-xs transition hover:scale-105">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.592 0 9 1.583 9 4.615V8z"/></svg>
                    </a>
                    @endif
                    @if($instagramUrl)
                    <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white hover:bg-[#E52E2E] text-[#E52E2E] hover:text-white border-2 border-red-300/80 hover:border-[#E52E2E] flex items-center justify-center shadow-xs transition hover:scale-105">
                        <svg class="w-3.5 h-3.5 fill-none stroke-current" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    @endif
                    @if($twitterUrl)
                    <a href="{{ $twitterUrl }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white hover:bg-[#E52E2E] text-[#E52E2E] hover:text-white border-2 border-red-300/80 hover:border-[#E52E2E] flex items-center justify-center shadow-xs transition hover:scale-105">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.18 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z"/></svg>
                    </a>
                    @endif
                </div>
            </div>
        </section>

    </main>

    <!-- =========================================================================
         SECTION 5: FOOTER (Classic Modified Borders)
         ========================================================================= -->
    @php
        $footerPhone = \App\Models\SiteSetting::get('company_phone', '06621990');
        $footerEmail = \App\Models\SiteSetting::get('company_email', 'contact@burgerhouse.com');
        $footerNewsletter = \App\Models\SiteSetting::get('footer_newsletter_title', 'Subscribe to our newsletter');
        $googlePlayUrl = \App\Models\SiteSetting::get('google_play_url', 'https://play.google.com');
    @endphp
    <footer class="w-full px-4 pb-5 pt-3">
        <div class="max-w-5xl mx-auto space-y-3">
            <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-sm border-2 border-stone-200/85 flex flex-col md:flex-row items-center justify-between gap-5">
                
                <!-- Left: Logo + Phone & Email -->
                <div class="flex flex-wrap items-center gap-5">
                    @if($siteLogo && file_exists(public_path($siteLogo)))
                        <img src="{{ asset($siteLogo) }}" alt="Burger House" class="h-10 w-auto object-contain flex-shrink-0">
                    @else
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#DC2626] to-[#EF4444] flex items-center justify-center text-white shadow-sm border border-white/50 flex-shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4c-4.418 0-8 2.239-8 5v1h16V9c0-2.761-3.582-5-8-5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 14h16v1c0 2.761-3.582 5-8 5s-8-2.239-8-5v-1z" />
                                <line x1="3" y1="12" x2="21" y2="12" stroke-linecap="round" />
                            </svg>
                        </div>
                    @endif

                    <div class="space-y-0.5 text-xs text-stone-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-[#E52E2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerPhone) }}" class="hover:text-[#E52E2E] font-medium">{{ $footerPhone }}</a>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-[#E52E2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:{{ $footerEmail }}" class="hover:text-[#E52E2E] font-medium">{{ $footerEmail }}</a>
                        </div>
                    </div>
                </div>

                <!-- Center: Subscribe to our newsletter -->
                <div class="w-full md:w-auto">
                    <p class="text-[11px] font-semibold text-stone-600 mb-1">{{ $footerNewsletter }}</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex items-center gap-1.5">
                        @csrf
                        <input type="email" 
                               name="email" 
                               placeholder="Your email" 
                               required 
                               class="px-3.5 py-1.5 bg-stone-50 border-2 border-stone-200/90 rounded-xl text-xs text-stone-800 placeholder-stone-400 focus:outline-none focus:border-[#E52E2E] w-44 sm:w-52">
                        <button type="submit" 
                                class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-[#E52E2E] hover:bg-[#C61A1A] text-white flex items-center justify-center shadow-xs border border-red-400 transition">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Right: Google Play Badge with Classic Border -->
                <div>
                    <a href="{{ $googlePlayUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3 py-1 rounded-xl border-2 border-stone-200 hover:border-stone-400 bg-white transition shadow-xs">
                        <svg class="w-4 h-4" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M3.6 1.8L13.8 12 3.6 22.2c-.3-.3-.6-.8-.6-1.5V3.3c0-.7.3-1.2.6-1.5z"/>
                            <path fill="#34A853" d="M17.2 8.6L13.8 12l3.4 3.4 3.8-2.2c.7-.4.7-1.1 0-1.5l-3.8-3.1z"/>
                            <path fill="#FBBC05" d="M3.6 1.8l10.2 10.2 3.4-3.4L6.1.5C5.4.1 4.4.2 3.6 1.8z"/>
                            <path fill="#EA4335" d="M17.2 15.4L13.8 12 3.6 22.2c.8 1.6 1.8 1.7 2.5 1.3l11.1-8.1z"/>
                        </svg>
                        <div class="text-left leading-tight">
                            <span class="block text-[7px] text-stone-500 uppercase tracking-wider font-semibold">GET IT ON</span>
                            <span class="block text-[11px] font-bold text-stone-900 tracking-tight">Google Play</span>
                        </div>
                    </a>
                </div>

            </div>

            <!-- Bottom Copyright & Developer Credit Bar -->
            <div class="flex flex-col sm:flex-row items-center justify-between text-[11px] text-stone-400 px-3 py-1 gap-2">
                <span>&copy; {{ date('Y') }} {{ \App\Models\SiteSetting::get('company_name', 'Burger House') }}. All rights reserved.</span>
                <span>Website by <a href="https://reliancesolutions.co.tz" target="_blank" rel="noopener noreferrer" class="text-[#E52E2E] font-bold hover:underline">Reliance Solutions</a></span>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Contact Button (06621990) -->
    <aside aria-label="WhatsApp Fast Support" class="fixed bottom-20 md:bottom-5 right-4 sm:right-6 z-40">
        <a href="https://wa.me/{{ \App\Models\SiteSetting::get('company_whatsapp', '2556621990') }}?text={{ urlencode('Habari Burger House! Naomba kuweka oda.') }}" 
           target="_blank" 
           rel="noopener noreferrer"
           class="group relative flex items-center gap-2.5 bg-[#25D366] hover:bg-[#20ba5a] text-white p-3 sm:px-4 sm:py-3 rounded-full shadow-[0_6px_20px_rgba(37,211,102,0.45)] hover:shadow-[0_8px_25px_rgba(37,211,102,0.6)] transition-all duration-300 hover:scale-105 active:scale-95 border-2 border-white ring-2 ring-emerald-300/40">
            
            <!-- Ripple Pulse Ring -->
            <span class="absolute -inset-0.5 rounded-full bg-[#25D366] opacity-75 animate-ping -z-10"></span>
            
            <!-- WhatsApp Official SVG Icon -->
            <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-current flex-shrink-0" viewBox="0 0 24 24">
                <path d="M12.031 2c-5.508 0-9.986 4.477-9.986 9.974 0 1.761.459 3.479 1.332 5.004l-1.417 5.176 5.305-1.392c1.47.801 3.125 1.226 4.766 1.226 5.508 0 9.986-4.477 9.986-9.974 0-5.498-4.478-9.988-9.986-9.988zm0 18.274c-1.485 0-2.942-.399-4.212-1.155l-.302-.18-3.136.823.837-3.056-.197-.315c-.83-1.32-1.268-2.859-1.268-4.415 0-4.57 3.719-8.288 8.278-8.288 4.56 0 8.278 3.719 8.278 8.288 0 4.569-3.718 8.298-8.278 8.298zm4.538-6.205c-.249-.125-1.472-.726-1.7-.809-.229-.083-.395-.125-.561.125-.166.249-.644.809-.789.975-.145.166-.291.187-.54.062s-1.05-.387-2.001-1.234c-.74-.66-1.24-1.476-1.385-1.725-.145-.249-.015-.383.11-.507.112-.112.249-.291.374-.436.125-.145.166-.249.249-.415.083-.166.042-.312-.021-.436s-.561-1.35-.769-1.849c-.202-.486-.407-.42-.561-.428-.145-.008-.312-.01-.478-.01s-.436.062-.664.312c-.229.249-.872.852-.872 2.077s.893 2.409 1.018 2.575c.125.166 1.758 2.684 4.258 3.764.595.257 1.06.41 1.422.525.598.19 1.142.163 1.572.099.48-.072 1.472-.602 1.68-1.183.208-.582.208-1.08.145-1.184-.063-.103-.229-.165-.478-.29z"/>
            </svg>

            <!-- Label -->
            <span class="hidden sm:inline font-extrabold text-xs tracking-wider">WhatsApp 06621990</span>
        </a>
    </aside>

    <!-- =========================================================================
         MOBILE APP BOTTOM TAB NAVIGATION (Visible on mobile only, md:hidden)
         Menus required: HOME, PRODUCT, ORDERS, PAYMENTS, PROFILE
         ========================================================================= -->
    <nav aria-label="Mobile App Navigation" class="md:hidden fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-md border-t-2 border-red-200/90 z-40 px-2 py-1.5 shadow-[0_-4px_20px_rgba(0,0,0,0.06)]">
        <div class="grid grid-cols-5 gap-1 items-center max-w-md mx-auto text-center">
            
            <!-- 1. HOME -->
            <a href="{{ route('home') }}" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ request()->routeIs('home') ? 'text-[#E52E2E] font-bold' : 'text-stone-500 hover:text-[#E52E2E]' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('home') ? 'stroke-[2.5]' : 'stroke-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-[10px] tracking-tight uppercase font-extrabold mt-0.5">Home</span>
            </a>

            <!-- 2. PRODUCT (Menu / Shop) -->
            <a href="{{ route('menu') }}" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ (request()->routeIs('menu') || request()->routeIs('shop*') || request()->routeIs('product.*')) ? 'text-[#E52E2E] font-bold' : 'text-stone-500 hover:text-[#E52E2E]' }}">
                <svg class="w-5 h-5 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                <span class="text-[10px] tracking-tight uppercase font-extrabold mt-0.5">Product</span>
            </a>

            <!-- 3. ORDERS (Live Order / Track Order) -->
            <a href="{{ route('order') }}" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ (request()->routeIs('order*') || request()->routeIs('cart*') || request()->routeIs('checkout*') || request()->routeIs('track*')) ? 'text-[#E52E2E] font-bold' : 'text-stone-500 hover:text-[#E52E2E]' }}">
                <div class="relative">
                    <svg class="w-5 h-5 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <template x-if="cartCount > 0">
                        <span class="absolute -top-1 -right-2.5 w-3.5 h-3.5 rounded-full bg-[#E52E2E] text-white text-[9px] font-bold flex items-center justify-center" x-text="cartCount"></span>
                    </template>
                </div>
                <span class="text-[10px] tracking-tight uppercase font-extrabold mt-0.5">Orders</span>
            </a>

            <!-- 4. PAYMENTS (Till & Mobile Money Info / Checkout) -->
            <a href="{{ route('checkout') }}" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ request()->routeIs('checkout*') ? 'text-[#E52E2E] font-bold' : 'text-stone-500 hover:text-[#E52E2E]' }}">
                <svg class="w-5 h-5 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="2" y="5" width="20" height="14" rx="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <line x1="2" y1="10" x2="22" y2="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="text-[10px] tracking-tight uppercase font-extrabold mt-0.5">Payments</span>
            </a>

            <!-- 5. PROFILE (Customer Dashboard / Login) -->
            <a href="{{ Auth::check() ? route('account.dashboard') : route('login') }}" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ (request()->routeIs('account.*') || request()->routeIs('login*') || request()->routeIs('register*')) ? 'text-[#E52E2E] font-bold' : 'text-stone-500 hover:text-[#E52E2E]' }}">
                <svg class="w-5 h-5 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-[10px] tracking-tight uppercase font-extrabold mt-0.5">Profile</span>
            </a>

        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>
