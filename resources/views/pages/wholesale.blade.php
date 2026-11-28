@extends('layouts.app')

@section('title', 'Wholesale & Distribution Channels | Biltong East Africa Corporation (BEAC)')
@section('meta_description', 'Wholesale beef biltong supply for supermarkets, specialty food stores, restaurants, Duka Direct, safari lodges, airlines, SGR, and gyms.')

@section('content')

    <!-- Wholesale Hero Header (Red, White & Cream) -->
    <section class="rounded-[32px] bg-gradient-to-br from-[#FAF5EE] via-white to-[#F6E4DE]/60 border border-[#E8DDD0] p-8 sm:p-12 lg:p-14 text-center space-y-4 shadow-sm">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider bg-red-600 text-white shadow-xs">
            BEAC Commercial Supply &amp; Distribution
        </span>
        <h1 class="text-3xl sm:text-5xl font-black text-zinc-900 tracking-tight">
            Partner with INAS Biltong <span class="text-red-600">(BEAC)</span>
        </h1>
        <p class="text-zinc-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            Stock East Africa's premier air-cured beef biltong in supermarkets, specialty food stores, safari lodges, gyms, liquor stores, and travel networks.
        </p>
    </section>

    <!-- How We Sell Our Biltong: Distribution Channels (Page 7 of BEAC Profile) -->
    <section class="mt-10 bg-white rounded-[32px] border border-[#E8DDD0] p-8 sm:p-10 shadow-sm space-y-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <span class="text-xs uppercase tracking-widest text-red-600 font-black">How We Sell Our Biltong</span>
                <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 mt-1">Distribution Channels &amp; Partnerships</h2>
            </div>
            <span class="text-xs font-bold text-zinc-500">Biltong.co.tz &bull; DUKA DIRECT &bull; Showroom</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <div class="p-6 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <h3 class="font-extrabold text-base text-zinc-900">Supermarkets &amp; Retailers</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Readily available in supermarkets, specialty food stores, health food stores, and restaurants across Tanzania.</p>
            </div>
            <div class="p-6 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <h3 class="font-extrabold text-base text-zinc-900">Online &amp; Direct Showroom</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Available on Biltong.co.tz, DUKA DIRECT, and direct sales from our Buguruni Malapa Showroom.</p>
            </div>
            <div class="p-6 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <h3 class="font-extrabold text-base text-zinc-900">Events, Bars &amp; Fitness</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Featured at Saba Saba and Nane Nane exhibitions, liquor stores, bars &amp; pubs, fitness centers, and sports events.</p>
            </div>
            <div class="p-6 rounded-2xl bg-[#FFF5F5] border border-red-200 space-y-2">
                <h3 class="font-extrabold text-base text-red-600">Safari Lodges &amp; Hospitality</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Ideal high-protein safari snack for game drives in Serengeti, Ngorongoro, Tarangire, and hotel minibars.</p>
            </div>
            <div class="p-6 rounded-2xl bg-[#FFF5F5] border border-red-200 space-y-2">
                <h3 class="font-extrabold text-base text-red-600">Travel &amp; Transit Networks</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Expanding strategic partnerships for SGR (TRC), Air Tanzania, and Precision Air passengers.</p>
            </div>
            <div class="p-6 rounded-2xl bg-[#FFF5F5] border border-red-200 space-y-2">
                <h3 class="font-extrabold text-base text-red-600">Marketing &amp; Collaborations</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Backed by influencer partnerships (Shilole, Official Nai, Mpoki, Mwijaku) and active social media campaigns.</p>
            </div>
        </div>
    </section>

    <!-- Wholesale Enquiry Form Section -->
    <section class="mt-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start" id="enquiry-form">
        
        <!-- Left: Info & Contact Callout -->
        <div class="lg:col-span-5 space-y-6">
            <div class="p-8 rounded-[32px] bg-red-600 text-white shadow-md space-y-6">
                <span class="text-xs uppercase tracking-widest text-red-100 font-black">Direct B2B Desk</span>
                <h2 class="text-2xl sm:text-3xl font-black text-white">
                    Request Wholesale Pricing &amp; Samples
                </h2>
                <p class="text-sm text-red-50 leading-relaxed">
                    Submit your business details and our BEAC commercial team will respond within 2 business hours with our wholesale tier catalog.
                </p>

                <div class="space-y-4 pt-4 border-t border-white/20 text-xs">
                    <div>
                        <span class="block text-red-100">Hotline / WhatsApp</span>
                        <a href="tel:+255749901907" class="font-extrabold text-white text-sm hover:underline">+255 749 901 907</a>
                    </div>
                    <div>
                        <span class="block text-red-100">Official Email</span>
                        <a href="mailto:info@biltong.co.tz" class="font-extrabold text-white text-sm hover:underline">info@biltong.co.tz</a>
                    </div>
                    <div>
                        <span class="block text-red-100">Dispatch Facility</span>
                        <span class="font-extrabold text-white text-sm">Buguruni Malapa, Dar es Salaam</span>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="https://wa.me/255749901907?text=Hello%20BEAC%20INAS!%20We%20would%20like%20to%20inquire%20about%20Wholesale%20Distribution." 
                       target="_blank" 
                       class="w-full flex items-center justify-center gap-2 py-3.5 px-4 rounded-full bg-white text-red-600 hover:bg-[#FAF5EE] font-black text-xs transition shadow-md">
                        <span>Fast-Track via WhatsApp (+255 749 901 907)</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right: Enquiry Form -->
        <div class="lg:col-span-7">
            <div class="p-8 sm:p-10 rounded-[32px] bg-white border border-[#E8DDD0] shadow-sm space-y-6">
                
                <div class="space-y-1">
                    <h3 class="text-2xl font-black text-zinc-900">Wholesale Application</h3>
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
                                   class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition">
                            @error('company_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Contact Person *</label>
                            <input type="text" name="contact_name" required value="{{ old('contact_name') }}" placeholder="e.g. David Mrema"
                                   class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition">
                            @error('contact_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Phone / WhatsApp Number *</label>
                            <input type="tel" name="phone" required value="{{ old('phone') }}" placeholder="e.g. +255 749 901 907"
                                   class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition">
                            @error('phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Email Address *</label>
                            <input type="email" name="email" required value="{{ old('email') }}" placeholder="e.g. procurement@serengeti.co.tz"
                                   class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition">
                            @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Business Type *</label>
                            <select name="business_type" required class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition">
                                <option value="Supermarkets & Retailers">Supermarkets &amp; Retailers</option>
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
                            <select name="estimated_monthly_volume" required class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition">
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
                               class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition">
                    </div>

                    <div class="space-y-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Additional Requirements / Notes</label>
                        <textarea name="message" rows="3" placeholder="Tell us about your distribution channels, retail outlets, or specific packaging needs..."
                                  class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" 
                            class="w-full py-4 rounded-full bg-red-600 hover:bg-red-700 text-white font-bold text-sm shadow-md hover:shadow-lg transition flex items-center justify-center gap-2 cursor-pointer">
                        <span>Submit Wholesale Application</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>

            </div>
        </div>

    </section>

@endsection
