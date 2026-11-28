@extends('layouts.app')

@section('title', 'Menu & Combos | Burger House')
@section('meta_description', 'Explore our delicious menu of prime gourmet burgers, double cheese burgers, crispy chicken, and combo meals served with golden fries.')

@section('content')

<!-- Header Banner -->
<div class="max-w-5xl mx-auto px-4 sm:px-6 pt-8 pb-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl sm:text-4xl font-black text-[#1E1E1E]">Our Full Menu</h1>
            <p class="text-xs sm:text-sm text-stone-500 mt-1">Served with Golden Crisp fries and a refreshing drink!</p>
        </div>

        <!-- Filter & Order shortcut -->
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}#menu" class="px-4 py-2 rounded-full bg-white border border-red-200 text-[#E52E2E] text-xs font-bold hover:bg-red-50 transition shadow-xs flex items-center gap-1.5">
                <span>Hot Deals</span>
                <span class="w-2 h-2 rounded-full bg-[#E52E2E]"></span>
            </a>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 pb-20 space-y-8">
    
    <!-- 4 Flagship Burgers (Exact from Screenshot) -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-red-100/70 relative flex flex-col justify-between group hover:shadow-md transition">
            <div class="absolute -top-3 right-3 bg-[#E52E2E] text-white text-[9px] font-extrabold px-2.5 py-0.5 rounded-full shadow-xs">
                Most Popular
            </div>
            <div>
                <div class="w-full h-28 rounded-xl overflow-hidden bg-stone-50 mb-3">
                    <img src="{{ asset('images/burger-house/special-burger.jpg') }}" alt="Burger House Special" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="font-bold text-xs text-[#1E1E1E]">Burger House Special</h3>
                <p class="text-[10px] text-stone-500 mt-1 leading-snug line-clamp-2">
                    Beef patty, American cheese, lettuce, tomato, onion, pickles, mustard, mayo, ketchup.
                </p>
            </div>
            <div class="mt-4 pt-2 border-t border-stone-100 flex items-center justify-between">
                <span class="font-extrabold text-xs text-[#1E1E1E]">$9.50</span>
                <button type="button" 
                        @click="addToCart(1, null, null, 1)"
                        class="px-3 py-1 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] text-white text-[11px] font-bold transition">
                    + Add
                </button>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-red-100/70 relative flex flex-col justify-between group hover:shadow-md transition">
            <div class="absolute -top-3 right-3 bg-[#E52E2E] text-white text-[9px] font-extrabold px-2.5 py-0.5 rounded-full shadow-xs">
                Hot Deals
            </div>
            <div>
                <div class="w-full h-28 rounded-xl overflow-hidden bg-stone-50 mb-3">
                    <img src="{{ asset('images/burger-house/double-cheese.jpg') }}" alt="Double Cheese Burger" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="font-bold text-xs text-[#1E1E1E]">Double Cheese Burger</h3>
                <p class="text-[10px] text-stone-500 mt-1 leading-snug line-clamp-2">
                    Angus beef, American cheese, bacon, grilled onions, special sauce.
                </p>
            </div>
            <div class="mt-4 pt-2 border-t border-stone-100 flex items-center justify-between">
                <span class="font-extrabold text-xs text-[#1E1E1E]">$11.20</span>
                <button type="button" 
                        @click="addToCart(2, null, null, 1)"
                        class="px-3 py-1 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] text-white text-[11px] font-bold transition">
                    + Add
                </button>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-red-100/70 relative flex flex-col justify-between group hover:shadow-md transition">
            <div class="absolute -top-3 right-3 bg-[#E52E2E] text-white text-[9px] font-extrabold px-2.5 py-0.5 rounded-full shadow-xs">
                Hot Deals
            </div>
            <div>
                <div class="w-full h-28 rounded-xl overflow-hidden bg-stone-50 mb-3">
                    <img src="{{ asset('images/burger-house/bbq-bacon.jpg') }}" alt="BBQ Bacon Burger" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="font-bold text-xs text-[#1E1E1E]">BBQ Bacon Burger</h3>
                <p class="text-[10px] text-stone-500 mt-1 leading-snug line-clamp-2">
                    Angus beef, bacon, American cheese, barbecue sauce, grilled onions.
                </p>
            </div>
            <div class="mt-4 pt-2 border-t border-stone-100 flex items-center justify-between">
                <span class="font-extrabold text-xs text-[#1E1E1E]">$11.20</span>
                <button type="button" 
                        @click="addToCart(3, null, null, 1)"
                        class="px-3 py-1 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] text-white text-[11px] font-bold transition">
                    + Add
                </button>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-red-100/70 relative flex flex-col justify-between group hover:shadow-md transition">
            <div class="absolute -top-3 right-3 bg-[#E52E2E] text-white text-[9px] font-extrabold px-2.5 py-0.5 rounded-full shadow-xs">
                New
            </div>
            <div>
                <div class="w-full h-28 rounded-xl overflow-hidden bg-stone-50 mb-3">
                    <img src="{{ asset('images/burger-house/chicken-avocado.jpg') }}" alt="Chicken Avocado Burger" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h3 class="font-bold text-xs text-[#1E1E1E]">Chicken Avocado Burger</h3>
                <p class="text-[10px] text-stone-500 mt-1 leading-snug line-clamp-2">
                    Crispy chicken, fresh avocado, lettuce, tomato, chipotle mayo.
                </p>
            </div>
            <div class="mt-4 pt-2 border-t border-stone-100 flex items-center justify-between">
                <span class="font-extrabold text-xs text-[#1E1E1E]">$10.50</span>
                <button type="button" 
                        @click="addToCart(4, null, null, 1)"
                        class="px-3 py-1 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] text-white text-[11px] font-bold transition">
                    + Add
                </button>
            </div>
        </div>
    </div>

    <!-- Additional Menu Catalog from Database if available -->
    @if(isset($products) && $products->count() > 0)
        <div class="pt-8 border-t border-red-100/80">
            <h2 class="text-xl font-extrabold text-[#1E1E1E] mb-4">Complete House Collection</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($products as $product)
                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-red-100/70 flex flex-col justify-between hover:shadow-md transition">
                        <div>
                            <div class="w-full h-32 rounded-xl overflow-hidden bg-stone-50 mb-3">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                            <h3 class="font-bold text-xs text-[#1E1E1E] truncate">{{ $product->name }}</h3>
                            <p class="text-[10px] text-stone-500 mt-1 leading-snug line-clamp-2">{{ $product->short_description }}</p>
                        </div>
                        <div class="mt-3 pt-2 border-t border-stone-100 flex items-center justify-between">
                            <span class="font-extrabold text-xs text-[#1E1E1E]">TZS {{ number_format($product->effective_price, 0) }}</span>
                            <button type="button" 
                                    @click="addToCart({{ $product->id }}, null, null, 1)"
                                    class="px-3 py-1 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] text-white text-[11px] font-bold transition">
                                + Add
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>

@endsection
