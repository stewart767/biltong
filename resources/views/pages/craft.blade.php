@extends('layouts.app')

@section('title', 'Quality & Process | COY BILTONG — Artisanal Curing Excellence')
@section('meta_description', 'Learn about COY BILTONG’s 4-stage artisanal curing process: butchery selection, spice infusion, moisture-controlled ambient drying, and precision slicing.')

@section('content')

<!-- Header Banner -->
<div class="bg-[#171717] text-white py-16 lg:py-24 border-b border-[#262626] text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-[0.25em] text-[#B77B3B] mb-3 inline-block">Uncompromising Standards</span>
        <h1 class="font-display font-extrabold text-4xl sm:text-5xl lg:text-6xl text-white">
            THE ART OF BILTONG
        </h1>
        <p class="mt-6 text-base sm:text-lg text-stone-300 font-light leading-relaxed max-w-2xl mx-auto">
            From pasture to precision slice: exploring how we turn prime Tanzanian beef into an international calibre gastronomic snack.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    
    <!-- 4-Step Process Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
        
        <!-- Step 1 -->
        <div class="bg-white p-8 rounded-3xl border border-[#ECE2D2] shadow-xs relative flex flex-col justify-between">
            <div>
                <span class="font-display font-black text-4xl text-[#ECE2D2]">01</span>
                <h3 class="font-display font-bold text-xl text-[#171717] mt-3">Selection & Trimming</h3>
                <p class="mt-3 text-xs text-stone-600 leading-relaxed">
                    We select prime whole-muscle beef cuts. Expert butchers hand-trim sinew while preserving a golden fat edge for moist, flavourful curing.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-[#ECE2D2] flex items-center gap-2 text-xs text-[#68734B] font-semibold">
                <i data-lucide="check" class="w-4 h-4"></i>
                <span>100% Prime Muscle</span>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="bg-white p-8 rounded-3xl border border-[#ECE2D2] shadow-xs relative flex flex-col justify-between">
            <div>
                <span class="font-display font-black text-4xl text-[#ECE2D2]">02</span>
                <h3 class="font-display font-bold text-xl text-[#171717] mt-3">Artisanal Marinade</h3>
                <p class="mt-3 text-xs text-stone-600 leading-relaxed">
                    Strips are immersed in natural cider vinegar, sea salt, freshly roasted whole coriander seeds, and cracked black pepper to cure without heat.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-[#ECE2D2] flex items-center gap-2 text-xs text-[#68734B] font-semibold">
                <i data-lucide="check" class="w-4 h-4"></i>
                <span>Freshly Roasted Spices</span>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="bg-white p-8 rounded-3xl border border-[#ECE2D2] shadow-xs relative flex flex-col justify-between">
            <div>
                <span class="font-display font-black text-4xl text-[#ECE2D2]">03</span>
                <h3 class="font-display font-bold text-xl text-[#171717] mt-3">Slow Ambient Air-Drying</h3>
                <p class="mt-3 text-xs text-stone-600 leading-relaxed">
                    Hung in sterile, humidity-monitored air chambers for 4 to 6 days. Gentle air flow evaporates moisture without cooking or toughening meat fibres.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-[#ECE2D2] flex items-center gap-2 text-xs text-[#68734B] font-semibold">
                <i data-lucide="check" class="w-4 h-4"></i>
                <span>Zero Kiln Heat</span>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="bg-white p-8 rounded-3xl border border-[#ECE2D2] shadow-xs relative flex flex-col justify-between">
            <div>
                <span class="font-display font-black text-4xl text-[#ECE2D2]">04</span>
                <h3 class="font-display font-bold text-xl text-[#171717] mt-3">Precision Carver Slicing</h3>
                <p class="mt-3 text-xs text-stone-600 leading-relaxed">
                    Slabs are inspected and sliced across the grain into bite-ready pieces, then immediately sealed in nitrogen-purged fresh-lock bags.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-[#ECE2D2] flex items-center gap-2 text-xs text-[#68734B] font-semibold">
                <i data-lucide="check" class="w-4 h-4"></i>
                <span>Hermetically Sealed</span>
            </div>
        </div>

    </div>

    <!-- Biltong vs Beef Jerky Comparison -->
    <div class="bg-white rounded-3xl border border-[#ECE2D2] p-8 sm:p-12 mb-20">
        <div class="text-center max-w-xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#68734B]">Educational Guide</span>
            <h3 class="font-display font-bold text-3xl text-[#171717] mt-1">Biltong vs. Commercial Jerky</h3>
            <p class="text-xs text-stone-500 mt-2">Why genuine biltong provides a superior culinary experience.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b-2 border-[#ECE2D2] text-[#171717]">
                        <th class="py-3 px-4 font-display font-bold">Feature</th>
                        <th class="py-3 px-4 font-display font-bold text-[#B77B3B]">COY BILTONG</th>
                        <th class="py-3 px-4 font-display font-bold text-stone-400">Commercial Jerky</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#ECE2D2] text-xs">
                    <tr>
                        <td class="py-3.5 px-4 font-bold text-stone-700">Drying Method</td>
                        <td class="py-3.5 px-4 font-semibold text-[#171717]">Slow ambient air cure (no heat)</td>
                        <td class="py-3.5 px-4 text-stone-500">Fast heated kiln or dehydrator bake</td>
                    </tr>
                    <tr>
                        <td class="py-3.5 px-4 font-bold text-stone-700">Texture</td>
                        <td class="py-3.5 px-4 font-semibold text-[#171717]">Tender, moist, easy to chew</td>
                        <td class="py-3.5 px-4 text-stone-500">Tough, dry, leathery</td>
                    </tr>
                    <tr>
                        <td class="py-3.5 px-4 font-bold text-stone-700">Sugar & Sweeteners</td>
                        <td class="py-3.5 px-4 font-semibold text-emerald-700">Zero added sugar / low carb</td>
                        <td class="py-3.5 px-4 text-stone-500">Heavily sweetened with corn syrups</td>
                    </tr>
                    <tr>
                        <td class="py-3.5 px-4 font-bold text-stone-700">Flavour Profile</td>
                        <td class="py-3.5 px-4 font-semibold text-[#171717]">Roasted whole coriander, cider vinegar & pepper</td>
                        <td class="py-3.5 px-4 text-stone-500">Artificial liquid smoke & chemical flavourings</td>
                    </tr>
                    <tr>
                        <td class="py-3.5 px-4 font-bold text-stone-700">Curing Cut</td>
                        <td class="py-3.5 px-4 font-semibold text-[#171717]">Thick sirloin slabs cured whole, then sliced</td>
                        <td class="py-3.5 px-4 text-stone-500">Thin raw strips cooked rapidly</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
