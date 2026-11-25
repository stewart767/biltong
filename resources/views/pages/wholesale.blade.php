@extends('layouts.app')

@section('title', 'Wholesale & B2B Distribution | INAS Premium Beef Biltong | Dar es Salaam')
@section('meta_description', 'Wholesale beef biltong supply for Tanzanian supermarkets, safari camps, luxury hotels, and gyms. Direct supply from Buguruni Malapa, Dar es Salaam.')

@section('content')

    <!-- Wholesale Hero Header -->
    <section class="py-16 bg-brand-charcoal border-b border-brand-border text-center relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 space-y-3 relative z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-red-600/20 text-red-600 border border-red-600/30">
                <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                Commercial Supply & Distribution
            </span>
            <h1 class="font-editorial text-4xl sm:text-6xl font-bold text-white tracking-wide">
                Partner with INAS Biltong
            </h1>
            <p class="text-zinc-300 text-base sm:text-lg max-w-2xl mx-auto">
                Stock Tanzania’s premier artisanal dried beef snacks in your supermarket, safari camp, gym, or hotel minibar.
            </p>
        </div>
    </section>

    <!-- Wholesale Content Grid -->
    <section class="py-16 bg-zinc-100 text-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            <!-- Industry Sectors Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Sector 1 -->
                <div class="p-8 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-4 hover:border-red-600 transition">
                    <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-600 border border-red-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="font-editorial text-xl font-bold text-zinc-900">Supermarkets & Retailers</h3>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        Retail-ready 100g shelf pouches with registered barcoding, tamper-evident seals, and high-impact POS display cartons. Outstanding shelf appeal and fast inventory turnover.
                    </p>
                </div>

                <!-- Sector 2 -->
                <div class="p-8 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-4 hover:border-red-600 transition">
                    <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-600 border border-red-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-editorial text-xl font-bold text-zinc-900">Safari Lodges & Hospitality</h3>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        The ultimate high-end safari snack for game drives in Serengeti, Ngorongoro, Tarangire, and Selous. Also suitable for luxury hotel minibars and cocktail sundowners.
                    </p>
                </div>

                <!-- Sector 3 -->
                <div class="p-8 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-4 hover:border-red-600 transition">
                    <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-600 border border-red-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="font-editorial text-xl font-bold text-zinc-900">Gyms & Fitness Centres</h3>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        52g of clean, complete animal protein per 100g. A clean post-workout snack for crossfit boxes, martial arts clubs, and wellness smoothie counters.
                    </p>
                </div>
            </div>

            <!-- Wholesale Value Propositions -->
            <div class="p-8 sm:p-12 rounded-3xl bg-brand-charcoal text-white border border-brand-border space-y-8">
                <div class="max-w-2xl space-y-2">
                    <span class="text-xs uppercase tracking-widest text-red-600 font-bold">B2B Advantages</span>
                    <h2 class="font-editorial text-2xl sm:text-4xl font-bold text-white">Why Distribute INAS Biltong?</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-xs text-zinc-300">
                    <div class="space-y-2 border-l-2 border-red-600 pl-4">
                        <span class="block font-bold text-white text-sm">Competitive Margins</span>
                        <p class="text-zinc-400">Generous wholesale pricing tiers designed to reward volume distributors and retailers.</p>
                    </div>
                    <div class="space-y-2 border-l-2 border-red-600 pl-4">
                        <span class="block font-bold text-white text-sm">Consistent Quality</span>
                        <p class="text-zinc-400">Calibrated climate rooms in Buguruni Malapa ensure identical curing and taste year-round.</p>
                    </div>
                    <div class="space-y-2 border-l-2 border-red-600 pl-4">
                        <span class="block font-bold text-white text-sm">Tanzania-Wide Dispatch</span>
                        <p class="text-zinc-400">Same-day freight in Dar es Salaam; daily regional air and bus cargo to Arusha, Mwanza, Zanzibar.</p>
                    </div>
                    <div class="space-y-2 border-l-2 border-red-600 pl-4">
                        <span class="block font-bold text-white text-sm">Full Certification</span>
                        <p class="text-zinc-400">100% Halal certified slaughter and compliance with Tanzania Bureau of Standards guidelines.</p>
                    </div>
                </div>
            </div>

            <!-- Wholesale Enquiry Form Section -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start" id="enquiry-form">
                
                <!-- Left: Info & Contact Callout -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="p-8 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-6">
                        <span class="text-xs uppercase tracking-widest text-red-600 font-bold">Direct B2B Desk</span>
                        <h3 class="font-editorial text-3xl font-bold text-zinc-900">
                            Request Wholesale Pricing & Samples
                        </h3>
                        <p class="text-sm text-zinc-600 leading-relaxed">
                            Submit your business details and our wholesale commercial manager will review your inquiry within 2 business hours with our complete wholesale tier catalog.
                        </p>

                        <div class="space-y-4 pt-4 border-t border-zinc-100 text-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-red-600 border border-red-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <div>
                                    <span class="block text-zinc-500">Hotline / WhatsApp</span>
                                    <a href="tel:+255682869629" class="font-bold text-zinc-900 hover:text-red-600">+255 682 869 629</a>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-red-600 border border-red-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                </div>
                                <div>
                                    <span class="block text-zinc-500">Dispatch Facility</span>
                                    <span class="font-bold text-zinc-900">Buguruni Malapa, Dar es Salaam</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a href="https://wa.me/255682869629?text=Hello%20INAS!%20We%20would%20like%20to%20inquire%20about%20Wholesale%20Distribution%20for%20our%20business." 
                               target="_blank" 
                               class="w-full flex items-center justify-center gap-2 py-3.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition shadow-md">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                <span>Fast-Track via WhatsApp (+255 682 869 629)</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right: Enquiry Form -->
                <div class="lg:col-span-7">
                    <div class="p-8 sm:p-10 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-6">
                        
                        <div class="space-y-1">
                            <h3 class="font-editorial text-2xl font-bold text-zinc-900">Wholesale Application</h3>
                            <p class="text-xs text-zinc-500">Please provide complete business information to help us prepare your quote.</p>
                        </div>

                        @if(session('wholesale_success'))
                            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-sm">
                                {{ session('wholesale_success') }}
                            </div>
                        @endif

                        <form action="{{ route('wholesale.store') }}" method="POST" class="space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Business / Company Name *</label>
                                    <input type="text" name="company_name" required value="{{ old('company_name') }}" placeholder="e.g. Serengeti Safari Camps Ltd"
                                           class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                                    @error('company_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-1">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Contact Person *</label>
                                    <input type="text" name="contact_name" required value="{{ old('contact_name') }}" placeholder="e.g. David Mrema"
                                           class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                                    @error('contact_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Phone / WhatsApp Number *</label>
                                    <input type="tel" name="phone" required value="{{ old('phone') }}" placeholder="e.g. +255 754 000 000"
                                           class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                                    @error('phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-1">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Email Address *</label>
                                    <input type="email" name="email" required value="{{ old('email') }}" placeholder="e.g. procurement@serengeti.co.tz"
                                           class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                                    @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Business Type *</label>
                                    <select name="business_type" required class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                                        <option value="Supermarkets & Retailers">Supermarkets & Retailers</option>
                                        <option value="Safari Camp / Lodge">Safari Camp / Lodge</option>
                                        <option value="Hotel / Resort">Hotel / Resort</option>
                                        <option value="Gym / Fitness Club">Gym / Fitness Club</option>
                                        <option value="Bar / Lounge">Bar / Lounge</option>
                                        <option value="Regional Distributor">Regional Distributor</option>
                                        <option value="Export / International">Export / International</option>
                                    </select>
                                </div>

                                <div class="space-y-1">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Estimated Monthly Volume *</label>
                                    <select name="estimated_monthly_volume" required class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                                        <option value="50 - 200 packs / month">50 - 200 packs / month (Starter)</option>
                                        <option value="200 - 500 packs / month">200 - 500 packs / month (Medium)</option>
                                        <option value="500 - 2,000 packs / month">500 - 2,000 packs / month (Large)</option>
                                        <option value="2,000+ packs / month">2,000+ packs / month (Major Distributor)</option>
                                        <option value="Bulk Slabs (10kg+ unsliced)">Bulk Slabs (10kg+ unsliced)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">City / Location *</label>
                                <input type="text" name="city" required value="{{ old('city') }}" placeholder="e.g. Dar es Salaam, Arusha, Zanzibar, Mwanza"
                                       class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                            </div>

                            <div class="space-y-1">
                                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Additional Requirements / Notes</label>
                                <textarea name="message" rows="3" placeholder="Tell us about your distribution channels, retail outlets, or specific packaging needs..."
                                          class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" 
                                    class="w-full py-4 rounded-xl bg-red-600 hover:bg-red-600-dark text-white font-bold text-sm shadow-md hover:shadow-lg transition flex items-center justify-center gap-2 cursor-pointer">
                                <span>Submit Wholesale Application</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection
