@extends('layouts.admin')

@section('title', 'Kitchen & System Settings')

@section('content')

<div class="max-w-5xl space-y-8">
    
    <div>
        <h2 class="text-2xl font-black text-white">Burger House System & Store Configuration</h2>
        <span class="text-xs text-stone-400">Control kitchen contact info, operating hours, delivery fees, payment merchant numbers, and WhatsApp ordering hotline.</span>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- 0. Brand Logo & Favicon Upload (Classic Modified Border) -->
        <div class="p-8 rounded-3xl bg-[#1C1C1C] border-2 border-[#2A2A2A] space-y-6 shadow-sm">
            <div class="flex items-center justify-between pb-3 border-b border-[#2A2A2A]">
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-[#E52E2E] border border-red-400"></span>
                    <h3 class="text-lg font-bold text-white">Brand Logo & Visual Identity</h3>
                </div>
                <span class="text-xs text-[#E52E2E] font-bold">Storefront & Admin Logo</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                <!-- Current Logo Preview -->
                <div class="md:col-span-4 flex flex-col items-center justify-center p-6 rounded-2xl bg-[#141414] border-2 border-[#2A2A2A]">
                    <span class="text-[10px] uppercase font-bold text-stone-400 mb-3 tracking-wider">Current Logo Preview</span>
                    @php $currentLogo = $settings['site_logo'] ?? null; @endphp
                    @if($currentLogo && file_exists(public_path($currentLogo)))
                        <div class="p-4 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center min-h-[90px] w-full">
                            <img src="{{ asset($currentLogo) }}" alt="Burger House Logo" class="max-h-16 max-w-full object-contain">
                        </div>
                        <label class="mt-3 flex items-center gap-2 text-xs text-red-400 cursor-pointer hover:text-red-300">
                            <input type="checkbox" name="remove_logo" value="1" class="rounded border-red-500 text-red-500">
                            <span>Remove / Reset to default icon</span>
                        </label>
                    @else
                        <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-[#DC2626] to-[#EF4444] flex items-center justify-center text-white shadow-lg border-2 border-white/30">
                            <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4c-4.418 0-8 2.239-8 5v1h16V9c0-2.761-3.582-5-8-5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 14h16v1c0 2.761-3.582 5-8 5s-8-2.239-8-5v-1z" />
                                <line x1="3" y1="12" x2="21" y2="12" stroke-linecap="round" />
                            </svg>
                        </div>
                        <span class="text-[11px] text-stone-500 mt-2">Using Default Burger Badge</span>
                    @endif
                </div>

                <!-- Logo & Favicon Upload Inputs -->
                <div class="md:col-span-8 space-y-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300">
                            Upload Brand Logo (PNG, SVG, JPG, WebP)
                        </label>
                        <input type="file" 
                               name="site_logo" 
                               accept="image/png,image/jpeg,image/svg+xml,image/webp"
                               class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-stone-300 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#E52E2E] file:text-white hover:file:bg-[#C61A1A] cursor-pointer focus:outline-none focus:border-[#E52E2E]">
                        <p class="text-[11px] text-stone-400">
                            Transparent PNG or SVG is recommended (optimal height ~80px to 120px). This logo will appear on the storefront header pill, footer, and admin portal.
                        </p>
                    </div>

                    <div class="space-y-1.5 pt-2 border-t border-[#2A2A2A]">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-300">
                            Upload Favicon Icon (Optional)
                        </label>
                        <input type="file" 
                               name="site_favicon" 
                               accept="image/png,image/x-icon,image/svg+xml"
                               class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-stone-300 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#2A2A2A] file:text-stone-200 hover:file:bg-[#333333] cursor-pointer focus:outline-none focus:border-[#E52E2E]">
                    </div>
                </div>
            </div>
        </div>

        <!-- 1. Company & Contact Information with Classic Modified Border -->
        <div class="p-8 rounded-3xl bg-[#1C1C1C] border-2 border-[#2A2A2A] space-y-6 shadow-sm">
            <div class="flex items-center gap-3 pb-3 border-b border-[#2A2A2A]">
                <span class="w-3 h-3 rounded-full bg-[#E52E2E] border border-red-400"></span>
                <h3 class="text-lg font-bold text-white">1. Kitchen & Storefront Contact Details</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Brand Name</label>
                    <input type="text" name="company_name" value="{{ $settings['company_name'] ?? 'BURGER HOUSE' }}" required
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Kitchen Location</label>
                    <input type="text" name="company_location" value="{{ $settings['company_location'] ?? 'Dar es Salaam, Tanzania' }}" required
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Phone Hotline</label>
                    <input type="text" name="company_phone" value="{{ $settings['company_phone'] ?? '(555) 123-4567' }}" required
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">WhatsApp (Order Hotline)</label>
                    <input type="text" name="company_whatsapp" value="{{ $settings['company_whatsapp'] ?? '255768123456' }}" required
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Official Email</label>
                    <input type="email" name="company_email" value="{{ $settings['company_email'] ?? 'contact@burgerhouse.com' }}" required
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Operating Hours</label>
                    <input type="text" name="operating_hours" value="{{ $settings['operating_hours'] ?? 'Monday - Sunday: 10:00 AM - 11:00 PM' }}"
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Announcement Bar Text</label>
                    <input type="text" name="announcement_bar" value="{{ $settings['announcement_bar'] ?? '🍔 FREE Delivery on all orders over $20 | Hot Combos Prepared Fresh' }}"
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>
            </div>
        </div>

        <!-- 2. Delivery Rates & Currency with Classic Modified Border -->
        <div class="p-8 rounded-3xl bg-[#1C1C1C] border-2 border-[#2A2A2A] space-y-6 shadow-sm">
            <div class="flex items-center gap-3 pb-3 border-b border-[#2A2A2A]">
                <span class="w-3 h-3 rounded-full bg-[#E52E2E] border border-red-400"></span>
                <h3 class="text-lg font-bold text-white">2. Delivery Charges & Free Threshold</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Standard Delivery Fee ($ / TZS)</label>
                    <input type="number" name="dar_delivery_fee" value="{{ $settings['dar_delivery_fee'] ?? '2.50' }}" step="0.01" required
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Express Delivery Fee</label>
                    <input type="number" name="upcountry_delivery_fee" value="{{ $settings['upcountry_delivery_fee'] ?? '4.50' }}" step="0.01" required
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Free Delivery Minimum Order</label>
                    <input type="number" name="free_delivery_threshold" value="{{ $settings['free_delivery_threshold'] ?? '20' }}" step="0.01" required
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>
            </div>
        </div>

        <!-- 3. Payment Integration Details with Classic Modified Border -->
        <div class="p-8 rounded-3xl bg-[#1C1C1C] border-2 border-[#2A2A2A] space-y-6 shadow-sm">
            <div class="flex items-center gap-3 pb-3 border-b border-[#2A2A2A]">
                <span class="w-3 h-3 rounded-full bg-[#E52E2E] border border-red-400"></span>
                <h3 class="text-lg font-bold text-white">3. Payment Merchant & Till Numbers</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">M-Pesa Merchant / Till Number</label>
                    <input type="text" name="mpesa_till_number" value="{{ $settings['mpesa_till_number'] ?? '5821940' }}"
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Tigo Pesa / Airtel Till Number</label>
                    <input type="text" name="airtel_pay_number" value="{{ $settings['airtel_pay_number'] ?? '7192301' }}"
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>
            </div>
        </div>

        <!-- 4. Social Media Showcase & Gallery Photos -->
        <div class="p-8 rounded-3xl bg-[#1C1C1C] border-2 border-[#2A2A2A] space-y-6 shadow-sm">
            <div class="flex items-center justify-between pb-3 border-b border-[#2A2A2A]">
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-[#E52E2E] border border-red-400"></span>
                    <h3 class="text-lg font-bold text-white">4. Social Media Section & Gallery Images</h3>
                </div>
                <span class="text-xs text-[#E52E2E] font-bold">Homepage Section & Social Feeds</span>
            </div>

            <!-- Section Headings -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Section Title</label>
                    <input type="text" name="social_section_title" value="{{ $settings['social_section_title'] ?? 'Social Media' }}" required
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Section Subtitle</label>
                    <input type="text" name="social_section_subtitle" value="{{ $settings['social_section_subtitle'] ?? 'Follow us for updates and more!' }}" required
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>
            </div>

            <!-- 4 Social Gallery Photos -->
            <div class="space-y-3 pt-2">
                <span class="block text-xs font-semibold uppercase tracking-wider text-stone-300">
                    Gallery Photos (4 Images Displayed on Homepage)
                </span>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @for($i = 1; $i <= 4; $i++)
                        @php 
                            $imgKey = "social_img_{$i}";
                            $defaultImg = "images/burger-house/social-{$i}.jpg";
                            $currentImg = $settings[$imgKey] ?? $defaultImg;
                        @endphp
                        <div class="p-4 rounded-2xl bg-[#141414] border-2 border-[#2A2A2A] space-y-3">
                            <span class="text-[11px] font-bold text-[#E52E2E]">Photo {{ $i }}</span>
                            <div class="aspect-4/3 rounded-xl overflow-hidden bg-black/40 border border-[#2A2A2A]">
                                <img src="{{ asset($currentImg) }}" alt="Social image {{ $i }}" class="w-full h-full object-cover">
                            </div>
                            <input type="file" 
                                   name="{{ $imgKey }}" 
                                   accept="image/*"
                                   class="w-full text-[11px] text-stone-400 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-[#E52E2E] file:text-white hover:file:bg-[#C61A1A] cursor-pointer">
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Social Media Profile Links -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-3 border-t border-[#2A2A2A]">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Facebook URL</label>
                    <input type="url" name="facebook_url" value="{{ $settings['facebook_url'] ?? 'https://facebook.com' }}"
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ $settings['instagram_url'] ?? 'https://instagram.com' }}"
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Twitter / X URL</label>
                    <input type="url" name="twitter_url" value="{{ $settings['twitter_url'] ?? 'https://twitter.com' }}"
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>
            </div>
        </div>

        <!-- 5. Footer Content & App Store Badges -->
        <div class="p-8 rounded-3xl bg-[#1C1C1C] border-2 border-[#2A2A2A] space-y-6 shadow-sm">
            <div class="flex items-center justify-between pb-3 border-b border-[#2A2A2A]">
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-[#E52E2E] border border-red-400"></span>
                    <h3 class="text-lg font-bold text-white">5. Footer Section & Developer Credit</h3>
                </div>
                <span class="text-xs text-[#E52E2E] font-bold">Bottom Storefront Bar</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Newsletter Headline</label>
                    <input type="text" name="footer_newsletter_title" value="{{ $settings['footer_newsletter_title'] ?? 'Subscribe to our newsletter' }}" required
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Google Play Store URL</label>
                    <input type="url" name="google_play_url" value="{{ $settings['google_play_url'] ?? 'https://play.google.com' }}"
                           class="w-full px-4 py-3 rounded-xl bg-[#141414] border-2 border-[#2A2A2A] text-xs text-white focus:outline-none focus:border-[#E52E2E]">
                </div>
            </div>

            <div class="p-4 rounded-2xl bg-[#141414] border-2 border-[#2A2A2A] flex items-center justify-between">
                <div>
                    <h4 class="text-xs font-bold text-white uppercase tracking-wider">Website Developer Credit</h4>
                    <p class="text-[11px] text-stone-400 mt-0.5">Designed & Developed by Reliance Solutions (<a href="https://reliancesolutions.co.tz" target="_blank" class="text-[#E52E2E] underline font-medium">reliancesolutions.co.tz</a>)</p>
                </div>
                <span class="px-3 py-1 rounded-lg bg-emerald-500/10 text-emerald-400 text-[10px] font-bold border border-emerald-500/30">Active</span>
            </div>
        </div>

        <button type="submit" class="px-8 py-4 bg-[#E52E2E] hover:bg-[#C61A1A] text-white rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-lg shadow-red-500/25 border-2 border-white/30">
            SAVE ALL SETTINGS
        </button>
    </form>

</div>

@endsection
