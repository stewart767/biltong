<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'INAS Premium Beef Biltong | Real Beef. Real Flavour. | Dar es Salaam')</title>
    <meta name="description" content="@yield('meta_description', 'Handcrafted premium beef biltong from Buguruni Malapa, Dar es Salaam. 100% pasture-grazed Tanzanian beef, toasted coriander, cracked black pepper. High protein gourmet dried meat.')">
    <meta name="keywords" content="biltong dar es salaam, beef biltong tanzania, inas biltong, dried beef snack, high protein snacks tanzania, wholesale biltong, buguruni malapa">

    <!-- OpenGraph / Social -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'INAS Premium Beef Biltong')">
    <meta property="og:description" content="Handcrafted premium beef biltong from Buguruni Malapa, Dar es Salaam. 100% pasture-grazed Tanzanian beef, high protein gourmet snack.">
    <meta property="og:image" content="{{ asset('images/hero-biltong.jpg') }}">

    <!-- Google Fonts: Plus Jakarta Sans (Unified System Font) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#FAF6F0] text-zinc-900 font-sans antialiased selection:bg-red-600 selection:text-white min-h-screen flex flex-col justify-between pb-20 lg:pb-0" 
      x-data="{ 
          mobileMenuOpen: false,
          langModalOpen: false,
          currentLang: '{{ app()->getLocale() }}',
          init() {
              if (!localStorage.getItem('inas_lang_chosen')) {
                  setTimeout(() => {
                      this.langModalOpen = true;
                  }, 400);
              }
          },
          selectLang(lang) {
              localStorage.setItem('inas_lang_chosen', lang);
              this.langModalOpen = false;
              if (this.currentLang !== lang) {
                  window.location.href = '/locale/' + lang;
              }
          }
      }"
      @open-lang-modal.window="langModalOpen = true">

    <!-- Top Announcement Bar (Warm Orange Accent) -->
    <div class="bg-red-600 text-white text-xs py-2 px-4">
        <div class="max-w-[1440px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-center sm:text-left">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-2 h-2 rounded-full bg-white animate-pulse"></span>
                <span class="font-medium tracking-wide">
                    @if(app()->getLocale() === 'sw')
                        🚚 Usafirishaji BURE Dar es Salaam kwa oda zaidi ya TZS 50,000 | Kuagiza kupitia WhatsApp
                    @else
                        {{ \App\Models\SiteSetting::get('announcement_bar', '🚚 Free Dar es Salaam delivery on orders over TZS 50,000 | Direct WhatsApp Ordering Available') }}
                    @endif
                </span>
            </div>
            <div class="flex items-center gap-4 text-xs font-semibold">
                <a href="{{ route('wholesale') }}" class="text-white/90 hover:text-white transition flex items-center gap-1 underline underline-offset-2">
                    <span>{{ app()->getLocale() === 'sw' ? 'Uuzaji wa Jumla' : 'Wholesale & Distribution' }}</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <span class="text-white/40">|</span>
                <a href="https://wa.me/255749901907" target="_blank" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>+255 749 901 907</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Clean Header (FastBite Layout in Red, White & Cream) -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-[#EDE4D8] shadow-xs transition-all duration-300" x-data="{ searchOpen: false }">
        @php $siteLogo = \App\Models\SiteSetting::get('site_logo'); @endphp
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">

            <!-- MOBILE HEADER (< lg): Left [Hamburger + Cart], Center [Large Logo], Right [Language] -->
            <div class="flex lg:hidden items-center justify-between h-20 relative">
                <!-- Left: Hamburger Menu + Cart -->
                <div class="flex items-center gap-1.5 z-10">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="p-2.5 rounded-xl bg-[#FAF5EE] hover:bg-red-50 text-zinc-800 hover:text-red-600 border border-[#E8DDD0] transition focus:outline-none cursor-pointer"
                            aria-label="Toggle Menu">
                        <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <button @click="$store.cart.toggle()" 
                            class="relative p-2.5 rounded-xl bg-[#FAF5EE] hover:bg-red-50 text-zinc-800 hover:text-red-600 border border-[#E8DDD0] transition cursor-pointer"
                            aria-label="Open Shopping Cart">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span x-show="$store.cart.count > 0" 
                              x-text="$store.cart.count"
                              class="absolute -top-1.5 -right-1.5 bg-red-600 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center shadow"
                              style="display: none;">
                        </span>
                    </button>
                </div>

                <!-- Center: Large Clearly Visible Logo -->
                <a href="{{ route('home') }}" class="absolute left-1/2 -translate-x-1/2 flex items-center gap-2.5 group">
                    @if(!empty($siteLogo))
                        <img src="{{ asset($siteLogo) }}" alt="INAS Beef Biltong Logo" class="h-14 w-auto max-w-[180px] object-contain rounded-lg">
                    @else
                        <div class="w-11 h-11 rounded-xl bg-red-600 flex items-center justify-center text-white shadow-md shadow-red-600/25">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-black text-2xl tracking-tight text-zinc-900 leading-none">
                                INAS<span class="text-red-600">.</span>
                            </span>
                            <span class="text-[9px] tracking-widest text-zinc-500 font-bold uppercase mt-0.5">
                                Beef Biltong
                            </span>
                        </div>
                    @endif
                </a>

                <!-- Right: Compact Language Switcher -->
                <div class="relative z-10" x-data="{ mobileLangOpen: false }">
                    <button @click="mobileLangOpen = !mobileLangOpen" 
                            class="flex items-center gap-1 px-2.5 py-2 rounded-xl text-xs font-bold bg-[#FAF5EE] text-zinc-700 border border-[#E8DDD0] cursor-pointer">
                        <span>{{ app()->getLocale() === 'sw' ? '🇹🇿 SW' : '🇬🇧 EN' }}</span>
                    </button>
                    <div x-show="mobileLangOpen" 
                         @click.away="mobileLangOpen = false"
                         class="absolute right-0 mt-2 w-40 rounded-2xl bg-white shadow-xl border border-[#E8DDD0] py-2 z-50 text-xs font-semibold"
                         style="display: none;">
                        <a href="{{ route('locale.switch', 'sw') }}" @click="localStorage.setItem('inas_lang_chosen', 'sw')" class="block px-4 py-2 hover:bg-red-50 {{ app()->getLocale() === 'sw' ? 'text-red-600 font-bold' : 'text-zinc-700' }}">🇹🇿 Kiswahili</a>
                        <a href="{{ route('locale.switch', 'en') }}" @click="localStorage.setItem('inas_lang_chosen', 'en')" class="block px-4 py-2 hover:bg-red-50 {{ app()->getLocale() === 'en' ? 'text-red-600 font-bold' : 'text-zinc-700' }}">🇬🇧 English</a>
                    </div>
                </div>
            </div>

            <!-- DESKTOP HEADER (>= lg): Unchanged Style -->
            <div class="hidden lg:flex items-center justify-between h-20 gap-4">
                
                <!-- Brand Logo (Managed via Admin Settings -> site_logo) -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0">
                    @if(!empty($siteLogo))
                        <img src="{{ asset($siteLogo) }}" alt="INAS Beef Biltong Logo" class="h-11 sm:h-12 w-auto max-w-[160px] object-contain rounded-lg group-hover:scale-105 transition duration-200">
                    @else
                        <div class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center text-white shadow-md shadow-red-600/25 group-hover:scale-105 transition duration-200">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-xl sm:text-2xl tracking-tight text-zinc-900 group-hover:text-red-600 transition">
                                INAS<span class="text-red-600 font-black">.</span>
                            </span>
                            <span class="text-[9px] tracking-widest text-zinc-400 font-bold uppercase -mt-1">
                                Beef Biltong
                            </span>
                        </div>
                    @endif
                </a>

                <!-- Center Horizontal Navigation Links (FastBite Single-Row Clean Style) -->
                <nav class="flex items-center gap-7 text-sm font-semibold">
                    <a href="{{ route('home') }}" 
                       class="py-2 transition border-b-2 {{ request()->routeIs('home') ? 'border-red-600 text-red-600 font-bold' : 'border-transparent text-zinc-700 hover:text-red-600' }}">
                        {{ app()->getLocale() === 'sw' ? 'Nyumbani' : 'Home' }}
                    </a>
                    <a href="{{ route('shop') }}" 
                       class="py-2 transition border-b-2 {{ request()->routeIs('shop*') ? 'border-red-600 text-red-600 font-bold' : 'border-transparent text-zinc-700 hover:text-red-600' }}">
                        {{ app()->getLocale() === 'sw' ? 'Menyu' : 'Menu' }}
                    </a>
                    <a href="{{ route('shop') }}#offers" 
                       class="py-2 transition border-b-2 border-transparent text-zinc-700 hover:text-red-600">
                        {{ app()->getLocale() === 'sw' ? 'Ofa' : 'Offers' }}
                    </a>
                    <a href="{{ route('wholesale') }}" 
                       class="py-2 transition border-b-2 {{ request()->routeIs('wholesale') ? 'border-red-600 text-red-600 font-bold' : 'border-transparent text-zinc-700 hover:text-red-600' }}">
                        {{ app()->getLocale() === 'sw' ? 'Jumla' : 'Wholesale' }}
                    </a>
                    <a href="{{ route('track') }}" 
                       class="py-2 transition border-b-2 {{ request()->routeIs('track') ? 'border-red-600 text-red-600 font-bold' : 'border-transparent text-zinc-700 hover:text-red-600' }}">
                        {{ app()->getLocale() === 'sw' ? 'Oda' : 'Orders' }}
                    </a>
                    <a href="{{ route('about') }}" 
                       class="py-2 transition border-b-2 {{ request()->routeIs('about') ? 'border-red-600 text-red-600 font-bold' : 'border-transparent text-zinc-700 hover:text-red-600' }}">
                        {{ app()->getLocale() === 'sw' ? 'Kuhusu' : 'About' }}
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="py-2 transition border-b-2 {{ request()->routeIs('contact') ? 'border-red-600 text-red-600 font-bold' : 'border-transparent text-zinc-700 hover:text-red-600' }}">
                        {{ app()->getLocale() === 'sw' ? 'Mawasiliano' : 'Contact' }}
                    </a>
                </nav>

                <!-- Right Utility Icons + Order Now CTA -->
                <div class="flex items-center gap-3">
                    
                    <!-- Search Toggle -->
                    <button @click="searchOpen = !searchOpen" 
                            class="flex items-center justify-center w-10 h-10 rounded-full text-zinc-600 hover:text-red-600 hover:bg-[#FAF5EE] transition cursor-pointer"
                            aria-label="Search">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>

                    <!-- Language Switcher Pill -->
                    <div class="relative" x-data="{ langMenuOpen: false }">
                        <button @click="langMenuOpen = !langMenuOpen" 
                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-[#FAF5EE] hover:bg-[#F3E9DC] text-zinc-700 border border-[#E8DDD0] transition cursor-pointer">
                            <span>{{ app()->getLocale() === 'sw' ? '🇹🇿 SW' : '🇬🇧 EN' }}</span>
                            <svg class="w-3 h-3 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <div x-show="langMenuOpen" 
                             @click.away="langMenuOpen = false"
                             class="absolute right-0 mt-2 w-44 rounded-2xl bg-white shadow-xl border border-[#E8DDD0] py-2 z-50 text-xs font-semibold"
                             style="display: none;">
                            <a href="{{ route('locale.switch', 'sw') }}" 
                               @click="localStorage.setItem('inas_lang_chosen', 'sw')" 
                               class="flex items-center justify-between px-4 py-2 hover:bg-red-50 hover:text-red-600 transition {{ app()->getLocale() === 'sw' ? 'text-red-600 font-bold bg-red-50/60' : 'text-zinc-700' }}">
                                <span class="flex items-center gap-2"><span>🇹🇿</span> Kiswahili</span>
                                @if(app()->getLocale() === 'sw') <span class="text-red-600 font-bold">✓</span> @endif
                            </a>
                            <a href="{{ route('locale.switch', 'en') }}" 
                               @click="localStorage.setItem('inas_lang_chosen', 'en')" 
                               class="flex items-center justify-between px-4 py-2 hover:bg-red-50 hover:text-red-600 transition {{ app()->getLocale() === 'en' ? 'text-red-600 font-bold bg-red-50/60' : 'text-zinc-700' }}">
                                <span class="flex items-center gap-2"><span>🇬🇧</span> English</span>
                                @if(app()->getLocale() === 'en') <span class="text-red-600 font-bold">✓</span> @endif
                            </a>
                        </div>
                    </div>

                    <!-- Shopping Cart Button with Red Badge -->
                    <button @click="$store.cart.toggle()" 
                            class="relative flex items-center justify-center w-10 h-10 rounded-full text-zinc-700 hover:text-red-600 hover:bg-[#FAF5EE] transition cursor-pointer"
                            aria-label="Open Shopping Cart">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span x-show="$store.cart.count > 0" 
                              x-text="$store.cart.count"
                              class="absolute -top-0.5 -right-0.5 bg-red-600 text-white text-[10px] font-black w-4 h-4 rounded-full flex items-center justify-center shadow"
                              style="display: none;">
                        </span>
                    </button>

                    <!-- Staff Account -->
                    <a href="{{ route('admin.login') }}" 
                       class="flex items-center justify-center w-10 h-10 rounded-full text-zinc-600 hover:text-red-600 hover:bg-[#FAF5EE] transition"
                       title="Staff Account">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </a>

                    <!-- Partnership CTA Pill -->
                    <a href="{{ route('wholesale') }}#enquiry-form" 
                       class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-full bg-[#FAF5EE] hover:bg-red-50 text-red-600 border border-red-200 font-bold text-xs transition transform hover:scale-105">
                        <span>{{ app()->getLocale() === 'sw' ? 'Ubia' : 'Partnership' }}</span>
                    </a>

                    <!-- Order Now CTA Pill (FastBite Top-Right Red CTA) -->
                    <a href="{{ route('shop') }}" 
                       class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-md shadow-red-600/25 transition transform hover:scale-105">
                        <span>{{ app()->getLocale() === 'sw' ? 'Agiza Sasa' : 'Order Now' }}</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>

                </div>

            </div>

            <!-- Expandable Search Bar -->
            <div x-show="searchOpen" x-collapse class="pb-4 border-t border-[#F0E6D8] pt-3" style="display: none;">
                <form action="{{ route('shop') }}" method="GET" class="max-w-2xl mx-auto relative">
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}" 
                           placeholder="{{ app()->getLocale() === 'sw' ? 'Tafuta aina za biltong, vitafunio, viungo...' : 'Search for biltong cuts, chilli bites, droëwors...' }}" 
                           class="w-full pl-11 pr-24 py-2.5 rounded-full bg-[#FAF5EE] border border-[#E8DDD0] focus:border-red-500 focus:bg-white text-xs sm:text-sm text-zinc-800 placeholder-zinc-400 focus:outline-none transition">
                    <svg class="w-4 h-4 text-stone-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <button type="submit" 
                            class="px-4 py-1.5 rounded-full bg-red-600 hover:bg-red-700 text-white text-xs font-bold absolute right-1.5 top-1/2 -translate-y-1/2 transition cursor-pointer">
                        Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div x-show="mobileMenuOpen" 
             x-collapse 
             class="lg:hidden border-b border-stone-200 bg-white px-4 pt-3 pb-6 space-y-2 shadow-lg"
             style="display: none;">
            
            <!-- Mobile Search -->
            <form action="{{ route('shop') }}" method="GET" class="pb-2">
                <input type="text" name="q" placeholder="Search biltong cuts..." class="w-full px-4 py-2 rounded-xl bg-[#FAF5EE] text-xs text-zinc-800 border border-[#E8DDD0]">
            </form>

            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('home') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">Home</a>
            <a href="{{ route('shop') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('shop*') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">Menu</a>
            <a href="{{ route('shop') }}#offers" class="block px-3 py-2 rounded-xl text-sm font-semibold text-zinc-700 hover:bg-red-50">Offers</a>
            <a href="{{ route('track') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('track') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">Orders</a>
            <a href="{{ route('wholesale') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('wholesale') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">Wholesale</a>
            <a href="{{ route('craft') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('craft') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">The Craft</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('about') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">About Us</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('contact') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">Contact</a>
            <a href="{{ route('wholesale') }}#enquiry-form" class="block px-3 py-2 rounded-xl text-sm font-bold text-red-600 bg-[#FAF5EE] hover:bg-red-50">Partnership</a>
            <a href="{{ route('admin.login') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold text-zinc-600 hover:bg-red-50">Staff Account</a>
            
            <div class="pt-2">
                <a href="https://wa.me/255749901907" target="_blank" class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-red-600 text-white font-bold text-xs">
                    Order via WhatsApp Desk
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN APP CONTAINER (Full Width without Sidebar) -->
    <div class="max-w-[1440px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 flex-1">
        <main class="w-full min-w-0">
            @yield('content')
        </main>
    </div>

    <!-- FIRST VISIT LANGUAGE CHOOSER POPUP MODAL -->
    <div x-show="langModalOpen" 
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4"
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">

        <div class="fixed inset-0 bg-black/75 backdrop-blur-sm transition-opacity" @click="langModalOpen = false"></div>

        <div class="relative bg-white text-zinc-900 rounded-3xl shadow-2xl max-w-lg w-full border border-stone-200 overflow-hidden z-10 text-center p-6 sm:p-8 space-y-6">
            <div class="space-y-3">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-red-600 flex items-center justify-center text-white shadow-lg">
                    <span class="font-extrabold text-2xl">I</span>
                </div>
                <div>
                    <h3 class="font-extrabold text-2xl text-zinc-900">
                        Chagua Lugha Yako
                    </h3>
                    <p class="text-base text-red-600 font-bold -mt-0.5">
                        Choose Your Language
                    </p>
                    <p class="text-xs text-zinc-500 mt-1 max-w-sm mx-auto">
                        Karibu INAS Premium Beef Biltong &bull; Buguruni Malapa, Dar es Salaam.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
                <button type="button" 
                        @click="selectLang('sw')"
                        class="p-5 rounded-2xl border-2 transition duration-200 text-left cursor-pointer flex flex-col justify-between space-y-3 {{ app()->getLocale() === 'sw' ? 'border-red-600 bg-red-50/70' : 'border-zinc-200 hover:border-red-500 hover:bg-zinc-50' }}">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-3xl">🇹🇿</span>
                            <span class="text-[10px] font-black uppercase tracking-wider bg-red-600 text-white px-2 py-0.5 rounded-full">Tanzania</span>
                        </div>
                        <h4 class="font-bold text-base text-zinc-900">Kiswahili</h4>
                        <p class="text-xs text-zinc-600">Nunua biltong halisi ya ng'ombe, fuatilia oda, na huduma kwa Kiswahili.</p>
                    </div>
                    <div class="pt-2">
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-red-600">
                            <span>Chagua Kiswahili</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                    </div>
                </button>

                <button type="button" 
                        @click="selectLang('en')"
                        class="p-5 rounded-2xl border-2 transition duration-200 text-left cursor-pointer flex flex-col justify-between space-y-3 {{ app()->getLocale() === 'en' ? 'border-red-600 bg-red-50/70' : 'border-zinc-200 hover:border-red-500 hover:bg-zinc-50' }}">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-3xl">🇬🇧</span>
                            <span class="text-[10px] font-black uppercase tracking-wider bg-zinc-800 text-white px-2 py-0.5 rounded-full">English</span>
                        </div>
                        <h4 class="font-bold text-base text-zinc-900">English</h4>
                        <p class="text-xs text-zinc-600">Explore artisanal beef biltong, track delivery, or inquire wholesale in English.</p>
                    </div>
                    <div class="pt-2">
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-red-600">
                            <span>Select English</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                    </div>
                </button>
            </div>

            <div class="pt-2 border-t border-zinc-100 flex items-center justify-between text-[11px] text-zinc-400">
                <span>Unaweza kubadili wakati wowote kwenye menyu.</span>
                <button type="button" @click="langModalOpen = false; localStorage.setItem('inas_lang_chosen', currentLang)" class="hover:text-zinc-700 underline font-semibold">
                    Skip &times;
                </button>
            </div>
        </div>
    </div>

    <!-- Slide-over Gourmet Cart Drawer -->
    <div x-show="$store.cart.drawerOpen" 
         class="fixed inset-0 z-50 overflow-hidden" 
         style="display: none;"
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="$store.cart.close()"></div>

        <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
            <div class="w-screen max-w-md bg-white text-zinc-900 shadow-2xl flex flex-col justify-between"
                 x-transition:enter="transform transition ease-in-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in-out duration-300"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full">

                <!-- Drawer Header -->
                <div class="p-6 border-b border-stone-200 flex items-center justify-between bg-stone-50">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-red-600 flex items-center justify-center text-white shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-base text-zinc-900">{{ app()->getLocale() === 'sw' ? 'Kikapu Chako' : 'Your Shopping Bag' }}</h3>
                            <span class="text-xs text-zinc-500" x-text="$store.cart.count + ' {{ app()->getLocale() === 'sw' ? 'vitu' : 'items' }}'"></span>
                        </div>
                    </div>
                    <button @click="$store.cart.close()" class="p-2 rounded-xl text-zinc-400 hover:text-zinc-700 hover:bg-stone-200/60 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Items list -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4">
                    <template x-if="$store.cart.items.length === 0">
                        <div class="text-center py-12 space-y-4">
                            <div class="w-16 h-16 mx-auto rounded-full bg-red-50 flex items-center justify-center text-red-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            </div>
                            <h4 class="font-bold text-zinc-800 text-base">{{ app()->getLocale() === 'sw' ? 'Kikapu chako kiko tupu' : 'Your cart is empty' }}</h4>
                            <p class="text-xs text-zinc-500 max-w-xs mx-auto">Gundua ladha ya nyama halisi ya ng'ombe wa malishoni Tanzania.</p>
                            <a href="{{ route('shop') }}" @click="$store.cart.close()" class="inline-block px-6 py-2.5 rounded-full bg-red-600 text-white font-bold text-xs uppercase tracking-wider hover:bg-red-700 transition">
                                {{ app()->getLocale() === 'sw' ? 'Duka la Biltong' : 'Explore Menu' }}
                            </a>
                        </div>
                    </template>

                    <template x-for="item in $store.cart.items" :key="item.id">
                        <div class="flex items-center gap-4 p-3 rounded-2xl bg-stone-50 border border-stone-200/80">
                            <img :src="item.image" :alt="item.name" class="w-16 h-16 rounded-xl object-cover border border-stone-200">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-xs text-zinc-900 truncate" x-text="item.name"></h4>
                                <span class="text-[11px] text-zinc-500" x-text="item.weight"></span>
                                <div class="font-black text-xs text-red-600 mt-1" x-text="'TZS ' + Number(item.price).toLocaleString()"></div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button @click="$store.cart.decrement(item.id)" class="w-6 h-6 rounded-lg bg-white border border-stone-300 flex items-center justify-center font-bold text-zinc-700 hover:bg-stone-100">-</button>
                                <span class="text-xs font-bold text-zinc-900 w-4 text-center" x-text="item.quantity"></span>
                                <button @click="$store.cart.increment(item.id)" class="w-6 h-6 rounded-lg bg-white border border-stone-300 flex items-center justify-center font-bold text-zinc-700 hover:bg-stone-100">+</button>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Footer Summary & Checkout Button -->
                <div class="p-6 border-t border-stone-200 bg-stone-50 space-y-4">
                    <div class="space-y-1.5 text-xs text-zinc-600">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span class="font-bold text-zinc-900" x-text="'TZS ' + Number($store.cart.subtotal).toLocaleString()"></span>
                        </div>
                        <div class="flex justify-between text-[11px] text-emerald-600 font-semibold">
                            <span>Dar es Salaam Delivery:</span>
                            <span x-text="$store.cart.subtotal >= 50000 ? 'FREE' : 'TZS 5,000'"></span>
                        </div>
                        <div class="border-t border-stone-200 pt-2 flex justify-between text-sm font-extrabold text-zinc-900">
                            <span>Total:</span>
                            <span class="text-red-600" x-text="'TZS ' + Number($store.cart.total).toLocaleString()"></span>
                        </div>
                    </div>

                    <a href="{{ route('checkout') }}" 
                       class="w-full flex items-center justify-center gap-2 py-3.5 rounded-full bg-red-600 hover:bg-red-700 text-white font-extrabold text-xs uppercase tracking-wider shadow-lg shadow-red-600/30 transition">
                        <span>{{ app()->getLocale() === 'sw' ? 'Endelea Kulipa' : 'Proceed to Checkout' }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- CLEAN MODERN WHITE FOOTER (Exact TasteHouse Design) -->
    <footer class="bg-white border-t border-stone-200 mt-16 text-zinc-600 text-xs">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-10">
                
                <!-- Brand Column -->
                <div class="lg:col-span-2 space-y-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                        @if(!empty($siteLogo))
                            <img src="{{ asset($siteLogo) }}" alt="INAS Beef Biltong Logo" class="h-10 w-auto max-w-[150px] object-contain rounded-lg">
                        @else
                            <div class="w-8 h-8 rounded-lg bg-red-600 flex items-center justify-center text-white shadow-sm">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
                                </svg>
                            </div>
                            <span class="font-black text-xl tracking-tight text-zinc-900">
                                INAS<span class="text-red-600">.</span>
                            </span>
                        @endif
                    </a>
                    
                    <p class="text-xs text-zinc-500 max-w-sm leading-relaxed">
                        <strong class="text-zinc-800">Biltong East Africa Corporation (BEAC)</strong> — Est. 2016 in Dar es Salaam, Tanzania. <span class="text-red-600 font-bold italic">Tafuna nyama, Kula maisha!</span>
                    </p>

                    <div class="text-[11px] text-zinc-500 space-y-1">
                        <div>Phone / WhatsApp: <a href="tel:+255749901907" class="font-bold text-zinc-800 hover:text-red-600">+255 749 901 907</a></div>
                        <div>Email: <a href="mailto:info@biltong.co.tz" class="font-bold text-zinc-800 hover:text-red-600">info@biltong.co.tz</a> &bull; Web: <span class="font-bold text-zinc-800">www.biltong.co.tz</span></div>
                    </div>

                    <!-- Social Icons -->
                    <div class="flex flex-wrap items-center gap-2 pt-1">
                        <a href="https://wa.me/255749901907" target="_blank" class="px-3 py-1.5 rounded-full bg-[#FAF5EE] hover:bg-red-600 hover:text-white text-zinc-700 font-semibold text-[11px] border border-[#E8DDD0] transition">
                            WhatsApp
                        </a>
                        <a href="https://instagram.com/biltongeastafrica" target="_blank" class="px-3 py-1.5 rounded-full bg-[#FAF5EE] hover:bg-red-600 hover:text-white text-zinc-700 font-semibold text-[11px] border border-[#E8DDD0] transition">
                            IG: @biltongeastafrica
                        </a>
                        <a href="https://facebook.com" target="_blank" class="px-3 py-1.5 rounded-full bg-[#FAF5EE] hover:bg-red-600 hover:text-white text-zinc-700 font-semibold text-[11px] border border-[#E8DDD0] transition">
                            FB / YT: BILTONG East Africa
                        </a>
                    </div>
                </div>

                <!-- Company Column -->
                <div class="space-y-3">
                    <h5 class="font-bold text-zinc-900 text-xs uppercase tracking-wider">Company</h5>
                    <ul class="space-y-2 text-zinc-500">
                        <li><a href="{{ route('about') }}" class="hover:text-red-600 transition">About Us</a></li>
                        <li><a href="{{ route('craft') }}" class="hover:text-red-600 transition">Air-Cure Craft</a></li>
                        <li><a href="{{ route('wholesale') }}" class="hover:text-red-600 transition">Wholesale & B2B</a></li>
                        <li><a href="{{ route('track') }}" class="hover:text-red-600 transition">Track Order</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-red-600 transition">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Support Column -->
                <div class="space-y-3">
                    <h5 class="font-bold text-zinc-900 text-xs uppercase tracking-wider">Support</h5>
                    <ul class="space-y-2 text-zinc-500">
                        <li><a href="https://wa.me/255682869629" target="_blank" class="hover:text-red-600 transition">Help Center</a></li>
                        <li><a href="{{ route('track') }}" class="hover:text-red-600 transition">Track Delivery</a></li>
                        <li><a href="{{ route('shop') }}" class="hover:text-red-600 transition">Delivery Info</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-red-600 transition">FAQs & Inquiries</a></li>
                    </ul>
                </div>

                <!-- Newsletter Column (Matching TasteHouse form) -->
                <div class="space-y-3">
                    <h5 class="font-bold text-zinc-900 text-xs uppercase tracking-wider">Newsletter</h5>
                    <p class="text-zinc-500 text-xs">Subscribe to get latest updates and exclusive offers.</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-2">
                        @csrf
                        <input type="email" 
                               name="email" 
                               required 
                               placeholder="Your Email" 
                               class="w-full px-3.5 py-2 rounded-xl bg-stone-100 border border-stone-200 text-xs text-zinc-800 placeholder-zinc-400 focus:outline-none focus:border-red-500">
                        <button type="submit" 
                                class="w-full py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-sm transition">
                            Subscribe
                        </button>
                    </form>
                </div>

            </div>

            <!-- Bottom Copyright & Policies -->
            <div class="mt-12 pt-6 border-t border-stone-200 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-zinc-400">
                <div>
                    &copy; {{ date('Y') }} INAS Company Limited. All rights reserved. Buguruni Malapa, Dar es Salaam.
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('about') }}" class="hover:text-zinc-600">Privacy</a>
                    <span>&bull;</span>
                    <a href="{{ route('about') }}" class="hover:text-zinc-600">Terms</a>
                    <span>&bull;</span>
                    <a href="{{ route('shop') }}" class="hover:text-zinc-600">Sitemap</a>
                </div>
            </div>

        </div>
    </footer>

    <!-- MOBILE APP BOTTOM TAB NAVIGATION (< lg) -->
    <nav class="lg:hidden fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-md border-t border-[#E8DDD0] shadow-[0_-6px_24px_rgba(0,0,0,0.08)]" aria-label="Mobile Bottom Navigation">
        <div class="grid grid-cols-5 h-16 max-w-lg mx-auto">
            <!-- Home -->
            <a href="{{ route('home') }}" 
               class="flex flex-col items-center justify-center gap-0.5 transition {{ request()->routeIs('home') ? 'text-red-600 font-extrabold' : 'text-zinc-500 hover:text-red-600 font-semibold' }}">
                <span class="p-1 rounded-xl {{ request()->routeIs('home') ? 'bg-red-50' : '' }}">
                    <svg class="w-5 h-5" fill="{{ request()->routeIs('home') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </span>
                <span class="text-[10px]">{{ app()->getLocale() === 'sw' ? 'Nyumbani' : 'Home' }}</span>
            </a>

            <!-- Menu -->
            <a href="{{ route('shop') }}" 
               class="flex flex-col items-center justify-center gap-0.5 transition {{ request()->routeIs('shop*') ? 'text-red-600 font-extrabold' : 'text-zinc-500 hover:text-red-600 font-semibold' }}">
                <span class="p-1 rounded-xl {{ request()->routeIs('shop*') ? 'bg-red-50' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </span>
                <span class="text-[10px]">{{ app()->getLocale() === 'sw' ? 'Menyu' : 'Menu' }}</span>
            </a>

            <!-- Wholesale -->
            <a href="{{ route('wholesale') }}" 
               class="flex flex-col items-center justify-center gap-0.5 transition {{ request()->routeIs('wholesale') ? 'text-red-600 font-extrabold' : 'text-zinc-500 hover:text-red-600 font-semibold' }}">
                <span class="p-1 rounded-xl {{ request()->routeIs('wholesale') ? 'bg-red-50' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </span>
                <span class="text-[10px]">{{ app()->getLocale() === 'sw' ? 'Jumla' : 'Wholesale' }}</span>
            </a>

            <!-- About -->
            <a href="{{ route('about') }}" 
               class="flex flex-col items-center justify-center gap-0.5 transition {{ request()->routeIs('about') ? 'text-red-600 font-extrabold' : 'text-zinc-500 hover:text-red-600 font-semibold' }}">
                <span class="p-1 rounded-xl {{ request()->routeIs('about') ? 'bg-red-50' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
                <span class="text-[10px]">{{ app()->getLocale() === 'sw' ? 'Kuhusu' : 'About' }}</span>
            </a>

            <!-- Contact -->
            <a href="{{ route('contact') }}" 
               class="flex flex-col items-center justify-center gap-0.5 transition {{ request()->routeIs('contact') ? 'text-red-600 font-extrabold' : 'text-zinc-500 hover:text-red-600 font-semibold' }}">
                <span class="p-1 rounded-xl {{ request()->routeIs('contact') ? 'bg-red-50' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </span>
                <span class="text-[10px]">{{ app()->getLocale() === 'sw' ? 'Mawasiliano' : 'Contact' }}</span>
            </a>
        </div>
    </nav>

    @stack('scripts')
</body>
</html>
