<!DOCTYPE html>
<html lang="en" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Burger House | Delicious Burgers Made Fresh')</title>
    <meta name="description" content="@yield('meta_description', 'Discover the best gourmet burgers made fresh with prime beef, crisp lettuce, melted cheese and golden fries. Order now for fast delivery.')">
    <meta name="keywords" content="Burger House, gourmet burgers, fresh burgers, cheeseburger, fast delivery">

    <!-- OpenGraph / Social Metadata -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Burger House | Delicious Burgers Made Fresh')">
    <meta property="og:description" content="@yield('meta_description', 'Discover the best gourmet burgers made fresh with prime beef, crisp lettuce, melted cheese and golden fries.')">
    <meta property="og:image" content="{{ asset('images/burger-house/hero-burger.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    @php 
        $siteFavicon = \App\Models\SiteSetting::get('site_favicon'); 
        $siteLogo = \App\Models\SiteSetting::get('site_logo');
    @endphp
    @if($siteFavicon && file_exists(public_path($siteFavicon)))
        <link rel="icon" href="{{ asset($siteFavicon) }}">
    @endif

    <!-- Google Fonts: Inter for crisp interface text -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#FAF6F0] text-[#1E1E1E] font-sans antialiased selection:bg-[#E52E2E] selection:text-white min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full pb-20 md:pb-0"
      x-data="{
          mobileDrawerOpen: false,
          searchModalOpen: false,
          cartCount: {{ app(\App\Services\CartService::class)->getSummary()['items_count'] }},
          toastMessage: '',
          toastVisible: false,
          showToast(msg) {
              this.toastMessage = msg;
              this.toastVisible = true;
              setTimeout(() => { this.toastVisible = false; }, 3500);
          },
          addToCart(productId, variantId = null, weight = null, qty = 1) {
              fetch('{{ route('cart.add') }}', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content'),
                      'Accept': 'application/json'
                  },
                  body: JSON.stringify({
                      product_id: productId,
                      variant_id: variantId,
                      weight: weight,
                      quantity: qty
                  })
              })
              .then(r => r.json())
              .then(res => {
                  if (res.success) {
                      this.cartCount = res.items_count;
                      this.showToast('✓ ' + res.message);
                  }
              })
              .catch(err => {
                  window.location.href = '{{ route('cart') }}';
              });
          }
      }"
      x-init="lucide.createIcons()"
      @toast.window="showToast($event.detail)">

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
                @if($siteLogo && file_exists(public_path($siteLogo)))
                    <img src="{{ asset($siteLogo) }}" alt="Burger House" class="h-9 lg:h-10 w-auto object-contain group-hover:scale-105 transition-transform">
                @else
                    <div class="w-9 h-9 lg:w-10 lg:h-10 rounded-full bg-gradient-to-tr from-[#DC2626] to-[#EF4444] flex items-center justify-center text-white shadow-sm border border-white/50 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4c-4.418 0-8 2.239-8 5v1h16V9c0-2.761-3.582-5-8-5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 14h16v1c0 2.761-3.582 5-8 5s-8-2.239-8-5v-1z" />
                            <line x1="3" y1="12" x2="21" y2="12" stroke-linecap="round" />
                        </svg>
                    </div>
                @endif
            </a>

            <!-- Center: Desktop Links -->
            <div class="flex items-center gap-6 lg:gap-8 text-xs lg:text-sm font-medium text-stone-600">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'relative text-[#1E1E1E] font-semibold flex flex-col items-center' : 'hover:text-[#E52E2E] transition' }}">
                    <span>Home</span>
                    @if(request()->routeIs('home'))
                        <span class="w-5 h-0.5 bg-[#E52E2E] rounded-full mt-0.5"></span>
                    @endif
                </a>
                <a href="{{ route('menu') }}" class="{{ (request()->routeIs('menu') || request()->routeIs('shop*')) ? 'relative text-[#1E1E1E] font-semibold flex flex-col items-center' : 'hover:text-[#E52E2E] transition' }}">
                    <span>Menu</span>
                    @if(request()->routeIs('menu') || request()->routeIs('shop*'))
                        <span class="w-5 h-0.5 bg-[#E52E2E] rounded-full mt-0.5"></span>
                    @endif
                </a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about*') ? 'relative text-[#1E1E1E] font-semibold flex flex-col items-center' : 'hover:text-[#E52E2E] transition' }}">
                    <span>About Us</span>
                    @if(request()->routeIs('about*'))
                        <span class="w-5 h-0.5 bg-[#E52E2E] rounded-full mt-0.5"></span>
                    @endif
                </a>
                <a href="{{ route('order') }}" class="{{ (request()->routeIs('order*') || request()->routeIs('cart*') || request()->routeIs('checkout*')) ? 'relative text-[#1E1E1E] font-semibold flex flex-col items-center' : 'hover:text-[#E52E2E] transition' }}">
                    <span>Order</span>
                    @if(request()->routeIs('order*') || request()->routeIs('cart*') || request()->routeIs('checkout*'))
                        <span class="w-5 h-0.5 bg-[#E52E2E] rounded-full mt-0.5"></span>
                    @endif
                </a>
            </div>

            <!-- Right: Desktop Account & Cart -->
            <div class="flex items-center gap-3">
                @auth
                    <div class="relative" x-data="{ userMenuOpen: false }">
                        <button @click="userMenuOpen = !userMenuOpen" class="w-8 h-8 rounded-full bg-red-50 text-[#E52E2E] hover:bg-red-100 flex items-center justify-center transition" title="{{ Auth::user()->name }}">
                            <i data-lucide="user" class="w-4 h-4"></i>
                        </button>
                        <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-transition class="absolute right-0 mt-2 w-44 bg-white rounded-2xl shadow-xl border border-red-100 py-2 z-50 text-xs">
                            <div class="px-4 py-2 border-b border-red-100/60 font-semibold text-stone-900 truncate">{{ Auth::user()->name }}</div>
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-stone-700 hover:text-[#E52E2E] hover:bg-red-50 font-medium">Admin Dashboard</a>
                            @endif
                            <a href="{{ route('account.dashboard') }}" class="block px-4 py-2 text-stone-700 hover:text-[#E52E2E] hover:bg-red-50">My Account</a>
                            <a href="{{ route('account.orders') }}" class="block px-4 py-2 text-stone-700 hover:text-[#E52E2E] hover:bg-red-50">My Orders</a>
                            <form method="POST" action="{{ route('logout') }}" class="border-t border-red-100/60 mt-1 pt-1">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">Log Out</button>
                            </form>
                        </div>
                    </div>
                @endauth

                <a href="{{ route('cart') }}" class="relative w-10 h-10 rounded-full border-2 border-red-200 hover:border-[#E52E2E] bg-red-50/40 hover:bg-red-50 flex items-center justify-center text-stone-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-[#E52E2E] text-white text-[10px] font-bold flex items-center justify-center shadow-xs border border-white" x-text="cartCount">0</span>
                </a>
            </div>
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

    <!-- Main Page Content -->
    <main class="flex-1">
        <!-- Flash messages -->
        @if(session('success'))
            <div class="max-w-4xl mx-auto px-4 mt-4">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl flex items-center justify-between text-xs font-semibold shadow-xs">
                    <div class="flex items-center gap-2">
                        <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs">✓</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 text-base">&times;</button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-4xl mx-auto px-4 mt-4">
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-2xl flex items-center justify-between text-xs font-semibold shadow-xs">
                    <div class="flex items-center gap-2">
                        <span class="w-5 h-5 rounded-full bg-red-500 text-white flex items-center justify-center text-xs">!</span>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900 text-base">&times;</button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- =========================================================================
         FOOTER (Classic Modified Borders)
         ========================================================================= -->
    @php
        $layoutFooterPhone = \App\Models\SiteSetting::get('company_phone', '06621990');
        $layoutFooterEmail = \App\Models\SiteSetting::get('company_email', 'contact@burgerhouse.com');
        $layoutFooterNewsletter = \App\Models\SiteSetting::get('footer_newsletter_title', 'Subscribe to our newsletter');
        $layoutGooglePlayUrl = \App\Models\SiteSetting::get('google_play_url', 'https://play.google.com');
    @endphp
    <footer class="w-full px-4 pb-5 pt-3 mt-8">
        <div class="max-w-5xl mx-auto space-y-3">
            <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-sm border-2 border-stone-200/85 flex flex-col md:flex-row items-center justify-between gap-5">
                
                <!-- Left: Logo + Phone & Email -->
                <div class="flex flex-wrap items-center gap-6">
                    <!-- Circular Logo Badge or Uploaded Logo -->
                    @if($siteLogo && file_exists(public_path($siteLogo)))
                        <img src="{{ asset($siteLogo) }}" alt="Burger House" class="h-11 w-auto object-contain flex-shrink-0">
                    @else
                        <div class="w-11 h-11 rounded-full bg-gradient-to-tr from-[#DC2626] to-[#EF4444] flex items-center justify-center text-white shadow-sm border border-white/50 flex-shrink-0">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4c-4.418 0-8 2.239-8 5v1h16V9c0-2.761-3.582-5-8-5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 14h16v1c0 2.761-3.582 5-8 5s-8-2.239-8-5v-1z" />
                                <line x1="3" y1="12" x2="21" y2="12" stroke-linecap="round" />
                            </svg>
                        </div>
                    @endif

                    <!-- Phone & Email info -->
                    <div class="space-y-1 text-xs text-stone-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-[#E52E2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $layoutFooterPhone) }}" class="hover:text-[#E52E2E] font-medium">{{ $layoutFooterPhone }}</a>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-[#E52E2E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:{{ $layoutFooterEmail }}" class="hover:text-[#E52E2E] font-medium">{{ $layoutFooterEmail }}</a>
                        </div>
                    </div>
                </div>

                <!-- Center: Subscribe to our newsletter -->
                <div class="w-full md:w-auto">
                    <p class="text-[11px] font-semibold text-stone-600 mb-1.5">{{ $layoutFooterNewsletter }}</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex items-center gap-1.5">
                        @csrf
                        <input type="email" 
                               name="email" 
                               placeholder="Your email" 
                               required 
                               class="px-4 py-2 bg-stone-50 border-2 border-stone-200/90 rounded-xl text-xs text-stone-800 placeholder-stone-400 focus:outline-none focus:border-[#E52E2E] w-48 sm:w-56">
                        <button type="submit" 
                                class="w-8 h-8 rounded-xl bg-[#E52E2E] hover:bg-[#C61A1A] text-white flex items-center justify-center shadow-xs border border-red-400 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Right: Google Play Badge with Classic Border -->
                <div>
                    <a href="{{ $layoutGooglePlayUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border-2 border-stone-200 hover:border-stone-400 bg-white transition shadow-xs">
                        <!-- Google Play Colorful Triangle Logo -->
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M3.6 1.8L13.8 12 3.6 22.2c-.3-.3-.6-.8-.6-1.5V3.3c0-.7.3-1.2.6-1.5z"/>
                            <path fill="#34A853" d="M17.2 8.6L13.8 12l3.4 3.4 3.8-2.2c.7-.4.7-1.1 0-1.5l-3.8-3.1z"/>
                            <path fill="#FBBC05" d="M3.6 1.8l10.2 10.2 3.4-3.4L6.1.5C5.4.1 4.4.2 3.6 1.8z"/>
                            <path fill="#EA4335" d="M17.2 15.4L13.8 12 3.6 22.2c.8 1.6 1.8 1.7 2.5 1.3l11.1-8.1z"/>
                        </svg>
                        <div class="text-left leading-tight">
                            <span class="block text-[8px] text-stone-500 uppercase tracking-wider font-semibold">GET IT ON</span>
                            <span class="block text-xs font-bold text-stone-900 tracking-tight">Google Play</span>
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
                <svg class="w-5 h-5 {{ (request()->routeIs('menu') || request()->routeIs('shop*')) ? 'stroke-[2.5]' : 'stroke-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                <span class="text-[10px] tracking-tight uppercase font-extrabold mt-0.5">Product</span>
            </a>

            <!-- 3. ORDERS (Live Order / Track Order) -->
            <a href="{{ route('order') }}" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ (request()->routeIs('order*') || request()->routeIs('cart*') || request()->routeIs('checkout*') || request()->routeIs('track*')) ? 'text-[#E52E2E] font-bold' : 'text-stone-500 hover:text-[#E52E2E]' }}">
                <div class="relative">
                    <svg class="w-5 h-5 {{ (request()->routeIs('order*') || request()->routeIs('cart*')) ? 'stroke-[2.5]' : 'stroke-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <svg class="w-5 h-5 {{ request()->routeIs('checkout*') ? 'stroke-[2.5]' : 'stroke-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="2" y="5" width="20" height="14" rx="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <line x1="2" y1="10" x2="22" y2="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="text-[10px] tracking-tight uppercase font-extrabold mt-0.5">Payments</span>
            </a>

            <!-- 5. PROFILE (Customer Dashboard / Login) -->
            <a href="{{ Auth::check() ? route('account.dashboard') : route('login') }}" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ (request()->routeIs('account.*') || request()->routeIs('login*') || request()->routeIs('register*')) ? 'text-[#E52E2E] font-bold' : 'text-stone-500 hover:text-[#E52E2E]' }}">
                <svg class="w-5 h-5 {{ (request()->routeIs('account.*') || request()->routeIs('login*')) ? 'stroke-[2.5]' : 'stroke-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    @stack('scripts')
</body>
</html>
