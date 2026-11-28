@extends('layouts.app')

@section('title', 'How We Process & Uses of Beef Biltong | BEAC Craft')

@section('content')

    <!-- Header Banner (Red, White & Cream) -->
    <section class="rounded-[32px] bg-gradient-to-br from-[#FAF5EE] via-white to-[#F6E4DE]/60 border border-[#E8DDD0] p-8 sm:p-12 lg:p-14 text-center space-y-4 shadow-sm">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider bg-red-600 text-white shadow-xs">
            BEAC Processing &amp; Culinary Guide
        </span>
        <h1 class="text-3xl sm:text-5xl font-black text-zinc-900 tracking-tight">
            The Air-Curing Craft
        </h1>
        <p class="text-zinc-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            How we process our beef biltong snack in 72–84 hours of controlled air drying — turning prime Tanzanian silverside and topside cuts into high-protein gourmet perfection.
        </p>
    </section>

    <!-- How We Process Our Beef Biltong Snack (6-Step BEAC Process) -->
    <section class="mt-10 bg-white rounded-[32px] border border-[#E8DDD0] p-8 sm:p-10 shadow-sm space-y-8">
        <div class="text-center max-w-2xl mx-auto">
            <span class="text-xs uppercase tracking-widest text-red-600 font-black">6-Stage Standard</span>
            <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 mt-1">How We Process Our Beef Biltong Snack</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <div class="p-6 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <span class="inline-block px-2.5 py-0.5 rounded-full bg-red-600 text-white text-[10px] font-black">01. BEEF</span>
                <h3 class="font-extrabold text-base text-zinc-900">Silverside &amp; Topside Cuts</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">
                    Starts with high-quality lean cuts of beef, typically silverside or topside, carefully selected for texture and flavor.
                </p>
            </div>
            <div class="p-6 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <span class="inline-block px-2.5 py-0.5 rounded-full bg-red-600 text-white text-[10px] font-black">02. PREPARATION</span>
                <h3 class="font-extrabold text-base text-zinc-900">Vinegar, Salt &amp; Spices</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">
                    Marinated in a mixture of vinegar, salt, and spices (coriander, black pepper, and chili) for authentic flavor and natural preservation.
                </p>
            </div>
            <div class="p-6 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <span class="inline-block px-2.5 py-0.5 rounded-full bg-red-600 text-white text-[10px] font-black">03. DRYING PROCESS</span>
                <h3 class="font-extrabold text-base text-zinc-900">72–84 Hours Air Drying</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">
                    Air-dried in a controlled environment with low humidity and calibrated air circulation for 72 to 84 hours.
                </p>
            </div>
            <div class="p-6 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <span class="inline-block px-2.5 py-0.5 rounded-full bg-red-600 text-white text-[10px] font-black">04. TEXTURE &amp; FLAVOR</span>
                <h3 class="font-extrabold text-base text-zinc-900">Chewy, Dense &amp; Savory</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">
                    Produces a flavorful, slightly tangy, and mildly spicy dried meat with a rich, dense, and satisfying chew.
                </p>
            </div>
            <div class="p-6 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <span class="inline-block px-2.5 py-0.5 rounded-full bg-red-600 text-white text-[10px] font-black">05. NUTRITION</span>
                <h3 class="font-extrabold text-base text-zinc-900">High Protein, Low Carb</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">
                    High-protein snack, naturally low in carbohydrates and typically low in fat depending on cut and trimming.
                </p>
            </div>
            <div class="p-6 rounded-2xl bg-[#FAF5EE] border border-[#E8DDD0] space-y-2">
                <span class="inline-block px-2.5 py-0.5 rounded-full bg-red-600 text-white text-[10px] font-black">06. HERITAGE</span>
                <h3 class="font-extrabold text-base text-zinc-900">African Cultural Tradition</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">
                    Holds deep cultural significance in Africa, originating as a natural method to preserve prime meat without refrigeration.
                </p>
            </div>
        </div>
    </section>

    <!-- Uses of Beef Biltong (Pages 5-7 of BEAC Profile) -->
    <section class="mt-10 bg-[#F4ECE1]/90 rounded-[32px] border border-[#E8DDD0] p-8 sm:p-10 space-y-8">
        <div class="text-center max-w-2xl mx-auto">
            <span class="text-xs uppercase tracking-widest text-red-600 font-black">Everyday &amp; Gourmet</span>
            <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 mt-1">Uses of Beef Biltong</h2>
            <p class="text-xs sm:text-sm text-zinc-600 mt-1">Enjoy on its own or elevate your favorite meals, gatherings, and travels.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs space-y-2">
                <h3 class="font-extrabold text-base text-red-600">High-Protein Snack</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Commonly consumed on its own — chewy texture and savory flavor make it ideal between meals or during outdoor activities.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs space-y-2">
                <h3 class="font-extrabold text-base text-red-600">Salads</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Sprinkle chopped or shredded beef biltong over fresh green or avocado salads for extra protein and crunch.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs space-y-2">
                <h3 class="font-extrabold text-base text-red-600">Sandwiches &amp; Wraps</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Use biltong slices or strips as a hearty, protein-rich filling in artisan sandwiches, wraps, or rolls.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs space-y-2">
                <h3 class="font-extrabold text-base text-red-600">Pizza Topping</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Add sliced biltong as a gourmet pizza topping for a rich, smoky East African twist.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs space-y-2">
                <h3 class="font-extrabold text-base text-red-600">Stews &amp; Soups</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Incorporate biltong into slow-simmered stews or soups to deepen savory beef flavor and add texture.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs space-y-2">
                <h3 class="font-extrabold text-base text-red-600">Charcuterie Board</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Serve sliced biltong alongside aged cheeses, fresh fruits, and nuts for an impressive appetizer platter.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs space-y-2">
                <h3 class="font-extrabold text-base text-red-600">Travel &amp; Camping Food</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Natural preservation and high protein make it the ideal safari, flight, and camping food without refrigeration.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs space-y-2">
                <h3 class="font-extrabold text-base text-red-600">Gourmet Gifts</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Packaged in ribboned gift hampers as a unique, culturally authentic corporate or personal gift.</p>
            </div>
            <div class="p-6 rounded-2xl bg-white border border-[#E8DDD0] shadow-xs space-y-2">
                <h3 class="font-extrabold text-base text-red-600">Pairing with Beverages</h3>
                <p class="text-xs text-zinc-600 leading-relaxed">Enjoy biltong paired with whisky, gin, craft beer, or fine wine — its savory profile complements every sip.</p>
            </div>
        </div>
    </section>

    <!-- Comparison Table: INAS Biltong vs Standard Jerky -->
    <section class="mt-10 bg-white rounded-[32px] border border-[#E8DDD0] p-8 sm:p-10 shadow-sm space-y-6">
        <div class="text-center">
            <span class="text-xs uppercase tracking-widest text-red-600 font-black">The Real Difference</span>
            <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 mt-1">BEAC Artisanal Biltong vs Commercial Jerky</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead>
                    <tr class="border-b border-[#E8DDD0] text-red-600 uppercase text-[11px] tracking-wider">
                        <th class="pb-3">Characteristic</th>
                        <th class="pb-3">BEAC / INAS Biltong</th>
                        <th class="pb-3">Standard Commercial Jerky</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F0E6D8] text-zinc-700">
                    <tr>
                        <td class="py-3 font-bold text-zinc-900">Drying Method</td>
                        <td class="py-3 text-emerald-700 font-semibold">Air-dried 72–84 hours (low humidity)</td>
                        <td class="py-3 text-zinc-500">Oven baked or smoked at high heat</td>
                    </tr>
                    <tr>
                        <td class="py-3 font-bold text-zinc-900">Ingredients</td>
                        <td class="py-3 text-emerald-700 font-semibold">Beef, vinegar, salt, coriander, pepper</td>
                        <td class="py-3 text-zinc-500">Often contains added sugar, MSG &amp; preservatives</td>
                    </tr>
                    <tr>
                        <td class="py-3 font-bold text-zinc-900">Texture &amp; Cut</td>
                        <td class="py-3 text-emerald-700 font-semibold">Whole silverside &amp; topside, thick &amp; tender</td>
                        <td class="py-3 text-zinc-500">Thin, dry, or ground &amp; formed</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

@endsection
