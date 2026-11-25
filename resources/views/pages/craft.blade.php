@extends('layouts.app')

@section('title', 'Quality & Craft | Air-Cured Beef Biltong | INAS Buguruni Malapa')

@section('content')

    <!-- Header Banner -->
    <section class="py-16 bg-brand-charcoal border-b border-brand-border text-center">
        <div class="max-w-4xl mx-auto px-4 space-y-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-red-600/20 text-red-600 border border-red-600/30">
                <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                Butcher’s Science
            </span>
            <h1 class="font-editorial text-4xl sm:text-6xl font-bold text-white tracking-wide">
                The Air-Curing Craft
            </h1>
            <p class="text-zinc-300 text-base sm:text-lg max-w-2xl mx-auto">
                How time, salt, coriander and gentle Dar es Salaam air turn fresh pasture beef into nutritious gourmet biltong.
            </p>
        </div>
    </section>

    <!-- Deep Dive Steps -->
    <section class="py-16 bg-zinc-100 text-zinc-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 space-y-16">
            
            <!-- Step 1 -->
            <div class="p-8 rounded-3xl bg-white border border-zinc-200 shadow-sm grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                <div class="md:col-span-7 space-y-3">
                    <span class="text-xs font-bold text-red-600 uppercase tracking-widest">Phase 01</span>
                    <h2 class="font-editorial text-2xl sm:text-3xl font-bold text-zinc-900">The Cut: Silverside & Topside Selection</h2>
                    <p class="text-sm text-zinc-600 leading-relaxed">
                        Great biltong cannot be made with inferior beef. We strictly procure silverside (eye of round) and topside subprimals from grass-grazed Tanzanian cattle. The meat is trimmed along natural muscle seams to ensure every slice will have a uniform tender bite without tough connective tissue.
                    </p>
                    <ul class="text-xs text-zinc-500 space-y-1.5 list-disc pl-4">
                        <li>100% whole muscle cuts — never ground or emulsified</li>
                        <li>Balanced fat marbling for rich beef sweetness</li>
                        <li>Daily inspection and grading at our Buguruni Malapa facility</li>
                    </ul>
                </div>
                <div class="md:col-span-5 rounded-2xl overflow-hidden border border-zinc-200">
                    <img src="{{ asset('images/hero-steak.jpg') }}" alt="Prime Cut Beef" class="w-full h-56 object-cover">
                </div>
            </div>

            <!-- Step 2 -->
            <div class="p-8 rounded-3xl bg-white border border-zinc-200 shadow-sm grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                <div class="md:col-span-5 rounded-2xl overflow-hidden border border-zinc-200 order-2 md:order-1">
                    <img src="{{ asset('images/craft-spices.jpg') }}" alt="Toasted Whole Coriander and Salt" class="w-full h-56 object-cover">
                </div>
                <div class="md:col-span-7 space-y-3 order-1 md:order-2">
                    <span class="text-xs font-bold text-red-600 uppercase tracking-widest">Phase 02</span>
                    <h2 class="font-editorial text-2xl sm:text-3xl font-bold text-zinc-900">The Cure: Cider Vinegar & Roasted Coriander</h2>
                    <p class="text-sm text-zinc-600 leading-relaxed">
                        The trimmed beef strips undergo an artisanal dry cure. First, they are splashed with cider vinegar to lower surface pH and sanitize naturally. Then, they are dredged in a blend of coarse rock salt, brown cane sugar, freshly cracked black pepper, and coriander seeds roasted in iron skillets to unlock aromatic terpenes.
                    </p>
                    <ul class="text-xs text-zinc-500 space-y-1.5 list-disc pl-4">
                        <li>Whole toasted coriander seeds crushed right before rub</li>
                        <li>Natural preservation through salinity and organic acids</li>
                        <li>Zero artificial sodium nitrites or potassium sorbate</li>
                    </ul>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="p-8 rounded-3xl bg-white border border-zinc-200 shadow-sm grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                <div class="md:col-span-7 space-y-3">
                    <span class="text-xs font-bold text-red-600 uppercase tracking-widest">Phase 03</span>
                    <h2 class="font-editorial text-2xl sm:text-3xl font-bold text-zinc-900">The Drying Chamber: 72 Hours at Low Temperature</h2>
                    <p class="text-sm text-zinc-600 leading-relaxed">
                        Unlike oven-cooked American jerky, biltong is gently air-dried at low ambient temperatures (between 22°C and 25°C) with constant calibrated humidity and air flow. Over 3 to 4 days, the strips lose roughly 55% of their water weight, concentrating the protein and infusing the spices deep into the beef fiber.
                    </p>
                    <ul class="text-xs text-zinc-500 space-y-1.5 list-disc pl-4">
                        <li>True air drying — not heat baked or boiled</li>
                        <li>Retains natural enzymes, vitamins and bioavailable iron</li>
                        <li>Produces characteristic tender-chew texture</li>
                    </ul>
                </div>
                <div class="md:col-span-5 rounded-2xl overflow-hidden border border-zinc-200">
                    <img src="{{ asset('images/curing-room.jpg') }}" alt="INAS Curing Room" class="w-full h-56 object-cover">
                </div>
            </div>

            <!-- Comparison Table: INAS Biltong vs Standard Jerky -->
            <div class="p-8 rounded-3xl bg-white border border-zinc-200 shadow-sm space-y-6">
                <div class="text-center">
                    <span class="text-xs uppercase tracking-widest text-red-600 font-bold">The Real Difference</span>
                    <h3 class="font-editorial text-2xl sm:text-3xl font-bold text-zinc-900 mt-1">INAS Biltong vs Standard Commercial Jerky</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm">
                        <thead>
                            <tr class="border-b border-zinc-200 text-red-600 uppercase text-[11px] tracking-wider">
                                <th class="pb-3">Characteristic</th>
                                <th class="pb-3">INAS Artisanal Biltong</th>
                                <th class="pb-3">Standard Commercial Jerky</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 text-zinc-700">
                            <tr>
                                <td class="py-3 font-semibold text-zinc-900">Cooking Method</td>
                                <td class="py-3 text-emerald-600 font-semibold">Never cooked (natural air-dried)</td>
                                <td class="py-3 text-zinc-400">Oven-baked / smoked heat</td>
                            </tr>
                            <tr>
                                <td class="py-3 font-semibold text-zinc-900">Added Sugars</td>
                                <td class="py-3 text-emerald-600 font-semibold">Under 1.2g natural / 100g</td>
                                <td class="py-3 text-zinc-400">High sugar syrups (15g - 25g)</td>
                            </tr>
                            <tr>
                                <td class="py-3 font-semibold text-zinc-900">Protein Density</td>
                                <td class="py-3 text-emerald-600 font-semibold">52.4g per 100g pack</td>
                                <td class="py-3 text-zinc-400">~25g - 32g per 100g</td>
                            </tr>
                            <tr>
                                <td class="py-3 font-semibold text-zinc-900">Texture & Bite</td>
                                <td class="py-3 text-emerald-600 font-semibold">Tender steak-like cross-grain slices</td>
                                <td class="py-3 text-zinc-400">Tough, leathery and rubbery</td>
                            </tr>
                            <tr>
                                <td class="py-3 font-semibold text-zinc-900">Preservatives</td>
                                <td class="py-3 text-emerald-600 font-semibold">Rock salt & cider vinegar only</td>
                                <td class="py-3 text-zinc-400">Sodium nitrites & artificial smoke</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Final CTA -->
            <div class="text-center space-y-4 pt-4">
                <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-red-600 hover:bg-red-600-dark text-white font-bold text-sm shadow-md transition cursor-pointer">
                    <span>Taste the Craft — Order 100g Biltong</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

        </div>
    </section>

@endsection
