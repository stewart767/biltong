@extends('layouts.admin')

@section('title', 'Manage Hero Sliders, Deals & Banners')

@section('content')

<div class="space-y-8" 
     x-data="{ 
        activeTab: 'hero',
        showCreateModal: false, 
        showEditModal: false,
        createType: 'hero',
        editingBanner: {
            id: null,
            title: '',
            subtitle: '',
            badge: '',
            image_url: '',
            cta_text: '',
            cta_url: '',
            secondary_cta_text: '5',
            secondary_cta_url: '',
            type: 'hero',
            sort_order: 1,
            is_active: true
        },
        openCreate(type = 'hero') {
            this.createType = type;
            this.showCreateModal = true;
        },
        openEdit(banner) {
            this.editingBanner = {
                id: banner.id,
                title: banner.title || '',
                subtitle: banner.subtitle || '',
                badge: banner.badge || '',
                image_url: banner.image_url || '',
                cta_text: banner.cta_text || '',
                cta_url: banner.cta_url || '',
                secondary_cta_text: banner.secondary_cta_text || '5',
                secondary_cta_url: banner.secondary_cta_url || '',
                type: banner.type || 'hero',
                sort_order: banner.sort_order ?? 1,
                is_active: Boolean(banner.is_active)
            };
            this.showEditModal = true;
        }
     }">

    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-red-500/10 border border-red-500/30 text-[#E52E2E] text-[11px] font-bold uppercase tracking-wider mb-1.5">
                <i data-lucide="sliders" class="w-3.5 h-3.5"></i>
                <span>Homepage Customization</span>
            </div>
            <h2 class="font-display text-2xl font-bold text-white">Hero Sliders & Deals Spotlight</h2>
            <p class="text-xs text-stone-400 mt-0.5">Manage everything on the homepage hero carousel and the Combo Pack deals spotlight (headlines, images, badges, links, and ratings).</p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <button type="button" 
                    @click="openCreate('hero')" 
                    class="px-4 py-2.5 bg-[#E52E2E] hover:bg-[#C61A1A] text-white rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-lg shadow-orange-600/30">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Add Hero Slide</span>
            </button>
            <button type="button" 
                    @click="openCreate('combo_pack')" 
                    class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-lg shadow-red-600/30">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
                <span>Add Combo Pack</span>
            </button>
            <button type="button" 
                    @click="openCreate('promo')" 
                    class="px-4 py-2.5 bg-[#2A2A2A] hover:bg-[#333333] text-stone-200 rounded-xl text-xs font-semibold transition flex items-center gap-2 border border-[#3A3A3A]">
                <i data-lucide="image" class="w-4 h-4"></i>
                <span>Add Promo Banner</span>
            </button>
        </div>
    </div>

    <!-- Quick Stats Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-[#1F1F1F] rounded-2xl border border-[#2E2E2E] p-4 flex items-center justify-between">
            <div>
                <p class="text-xs text-stone-400 font-medium">Hero Slides Total</p>
                <p class="text-2xl font-black text-white mt-1">{{ $heroSlides->count() }}</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-red-500/10 border border-red-500/20 text-[#E52E2E] flex items-center justify-center">
                <i data-lucide="play-circle" class="w-5 h-5"></i>
            </div>
        </div>

        <div class="bg-[#1F1F1F] rounded-2xl border border-[#2E2E2E] p-4 flex items-center justify-between">
            <div>
                <p class="text-xs text-stone-400 font-medium">Combo Pack Spotlight</p>
                @php $activeComboCount = $comboBanners->where('is_active', true)->count(); @endphp
                <p class="text-2xl font-black {{ $activeComboCount > 0 ? 'text-emerald-400' : 'text-stone-400' }} mt-1">
                    {{ $activeComboCount > 0 ? 'Active on Menu' : 'Inactive / None' }}
                </p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 flex items-center justify-center">
                <i data-lucide="package" class="w-5 h-5"></i>
            </div>
        </div>

        <div class="bg-[#1F1F1F] rounded-2xl border border-[#2E2E2E] p-4 flex items-center justify-between">
            <div>
                <p class="text-xs text-stone-400 font-medium">Secondary / Promo Banners</p>
                <p class="text-2xl font-black text-amber-400 mt-1">{{ $promoBanners->count() }}</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center">
                <i data-lucide="tag" class="w-5 h-5"></i>
            </div>
        </div>
    </div>

    <!-- Tab Filter -->
    <div class="flex items-center gap-2 border-b border-[#2A2A2A] pb-3 text-xs font-semibold">
        <button type="button" 
                @click="activeTab = 'hero'" 
                :class="activeTab === 'hero' ? 'bg-[#E52E2E] text-white shadow-md shadow-orange-600/20' : 'bg-[#1F1F1F] text-stone-300 hover:text-white'"
                class="px-4 py-2 rounded-xl transition flex items-center gap-2">
            <i data-lucide="sliders" class="w-3.5 h-3.5"></i>
            <span>Homepage Hero Sliders ({{ $heroSlides->count() }})</span>
        </button>

        <button type="button" 
                @click="activeTab = 'combo'" 
                :class="activeTab === 'combo' ? 'bg-red-600 text-white shadow-md shadow-red-600/20' : 'bg-[#1F1F1F] text-stone-300 hover:text-white'"
                class="px-4 py-2 rounded-xl transition flex items-center gap-2">
            <i data-lucide="package" class="w-3.5 h-3.5"></i>
            <span>Combo Pack Spotlight ({{ $comboBanners->count() }})</span>
        </button>

        <button type="button" 
                @click="activeTab = 'promo'" 
                :class="activeTab === 'promo' ? 'bg-[#E52E2E] text-white' : 'bg-[#1F1F1F] text-stone-300 hover:text-white'"
                class="px-4 py-2 rounded-xl transition flex items-center gap-2">
            <i data-lucide="image" class="w-3.5 h-3.5"></i>
            <span>Promotional Banners ({{ $promoBanners->count() }})</span>
        </button>
    </div>

    <!-- ==========================================
         TAB 1: HERO SLIDERS
         ========================================== -->
    <div x-show="activeTab === 'hero'" class="space-y-6">
        <div class="flex items-center justify-between">
            <div class="text-xs text-stone-400">
                <span>Slides cycle in sort order with live transitions and dot indicators on the front page.</span>
            </div>
        </div>

        @if($heroSlides->isEmpty())
            <div class="bg-[#1F1F1F] border border-[#2A2A2A] rounded-3xl p-12 text-center text-stone-400">
                <i data-lucide="sliders" class="w-12 h-12 mx-auto text-stone-600 mb-3"></i>
                <h4 class="text-base font-bold text-white">No Hero Sliders Configured</h4>
                <p class="text-xs mt-1">Create your first hero slide to customize the homepage carousel.</p>
                <button type="button" @click="openCreate('hero')" class="mt-4 px-5 py-2.5 bg-[#E52E2E] hover:bg-[#C61A1A] text-white rounded-xl text-xs font-bold transition">
                    Create Slide
                </button>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
                @foreach($heroSlides as $slide)
                    <div class="bg-[#1F1F1F] rounded-3xl border {{ $slide->is_active ? 'border-[#333333]' : 'border-red-900/40 opacity-75' }} overflow-hidden shadow-lg flex flex-col justify-between transition-all hover:border-red-500/40">
                        
                        <!-- Top Header & Visual Frame -->
                        <div>
                            <!-- Visual Simulated Hero Preview -->
                            <div class="bg-gradient-to-r from-[#171717] to-[#121212] p-5 border-b border-[#2A2A2A] flex items-center justify-between relative overflow-hidden">
                                
                                <!-- Text Preview -->
                                <div class="max-w-[55%] z-10 space-y-1">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase bg-[#E52E2E] text-white">
                                            Slide #{{ $slide->sort_order ?? $loop->iteration }}
                                        </span>
                                        @if($slide->badge)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-orange-950/60 text-orange-400 border border-orange-800/40">
                                                {{ $slide->badge }}
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="font-display font-black text-xl text-white tracking-tight leading-tight whitespace-pre-line">
                                        {{ $slide->title }}
                                    </h3>
                                    <p class="text-xs font-semibold text-[#E52E2E] leading-snug whitespace-pre-line line-clamp-2">
                                        {{ $slide->subtitle }}
                                    </p>
                                </div>

                                <!-- Signature Orange Disc with Cutout Burger Image -->
                                <div class="relative w-28 h-28 rounded-full bg-gradient-to-b from-[#E52E2E] to-[#C61A1A] flex items-center justify-center shadow-lg border-2 border-white/60 ring-2 ring-red-300/30 flex-shrink-0">
                                    @php
                                        $imgUrl = $slide->image_url;
                                        if ($imgUrl && !str_starts_with($imgUrl, 'http://') && !str_starts_with($imgUrl, 'https://')) {
                                            $imgUrl = asset($imgUrl);
                                        }
                                    @endphp
                                    <img src="{{ $imgUrl ?: asset('images/burger-house/hero-burger-transparent.png') }}" 
                                         alt="{{ $slide->title }}" 
                                         class="w-[110%] max-w-none transform -translate-y-1 drop-shadow-md select-none pointer-events-none">
                                </div>

                                <!-- Background glow effect -->
                                <div class="absolute -right-6 -bottom-6 w-32 h-32 rounded-full bg-orange-600/10 blur-2xl pointer-events-none"></div>
                            </div>

                            <!-- Details Body -->
                            <div class="p-5 space-y-3">
                                <div class="flex flex-wrap items-center gap-2 text-xs">
                                    <span class="text-stone-400">CTA Button:</span>
                                    <span class="px-2.5 py-1 rounded-lg bg-[#262626] text-white font-medium border border-[#333333] flex items-center gap-1.5">
                                        <span>{{ $slide->cta_text ?: 'Order Now' }}</span>
                                        <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-[#E52E2E]"></i>
                                        <span class="text-stone-400 font-mono text-[11px]">({{ $slide->cta_url ?: '/order' }})</span>
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 text-xs text-stone-400 pt-1">
                                    <span>Image source:</span>
                                    <span class="font-mono text-[11px] text-stone-300 truncate max-w-xs" title="{{ $slide->image_url }}">
                                        {{ $slide->image_url ?: 'Default Burger House Cutout' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="p-5 pt-3 border-t border-[#2A2A2A] flex items-center justify-between bg-[#1A1A1A]">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold flex items-center gap-1.5 {{ $slide->is_active ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-stone-800 text-stone-400 border border-stone-700' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $slide->is_active ? 'bg-emerald-400' : 'bg-stone-400' }}"></span>
                                <span>{{ $slide->is_active ? 'Active on Homepage' : 'Hidden / Inactive' }}</span>
                            </span>

                            <div class="flex items-center gap-2">
                                <button type="button" 
                                        @click="openEdit({{ Js::from($slide) }})" 
                                        class="px-3 py-1.5 bg-[#2A2A2A] hover:bg-[#383838] text-white rounded-xl text-xs font-semibold transition flex items-center gap-1.5 border border-[#3A3A3A]">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5 text-[#E52E2E]"></i>
                                    <span>Edit Slide</span>
                                </button>

                                <form action="{{ route('admin.content.banners.destroy', $slide) }}" method="POST" onsubmit="return confirm('Delete this hero slide?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-xl bg-red-950/40 hover:bg-red-900/60 text-red-400 border border-red-800/40 transition" title="Delete Slide">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- ==========================================
         TAB 2: COMBO PACK SPOTLIGHT
         ========================================== -->
    <div x-show="activeTab === 'combo'" class="space-y-6" style="display: none;">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-white">Homepage Menu Section &bull; Combo Pack Spotlight</h3>
                <p class="text-xs text-stone-400 mt-0.5">Controls the circular spotlight card displayed on the right of the Fresh From The Kitchen menu cards.</p>
            </div>

            <button type="button" 
                    @click="openCreate('combo_pack')" 
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-md shadow-red-600/30">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Add Combo Spotlight</span>
            </button>
        </div>

        @if($comboBanners->isEmpty())
            <div class="bg-[#1F1F1F] border border-[#2A2A2A] rounded-3xl p-12 text-center text-stone-400">
                <i data-lucide="package" class="w-12 h-12 mx-auto text-stone-600 mb-3"></i>
                <h4 class="text-base font-bold text-white">No Combo Pack Spotlight Found</h4>
                <p class="text-xs mt-1">Configure your combo deal card to spotlight your best burgers on the homepage.</p>
                <button type="button" @click="openCreate('combo_pack')" class="mt-4 px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl text-xs font-bold transition">
                    Configure Combo Pack
                </button>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach($comboBanners as $combo)
                    <div class="bg-[#1F1F1F] rounded-3xl border {{ $combo->is_active ? 'border-[#333333]' : 'border-stone-800 opacity-75' }} overflow-hidden shadow-lg p-6 flex flex-col justify-between">
                        
                        <div>
                            <!-- Header & Status -->
                            <div class="flex items-center justify-between mb-5">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $combo->is_active ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-stone-800 text-stone-400 border border-stone-700' }}">
                                    {{ $combo->is_active ? 'Active on Homepage' : 'Hidden / Inactive' }}
                                </span>

                                <span class="text-xs text-stone-400">Sort #{{ $combo->sort_order }}</span>
                            </div>

                            <!-- Live Visual Simulation of Homepage Circle Card -->
                            <div class="bg-[#171717] rounded-2xl p-6 border border-[#2A2A2A] flex justify-center mb-6">
                                <div class="w-64 h-64 rounded-full bg-gradient-to-b from-[#FFF5EE] via-[#FFF8F2] to-[#FFF0E6] relative p-4 flex flex-col items-center justify-between overflow-hidden shadow-md border-2 border-red-200/90 text-stone-900">
                                    
                                    <!-- Top Row: Title + Ribbon -->
                                    <div class="w-full px-4 pt-1 flex items-start justify-between z-10">
                                        <div>
                                            <h4 class="font-bold text-sm text-[#B77B3B] leading-tight">{{ $combo->title ?: 'Hot Deals' }}</h4>
                                            <svg class="w-8 h-1.5 text-[#E52E2E] mt-0.5" viewBox="0 0 60 8" fill="none">
                                                <path d="M2 6C15 2 40 2 58 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </div>

                                        @if($combo->badge)
                                            <div class="bg-white/95 border border-red-300 text-[#D32F2F] text-[8px] font-black px-2 py-0.5 rounded-full shadow-2xs leading-tight text-center">
                                                <span>{!! nl2br(e($combo->badge)) !!}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Meal Image -->
                                    @php
                                        $comboImg = $combo->image_url;
                                        if ($comboImg && !str_starts_with($comboImg, 'http://') && !str_starts_with($comboImg, 'https://')) {
                                            $comboImg = asset($comboImg);
                                        }
                                    @endphp
                                    <div class="w-44 h-28 rounded-xl overflow-hidden shadow-md border-2 border-white my-auto ring-1 ring-red-200/40">
                                        <img src="{{ $comboImg ?: asset('images/burger-house/hot-deals-combo.jpg') }}" alt="{{ $combo->title }}" class="w-full h-full object-cover">
                                    </div>

                                    <!-- Bottom: Rating & Pill -->
                                    <div class="w-full flex flex-col items-center z-10 -mt-1 pb-1">
                                        <div class="flex items-center gap-0.5 text-amber-500 text-[10px]">
                                            @php $ratingNum = is_numeric($combo->secondary_cta_text) ? (int)$combo->secondary_cta_text : 5; @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="{{ $i <= $ratingNum ? 'text-amber-500' : 'text-stone-300' }}">★</span>
                                            @endfor
                                        </div>
                                        <div class="mt-1 bg-[#D32F2F] text-white text-[8px] font-bold px-3 py-0.5 rounded-full shadow-2xs border border-white/50 tracking-wider">
                                            {{ $combo->cta_text ?: 'Combo Pack' }}
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Details Table -->
                            <div class="space-y-2.5 text-xs">
                                <div class="flex justify-between py-1.5 border-b border-[#2A2A2A]">
                                    <span class="text-stone-400">Spotlight Heading:</span>
                                    <span class="font-bold text-white">{{ $combo->title }}</span>
                                </div>
                                <div class="flex justify-between py-1.5 border-b border-[#2A2A2A]">
                                    <span class="text-stone-400">Ribbon Badge:</span>
                                    <span class="font-semibold text-red-400">{{ $combo->badge ?: 'None' }}</span>
                                </div>
                                <div class="flex justify-between py-1.5 border-b border-[#2A2A2A]">
                                    <span class="text-stone-400">Button Label:</span>
                                    <span class="font-bold text-[#E52E2E]">{{ $combo->cta_text ?: 'Combo Pack' }}</span>
                                </div>
                                <div class="flex justify-between py-1.5 border-b border-[#2A2A2A]">
                                    <span class="text-stone-400">Target Destination:</span>
                                    <span class="font-mono text-stone-300">{{ $combo->cta_url ?: '/order' }}</span>
                                </div>
                                <div class="flex justify-between py-1.5 border-b border-[#2A2A2A]">
                                    <span class="text-stone-400">Star Rating:</span>
                                    <span class="text-amber-400 font-bold">{{ $combo->secondary_cta_text ?: '5' }} / 5 Stars</span>
                                </div>
                                <div class="flex justify-between py-1.5 border-b border-[#2A2A2A]">
                                    <span class="text-stone-400">Image Path:</span>
                                    <span class="font-mono text-stone-300 text-[11px] truncate max-w-[200px]" title="{{ $combo->image_url }}">{{ $combo->image_url }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="pt-5 mt-4 border-t border-[#2A2A2A] flex items-center justify-end gap-2.5">
                            <button type="button" 
                                    @click="openEdit({{ Js::from($combo) }})" 
                                    class="px-4 py-2 bg-[#2A2A2A] hover:bg-[#383838] text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 border border-[#3A3A3A]">
                                <i data-lucide="edit-3" class="w-3.5 h-3.5 text-red-400"></i>
                                <span>Edit Combo Pack</span>
                            </button>

                            <form action="{{ route('admin.content.banners.destroy', $combo) }}" method="POST" onsubmit="return confirm('Delete this combo spotlight?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl bg-red-950/40 hover:bg-red-900/60 text-red-400 border border-red-800/40 transition" title="Delete">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- ==========================================
         TAB 3: PROMOTIONAL & SECONDARY BANNERS
         ========================================== -->
    <div x-show="activeTab === 'promo'" class="space-y-6" style="display: none;">
        @if($promoBanners->isEmpty())
            <div class="bg-[#1F1F1F] border border-[#2A2A2A] rounded-3xl p-12 text-center text-stone-400">
                <i data-lucide="image" class="w-12 h-12 mx-auto text-stone-600 mb-3"></i>
                <h4 class="text-base font-bold text-white">No Promotional Banners Found</h4>
                <p class="text-xs mt-1">Add banners to promote special combos or kitchen announcements.</p>
                <button type="button" @click="openCreate('promo')" class="mt-4 px-5 py-2.5 bg-[#E52E2E] hover:bg-[#C61A1A] text-white rounded-xl text-xs font-bold transition">
                    Add Promo Banner
                </button>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($promoBanners as $banner)
                    <div class="bg-[#1F1F1F] rounded-3xl border border-[#2A2A2A] overflow-hidden shadow-xs flex flex-col justify-between">
                        <div>
                            @if($banner->image_url)
                                <div class="h-44 bg-[#171717] overflow-hidden relative">
                                    <img src="{{ asset($banner->image_url) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover">
                                    <span class="absolute top-3 left-3 px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-black/70 text-[#E52E2E] border border-[#E52E2E]/40">
                                        {{ $banner->type }}
                                    </span>
                                </div>
                            @endif

                            <div class="p-6">
                                @if($banner->badge)
                                    <span class="text-[10px] font-bold text-orange-400 uppercase tracking-wider block mb-1">{{ $banner->badge }}</span>
                                @endif
                                <h3 class="font-display font-bold text-xl text-white">{{ $banner->title }}</h3>
                                <p class="text-xs text-stone-300 mt-2 leading-relaxed">{{ $banner->subtitle }}</p>

                                <div class="mt-4 pt-4 border-t border-[#2A2A2A] flex flex-wrap gap-2 text-xs">
                                    @if($banner->cta_text)
                                        <span class="px-2.5 py-1 rounded bg-[#2A2A2A] text-stone-300 text-[11px]">CTA: <strong>{{ $banner->cta_text }}</strong> ({{ $banner->cta_url }})</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="p-6 pt-3 border-t border-[#2A2A2A] flex items-center justify-between">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $banner->is_active ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-stone-800 text-stone-400' }}">
                                {{ $banner->is_active ? 'Active on Storefront' : 'Draft / Inactive' }}
                            </span>

                            <div class="flex items-center gap-2">
                                <button type="button" 
                                        @click="openEdit({{ Js::from($banner) }})" 
                                        class="px-3 py-1.5 bg-[#2A2A2A] hover:bg-[#383838] text-white rounded-xl text-xs font-semibold transition border border-[#3A3A3A]">
                                    Edit
                                </button>
                                <form action="{{ route('admin.content.banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('Delete this banner?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-stone-400 hover:text-red-400 transition">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- ==========================================
         MODAL: ADD NEW SLIDE / BANNER / COMBO
         ========================================== -->
    <div x-show="showCreateModal" 
         x-transition 
         class="fixed inset-0 z-50 bg-[#171717]/80 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto"
         style="display: none;">
        <div @click.away="showCreateModal = false" class="bg-[#1F1F1F] w-full max-w-xl rounded-3xl p-6 sm:p-8 shadow-2xl border border-[#2A2A2A] relative text-xs my-8 max-h-[90vh] overflow-y-auto">
            <button @click="showCreateModal = false" class="absolute top-6 right-6 text-stone-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <div class="mb-5">
                <h3 class="font-display font-bold text-xl text-white">Add New Section / Slide</h3>
                <p class="text-xs text-stone-400 mt-0.5">Configure headlines, meal images, ribbon badges, CTA links, and display order.</p>
            </div>

            <form action="{{ route('admin.content.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-stone-400 font-semibold mb-1">Section Type *</label>
                        <select name="type" x-model="createType" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                            <option value="hero">Hero Top Slider (Homepage)</option>
                            <option value="combo_pack">Combo Pack Spotlight (Menu Section)</option>
                            <option value="promo">Promotional Section</option>
                            <option value="lifestyle">Lifestyle Spotlight</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-stone-400 font-semibold mb-1">Display Sort Order</label>
                        <input type="number" name="sort_order" value="1" min="1" max="99" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-stone-400 font-semibold mb-1">Badge Tag / Ribbon Text</label>
                    <input type="text" name="badge" placeholder="Free Delivery (or 20% OFF / Chef's Pick)" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                </div>

                <div>
                    <label class="block text-stone-400 font-semibold mb-1">Main Heading / Title *</label>
                    <input type="text" name="title" required placeholder="Hot Deals" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                </div>

                <div x-show="createType !== 'combo_pack'">
                    <label class="block text-stone-400 font-semibold mb-1">Subtitle / Supporting Text</label>
                    <textarea name="subtitle" rows="2" placeholder="Delicious Burgers Made Fresh" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-stone-400 font-semibold mb-1">Button Text</label>
                        <input type="text" name="cta_text" value="Combo Pack" placeholder="Combo Pack" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                    </div>
                    <div>
                        <label class="block text-stone-400 font-semibold mb-1">Button Destination URL</label>
                        <input type="text" name="cta_url" value="/order" placeholder="/order" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                    </div>
                </div>

                <!-- Star Rating for Combo Pack -->
                <div x-show="createType === 'combo_pack'">
                    <label class="block text-stone-400 font-semibold mb-1">Star Rating (1 to 5 Stars)</label>
                    <select name="secondary_cta_text" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                        <option value="5">★★★★★ (5 Stars - Top Rated)</option>
                        <option value="4">★★★★☆ (4 Stars)</option>
                        <option value="3">★★★☆☆ (3 Stars)</option>
                    </select>
                </div>

                <!-- Image Controls -->
                <div class="space-y-3 pt-2 border-t border-[#2A2A2A]">
                    <label class="block text-stone-300 font-bold">Meal / Section Image</label>
                    
                    <div>
                        <label class="block text-stone-400 mb-1">Upload Image File</label>
                        <input type="file" name="image_file" accept="image/*" class="w-full text-stone-300 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#E52E2E] file:text-white hover:file:bg-[#C61A1A]">
                    </div>

                    <div>
                        <label class="block text-stone-400 mb-1">Or Select From Preset Burger House Images:</label>
                        <select onchange="document.getElementById('new_image_url').value = this.value" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white mb-2">
                            <option value="">-- Choose Image Preset --</option>
                            <option value="images/burger-house/hot-deals-combo.jpg">Hot Deals 3-Burger Platter with Fries & Dips</option>
                            <option value="images/burger-house/special-burger.jpg">Special Burger House Platter</option>
                            <option value="images/burger-house/hero-burger-transparent.png">Classic Burger House Gourmet</option>
                            <option value="images/burger-house/hero-burger-main.png">Double Cheese Burger Stack</option>
                            <option value="images/burger-house/hero-burger-transp1.png">Smoky BBQ Bacon Burger</option>
                            <option value="images/burger-house/hero-burger-transp2.png">Crispy Chicken Avocado Stack</option>
                        </select>
                        <input type="text" id="new_image_url" name="image_url" placeholder="or enter image path (e.g. images/burger-house/hot-deals-combo.jpg)" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white text-xs">
                    </div>
                </div>

                <div class="pt-2 flex items-center justify-between border-t border-[#2A2A2A]">
                    <label class="flex items-center gap-2 cursor-pointer text-stone-300">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded bg-[#171717] border-stone-700 text-[#E52E2E] focus:ring-[#E52E2E]">
                        <span class="font-medium">Active on Storefront immediately</span>
                    </label>

                    <div class="flex items-center gap-2">
                        <button type="button" @click="showCreateModal = false" class="px-4 py-2 text-stone-400 hover:text-white">Cancel</button>
                        <button type="submit" class="px-6 py-2.5 bg-[#E52E2E] hover:bg-[#C61A1A] text-white rounded-xl font-bold uppercase tracking-wider transition shadow-md shadow-orange-600/30">Save Section</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ==========================================
         MODAL: EDIT EXISTING SLIDE / BANNER / COMBO
         ========================================== -->
    <div x-show="showEditModal" 
         x-transition 
         class="fixed inset-0 z-50 bg-[#171717]/80 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto"
         style="display: none;">
        <div @click.away="showEditModal = false" class="bg-[#1F1F1F] w-full max-w-xl rounded-3xl p-6 sm:p-8 shadow-2xl border border-[#2A2A2A] relative text-xs my-8 max-h-[90vh] overflow-y-auto">
            <button @click="showEditModal = false" class="absolute top-6 right-6 text-stone-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <div class="mb-5">
                <h3 class="font-display font-bold text-xl text-white" x-text="editingBanner.type === 'combo_pack' ? 'Edit Combo Pack Spotlight' : 'Edit Slide / Banner'"></h3>
                <p class="text-xs text-stone-400 mt-0.5">Update headlines, meal images, ribbon badges, button links, or ratings.</p>
            </div>

            <form :action="'{{ url('/admin/content/banners') }}/' + editingBanner.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-stone-400 font-semibold mb-1">Section Type *</label>
                        <select name="type" x-model="editingBanner.type" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                            <option value="hero">Hero Top Slider (Homepage)</option>
                            <option value="combo_pack">Combo Pack Spotlight (Menu Section)</option>
                            <option value="promo">Promotional Section</option>
                            <option value="lifestyle">Lifestyle Spotlight</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-stone-400 font-semibold mb-1">Display Sort Order</label>
                        <input type="number" name="sort_order" x-model="editingBanner.sort_order" min="1" max="99" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-stone-400 font-semibold mb-1">Ribbon Badge / Tag Text</label>
                    <input type="text" name="badge" x-model="editingBanner.badge" placeholder="Free Delivery" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                </div>

                <div>
                    <label class="block text-stone-400 font-semibold mb-1">Main Heading / Title *</label>
                    <input type="text" name="title" required x-model="editingBanner.title" placeholder="Hot Deals" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                </div>

                <div x-show="editingBanner.type !== 'combo_pack'">
                    <label class="block text-stone-400 font-semibold mb-1">Subtitle / Tagline</label>
                    <textarea name="subtitle" rows="2" x-model="editingBanner.subtitle" placeholder="Delicious Burgers Made Fresh" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-stone-400 font-semibold mb-1">Button Label</label>
                        <input type="text" name="cta_text" x-model="editingBanner.cta_text" placeholder="Combo Pack" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                    </div>
                    <div>
                        <label class="block text-stone-400 font-semibold mb-1">Button Link URL</label>
                        <input type="text" name="cta_url" x-model="editingBanner.cta_url" placeholder="/order" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                    </div>
                </div>

                <!-- Star Rating for Combo Pack -->
                <div x-show="editingBanner.type === 'combo_pack'">
                    <label class="block text-stone-400 font-semibold mb-1">Star Rating (1 to 5 Stars)</label>
                    <select name="secondary_cta_text" x-model="editingBanner.secondary_cta_text" class="w-full px-3 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-white focus:border-[#E52E2E] outline-none">
                        <option value="5">★★★★★ (5 Stars - Top Rated)</option>
                        <option value="4">★★★★☆ (4 Stars)</option>
                        <option value="3">★★★☆☆ (3 Stars)</option>
                    </select>
                </div>

                <!-- Meal Image Controls -->
                <div class="space-y-3 pt-2 border-t border-[#2A2A2A]">
                    <div class="flex items-center justify-between">
                        <label class="block text-stone-300 font-bold">Image</label>
                        <span class="text-stone-500 text-[11px]" x-text="'Current: ' + (editingBanner.image_url || 'Default')"></span>
                    </div>

                    <!-- Current Image Preview -->
                    <template x-if="editingBanner.image_url">
                        <div class="flex items-center gap-4 p-3 bg-[#171717] rounded-2xl border border-[#2E2E2E]">
                            <div class="w-20 h-14 rounded-xl overflow-hidden border border-stone-700 bg-stone-900 flex-shrink-0">
                                <img :src="'{{ asset('') }}' + editingBanner.image_url.replace(/^\/+/, '')" 
                                     alt="Preview" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="truncate">
                                <p class="text-white font-semibold">Active Image</p>
                                <p class="text-[11px] text-stone-400 font-mono truncate" x-text="editingBanner.image_url"></p>
                            </div>
                        </div>
                    </template>
                    
                    <div>
                        <label class="block text-stone-400 mb-1">Upload New Image File <span class="text-stone-500">(Optional: leaves current image if empty)</span></label>
                        <input type="file" name="image_file" accept="image/*" class="w-full text-stone-300 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#E52E2E] file:text-white hover:file:bg-[#C61A1A]">
                    </div>

                    <div>
                        <label class="block text-stone-400 mb-1">Or Change To Preset Meal / Cutout Image:</label>
                        <select @change="editingBanner.image_url = $event.target.value; $refs.editImageUrlInput.value = $event.target.value" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white mb-2">
                            <option value="">-- Choose Image Preset --</option>
                            <option value="images/burger-house/hot-deals-combo.jpg">Hot Deals 3-Burger Platter with Fries & Dips</option>
                            <option value="images/burger-house/special-burger.jpg">Special Burger House Platter</option>
                            <option value="images/burger-house/hero-burger-transparent.png">Classic Burger House Gourmet Cutout</option>
                            <option value="images/burger-house/hero-burger-main.png">Double Cheese Burger Stack</option>
                            <option value="images/burger-house/hero-burger-transp1.png">Smoky BBQ Bacon Burger</option>
                            <option value="images/burger-house/hero-burger-transp2.png">Crispy Chicken Avocado Stack</option>
                        </select>
                        <input type="text" x-ref="editImageUrlInput" name="image_url" x-model="editingBanner.image_url" placeholder="or enter image path" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white text-xs">
                    </div>
                </div>

                <div class="pt-2 flex items-center justify-between border-t border-[#2A2A2A]">
                    <label class="flex items-center gap-2 cursor-pointer text-stone-300">
                        <input type="checkbox" name="is_active" value="1" x-model="editingBanner.is_active" class="rounded bg-[#171717] border-stone-700 text-[#E52E2E] focus:ring-[#E52E2E]">
                        <span class="font-medium">Active on Storefront</span>
                    </label>

                    <div class="flex items-center gap-2">
                        <button type="button" @click="showEditModal = false" class="px-4 py-2 text-stone-400 hover:text-white">Cancel</button>
                        <button type="submit" class="px-6 py-2.5 bg-[#E52E2E] hover:bg-[#C61A1A] text-white rounded-xl font-bold uppercase tracking-wider transition shadow-md shadow-orange-600/30">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
