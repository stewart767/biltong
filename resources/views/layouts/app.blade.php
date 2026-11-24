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

    <!-- Google Fonts: Playfair Display + Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-brand-black text-brand-white font-sans antialiased selection:bg-brand-red selection:text-white" 
      x-data="{ 
          mobileMenuOpen: false,
          langModalOpen: false,
          currentLang: '{{ app()->getLocale() }}',
          init() {
              // Check if user has already chosen a language on first visit
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

    <!-- Top Announcement Bar (Red & Dark) -->
    <div class="bg-brand-red-dark text-white text-xs py-2 px-4 border-b border-brand-red">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-center sm:text-left">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-2 h-2 rounded-full bg-white animate-pulse"></span>
                <span class="font-medium tracking-wide">
                    @if(app()->getLocale() === 'sw')
                        🚚 Usafirishaji bure Dar es Salaam kwa oda zaidi ya TZS 50,000 | Kuagiza kupitia WhatsApp
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
                    <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span>+255 682 869 629</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header (Clean Dark with Red Accents) -->
    <header class="sticky top-0 z-40 bg-brand-black/95 backdrop-blur-md border-b border-brand-charcoal transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo with Butcher Red Shield -->
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-brand-red to-brand-red-dark flex items-center justify-center border-2 border-white/20 shadow-lg group-hover:scale-105 transition duration-300">
                        <span class="font-editorial text-2xl font-black text-white tracking-wider">I</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-editorial text-xl sm:text-2xl font-bold tracking-widest text-white uppercase group-hover:text-brand-red-light transition">
                            INAS
                        </span>
                        <span class="text-[9px] tracking-[0.25em] text-white/70 uppercase -mt-0.5">
                            Premium Beef Biltong
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Links (Bilingual) -->
                <nav class="hidden md:flex items-center gap-6 text-sm font-semibold">
                    <a href="{{ route('home') }}" class="hover:text-brand-red-light transition {{ request()->routeIs('home') ? 'text-brand-red-light font-bold' : 'text-white/80' }}">
                        {{ __('nav_home') }}
                    </a>
                    <a href="{{ route('shop') }}" class="hover:text-brand-red-light transition {{ request()->routeIs('shop*') ? 'text-brand-red-light font-bold' : 'text-white/80' }}">
                        {{ __('nav_shop') }}
                    </a>
                    <a href="{{ route('about') }}" class="hover:text-brand-red-light transition {{ request()->routeIs('about') ? 'text-brand-red-light font-bold' : 'text-white/80' }}">
                        {{ __('nav_about') }}
                    </a>
                    <a href="{{ route('craft') }}" class="hover:text-brand-red-light transition {{ request()->routeIs('craft') ? 'text-brand-red-light font-bold' : 'text-white/80' }}">
                        {{ __('nav_craft') }}
                    </a>
                    <a href="{{ route('wholesale') }}" class="hover:text-brand-red-light transition {{ request()->routeIs('wholesale*') ? 'text-brand-red-light font-bold' : 'text-white/80' }}">
                        {{ __('nav_wholesale') }}
                    </a>
                    <a href="{{ route('track') }}" class="hover:text-brand-red-light transition {{ request()->routeIs('track*') ? 'text-brand-red-light font-bold' : 'text-white/80' }}">
                        {{ __('nav_track') }}
                    </a>
                    <a href="{{ route('contact') }}" class="hover:text-brand-red-light transition {{ request()->routeIs('contact') ? 'text-brand-red-light font-bold' : 'text-white/80' }}">
                        {{ __('nav_contact') }}
                    </a>
                </nav>

                <!-- Actions: Language Switcher + WhatsApp + Cart + Mobile Toggle -->
                <div class="flex items-center gap-2.5 sm:gap-3">
                    
                    <!-- Language Switcher Pill (Interactive with Dropdown) -->
                    <div class="relative" x-data="{ langMenuOpen: false }">
                        <button @click="langMenuOpen = !langMenuOpen" 
                                class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-brand-charcoal hover:bg-brand-red text-white text-xs font-bold transition border border-white/10 shadow-sm focus:outline-none"
                                title="Change Language / Chagua Lugha">
                            <span class="text-sm">{{ app()->getLocale() === 'sw' ? '🇹🇿' : '🇬🇧' }}</span>
                            <span class="uppercase tracking-wider font-extrabold text-[11px]">{{ app()->getLocale() === 'sw' ? 'SWA' : 'ENG' }}</span>
                            <svg class="w-3 h-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="langMenuOpen" 
                             @click.away="langMenuOpen = false" 
                             x-transition 
                             class="absolute right-0 mt-2 w-44 rounded-2xl bg-white text-zinc-900 border border-zinc-200 shadow-2xl overflow-hidden py-1.5 z-50 text-xs font-bold"
                             style="display: none;">
                            <div class="px-3 py-1 text-[10px] text-zinc-400 uppercase tracking-widest border-b border-zinc-100">
                                Lugha / Language
                            </div>
                            <a href="{{ route('locale.switch', 'sw') }}" 
                               @click="localStorage.setItem('inas_lang_chosen', 'sw')" 
                               class="flex items-center justify-between px-3.5 py-2.5 hover:bg-red-50 hover:text-brand-red transition {{ app()->getLocale() === 'sw' ? 'text-brand-red bg-red-50/70 font-black' : 'text-zinc-700' }}">
                                <span class="flex items-center gap-2">
                                    <span class="text-base">🇹🇿</span>
                                    <span>Kiswahili</span>
                                </span>
                                @if(app()->getLocale() === 'sw')
                                    <svg class="w-4 h-4 text-brand-red" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                @endif
                            </a>
                            <a href="{{ route('locale.switch', 'en') }}" 
                               @click="localStorage.setItem('inas_lang_chosen', 'en')" 
                               class="flex items-center justify-between px-3.5 py-2.5 hover:bg-red-50 hover:text-brand-red transition {{ app()->getLocale() === 'en' ? 'text-brand-red bg-red-50/70 font-black' : 'text-zinc-700' }}">
                                <span class="flex items-center gap-2">
                                    <span class="text-base">🇬🇧</span>
                                    <span>English</span>
                                </span>
                                @if(app()->getLocale() === 'en')
                                    <svg class="w-4 h-4 text-brand-red" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                @endif
                            </a>
                            <div class="border-t border-zinc-100 pt-1 mt-1">
                                <button type="button" @click="langMenuOpen = false; langModalOpen = true" class="w-full text-left px-3.5 py-1.5 text-[11px] text-zinc-500 hover:text-brand-red">
                                    ⚙️ Chagua upya / Select modal...
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Direct WhatsApp Order button -->
                    <a href="https://wa.me/255682869629?text=Hello%20INAS%20Biltong!%20I%20would%20like%20to%20place%20an%20order." 
                       target="_blank" 
                       class="hidden xl:flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-white text-brand-black hover:bg-brand-red hover:text-white transition shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span>WhatsApp Desk</span>
                    </a>

                    <!-- Shopping Cart Trigger with Red Badge -->
                    <button @click="$store.cart.toggle()" 
                            class="relative p-2.5 rounded-xl bg-brand-charcoal hover:bg-brand-red text-white transition focus:outline-none border border-white/10"
                            aria-label="Open Cart Bag">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span x-show="$store.cart.count > 0" 
                              x-text="$store.cart.count"
                              class="absolute -top-1.5 -right-1.5 bg-brand-red text-white text-[11px] font-black w-5 h-5 rounded-full flex items-center justify-center ring-2 ring-brand-black"
                              style="display: none;">
                        </span>
                    </button>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="md:hidden p-2.5 rounded-xl bg-brand-charcoal text-white hover:text-brand-red-light focus:outline-none border border-white/10">
                        <svg class="w-6 h-6" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg class="w-6 h-6" x-show="mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="mobileMenuOpen" 
             x-collapse 
             class="md:hidden border-b border-brand-charcoal bg-brand-dark px-4 pt-3 pb-6 space-y-2"
             style="display: none;">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-white hover:bg-brand-red">{{ __('nav_home') }}</a>
            <a href="{{ route('shop') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-white hover:bg-brand-red">{{ __('nav_shop') }}</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-white hover:bg-brand-red">{{ __('nav_about') }}</a>
            <a href="{{ route('craft') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-white hover:bg-brand-red">{{ __('nav_craft') }}</a>
            <a href="{{ route('wholesale') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-white hover:bg-brand-red">{{ __('nav_wholesale') }}</a>
            <a href="{{ route('track') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-white hover:bg-brand-red">{{ __('nav_track') }}</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg text-base font-semibold text-white hover:bg-brand-red">{{ __('nav_contact') }}</a>
            
            <!-- Mobile Language Switcher Row -->
            <div class="pt-3 border-t border-brand-charcoal flex items-center justify-between text-xs">
                <span class="text-zinc-400 font-bold uppercase tracking-wider">Lugha / Language:</span>
                <div class="flex items-center gap-2">
                    <a href="{{ route('locale.switch', 'sw') }}" 
                       @click="localStorage.setItem('inas_lang_chosen', 'sw')"
                       class="px-3 py-1.5 rounded-lg border font-bold transition flex items-center gap-1 {{ app()->getLocale() === 'sw' ? 'bg-brand-red text-white border-brand-red' : 'bg-brand-charcoal text-zinc-300 border-zinc-700' }}">
                        <span>🇹🇿</span> Kiswahili
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" 
                       @click="localStorage.setItem('inas_lang_chosen', 'en')"
                       class="px-3 py-1.5 rounded-lg border font-bold transition flex items-center gap-1 {{ app()->getLocale() === 'en' ? 'bg-brand-red text-white border-brand-red' : 'bg-brand-charcoal text-zinc-300 border-zinc-700' }}">
                        <span>🇬🇧</span> English
                    </a>
                </div>
            </div>

            <div class="pt-2">
                <a href="https://wa.me/255682869629" target="_blank" class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-brand-red text-white font-bold text-sm">
                    Order via WhatsApp (+255 682 869 629)
                </a>
            </div>
        </div>
    </header>

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

        <!-- Dark Blurred Backdrop -->
        <div class="fixed inset-0 bg-black/85 backdrop-blur-md transition-opacity" @click="langModalOpen = false"></div>

        <!-- Modal Box -->
        <div class="relative bg-white text-zinc-900 rounded-3xl shadow-2xl max-w-lg w-full border-2 border-brand-red/30 overflow-hidden z-10 text-center p-6 sm:p-8 space-y-6">
            
            <!-- Top Logo Badge -->
            <div class="space-y-3">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-brand-red to-brand-red-dark flex items-center justify-center border-2 border-white/20 shadow-xl">
                    <span class="font-editorial text-3xl font-black text-white">I</span>
                </div>
                <div>
                    <h3 class="font-editorial text-2xl sm:text-3xl font-black text-zinc-900 tracking-tight">
                        Chagua Lugha Yako
                    </h3>
                    <p class="font-editorial text-lg text-brand-red font-bold -mt-0.5">
                        Choose Your Language
                    </p>
                    <p class="text-xs text-zinc-500 mt-1 max-w-sm mx-auto">
                        Karibu INAS Premium Beef Biltong &bull; Buguruni Malapa, Dar es Salaam.
                    </p>
                </div>
            </div>

            <!-- Two Interactive Language Options -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
                
                <!-- Option 1: Kiswahili (Recommended for Tanzania) -->
                <button type="button" 
                        @click="selectLang('sw')"
                        class="p-5 rounded-2xl border-2 transition duration-200 text-left cursor-pointer group flex flex-col justify-between space-y-3 {{ app()->getLocale() === 'sw' ? 'border-brand-red bg-red-50/70 ring-2 ring-brand-red' : 'border-zinc-200 hover:border-brand-red hover:bg-zinc-50' }}">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-3xl">🇹🇿</span>
                            <span class="text-[10px] font-black uppercase tracking-wider bg-brand-red text-white px-2 py-0.5 rounded-full">Tanzania</span>
                        </div>
                        <h4 class="font-bold text-base text-zinc-900 group-hover:text-brand-red transition">
                            Kiswahili
                        </h4>
                        <p class="text-xs text-zinc-600 leading-relaxed">
                            Nunua biltong halisi ya ng'ombe, fuatilia oda, na huduma kwa Kiswahili.
                        </p>
                    </div>
                    <div class="pt-2">
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-red group-hover:translate-x-1 transition transform">
                            <span>Chagua Kiswahili</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                    </div>
                </button>

                <!-- Option 2: English -->
                <button type="button" 
                        @click="selectLang('en')"
                        class="p-5 rounded-2xl border-2 transition duration-200 text-left cursor-pointer group flex flex-col justify-between space-y-3 {{ app()->getLocale() === 'en' ? 'border-brand-red bg-red-50/70 ring-2 ring-brand-red' : 'border-zinc-200 hover:border-brand-red hover:bg-zinc-50' }}">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-3xl">🇬🇧</span>
                            <span class="text-[10px] font-black uppercase tracking-wider bg-zinc-800 text-white px-2 py-0.5 rounded-full">English</span>
                        </div>
                        <h4 class="font-bold text-base text-zinc-900 group-hover:text-brand-red transition">
                            English
                        </h4>
                        <p class="text-xs text-zinc-600 leading-relaxed">
                            Explore artisanal beef biltong, track delivery, or inquire wholesale in English.
                        </p>
                    </div>
                    <div class="pt-2">
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-zinc-900 group-hover:text-brand-red group-hover:translate-x-1 transition transform">
                            <span>Select English</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                    </div>
                </button>

            </div>

            <!-- Footer note & Close -->
            <div class="pt-2 border-t border-zinc-100 flex items-center justify-between text-[11px] text-zinc-400">
                <span>Unaweza kubadili wakati wowote kwenye menyu.</span>
                <button type="button" @click="langModalOpen = false; localStorage.setItem('inas_lang_chosen', currentLang)" class="hover:text-zinc-700 underline font-semibold">
                    Skip / Funga &times;
                </button>
            </div>

        </div>
    </div>

    <!-- Main Content Area -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Slide-over Gourmet Cart Drawer (White Card Surface with Red CTAs) -->
    <div x-show="$store.cart.drawerOpen" 
         class="fixed inset-0 z-50 overflow-hidden" 
         style="display: none;"
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
         
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" @click="$store.cart.close()"></div>

        <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
            <div class="w-screen max-w-md bg-white text-zinc-900 border-l border-zinc-200 flex flex-col shadow-2xl">
                
                <!-- Drawer Header -->
                <div class="p-6 bg-brand-charcoal text-white border-b border-brand-border flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-brand-red flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-editorial text-xl font-bold text-white tracking-wide">
                                {{ app()->getLocale() === 'sw' ? 'Mfuko Wako' : 'Your Gourmet Bag' }}
                            </h3>
                            <span class="text-xs text-zinc-400 font-medium" x-text="$store.cart.count + ' {{ app()->getLocale() === 'sw' ? 'vitu' : 'items' }}'"></span>
                        </div>
                    </div>
                    <button @click="$store.cart.close()" class="p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Free delivery indicator -->
                <div class="px-6 py-3 bg-red-50 border-b border-red-100 text-xs">
                    <template x-if="$store.cart.subtotal >= 50000">
                        <div class="flex items-center gap-1.5 text-emerald-700 font-bold">
                            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>{{ app()->getLocale() === 'sw' ? 'Hongera! Umefuzu usafirishaji wa bure Dar es Salaam!' : 'You qualify for Free Express Delivery in Dar es Salaam!' }}</span>
                        </div>
                    </template>
                    <template x-if="$store.cart.subtotal < 50000">
                        <div class="space-y-1.5 text-zinc-600">
                            <div class="flex justify-between font-semibold">
                                <span>{{ app()->getLocale() === 'sw' ? 'Ongeza' : 'Add' }} <strong class="text-brand-red" x-text="'TZS ' + Number(50000 - $store.cart.subtotal).toLocaleString()"></strong> {{ app()->getLocale() === 'sw' ? 'upate bure Dar' : 'for Free Dar Delivery' }}</span>
                                <span class="text-brand-red font-bold" x-text="Math.round(($store.cart.subtotal / 50000) * 100) + '%'"></span>
                            </div>
                            <div class="w-full bg-zinc-200 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-brand-red h-full rounded-full transition-all duration-300" :style="'width: ' + Math.min(100, ($store.cart.subtotal / 50000) * 100) + '%'"></div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Bag Items List -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4">
                    <template x-if="$store.cart.items.length === 0">
                        <div class="h-full flex flex-col items-center justify-center text-center space-y-3 py-12">
                            <div class="w-16 h-16 rounded-full bg-zinc-100 text-zinc-400 flex items-center justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            </div>
                            <h4 class="font-editorial text-lg font-bold text-zinc-800">{{ app()->getLocale() === 'sw' ? 'Mfuko wako hauna kitu' : 'Your bag is empty' }}</h4>
                            <p class="text-xs text-zinc-500 max-w-xs">{{ app()->getLocale() === 'sw' ? 'Gundua biltong halisi iliyokaushwa kwa asili kisha uongeze kwenye mfuko wako.' : 'Explore our freshly sliced beef biltong and authentic dried snacks to start.' }}</p>
                            <a href="{{ route('shop') }}" @click="$store.cart.close()" class="mt-2 px-6 py-2.5 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white text-xs font-bold shadow-md transition">
                                {{ app()->getLocale() === 'sw' ? 'Angalia Bidhaa' : 'Shop Our Cuts' }}
                            </a>
                        </div>
                    </template>

                    <template x-for="item in $store.cart.items" :key="item.id + '-' + item.pack_size">
                        <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-200 flex gap-4 transition hover:border-zinc-300">
                            <img :src="item.image" :alt="item.name" class="w-16 h-16 rounded-lg object-cover bg-zinc-200 border border-zinc-200 flex-shrink-0">
                            
                            <div class="flex-1 min-w-0 space-y-1">
                                <div class="flex items-start justify-between gap-2">
                                    <h4 class="font-bold text-sm text-zinc-900 truncate" x-text="item.name"></h4>
                                    <button @click="$store.cart.removeItem(item.id, item.pack_size)" class="text-zinc-400 hover:text-brand-red transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                                <span class="inline-block text-[11px] font-semibold text-zinc-500" x-text="item.pack_size"></span>
                                
                                <div class="flex items-center justify-between pt-2">
                                    <div class="flex items-center border border-zinc-300 rounded-lg bg-white overflow-hidden">
                                        <button @click="$store.cart.updateQuantity(item.id, item.pack_size, item.quantity - 1)" class="px-2 py-0.5 text-zinc-600 hover:bg-zinc-100">-</button>
                                        <span class="px-2.5 py-0.5 text-xs font-bold text-zinc-900" x-text="item.quantity"></span>
                                        <button @click="$store.cart.updateQuantity(item.id, item.pack_size, item.quantity + 1)" class="px-2 py-0.5 text-zinc-600 hover:bg-zinc-100">+</button>
                                    </div>
                                    <span class="font-extrabold text-sm text-brand-red" x-text="'TZS ' + Number(item.price * item.quantity).toLocaleString()"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Drawer Footer with Checkout Actions -->
                <div x-show="$store.cart.items.length > 0" class="p-6 bg-zinc-50 border-t border-zinc-200 space-y-4">
                    <div class="space-y-1.5 text-sm">
                        <div class="flex justify-between text-zinc-600 font-medium">
                            <span>{{ app()->getLocale() === 'sw' ? 'Jumla ya Bidhaa' : 'Subtotal' }}</span>
                            <span class="font-bold text-zinc-900" x-text="$store.cart.formattedSubtotal"></span>
                        </div>
                        <div class="flex justify-between text-xs text-zinc-500">
                            <span>{{ app()->getLocale() === 'sw' ? 'Usafirishaji' : 'Delivery' }}</span>
                            <span x-text="$store.cart.subtotal >= 50000 ? '{{ app()->getLocale() === 'sw' ? 'BURE (Dar)' : 'FREE (Dar)' }}' : '{{ app()->getLocale() === 'sw' ? 'Itahesabiwa' : 'Calculated at checkout' }}'"></span>
                        </div>
                    </div>

                    <div class="space-y-2 pt-2">
                        <a href="{{ route('checkout') }}" 
                           @click="$store.cart.close()" 
                           class="w-full py-3.5 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-sm shadow-md hover:shadow-lg transition flex items-center justify-center gap-2 cursor-pointer">
                            <span>{{ app()->getLocale() === 'sw' ? 'Endelea Kulipa' : 'Proceed to Checkout' }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>

                        <!-- Direct WhatsApp Order from Drawer -->
                        <button type="button" 
                                @click="window.open($store.cart.generateWhatsAppLink(), '_blank')" 
                                class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition flex items-center justify-center gap-2 shadow cursor-pointer">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span>{{ app()->getLocale() === 'sw' ? 'Agiza Haraka kwa WhatsApp' : '1-Click WhatsApp Order' }}</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Premium Footer (Charcoal Black, White, Red Accents) -->
    <footer class="bg-brand-black border-t border-brand-charcoal text-white pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
            
            <!-- Brand & Tagline -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-brand-red flex items-center justify-center font-editorial text-xl font-bold text-white shadow-md">
                        I
                    </div>
                    <span class="font-editorial text-2xl font-bold tracking-widest text-white uppercase">INAS</span>
                </div>
                <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed max-w-sm">
                    {{ __('footer_tagline') }}
                </p>
                
                <!-- Language Switcher in Footer -->
                <div class="pt-2 flex items-center gap-3 text-xs">
                    <span class="text-zinc-500 font-semibold">{{ app()->getLocale() === 'sw' ? 'Lugha:' : 'Language:' }}</span>
                    <a href="{{ route('locale.switch', 'sw') }}" @click="localStorage.setItem('inas_lang_chosen', 'sw')" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-bold transition {{ app()->getLocale() === 'sw' ? 'bg-brand-red text-white border-brand-red' : 'bg-brand-charcoal text-zinc-300 border-zinc-700 hover:border-zinc-500' }}">
                        <span>🇹🇿</span> Kiswahili
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" @click="localStorage.setItem('inas_lang_chosen', 'en')" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-bold transition {{ app()->getLocale() === 'en' ? 'bg-brand-red text-white border-brand-red' : 'bg-brand-charcoal text-zinc-300 border-zinc-700 hover:border-zinc-500' }}">
                        <span>🇬🇧</span> English
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-xs uppercase tracking-wider font-bold text-brand-red mb-4">{{ app()->getLocale() === 'sw' ? 'Viungo Muhimu' : 'Discover' }}</h4>
                <ul class="space-y-2.5 text-xs text-white/80 font-medium">
                    <li><a href="{{ route('shop') }}" class="hover:text-brand-red transition">{{ __('nav_shop') }}</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-brand-red transition">{{ __('nav_about') }}</a></li>
                    <li><a href="{{ route('craft') }}" class="hover:text-brand-red transition">{{ __('nav_craft') }}</a></li>
                    <li><a href="{{ route('wholesale') }}" class="hover:text-brand-red transition">{{ __('nav_wholesale') }}</a></li>
                    <li><a href="{{ route('track') }}" class="hover:text-brand-red transition">{{ __('nav_track') }}</a></li>
                </ul>
            </div>

            <!-- Products -->
            <div>
                <h4 class="text-xs uppercase tracking-wider font-bold text-brand-red mb-4">{{ app()->getLocale() === 'sw' ? 'Aina za Biltong' : 'Cuts & Varieties' }}</h4>
                <ul class="space-y-2.5 text-xs text-white/80 font-medium">
                    <li><a href="{{ route('product.show', 'biltong-original-100g') }}" class="hover:text-brand-red transition">Biltong Original 100g</a></li>
                    <li><a href="{{ route('product.show', 'chilli-biltong-bites-100g') }}" class="hover:text-brand-red transition">Chilli Biltong Bites</a></li>
                    <li><a href="{{ route('product.show', 'traditional-droewors-100g') }}" class="hover:text-brand-red transition">Traditional Droëwors</a></li>
                    <li><a href="{{ route('product.show', 'carvers-biltong-whole-slab-250g') }}" class="hover:text-brand-red transition">Carver’s Biltong Slab</a></li>
                    <li><a href="{{ route('product.show', 'wholesale-starter-carton-10x-100g') }}" class="hover:text-brand-red transition">Wholesale Starter Carton</a></li>
                </ul>
            </div>

            <!-- Business Location & Contact -->
            <div>
                <h4 class="text-xs uppercase tracking-wider font-bold text-brand-red mb-4">{{ app()->getLocale() === 'sw' ? 'Ofisi na Kiwanda' : 'Business Information' }}</h4>
                <ul class="space-y-3 text-xs text-white/80 font-medium">
                    <li class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-brand-red mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>INAS Company Limited<br>{{ __('footer_location') }}</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-brand-red flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:+255682869629" class="hover:text-brand-red transition">+255 682 869 629</a>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-brand-red flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ __('footer_hours') }}</span>
                    </li>
                    <li class="pt-2">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-brand-charcoal border border-zinc-700 text-[11px] text-white">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            <span>100% Halal & TBS Standards</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Copyright & Payment Methods -->
        <div class="border-t border-brand-charcoal py-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-zinc-400">
                <div>
                    &copy; {{ date('Y') }} INAS Company Limited. All rights reserved. Buguruni Malapa, Dar es Salaam.
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-[11px]">Tanzanian Payments:</span>
                    <span class="px-2 py-0.5 rounded bg-brand-charcoal border border-zinc-700 text-[10px] text-white">M-Pesa</span>
                    <span class="px-2 py-0.5 rounded bg-brand-charcoal border border-zinc-700 text-[10px] text-white">Tigo Pesa</span>
                    <span class="px-2 py-0.5 rounded bg-brand-charcoal border border-zinc-700 text-[10px] text-white">Airtel</span>
                    <span class="px-2 py-0.5 rounded bg-brand-charcoal border border-zinc-700 text-[10px] text-white">Halopesa</span>
                    <span class="text-zinc-600">|</span>
                    <a href="{{ route('admin.login') }}" class="hover:text-brand-red transition text-[11px]">Staff Access</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
