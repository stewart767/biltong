@extends('layouts.app')

@section('title', 'Company Profile | Biltong East Africa Corporation (BEAC) | Dar es Salaam')

@section('content')

    <!-- Header Banner (Red, White & Cream) -->
    <section class="rounded-[32px] bg-gradient-to-br from-[#FAF5EE] via-white to-[#F6E4DE]/60 border border-[#E8DDD0] p-8 sm:p-12 lg:p-14 text-center space-y-4 shadow-sm">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider bg-red-600 text-white shadow-xs">
            Est. 2016 &bull; Dar es Salaam, Tanzania
        </span>
        <h1 class="text-3xl sm:text-5xl font-black text-zinc-900 tracking-tight">
            The Story Behind INAS <span class="text-red-600">(BEAC)</span>
        </h1>
        <p class="text-red-600 font-bold italic text-lg">
            "Tafuna nyama, Kula maisha!"
        </p>
        <p class="text-zinc-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            <strong>BILTONG EAST AFRICA CORPORATION (BEAC)</strong> is a leader in the East African meat processing industry, specializing in the production of premium biltong since our establishment in 2016.
        </p>
    </section>

    <!-- Overview & Mission Statement -->
    <section class="mt-10 grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
        <div class="lg:col-span-7 bg-white rounded-[32px] border border-[#E8DDD0] p-8 sm:p-10 shadow-sm space-y-4 flex flex-col justify-center">
            <span class="text-xs font-black uppercase tracking-wider text-red-600">Company Overview</span>
            <h2 class="text-2xl sm:text-3xl font-black text-zinc-900">
                Quality, Innovation &amp; Sustainable Craft
            </h2>
            <p class="text-sm sm:text-base text-zinc-600 leading-relaxed">
                Based in <strong>Buguruni Malapa, Dar es Salaam, Tanzania</strong>, BILTONG EAST AFRICA CORPORATION (BEAC) has quickly gained recognition for our commitment to quality, innovation, and sustainable business practices.
            </p>
            <p class="text-sm sm:text-base text-zinc-600 leading-relaxed">
                We craft authentic traditional and flavored biltong from locally sourced East African pasture-grazed beef, combining time-honored recipes with modern controlled air-curing facilities.
            </p>
        </div>

        <div class="lg:col-span-5 bg-red-600 text-white rounded-[32px] p-8 sm:p-10 shadow-md flex flex-col justify-center space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-white/15 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <span class="text-xs font-black uppercase tracking-widest text-red-100">Mission Statement</span>
            <blockquote class="text-lg sm:text-xl font-bold leading-relaxed text-white">
                "To deliver exceptional quality biltong products while promoting the rich culinary heritage of East Africa, using sustainable practices that benefit our customers, employees, and communities."
            </blockquote>
        </div>
    </section>

    <!-- 5 Core Values -->
    <section class="mt-10 bg-white rounded-[32px] border border-[#E8DDD0] p-8 sm:p-10 shadow-sm space-y-8">
        <div class="text-center max-w-xl mx-auto">
            <span class="text-xs uppercase tracking-widest text-red-600 font-black">What Guides Us</span>
            <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 mt-1">Our Core Values</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <div class="p-5 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <span class="w-9 h-9 rounded-full bg-red-600 text-white font-black text-xs flex items-center justify-center">01</span>
                <h3 class="font-extrabold text-sm text-zinc-900">Quality</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">We uphold the highest standards in sourcing, processing, and delivering premium biltong products.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <span class="w-9 h-9 rounded-full bg-red-600 text-white font-black text-xs flex items-center justify-center">02</span>
                <h3 class="font-extrabold text-sm text-zinc-900">Innovation</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Embracing modern technologies and techniques to enhance product quality and customer satisfaction.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <span class="w-9 h-9 rounded-full bg-red-600 text-white font-black text-xs flex items-center justify-center">03</span>
                <h3 class="font-extrabold text-sm text-zinc-900">Sustainability</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Committed to environmental stewardship and community engagement across Tanzania.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <span class="w-9 h-9 rounded-full bg-red-600 text-white font-black text-xs flex items-center justify-center">04</span>
                <h3 class="font-extrabold text-sm text-zinc-900">Integrity</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Operating with honesty, transparency, and respect for all stakeholders.</p>
            </div>
            <div class="p-5 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <span class="w-9 h-9 rounded-full bg-red-600 text-white font-black text-xs flex items-center justify-center">05</span>
                <h3 class="font-extrabold text-sm text-zinc-900">Product Offering</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Premium biltong traditional and flavored products made from locally sourced East African beef.</p>
            </div>
        </div>
    </section>

    <!-- 4 Key Strengths -->
    <section class="mt-10 bg-[#F4ECE1]/90 rounded-[32px] border border-[#E8DDD0] p-8 sm:p-10 space-y-8">
        <div class="text-center max-w-xl mx-auto">
            <span class="text-xs uppercase tracking-widest text-red-600 font-black">Why BEAC Leads</span>
            <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 mt-1">Key Strengths</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs flex items-start gap-4">
                <span class="w-9 h-9 rounded-full bg-red-600 text-white font-black text-sm flex items-center justify-center flex-shrink-0">1</span>
                <div>
                    <h3 class="font-extrabold text-base text-zinc-900">Premium Quality</h3>
                    <p class="text-xs sm:text-sm text-zinc-600 mt-1">Made from locally sourced beef and prepared using traditional recipes combined with modern processing methods.</p>
                </div>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs flex items-start gap-4">
                <span class="w-9 h-9 rounded-full bg-red-600 text-white font-black text-sm flex items-center justify-center flex-shrink-0">2</span>
                <div>
                    <h3 class="font-extrabold text-base text-zinc-900">Market Leadership</h3>
                    <p class="text-xs sm:text-sm text-zinc-600 mt-1">A recognized leader in the East African biltong market, trusted for superior product quality and consistency.</p>
                </div>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs flex items-start gap-4">
                <span class="w-9 h-9 rounded-full bg-red-600 text-white font-black text-sm flex items-center justify-center flex-shrink-0">3</span>
                <div>
                    <h3 class="font-extrabold text-base text-zinc-900">Customer Focus &amp; Satisfaction</h3>
                    <p class="text-xs sm:text-sm text-zinc-600 mt-1">Dedicated to exceeding customer expectations through personalized service and responsiveness.</p>
                </div>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs flex items-start gap-4">
                <span class="w-9 h-9 rounded-full bg-red-600 text-white font-black text-sm flex items-center justify-center flex-shrink-0">4</span>
                <div>
                    <h3 class="font-extrabold text-base text-zinc-900">Operational Excellence</h3>
                    <p class="text-xs sm:text-sm text-zinc-600 mt-1">Efficient production processes ensuring timely delivery and optimal product freshness.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Future Outlook: Strategic Transport Partnerships -->
    <section class="mt-10 bg-white rounded-[32px] border border-[#E8DDD0] p-8 sm:p-10 shadow-sm space-y-6">
        <div class="max-w-2xl">
            <span class="text-xs uppercase tracking-widest text-red-600 font-black">Future Outlook</span>
            <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 mt-1">Strategic Partnerships &amp; Travel Networks</h2>
            <p class="text-xs sm:text-sm text-zinc-600 mt-2">
                BEAC is strategically poised for growth by bringing premium East African biltong snacks directly to passengers traveling on:
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="p-6 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-3">
                <img src="{{ asset('images/partners/trc-sgr.svg') }}" alt="TRC SGR Logo" class="h-16 w-full object-contain bg-white rounded-xl p-2 border border-[#E8DDD0]">
                <h3 class="font-extrabold text-base text-zinc-900">SGR (Standard Gauge Railway)</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Serving travelers commuting between major cities in Tanzania with convenient high-protein biltong packs.</p>
            </div>
            <div class="p-6 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-3">
                <img src="{{ asset('images/partners/air-tanzania.svg') }}" alt="Air Tanzania Logo" class="h-16 w-full object-contain bg-white rounded-xl p-2 border border-[#E8DDD0]">
                <h3 class="font-extrabold text-base text-zinc-900">Air Tanzania Passengers</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Showcasing locally sourced, expertly crafted Tanzanian biltong across domestic and international flights.</p>
            </div>
            <div class="p-6 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-3">
                <img src="{{ asset('images/partners/precision-air.svg') }}" alt="Precision Air Logo" class="h-16 w-full object-contain bg-white rounded-xl p-2 border border-[#E8DDD0]">
                <h3 class="font-extrabold text-base text-zinc-900">Precision Air Passengers</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Bringing BEAC's traditional and flavored biltong variants to domestic and regional flyers.</p>
            </div>
        </div>
    </section>

    <!-- Brand Influencers & CTA -->
    <section class="mt-10 bg-red-600 text-white rounded-[32px] p-8 sm:p-12 shadow-md space-y-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="text-xs uppercase tracking-widest text-red-100 font-black">Brand Ambassadors</span>
                <h2 class="text-2xl sm:text-3xl font-black text-white mt-1">Our Brand Influencers</h2>
            </div>
            <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white text-red-600 hover:bg-[#FAF5EE] font-black text-xs uppercase tracking-wider shadow-sm transition self-start">
                <span>Shop Our Cuts</span>
                <span>&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-5 rounded-2xl bg-white text-zinc-900 shadow-md flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-xl bg-red-600 text-white font-black text-base flex items-center justify-center flex-shrink-0">ON</div>
                <div class="min-w-0">
                    <div class="font-black text-sm truncate">Hanaiya Ramadhani</div>
                    <div class="text-xs text-red-600 font-bold">'Official Nai'</div>
                    <div class="mt-1 text-[10px] font-bold bg-[#FAF5EE] border border-[#E8DDD0] inline-block px-2 py-0.5 rounded-full">3.7M Followers on IG</div>
                </div>
            </div>
            <div class="p-5 rounded-2xl bg-white text-zinc-900 shadow-md flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-xl bg-red-600 text-white font-black text-base flex items-center justify-center flex-shrink-0">SH</div>
                <div class="min-w-0">
                    <div class="font-black text-sm truncate">Zuwena Mohammed</div>
                    <div class="text-xs text-red-600 font-bold">'Shilole'</div>
                    <div class="mt-1 text-[10px] font-bold bg-[#FAF5EE] border border-[#E8DDD0] inline-block px-2 py-0.5 rounded-full">12M Followers on IG</div>
                </div>
            </div>
            <div class="p-5 rounded-2xl bg-white text-zinc-900 shadow-md flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-xl bg-red-600 text-white font-black text-base flex items-center justify-center flex-shrink-0">MW</div>
                <div class="min-w-0">
                    <div class="font-black text-sm truncate">Burton Mwemba</div>
                    <div class="text-xs text-red-600 font-bold">'Mwijaku'</div>
                    <div class="mt-1 text-[10px] font-bold bg-[#FAF5EE] border border-[#E8DDD0] inline-block px-2 py-0.5 rounded-full">2.2M Followers on IG</div>
                </div>
            </div>
            <div class="p-5 rounded-2xl bg-white text-zinc-900 shadow-md flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-xl bg-red-600 text-white font-black text-base flex items-center justify-center flex-shrink-0">MP</div>
                <div class="min-w-0">
                    <div class="font-black text-sm truncate">Sylvester Mujuni</div>
                    <div class="text-xs text-red-600 font-bold">'Mpoki'</div>
                    <div class="mt-1 text-[10px] font-bold bg-[#FAF5EE] border border-[#E8DDD0] inline-block px-2 py-0.5 rounded-full">3.1M Followers on IG</div>
                </div>
            </div>
        </div>
    </section>

@endsection
