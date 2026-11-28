@extends('layouts.app')

@section('title', 'About Us | Our Story')
@section('meta_description', 'Discover the story behind our delicious recipes, fresh prime ingredients, artisanal preparation, and dedication to unforgettable taste.')

@section('content')

<!-- Hero Header Section -->
<div class="max-w-5xl mx-auto px-4 sm:px-6 pt-6 sm:pt-8 pb-8 text-center">
    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-red-100/70 border border-red-200 text-[#E52E2E] text-[11px] font-bold uppercase tracking-wider mb-3">
        <span>About Our Kitchen</span>
    </div>
    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#1E1E1E] tracking-tight leading-tight">
        Our Story & Passion for<br>
        <span class="text-[#E52E2E]">Real Delicious Taste</span>
    </h1>
    <p class="mt-2.5 text-xs sm:text-sm text-stone-500 max-w-xl mx-auto leading-relaxed">
        Crafted with pride, prepared fresh daily, and dedicated to delivering delicious food experiences using the finest prime ingredients.
    </p>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 pb-14 space-y-10">
    
    <!-- Section 1: The Origin & Vision with Classic Modified Border -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 sm:gap-12 items-center bg-white rounded-3xl p-6 sm:p-10 border-2 border-stone-200/85 shadow-sm">
        <div class="md:col-span-6 space-y-4">
            <span class="text-xs font-extrabold uppercase tracking-widest text-[#E52E2E]">Where It All Began</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1E1E1E]">
                Made Fresh, Served with Love
            </h2>
            <p class="text-sm text-stone-600 leading-relaxed">
                We believe that great food starts with simple, honest principles: prime ingredients, signature secret spices, and culinary patience. Every single recipe is crafted from scratch to ensure juicy tenderness, bold aroma, and unmatched flavor in every bite.
            </p>
            <p class="text-sm text-stone-600 leading-relaxed">
                Whether you are enjoying lunch with friends, grabbing dinner on the go, or celebrating with family, our mission is to deliver the freshest, most satisfying experience right to your table or doorstep.
            </p>
            <div class="pt-2">
                <a href="{{ route('home') }}#menu" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] text-white text-xs font-bold transition shadow-md shadow-red-500/20 border-2 border-white/40 ring-2 ring-red-300/30">
                    <span>Explore Our Menu</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
        <div class="md:col-span-6">
            <div class="rounded-2xl overflow-hidden shadow-lg border-2 border-stone-200/80 ring-4 ring-red-100/40 aspect-4/3">
                <img src="{{ asset('images/burger-house/hero-burger.jpg') }}" alt="Gourmet Burger Meal" class="w-full h-full object-cover">
            </div>
        </div>
    </div>

    <!-- Section 2: 3 Core Pillars with Classic Modified Borders -->
    <div class="bg-white rounded-3xl border-2 border-stone-200/85 p-8 sm:p-12 shadow-sm">
        <div class="text-center max-w-xl mx-auto mb-10">
            <span class="text-xs font-extrabold uppercase tracking-widest text-[#E52E2E]">Our Standards</span>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-[#1E1E1E] mt-1">What Sets Us Apart</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex flex-col items-center text-center p-5 rounded-2xl bg-[#FAF6F0] border-2 border-red-200/80 hover:border-[#E52E2E]/70 transition-all shadow-xs">
                <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-[#DC2626] to-[#EF4444] text-white flex items-center justify-center mb-4 shadow-sm border border-white/50">
                    <i data-lucide="award" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-base text-[#1E1E1E]">100% Prime Quality</h4>
                <p class="mt-2 text-xs text-stone-500 leading-relaxed">
                    We select prime pasture beef, farm-fresh produce, and artisan buns baked to perfection daily.
                </p>
            </div>

            <div class="flex flex-col items-center text-center p-5 rounded-2xl bg-[#FAF6F0] border-2 border-red-200/80 hover:border-[#E52E2E]/70 transition-all shadow-xs">
                <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-[#DC2626] to-[#EF4444] text-white flex items-center justify-center mb-4 shadow-sm border border-white/50">
                    <i data-lucide="flame" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-base text-[#1E1E1E]">Signature Recipes</h4>
                <p class="mt-2 text-xs text-stone-500 leading-relaxed">
                    Custom seasoning blends, melted real cheddar, and house sauces created for pure deliciousness.
                </p>
            </div>

            <div class="flex flex-col items-center text-center p-5 rounded-2xl bg-[#FAF6F0] border-2 border-red-200/80 hover:border-[#E52E2E]/70 transition-all shadow-xs">
                <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-[#DC2626] to-[#EF4444] text-white flex items-center justify-center mb-4 shadow-sm border border-white/50">
                    <i data-lucide="truck" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-base text-[#1E1E1E]">Fast & Fresh Delivery</h4>
                <p class="mt-2 text-xs text-stone-500 leading-relaxed">
                    Speedy delivery in thermal packaging so every order arrives piping hot and full of flavor.
                </p>
            </div>
        </div>
    </div>

    <!-- Section 3: Call to Action Banner with Classic Border -->
    <div class="bg-gradient-to-r from-[#E52E2E] to-[#C61A1A] text-white rounded-3xl p-8 sm:p-12 text-center shadow-lg shadow-red-500/20 border-2 border-white/40 ring-4 ring-red-200/50">
        <h3 class="text-3xl sm:text-4xl font-black text-white">
            Ready to Taste the Difference?
        </h3>
        <p class="mt-3 text-orange-100 text-sm max-w-xl mx-auto leading-relaxed">
            Order your favorite combo now with golden crisp fries and ice-cold refreshments!
        </p>
        <div class="mt-6 flex flex-wrap justify-center gap-4">
            <a href="{{ route('home') }}#menu" class="px-8 py-3.5 bg-white hover:bg-stone-50 text-[#E52E2E] font-extrabold rounded-full text-xs uppercase tracking-wider transition shadow-md border-2 border-white">
                ORDER NOW ↗
            </a>
            <a href="tel:5551234567" class="px-8 py-3.5 bg-orange-800/40 hover:bg-orange-800/60 text-white font-bold rounded-full text-xs uppercase tracking-wider border-2 border-white/40 transition">
                CALL TO ORDER
            </a>
        </div>
    </div>

</div>

@endsection
