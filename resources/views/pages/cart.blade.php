@extends('layouts.app')

@section('title', 'Your Order Bag | Burger House')

@section('content')

<!-- Header Banner -->
<div class="max-w-5xl mx-auto px-4 sm:px-6 pt-8 pb-4">
    <h1 class="text-3xl sm:text-4xl font-black text-[#1E1E1E]">Your Shopping Bag & Order</h1>
    <p class="text-xs sm:text-sm text-stone-500 mt-1">Review your meal before proceeding to checkout and delivery.</p>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 pb-20"
     x-data="{
         deliveryMethod: '{{ request('delivery_method', 'dar_express') }}',
         updateDelivery() {
             window.location.href = '{{ route('cart') }}?delivery_method=' + this.deliveryMethod;
         }
     }">

    @if($items->isEmpty())
        <div class="bg-white rounded-3xl border border-red-100/80 p-12 sm:p-16 text-center max-w-xl mx-auto my-8 shadow-sm">
            <div class="w-16 h-16 rounded-full bg-red-50 text-[#E52E2E] flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-black text-[#1E1E1E]">Your Bag is Currently Empty</h2>
            <p class="text-xs text-stone-500 mt-2 max-w-md mx-auto">
                Explore our mouth-watering burgers, crispy fries, and refreshing combos to get started!
            </p>
            <a href="{{ route('home') }}#menu" class="inline-flex items-center gap-2 mt-6 px-8 py-3.5 bg-[#E52E2E] hover:bg-[#C61A1A] text-white rounded-full text-xs font-bold uppercase tracking-wider transition shadow-md shadow-red-500/20">
                <span>BROWSE MENU</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Cart Items Table (Left - 8 cols) -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-3xl border border-[#ECE2D2] overflow-hidden shadow-xs">
                    
                    <div class="p-6 border-b border-[#ECE2D2] flex items-center justify-between">
                        <span class="font-display font-bold text-lg text-[#171717]">
                            Items in Bag ({{ $summary['items_count'] }})
                        </span>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs text-stone-400 hover:text-red-600 transition flex items-center gap-1">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                <span>Clear Cart</span>
                            </button>
                        </form>
                    </div>

                    <div class="divide-y divide-[#ECE2D2]">
                        @foreach($items as $item)
                            <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                
                                <!-- Product Info -->
                                <div class="flex items-center gap-4">
                                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-[#F6F0E6] flex-shrink-0 border border-[#ECE2D2]">
                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <a href="{{ route('product.show', $item->product->slug) }}" class="font-display font-bold text-base text-[#171717] hover:text-[#B77B3B] transition">
                                            {{ $item->product->name }}
                                        </a>
                                        <div class="flex items-center gap-2 text-xs text-stone-500 mt-1">
                                            <span>Pack Size: <strong class="text-[#171717]">{{ $item->weight }}</strong></span>
                                            <span>•</span>
                                            <span>Unit: Tshs {{ number_format($item->price, 0) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quantity Controls & Line Total -->
                                <div class="flex items-center justify-between w-full sm:w-auto sm:justify-end gap-6">
                                    <!-- Quantity form -->
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center border border-[#ECE2D2] rounded-xl overflow-hidden bg-[#F6F0E6]">
                                        @csrf
                                        <input type="hidden" name="delivery_method" :value="deliveryMethod">
                                        <button type="submit" name="quantity" value="{{ max(0, $item->quantity - 1) }}" class="px-3 py-1.5 text-stone-600 hover:bg-white transition font-bold text-xs">-</button>
                                        <span class="px-3 py-1.5 text-xs font-bold text-[#171717]">{{ $item->quantity }}</span>
                                        <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" class="px-3 py-1.5 text-stone-600 hover:bg-white transition font-bold text-xs">+</button>
                                    </form>

                                    <!-- Subtotal -->
                                    <div class="text-right min-w-[90px]">
                                        <span class="font-black text-sm text-[#171717]">
                                            Tshs {{ number_format($item->subtotal, 0) }}
                                        </span>
                                    </div>

                                    <!-- Remove -->
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-1.5 text-stone-400 hover:text-red-600 transition" title="Remove Item">
                                            <i data-lucide="x" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        @endforeach
                    </div>

                </div>

                <!-- Continue Shopping link -->
                <div class="mt-6 flex items-center justify-between text-xs">
                    <a href="{{ route('shop') }}" class="font-bold text-[#B77B3B] hover:underline flex items-center gap-1.5">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                        <span>Continue Shopping</span>
                    </a>
                </div>
            </div>

            <!-- Order Summary & Checkout Card (Right - 4 cols) -->
            <div class="lg:col-span-4 flex flex-col gap-6">
                
                <!-- Summary Card -->
                <div class="bg-white rounded-3xl border border-[#ECE2D2] p-6 shadow-xs">
                    <h3 class="font-display font-bold text-lg text-[#171717] pb-4 border-b border-[#ECE2D2]">
                        Order Summary
                    </h3>

                    <!-- Delivery Method Picker -->
                    <div class="mt-4 pb-4 border-b border-[#ECE2D2]">
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-2">Delivery Destination:</label>
                        <select x-model="deliveryMethod" 
                                @change="updateDelivery()" 
                                class="w-full px-3 py-2.5 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-xs font-semibold text-[#171717] focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                            <option value="dar_express">Dar es Salaam Express (Tshs 5,000 / Free >50k)</option>
                            <option value="upcountry">Upcountry Regional Bus / Courier (Tshs 12,000)</option>
                            <option value="pickup">Self Collection / Butchery Pickup (FREE)</option>
                        </select>
                    </div>

                    <!-- Discount Coupon Form -->
                    <div class="mt-4 pb-4 border-b border-[#ECE2D2]">
                        @if($summary['coupon_code'])
                            <div class="flex items-center justify-between p-2.5 bg-emerald-50 border border-emerald-200 rounded-xl text-xs text-emerald-800">
                                <div>
                                    <span class="font-bold">Coupon: {{ $summary['coupon_code'] }}</span>
                                    <span class="block text-[10px] text-emerald-600">-Tshs {{ number_format($summary['discount'], 0) }}</span>
                                </div>
                                <form action="{{ route('cart.coupon.remove') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-xs text-emerald-800 hover:text-red-600 font-bold">Remove</button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('cart.coupon.apply') }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="text" name="code" placeholder="Discount Code (e.g. COY10)" required class="flex-1 px-3 py-2 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-xs uppercase text-[#171717] focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                                <button type="submit" class="px-4 py-2 bg-[#171717] hover:bg-[#B77B3B] text-white rounded-xl text-xs font-bold uppercase transition">Apply</button>
                            </form>
                        @endif
                    </div>

                    <!-- Figures -->
                    <div class="mt-4 space-y-3 text-xs">
                        <div class="flex justify-between text-stone-600">
                            <span>Subtotal</span>
                            <span class="font-bold text-[#171717]">Tshs {{ number_format($summary['subtotal'], 0) }}</span>
                        </div>
                        @if($summary['discount'] > 0)
                            <div class="flex justify-between text-emerald-700 font-semibold">
                                <span>Discount</span>
                                <span>-Tshs {{ number_format($summary['discount'], 0) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-stone-600">
                            <span>Delivery</span>
                            <span class="font-bold {{ $summary['delivery_fee'] == 0 ? 'text-emerald-700' : 'text-[#171717]' }}">
                                {{ $summary['delivery_fee'] == 0 ? 'FREE' : 'Tshs ' . number_format($summary['delivery_fee'], 0) }}
                            </span>
                        </div>
                        <div class="pt-3 border-t border-[#ECE2D2] flex justify-between items-baseline">
                            <span class="font-bold text-sm text-[#171717]">Total</span>
                            <span class="font-display font-extrabold text-2xl text-[#171717]">
                                Tshs {{ number_format($summary['total'], 0) }}
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex flex-col gap-3">
                        <a href="{{ route('checkout') }}?delivery_method={{ request('delivery_method', 'dar_express') }}" 
                           class="w-full bg-[#B77B3B] hover:bg-[#C98E4F] text-white py-4 rounded-xl font-bold text-xs uppercase tracking-wider text-center transition shadow-lg shadow-[#B77B3B]/25 flex items-center justify-center gap-2">
                            <span>PROCEED TO CHECKOUT</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>

                        <a href="https://wa.me/{{ \App\Models\SiteSetting::get('company_whatsapp', '2556621990') }}?text={{ urlencode("Habari Burger House! Naomba kuweka oda ya kapu langu (Jumla: Tshs " . number_format($summary['total'], 0) . ") kupitia WhatsApp.") }}" 
                           target="_blank" 
                           class="w-full bg-[#25D366] hover:bg-[#20ba5a] text-white py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider text-center transition flex items-center justify-center gap-2 shadow-md shadow-emerald-500/20">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Tuma Oda WhatsApp Moja kwa Moja (06621990)</span>
                        </a>
                    </div>

                </div>

                <!-- Safe Checkout Guarantee -->
                <div class="bg-[#F6F0E6] p-4 rounded-2xl border border-[#ECE2D2] text-xs text-stone-600 flex items-center gap-3">
                    <i data-lucide="lock" class="w-5 h-5 text-[#68734B] flex-shrink-0"></i>
                    <span>Secure checkout powered by M-Pesa, Airtel Money, Tigo Pesa, HaloPesa & Bank.</span>
                </div>

            </div>

        </div>
    @endif

</div>

@endsection
