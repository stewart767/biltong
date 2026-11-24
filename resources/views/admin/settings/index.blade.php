@extends('layouts.admin')

@section('title', 'Website & Business Settings')
@section('page_title', 'Brand & Website Settings')

@section('content')

    <div class="max-w-4xl space-y-6">
        
        <div>
            <h2 class="font-editorial text-2xl font-bold text-brand-cream">INAS Business & Website Configuration</h2>
            <span class="text-xs text-brand-muted">Manage business address, hotline numbers, homepage editorial headlines, delivery fees and SEO settings</span>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
            @csrf

            <!-- 1. Business & Contact Information -->
            <div class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-6 shadow-lg">
                <div class="flex items-center gap-3 pb-3 border-b border-brand-border/60">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-red"></span>
                    <h3 class="font-editorial text-xl font-bold text-brand-cream">Company & Location Information</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Registered Company Name</label>
                        <input type="text" name="company_name" value="{{ $settings['company_name'] ?? 'INAS Company Limited' }}" required
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Location & Physical Facility</label>
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
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">WhatsApp Hotline Number (Digits)</label>
                        <input type="text" name="company_whatsapp" value="{{ $settings['company_whatsapp'] ?? '255682869629' }}" required
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Public Contact Email</label>
                        <input type="email" name="company_email" value="{{ $settings['company_email'] ?? 'sales@inasbiltong.co.tz' }}" required
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Operating & Butchery Hours</label>
                    <input type="text" name="operating_hours" value="{{ $settings['operating_hours'] ?? 'Monday - Saturday: 8:00 AM - 6:30 PM (EAT)' }}"
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>
            </div>

            <!-- 2. Homepage Editorial & Banners -->
            <div class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-6 shadow-lg">
                <div class="flex items-center gap-3 pb-3 border-b border-brand-border/60">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-red"></span>
                    <h3 class="font-editorial text-xl font-bold text-brand-cream">Homepage Editorial & Banners</h3>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Top Announcement Bar Text</label>
                    <input type="text" name="announcement_bar" value="{{ $settings['announcement_bar'] ?? '🚚 Free Dar es Salaam delivery on orders over TZS 50,000 | Direct WhatsApp Ordering Available' }}"
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Hero Headline</label>
                    <input type="text" name="hero_headline" value="{{ $settings['hero_headline'] ?? 'REAL BEEF. REAL FLAVOUR.' }}" required
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Hero Sub-Headline</label>
                    <textarea name="hero_subheadline" rows="2"
                              class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">{{ $settings['hero_subheadline'] ?? 'Handcrafted in Buguruni Malapa from 100% pasture-grazed Tanzanian beef, toasted coriander, cracked black pepper and artisanal natural air drying.' }}</textarea>
                </div>
            </div>

            <!-- 3. Delivery Rates -->
            <div class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-6 shadow-lg">
                <div class="flex items-center gap-3 pb-3 border-b border-brand-border/60">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-red"></span>
                    <h3 class="font-editorial text-xl font-bold text-brand-cream">Delivery Charges & Thresholds</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Dar Delivery Fee (TZS)</label>
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

            <!-- Save Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-8 py-4 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-sm font-bold uppercase tracking-wider hover:shadow-xl transition">
                    Save Website Settings
                </button>
            </div>
        </form>

    </div>

@endsection
