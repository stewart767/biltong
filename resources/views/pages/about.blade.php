@extends('layouts.app')

@section('title', 'Our Story | INAS Premium Beef Biltong | Buguruni Malapa, Dar es Salaam')

@section('content')

    <!-- Header Banner -->
    <section class="py-16 bg-brand-charcoal border-b border-brand-border relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10 space-y-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-red/20 text-brand-red border border-brand-red/30">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-red"></span>
                The Heritage & Craft
            </span>
            <h1 class="font-editorial text-4xl sm:text-6xl font-bold text-white tracking-wide">
                The Story Behind INAS
            </h1>
            <p class="text-zinc-300 text-base sm:text-lg max-w-2xl mx-auto">
                Born out of passion for genuine Tanzanian livestock and the time-honored artisanal tradition of natural air-cured beef.
            </p>
        </div>
    </section>

    <!-- Content Sections -->
    <section class="py-16 bg-zinc-100 text-zinc-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 space-y-16">
            
            <div class="space-y-6 text-zinc-700 leading-relaxed text-base sm:text-lg bg-white p-8 sm:p-10 rounded-3xl border border-zinc-200 shadow-sm">
                <h2 class="font-editorial text-3xl font-bold text-zinc-900">
                    From Buguruni Malapa to Discerning Tables Across Tanzania
                </h2>
                <p>
                    <strong class="text-brand-red">INAS Company Limited</strong> was founded with a singular conviction: Tanzania is home to some of Africa’s richest, most naturally grass-fed cattle, yet the market was inundated with processed, sugar-laden, imported meat snacks.
                </p>
                <p>
                    We set out to master the craft of authentic <em>biltong</em>—a method developed centuries ago that relies on whole coriander seed, sea salt, coarse black pepper, and gentle air movement rather than high-temperature ovens or chemical curing salts.
                </p>
                <p>
                    From our production facility in <strong>Buguruni Malapa, Dar es Salaam</strong>, our butchers hand-select silverside and topside prime cuts every morning, ensuring exact marbling and thickness before our traditional curing process begins.
                </p>
            </div>

            <!-- Visual Showcase -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="rounded-2xl overflow-hidden border border-zinc-200 bg-white shadow-sm">
                    <img src="{{ asset('images/tanzania-pasture.jpg') }}" alt="Tanzanian Cattle" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h4 class="font-bold text-zinc-900 text-base">100% Pasture-Grazed Cattle</h4>
                        <p class="text-xs text-zinc-500 mt-1">Ethically sourced from sustainable Tanzanian pastoralists.</p>
                    </div>
                </div>
                <div class="rounded-2xl overflow-hidden border border-zinc-200 bg-white shadow-sm">
                    <img src="{{ asset('images/craft-spices.jpg') }}" alt="Artisanal Spices" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h4 class="font-bold text-zinc-900 text-base">Iron Skillet Toasted Spices</h4>
                        <p class="text-xs text-zinc-500 mt-1">Cracked coriander, tellicherry pepper, and rock salt.</p>
                    </div>
                </div>
            </div>

            <!-- Pillars -->
            <div class="space-y-8">
                <div class="text-center">
                    <span class="text-xs uppercase tracking-widest text-brand-red font-bold">Our Philosophy</span>
                    <h3 class="font-editorial text-3xl font-bold text-zinc-900 mt-1">Our Four Founding Principles</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-2">
                        <span class="text-xs font-bold text-brand-red uppercase tracking-wider block">01. Unadulterated Meat</span>
                        <p class="text-xs text-zinc-600 leading-relaxed">
                            No fillers, no mechanical re-formation, no soy substitutes. Each pouch contains genuine whole muscle cuts.
                        </p>
                    </div>
                    <div class="p-6 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-2">
                        <span class="text-xs font-bold text-brand-red uppercase tracking-wider block">02. 100% Halal Standards</span>
                        <p class="text-xs text-zinc-600 leading-relaxed">
                            Every batch follows certified Halal slaughtering, handling and packaging protocols under stringent hygienic control.
                        </p>
                    </div>
                    <div class="p-6 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-2">
                        <span class="text-xs font-bold text-brand-red uppercase tracking-wider block">03. Nutrient Density</span>
                        <p class="text-xs text-zinc-600 leading-relaxed">
                            Over 52g protein per 100g. Naturally abundant in bioavailable iron, vitamin B12, and potassium.
                        </p>
                    </div>
                    <div class="p-6 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-2">
                        <span class="text-xs font-bold text-brand-red uppercase tracking-wider block">04. Local Pride</span>
                        <p class="text-xs text-zinc-600 leading-relaxed">
                            Proudly Tanzanian. Supporting local cattle farming communities while competing at an international gourmet standard.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="p-8 sm:p-12 rounded-3xl bg-brand-charcoal text-white border border-brand-border text-center space-y-5">
                <h3 class="font-editorial text-3xl font-bold text-white">Experience the Taste of Real Beef</h3>
                <p class="text-sm text-zinc-300 max-w-md mx-auto">
                    Try our flagship 100g Biltong Original or order direct for same-day Dar es Salaam dispatch.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                    <a href="{{ route('shop') }}" class="px-8 py-3.5 rounded-full bg-brand-red hover:bg-brand-red-dark text-white font-bold text-sm shadow-md transition">
                        Shop Our Cuts
                    </a>
                    <a href="{{ route('contact') }}" class="px-8 py-3.5 rounded-full bg-zinc-800 hover:bg-zinc-700 border border-zinc-600 text-white text-sm font-semibold transition">
                        Visit Us in Buguruni Malapa
                    </a>
                </div>
            </div>

        </div>
    </section>

@endsection
