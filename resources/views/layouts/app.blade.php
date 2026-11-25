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

    <!-- Google Fonts: Plus Jakarta Sans + Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#FAF6F0] text-zinc-900 font-sans antialiased selection:bg-red-600 selection:text-white min-h-screen flex flex-col justify-between" 
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
                <a href="https://wa.me/255682869629" target="_blank" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>+255 682 869 629</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Clean Header (Matching TasteHouse Modern Layout) -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-stone-200/80 transition-all duration-300">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-4">
                
                <!-- Brand Logo (TasteHouse style with Orange Icon) -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0">
                    <div class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center text-white shadow-md shadow-red-600/25 group-hover:scale-105 transition duration-200">
                        <!-- Fork / Knife butchery emblem -->
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
                </a>

                <!-- Wide Search Bar (Exact TasteHouse center search bar) -->
                <form action="{{ route('shop') }}" method="GET" class="hidden md:flex flex-1 max-w-xl mx-2 lg:mx-8">
                    <div class="relative w-full">
                        <input type="text" 
                               name="q" 
                               value="{{ request('q') }}" 
                               placeholder="{{ app()->getLocale() === 'sw' ? 'Tafuta aina za biltong, vitafunio, viungo...' : 'Search for dishes, cuts, biltong snacks...' }}" 
                               class="w-full pl-11 pr-12 py-2.5 rounded-full bg-stone-100 hover:bg-stone-50/80 border border-stone-200/80 focus:border-red-500 focus:bg-white text-xs sm:text-sm text-zinc-800 placeholder-zinc-400 focus:outline-none transition shadow-inner">
                        <svg class="w-4 h-4 text-stone-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <button type="submit" 
                                class="w-8 h-8 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center absolute right-1.5 top-1/2 -translate-y-1/2 transition shadow-sm cursor-pointer"
                                aria-label="Search">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Right Utility Icons (Language Switcher, Favorites, Cart, Account) -->
                <div class="flex items-center gap-2 sm:gap-4">
                    
                    <!-- Language Switcher Pill -->
                    <div class="relative" x-data="{ langMenuOpen: false }">
                        <button @click="langMenuOpen = !langMenuOpen" 
                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-stone-100 hover:bg-stone-200/70 text-zinc-700 border border-stone-200 transition cursor-pointer">
                            <span>{{ app()->getLocale() === 'sw' ? '🇹🇿 SW' : '🇬🇧 EN' }}</span>
                            <svg class="w-3 h-3 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <div x-show="langMenuOpen" 
                             @click.away="langMenuOpen = false"
                             class="absolute right-0 mt-2 w-48 rounded-2xl bg-white shadow-xl border border-stone-200 py-2 z-50 text-xs font-semibold"
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

                    <!-- Favorites (Heart Icon) -->
                    <a href="{{ route('shop') }}" 
                       class="hidden sm:flex flex-col items-center justify-center p-2 rounded-xl text-zinc-600 hover:text-red-600 hover:bg-red-50 transition"
                       title="Favorites">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="text-[10px] font-medium text-zinc-500 mt-0.5">Favorites</span>
                    </a>

                    <!-- Shopping Cart Button with Badge (Matching TasteHouse) -->
                    <button @click="$store.cart.toggle()" 
                            class="relative flex flex-col items-center justify-center p-2 rounded-xl text-zinc-700 hover:text-red-600 hover:bg-red-50 transition cursor-pointer"
                            aria-label="Open Shopping Cart">
                        <div class="relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <span x-show="$store.cart.count > 0" 
                                  x-text="$store.cart.count"
                                  class="absolute -top-1 -right-2 bg-red-600 text-white text-[10px] font-black w-4 h-4 rounded-full flex items-center justify-center shadow"
                                  style="display: none;">
                            </span>
                        </div>
                        <span class="text-[10px] font-medium text-zinc-500 mt-0.5">Cart</span>
                    </button>

                    <!-- Account / Staff Access -->
                    <a href="{{ route('admin.login') }}" 
                       class="flex flex-col items-center justify-center p-2 rounded-xl text-zinc-600 hover:text-red-600 hover:bg-red-50 transition"
                       title="Staff Account">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="text-[10px] font-medium text-zinc-500 mt-0.5">Account</span>
                    </a>

                    <!-- Mobile Menu Hamburger -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="lg:hidden p-2 rounded-xl text-zinc-700 hover:bg-stone-100 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                </div>

            </div>

            <!-- TOP HORIZONTAL NAVIGATION (Visible on Desktop) -->
            <nav class="hidden lg:flex items-center gap-1.5 py-2.5 border-t border-stone-100 overflow-x-auto text-xs font-bold">
                <!-- Home -->
                <a href="{{ route('home') }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-full transition {{ request()->routeIs('home') ? 'bg-red-600 text-white shadow-md shadow-red-600/25' : 'text-zinc-600 hover:bg-stone-100 hover:text-red-600' }}">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'sw' ? 'Nyumbani' : 'Home' }}</span>
                </a>

                <!-- Menu / Shop Cuts -->
                <a href="{{ route('shop') }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-full transition {{ request()->routeIs('shop*') ? 'bg-red-600 text-white shadow-md shadow-red-600/25' : 'text-zinc-600 hover:bg-stone-100 hover:text-red-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'sw' ? 'Menyu ya Biltong' : 'Menu' }}</span>
                </a>

                <!-- Offers / Specials -->
                <a href="{{ route('shop') }}#offers" 
                   class="flex items-center gap-2 px-4 py-2 rounded-full transition text-zinc-600 hover:bg-stone-100 hover:text-red-600">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'sw' ? 'Punguzo & Ofa' : 'Offers' }}</span>
                </a>

                <!-- Track Orders -->
                <a href="{{ route('track') }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-full transition {{ request()->routeIs('track') ? 'bg-red-600 text-white shadow-md shadow-red-600/25' : 'text-zinc-600 hover:bg-stone-100 hover:text-red-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'sw' ? 'Fuatilia Oda' : 'Orders' }}</span>
                </a>

                <!-- Wholesale -->
                <a href="{{ route('wholesale') }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-full transition {{ request()->routeIs('wholesale') ? 'bg-red-600 text-white shadow-md shadow-red-600/25' : 'text-zinc-600 hover:bg-stone-100 hover:text-red-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'sw' ? 'Uuzaji wa Jumla' : 'Wholesale' }}</span>
                </a>

                <!-- The Craft -->
                <a href="{{ route('craft') }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-full transition {{ request()->routeIs('craft') ? 'bg-red-600 text-white shadow-md shadow-red-600/25' : 'text-zinc-600 hover:bg-stone-100 hover:text-red-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'sw' ? 'Ukaushaji Wetu' : 'The Craft' }}</span>
                </a>

                <!-- About Us -->
                <a href="{{ route('about') }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-full transition {{ request()->routeIs('about') ? 'bg-red-600 text-white shadow-md shadow-red-600/25' : 'text-zinc-600 hover:bg-stone-100 hover:text-red-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'sw' ? 'Kuhusu Sisi' : 'About Us' }}</span>
                </a>

                <!-- Support / Contact -->
                <a href="{{ route('contact') }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-full transition {{ request()->routeIs('contact') ? 'bg-red-600 text-white shadow-md shadow-red-600/25' : 'text-zinc-600 hover:bg-stone-100 hover:text-red-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'sw' ? 'Mawasiliano' : 'Support' }}</span>
                </a>
            </nav>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div x-show="mobileMenuOpen" 
             x-collapse 
             class="lg:hidden border-b border-stone-200 bg-white px-4 pt-3 pb-6 space-y-2 shadow-lg"
             style="display: none;">
            
            <!-- Mobile Search -->
            <form action="{{ route('shop') }}" method="GET" class="pb-2">
                <input type="text" name="q" placeholder="Search biltong cuts..." class="w-full px-4 py-2 rounded-xl bg-stone-100 text-xs text-zinc-800 border border-stone-200">
            </form>

            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('home') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">Home</a>
            <a href="{{ route('shop') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('shop*') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">Menu</a>
            <a href="{{ route('shop') }}#offers" class="block px-3 py-2 rounded-xl text-sm font-semibold text-zinc-700 hover:bg-red-50">Offers</a>
            <a href="{{ route('track') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('track') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">Orders</a>
            <a href="{{ route('wholesale') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('wholesale') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">Wholesale</a>
            <a href="{{ route('craft') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('craft') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">The Craft</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('about') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">About Us</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('contact') ? 'bg-red-600 text-white' : 'text-zinc-700 hover:bg-red-50' }}">Support / Contact</a>
            
            <div class="pt-2">
                <a href="https://wa.me/255682869629" target="_blank" class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-emerald-600 text-white font-bold text-xs">
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
                        <div class="w-8 h-8 rounded-lg bg-red-600 flex items-center justify-center text-white shadow-sm">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
                            </svg>
                        </div>
                        <span class="font-black text-xl tracking-tight text-zinc-900">
                            INAS<span class="text-red-600">.</span>
                        </span>
                    </a>
                    
                    <p class="text-xs text-zinc-500 max-w-sm leading-relaxed">
                        Your favorite artisanal beef biltong, slow air-cured in Buguruni Malapa and delivered fast to your doorstep across Dar es Salaam.
                    </p>

                    <!-- Social Icons -->
                    <div class="flex items-center gap-3 pt-1">
                        <a href="https://wa.me/255682869629" target="_blank" class="w-8 h-8 rounded-full bg-stone-100 hover:bg-red-600 hover:text-white text-zinc-600 flex items-center justify-center transition">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        </a>
                        <a href="https://instagram.com" target="_blank" class="w-8 h-8 rounded-full bg-stone-100 hover:bg-red-600 hover:text-white text-zinc-600 flex items-center justify-center transition">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
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

    @stack('scripts')
</body>
</html>
