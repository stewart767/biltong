@extends('layouts.admin')

@section('title', 'Website & System Settings')
@section('page_title', 'Manage System & Content Sections')

@section('content')

    <div class="max-w-5xl space-y-8">
        
        <div>
            <h2 class="font-editorial text-2xl font-bold text-brand-cream">INAS System & Storefront Configuration</h2>
            <span class="text-xs text-brand-muted">Control company info, hero carousel images, feature badges, promo banners, delivery fees, and Lipa Namba payments</span>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- 1. Company & Contact Information -->
            <div class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-6 shadow-xl">
                <div class="flex items-center gap-3 pb-3 border-b border-brand-border/60">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-red"></span>
                    <h3 class="font-editorial text-xl font-bold text-brand-cream">1. Company & Butchery Contact Details</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Registered Company Name</label>
                        <input type="text" name="company_name" value="{{ $settings['company_name'] ?? 'INAS Company Limited' }}" required
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Location & Facility Address</label>
                        <input type="text" name="company_location" value="{{ $settings['company_location'] ?? 'Buguruni Malapa, Dar es Salaam, Tanzania' }}" required
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Official Phone / Hotline</label>
                        <input type="text" name="company_phone" value="{{ $settings['company_phone'] ?? '+255 682 869 629' }}" required
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">WhatsApp Hotline (Digits Only)</label>
                        <input type="text" name="company_whatsapp" value="{{ $settings['company_whatsapp'] ?? '255682869629' }}" required
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Official Contact Email</label>
                        <input type="email" name="company_email" value="{{ $settings['company_email'] ?? 'sales@inasbiltong.co.tz' }}" required
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Operating Hours</label>
                        <input type="text" name="operating_hours" value="{{ $settings['operating_hours'] ?? 'Monday - Saturday: 8:00 AM - 6:30 PM (EAT)' }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Google Maps / Directions URL</label>
                        <input type="url" name="google_maps_url" value="{{ $settings['google_maps_url'] ?? 'https://maps.google.com/?q=Buguruni+Malapa+Dar+es+Salaam' }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- 2. Hero Rotating Dish Carousel & Images (Upload Any Images!) -->
            <div class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-6 shadow-xl">
                <div class="flex items-center justify-between pb-3 border-b border-brand-border/60">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-brand-red"></span>
                        <h3 class="font-editorial text-xl font-bold text-brand-cream">2. Hero Section Rotating Dishes & Images</h3>
                    </div>
                    <span class="text-xs text-brand-red font-semibold">Upload custom food or plate photos</span>
                </div>

                <p class="text-xs text-brand-muted">
                    These 4 rotating dishes appear in the large circular plate on your homepage hero section. You can upload any image, set its badge tag, dish name, price tag, and button link.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Slide 1 -->
                    <div class="p-5 rounded-2xl bg-brand-dark/70 border border-brand-border space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-brand-red uppercase">Hero Slide 1 (Primary)</span>
                            @php $img1 = $settings['hero_slide_1_image'] ?? 'images/bbq-biltong.jpg'; @endphp
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-brand-red/60 shadow-lg flex-shrink-0 bg-brand-dark">
                                <img src="{{ asset($img1) }}" alt="Slide 1" class="w-full h-full object-cover">
                            </div>
                            <div class="space-y-1 flex-1">
                                <label class="block text-[11px] font-semibold text-brand-cream">Upload New Slide 1 Image</label>
                                <input type="file" name="hero_slide_1_image" accept="image/*"
                                       class="w-full text-xs text-brand-muted file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-red file:text-white hover:file:bg-brand-red-dark cursor-pointer">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="space-y-1">
                                <label class="block text-[10px] uppercase font-bold text-brand-muted">Badge Tag</label>
                                <input type="text" name="hero_slide_1_tag" value="{{ $settings['hero_slide_1_tag'] ?? 'SIGNATURE 100G' }}"
                                       class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[10px] uppercase font-bold text-brand-muted">Price Tag</label>
                                <input type="text" name="hero_slide_1_price" value="{{ $settings['hero_slide_1_price'] ?? 'TZS 10,000' }}"
                                       class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-muted">Dish / Cut Name</label>
                            <input type="text" name="hero_slide_1_title" value="{{ $settings['hero_slide_1_title'] ?? 'Biltong Original 100g' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-muted">Subtitle / Cut Details</label>
                            <input type="text" name="hero_slide_1_sub" value="{{ $settings['hero_slide_1_sub'] ?? '100% pasture-grazed Tanzanian beef' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-muted">Button Link</label>
                            <input type="text" name="hero_slide_1_link" value="{{ $settings['hero_slide_1_link'] ?? '/shop' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="p-5 rounded-2xl bg-brand-dark/70 border border-brand-border space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-brand-red uppercase">Hero Slide 2</span>
                            @php $img2 = $settings['hero_slide_2_image'] ?? 'images/chilli-biltong.jpg'; @endphp
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-brand-red/60 shadow-lg flex-shrink-0 bg-brand-dark">
                                <img src="{{ asset($img2) }}" alt="Slide 2" class="w-full h-full object-cover">
                            </div>
                            <div class="space-y-1 flex-1">
                                <label class="block text-[11px] font-semibold text-brand-cream">Upload New Slide 2 Image</label>
                                <input type="file" name="hero_slide_2_image" accept="image/*"
                                       class="w-full text-xs text-brand-muted file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-red file:text-white hover:file:bg-brand-red-dark cursor-pointer">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="space-y-1">
                                <label class="block text-[10px] uppercase font-bold text-brand-muted">Badge Tag</label>
                                <input type="text" name="hero_slide_2_tag" value="{{ $settings['hero_slide_2_tag'] ?? 'SPICY PERI-PERI' }}"
                                       class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[10px] uppercase font-bold text-brand-muted">Price Tag</label>
                                <input type="text" name="hero_slide_2_price" value="{{ $settings['hero_slide_2_price'] ?? 'TZS 11,000' }}"
                                       class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-muted">Dish / Cut Name</label>
                            <input type="text" name="hero_slide_2_title" value="{{ $settings['hero_slide_2_title'] ?? 'Chilli Biltong Bites' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-muted">Subtitle / Cut Details</label>
                            <input type="text" name="hero_slide_2_sub" value="{{ $settings['hero_slide_2_sub'] ?? 'Warm lingering spice kick' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-muted">Button Link</label>
                            <input type="text" name="hero_slide_2_link" value="{{ $settings['hero_slide_2_link'] ?? '/shop' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="p-5 rounded-2xl bg-brand-dark/70 border border-brand-border space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-brand-red uppercase">Hero Slide 3</span>
                            @php $img3 = $settings['hero_slide_3_image'] ?? 'images/droewors.jpg'; @endphp
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-brand-red/60 shadow-lg flex-shrink-0 bg-brand-dark">
                                <img src="{{ asset($img3) }}" alt="Slide 3" class="w-full h-full object-cover">
                            </div>
                            <div class="space-y-1 flex-1">
                                <label class="block text-[11px] font-semibold text-brand-cream">Upload New Slide 3 Image</label>
                                <input type="file" name="hero_slide_3_image" accept="image/*"
                                       class="w-full text-xs text-brand-muted file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-red file:text-white hover:file:bg-brand-red-dark cursor-pointer">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="space-y-1">
                                <label class="block text-[10px] uppercase font-bold text-brand-muted">Badge Tag</label>
                                <input type="text" name="hero_slide_3_tag" value="{{ $settings['hero_slide_3_tag'] ?? 'AIR-DRIED SAUSAGE' }}"
                                       class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[10px] uppercase font-bold text-brand-muted">Price Tag</label>
                                <input type="text" name="hero_slide_3_price" value="{{ $settings['hero_slide_3_price'] ?? 'TZS 12,000' }}"
                                       class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-muted">Dish / Cut Name</label>
                            <input type="text" name="hero_slide_3_title" value="{{ $settings['hero_slide_3_title'] ?? 'Traditional Droëwors' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-muted">Subtitle / Cut Details</label>
                            <input type="text" name="hero_slide_3_sub" value="{{ $settings['hero_slide_3_sub'] ?? 'Spiced beef & roasted coriander' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-muted">Button Link</label>
                            <input type="text" name="hero_slide_3_link" value="{{ $settings['hero_slide_3_link'] ?? '/shop' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="p-5 rounded-2xl bg-brand-dark/70 border border-brand-border space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-brand-red uppercase">Hero Slide 4</span>
                            @php $img4 = $settings['hero_slide_4_image'] ?? 'images/carvers-slab.jpg'; @endphp
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-brand-red/60 shadow-lg flex-shrink-0 bg-brand-dark">
                                <img src="{{ asset($img4) }}" alt="Slide 4" class="w-full h-full object-cover">
                            </div>
                            <div class="space-y-1 flex-1">
                                <label class="block text-[11px] font-semibold text-brand-cream">Upload New Slide 4 Image</label>
                                <input type="file" name="hero_slide_4_image" accept="image/*"
                                       class="w-full text-xs text-brand-muted file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-red file:text-white hover:file:bg-brand-red-dark cursor-pointer">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="space-y-1">
                                <label class="block text-[10px] uppercase font-bold text-brand-muted">Badge Tag</label>
                                <input type="text" name="hero_slide_4_tag" value="{{ $settings['hero_slide_4_tag'] ?? 'CHEF SPECIAL' }}"
                                       class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[10px] uppercase font-bold text-brand-muted">Price Tag</label>
                                <input type="text" name="hero_slide_4_price" value="{{ $settings['hero_slide_4_price'] ?? 'TZS 24,000' }}"
                                       class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-muted">Dish / Cut Name</label>
                            <input type="text" name="hero_slide_4_title" value="{{ $settings['hero_slide_4_title'] ?? 'Carvers Whole Slab' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-muted">Subtitle / Cut Details</label>
                            <input type="text" name="hero_slide_4_sub" value="{{ $settings['hero_slide_4_sub'] ?? 'Prime dry-aged whole beef slab' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-brand-muted">Button Link</label>
                            <input type="text" name="hero_slide_4_link" value="{{ $settings['hero_slide_4_link'] ?? '/shop' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>
                    </div>

                </div>
            </div>

            <!-- 3. Homepage Headlines & Announcements -->
            <div class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-6 shadow-xl">
                <div class="flex items-center gap-3 pb-3 border-b border-brand-border/60">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-red"></span>
                    <h3 class="font-editorial text-xl font-bold text-brand-cream">3. Homepage Headlines & Typography</h3>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Top Announcement Bar Text</label>
                    <input type="text" name="announcement_bar" value="{{ $settings['announcement_bar'] ?? '🚚 Free Dar es Salaam delivery on orders over TZS 50,000 | Direct WhatsApp Ordering Available' }}"
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Hero Top Tag / Badge</label>
                        <input type="text" name="hero_badge" value="{{ $settings['hero_badge'] ?? 'GOOD FOOD, GOOD MOOD' }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Hero Main Headline</label>
                        <input type="text" name="hero_headline" value="{{ $settings['hero_headline'] ?? 'REAL BEEF. REAL FLAVOUR.' }}" required
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Hero Subtitle & Craft Story</label>
                    <textarea name="hero_subheadline" rows="2"
                              class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">{{ $settings['hero_subheadline'] ?? 'Handcrafted in Buguruni Malapa, Dar es Salaam. Discover 100% pasture-grazed Tanzanian beef cured with skillet-toasted coriander and natural air drying. Tender, savoury, authentic.' }}</textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Customer Social Proof Text</label>
                    <input type="text" name="social_proof_count" value="{{ $settings['social_proof_count'] ?? '1,500+ Happy Food Lovers in Dar es Salaam' }}"
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>
            </div>

            <!-- 4. Four Feature Badges Strip -->
            <div class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-6 shadow-xl">
                <div class="flex items-center gap-3 pb-3 border-b border-brand-border/60">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-red"></span>
                    <h3 class="font-editorial text-xl font-bold text-brand-cream">4. Homepage 4 Feature Badges Strip</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="p-4 rounded-xl bg-brand-dark/70 border border-brand-border space-y-2">
                        <span class="text-[10px] font-bold text-brand-red uppercase">Badge 1: Delivery</span>
                        <input type="text" name="badge_1_title" value="{{ $settings['badge_1_title'] ?? 'Free Delivery' }}" placeholder="Title"
                               class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        <input type="text" name="badge_1_sub" value="{{ $settings['badge_1_sub'] ?? 'On orders over TZS 50,000' }}" placeholder="Subtitle"
                               class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-[11px] text-brand-muted focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="p-4 rounded-xl bg-brand-dark/70 border border-brand-border space-y-2">
                        <span class="text-[10px] font-bold text-emerald-400 uppercase">Badge 2: Quality & Halal</span>
                        <input type="text" name="badge_2_title" value="{{ $settings['badge_2_title'] ?? '100% Halal & Pure' }}" placeholder="Title"
                               class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        <input type="text" name="badge_2_sub" value="{{ $settings['badge_2_sub'] ?? 'Zero nitrates & no MSG' }}" placeholder="Subtitle"
                               class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-[11px] text-brand-muted focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="p-4 rounded-xl bg-brand-dark/70 border border-brand-border space-y-2">
                        <span class="text-[10px] font-bold text-blue-400 uppercase">Badge 3: Payment</span>
                        <input type="text" name="badge_3_title" value="{{ $settings['badge_3_title'] ?? 'Secure Payment' }}" placeholder="Title"
                               class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        <input type="text" name="badge_3_sub" value="{{ $settings['badge_3_sub'] ?? 'M-Pesa, Tigo, Airtel, Halopesa' }}" placeholder="Subtitle"
                               class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-[11px] text-brand-muted focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="p-4 rounded-xl bg-brand-dark/70 border border-brand-border space-y-2">
                        <span class="text-[10px] font-bold text-purple-400 uppercase">Badge 4: Support</span>
                        <input type="text" name="badge_4_title" value="{{ $settings['badge_4_title'] ?? '24/7 Support' }}" placeholder="Title"
                               class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        <input type="text" name="badge_4_sub" value="{{ $settings['badge_4_sub'] ?? '+255 682 869 629' }}" placeholder="Subtitle"
                               class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-[11px] text-brand-muted focus:border-brand-red focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- 5. Dual Promotional Banners & Sidebar Promo -->
            <div class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-6 shadow-xl">
                <div class="flex items-center gap-3 pb-3 border-b border-brand-border/60">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-red"></span>
                    <h3 class="font-editorial text-xl font-bold text-brand-cream">5. Promotional Banners & Left Sidebar Card</h3>
                </div>

                <!-- Left Sidebar Special Promo Image -->
                <div class="p-5 rounded-2xl bg-brand-dark/70 border border-brand-border space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-brand-cream uppercase">Left Sidebar "Special Promo" Circular Image</span>
                        @php $sideImg = $settings['sidebar_promo_image'] ?? 'images/bbq-biltong.jpg'; @endphp
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-brand-red shadow flex-shrink-0 bg-brand-dark">
                            <img src="{{ asset($sideImg) }}" alt="Sidebar Promo" class="w-full h-full object-cover">
                        </div>
                        <div class="space-y-1 flex-1">
                            <label class="block text-xs text-brand-cream font-medium">Upload New Sidebar Promo Photo</label>
                            <input type="file" name="sidebar_promo_image" accept="image/*"
                                   class="w-full text-xs text-brand-muted file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-red file:text-white hover:file:bg-brand-red-dark cursor-pointer">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Promo 1 -->
                    <div class="p-5 rounded-xl bg-brand-dark/70 border border-brand-border space-y-3">
                        <span class="text-xs font-bold text-brand-red uppercase">Promo Banner 1</span>
                        <div class="space-y-1">
                            <label class="block text-[11px] text-brand-muted">Tag</label>
                            <input type="text" name="promo_1_tag" value="{{ $settings['promo_1_tag'] ?? 'Limited Time Offer' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[11px] text-brand-muted">Headline</label>
                            <input type="text" name="promo_1_title" value="{{ $settings['promo_1_title'] ?? 'Flat 10% OFF On Your First Order!' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[11px] text-brand-muted">Discount Coupon Code</label>
                            <input type="text" name="promo_1_code" value="{{ $settings['promo_1_code'] ?? 'INAS10' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[11px] text-brand-muted">Description</label>
                            <textarea name="promo_1_desc" rows="2"
                                      class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">{{ $settings['promo_1_desc'] ?? 'Use code INAS10 at checkout and enjoy real artisanal biltong.' }}</textarea>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[11px] text-brand-muted">Target Link</label>
                            <input type="text" name="promo_1_link" value="{{ $settings['promo_1_link'] ?? '/shop' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>
                    </div>

                    <!-- Promo 2 -->
                    <div class="p-5 rounded-xl bg-brand-dark/70 border border-brand-border space-y-3">
                        <span class="text-xs font-bold text-amber-400 uppercase">Promo Banner 2</span>
                        <div class="space-y-1">
                            <label class="block text-[11px] text-brand-muted">Tag</label>
                            <input type="text" name="promo_2_tag" value="{{ $settings['promo_2_tag'] ?? 'Weekend Special' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[11px] text-brand-muted">Headline</label>
                            <input type="text" name="promo_2_title" value="{{ $settings['promo_2_title'] ?? 'Family & Party Combo Packs' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[11px] text-brand-muted">Description</label>
                            <textarea name="promo_2_desc" rows="2"
                                      class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">{{ $settings['promo_2_desc'] ?? 'Feed your gathering or stock your bar with our 10-pack cartons.' }}</textarea>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[11px] text-brand-muted">Target Link</label>
                            <input type="text" name="promo_2_link" value="{{ $settings['promo_2_link'] ?? '/wholesale' }}"
                                   class="w-full px-3 py-2 rounded-lg bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. Delivery Rates & Free Thresholds -->
            <div class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-6 shadow-xl">
                <div class="flex items-center gap-3 pb-3 border-b border-brand-border/60">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-red"></span>
                    <h3 class="font-editorial text-xl font-bold text-brand-cream">6. Delivery Fees & Free Delivery Thresholds</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Dar es Salaam Delivery Fee (TZS)</label>
                        <input type="number" name="dar_delivery_fee" value="{{ $settings['dar_delivery_fee'] ?? 5000 }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Free Delivery Threshold (TZS)</label>
                        <input type="number" name="free_delivery_threshold" value="{{ $settings['free_delivery_threshold'] ?? 50000 }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Upcountry Courier Fee (TZS)</label>
                        <input type="number" name="upcountry_delivery_fee" value="{{ $settings['upcountry_delivery_fee'] ?? 12000 }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- 7. Tanzanian Mobile Money & Lipa Namba Details -->
            <div class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-6 shadow-xl">
                <div class="flex items-center gap-3 pb-3 border-b border-brand-border/60">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-red"></span>
                    <h3 class="font-editorial text-xl font-bold text-brand-cream">7. Storefront Mobile Money & Lipa Namba Numbers</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Vodacom M-Pesa Lipa Namba / Till</label>
                        <input type="text" name="mpesa_till" value="{{ $settings['mpesa_till'] ?? '5544321 - INAS COMPANY' }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Tigo Pesa Lipa Namba</label>
                        <input type="text" name="tigopesa_till" value="{{ $settings['tigopesa_till'] ?? '6677889 - INAS BILTONG' }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Airtel Money Lipa Namba</label>
                        <input type="text" name="airtel_till" value="{{ $settings['airtel_till'] ?? '3322110 - INAS BILTONG' }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Halopesa Lipa Namba</label>
                        <input type="text" name="halopesa_till" value="{{ $settings['halopesa_till'] ?? '8899001 - INAS BILTONG' }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Bank Transfer Account Details</label>
                    <input type="text" name="bank_details" value="{{ $settings['bank_details'] ?? 'CRDB Bank • Account: 0150829384900 • Name: INAS Company Limited' }}"
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>
            </div>

            <!-- 8. Social Media Handles & SEO Meta -->
            <div class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-6 shadow-xl">
                <div class="flex items-center gap-3 pb-3 border-b border-brand-border/60">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-red"></span>
                    <h3 class="font-editorial text-xl font-bold text-brand-cream">8. Social Media Channels & SEO Meta</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Instagram Handle</label>
                        <input type="text" name="instagram_handle" value="{{ $settings['instagram_handle'] ?? '@inas_biltong_tz' }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Facebook Page URL</label>
                        <input type="text" name="facebook_url" value="{{ $settings['facebook_url'] ?? 'https://facebook.com/inasbiltong' }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">TikTok Handle</label>
                        <input type="text" name="tiktok_handle" value="{{ $settings['tiktok_handle'] ?? '@inas_biltong' }}"
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">SEO Search Description</label>
                    <textarea name="meta_description" rows="2"
                              class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">{{ $settings['meta_description'] ?? 'Handcrafted premium beef biltong from Buguruni Malapa, Dar es Salaam. 100% pasture-grazed Tanzanian beef cured with skillet-toasted coriander and natural air drying.' }}</textarea>
                </div>
            </div>

            <!-- Save Button Sticky Bar -->
            <div class="flex items-center justify-between p-6 rounded-2xl bg-brand-card border border-brand-border sticky bottom-4 shadow-2xl z-20">
                <span class="text-xs text-brand-muted">All uploaded images and headlines apply instantly to your live homepage.</span>
                <button type="submit" class="px-8 py-4 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-sm uppercase tracking-wider hover:shadow-xl transition cursor-pointer">
                    Save All Settings & Images
                </button>
            </div>
        </form>

    </div>

@endsection
