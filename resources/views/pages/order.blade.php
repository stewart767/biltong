@extends('layouts.app')

@section('title', 'Order Online | Fast Fresh Delivery')
@section('meta_description', 'Customize your gourmet burger order, add golden fries and drinks, and get fast delivery directly to your door.')

@section('content')

<!-- Header Banner -->
<div class="max-w-5xl mx-auto px-4 sm:px-6 pt-3 sm:pt-4 pb-2">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-[#E52E2E]">Online Ordering</span>
            <h1 class="text-2xl sm:text-3xl font-black text-[#1E1E1E] mt-0.5">Order Your Favorite Meal</h1>
            <p class="text-xs text-stone-500 mt-0.5">Select items below or complete your delivery information.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-bold flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Kitchen Open & Ready
            </span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 pb-12"
     x-data="{
         items: [
             @if(isset($products) && $products->count() > 0)
                 @foreach($products as $p)
                     {
                         id: {{ $p->id }},
                         name: '{{ addslashes($p->name) }}',
                         price: {{ (float) $p->effective_price }},
                         qty: {{ $loop->first ? 1 : 0 }},
                         img: '{{ $p->image_url }}',
                         category: '{{ $p->category?->slug ?? 'general' }}'
                     },
                 @endforeach
             @else
                 { id: 12, name: 'Burger House Special', price: 22000, qty: 1, img: '{{ asset('images/burger-house/special-burger.jpg') }}' },
                 { id: 13, name: 'Double Cheese Burger', price: 26000, qty: 0, img: '{{ asset('images/burger-house/double-cheese.jpg') }}' },
                 { id: 14, name: 'BBQ Bacon Burger', price: 26000, qty: 0, img: '{{ asset('images/burger-house/bbq-bacon.jpg') }}' },
                 { id: 15, name: 'Chicken Avocado Burger', price: 24000, qty: 0, img: '{{ asset('images/burger-house/chicken-avocado.jpg') }}' }
             @endif
         ],
         deliveryMethod: 'express',
         paymentMethod: 'mpesa',
         formatTshs(amt) {
             return 'Tshs ' + Math.round(amt).toLocaleString();
         },
         get subtotal() {
             return this.items.reduce((sum, item) => sum + (item.price * item.qty), 0);
         },
         get deliveryFee() {
             return this.subtotal >= 50000 || this.subtotal === 0 ? 0 : 5000;
         },
         get total() {
             return this.subtotal + this.deliveryFee;
         },
         increment(index) {
             this.items[index].qty++;
         },
         decrement(index) {
             if (this.items[index].qty > 0) {
                 this.items[index].qty--;
             }
         },
         sendToWhatsApp() {
             const selected = this.items.filter(i => i.qty > 0);
             if (selected.length === 0) {
                 alert('Tafadhali chagua angalau chakula kimoja kuweka oda.');
                 return;
             }
             const name = document.querySelector('input[name="customer_name"]')?.value || '';
             const phone = document.querySelector('input[name="customer_phone"]')?.value || '';
             const address = document.querySelector('input[name="delivery_address"]')?.value || '';
             const city = document.querySelector('input[name="delivery_city"]')?.value || 'Dar es Salaam';
             const area = document.querySelector('input[name="delivery_area"]')?.value || '';
             const notes = document.querySelector('textarea[name="notes"]')?.value || '';

             let msg = "🍔 *ODA MPYA YA BURGER HOUSE*\n";
             msg += "━━━━━━━━━━━━━━━━━━━━\n";
             if (name) msg += "👤 *Mteja:* " + name + "\n";
             if (phone) msg += "📞 *Simu:* " + phone + "\n";
             if (area || city) msg += "📍 *Eneo / Location:* " + (area ? area + ", " : "") + city + "\n";
             if (address) msg += "🏠 *Anwani:* " + address + "\n";
             if (notes) msg += "📝 *Maelezo ya Ziada:* " + notes + "\n";
             msg += "━━━━━━━━━━━━━━━━━━━━\n";
             msg += "🛒 *Vyakula Vilivyoagizwa:*\n";
             selected.forEach(i => {
                 msg += "• " + i.name + " x" + i.qty + " — " + this.formatTshs(i.price * i.qty) + "\n";
             });
             msg += "━━━━━━━━━━━━━━━━━━━━\n";
             msg += "🛵 *Usafirishaji:* " + (this.deliveryFee === 0 ? "BURE (FREE)" : this.formatTshs(this.deliveryFee)) + "\n";
             msg += "💰 *JUMLA KUU:* " + this.formatTshs(this.total) + "\n";
             msg += "💳 *Njia ya Malipo:* " + this.paymentMethod.toUpperCase() + "\n";
             msg += "━━━━━━━━━━━━━━━━━━━━\n";
             msg += "Habari Burger House! Nimetuma oda yangu hapa, naomba uthibitisho na kuanza kuandaliwa.";

             const url = "https://wa.me/2556621990?text=" + encodeURIComponent(msg);
             window.open(url, '_blank');
         }
     }">

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Area: Meal Selection + Delivery Address (7 cols) -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- 1. Select Your Burgers & Combos with Classic Modified Border -->
                <div class="bg-white rounded-3xl p-5 sm:p-6 border-2 border-stone-200/85 shadow-sm space-y-4">
                    <div class="flex items-center justify-between border-b border-stone-200/70 pb-3">
                        <h2 class="text-base font-extrabold text-[#1E1E1E] flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-[#E52E2E] text-white text-xs flex items-center justify-center font-bold border border-white/50">1</span>
                            <span>Select Your Items</span>
                        </h2>
                        <a href="{{ route('menu') }}" class="text-xs text-[#E52E2E] font-bold hover:underline">View Menu &rarr;</a>
                    </div>

                    <div class="space-y-3">
                        <template x-for="(item, index) in items" :key="item.id">
                            <div class="p-3 rounded-2xl border-2 border-stone-200/80 bg-[#FCF8F5]/50 flex items-center justify-between gap-3 hover:bg-white hover:border-[#E52E2E]/70 transition-all">
                                <div class="flex items-center gap-3">
                                    <img :src="item.img" :alt="item.name" class="w-12 h-12 rounded-xl object-cover border border-stone-200/70 flex-shrink-0">
                                    <div>
                                        <h3 class="font-bold text-xs text-[#1E1E1E]" x-text="item.name"></h3>
                                        <span class="font-extrabold text-xs text-[#E52E2E]" x-text="formatTshs(item.price)"></span>
                                    </div>
                                </div>

                                <!-- Quantity Controls with Classic Borders -->
                                <div class="flex items-center gap-2 bg-white rounded-full border-2 border-stone-200 px-2 py-1 shadow-xs">
                                    <button type="button" @click="decrement(index)" class="w-5 h-5 rounded-full bg-stone-100 hover:bg-[#E52E2E] hover:text-white flex items-center justify-center text-xs font-bold transition">-</button>
                                    <span class="text-xs font-bold w-4 text-center" x-text="item.qty"></span>
                                    <button type="button" @click="increment(index)" class="w-5 h-5 rounded-full bg-[#E52E2E] text-white flex items-center justify-center text-xs font-bold transition shadow-xs">+</button>
                                </div>
                            </div>
                        </template>

                        <!-- Hidden Inputs for Form Submission -->
                        <template x-for="item in items" :key="'hidden-' + item.id">
                            <input type="hidden" :name="'items[' + item.id + ']'" :value="item.qty" x-if="item.qty > 0">
                        </template>
                    </div>
                </div>

                <!-- 2. Customer & Delivery Information with Classic Modified Border -->
                <div class="bg-white rounded-3xl p-5 sm:p-6 border-2 border-stone-200/85 shadow-sm space-y-4">
                    <h2 class="text-base font-extrabold text-[#1E1E1E] flex items-center gap-2 border-b border-stone-200/70 pb-3">
                        <span class="w-6 h-6 rounded-full bg-[#E52E2E] text-white text-xs flex items-center justify-center font-bold border border-white/50">2</span>
                        <span>Delivery Information</span>
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div>
                            <label class="block font-bold text-stone-700 mb-1">Full Name *</label>
                            <input type="text" name="customer_name" required placeholder="e.g. Sophie Miller" value="{{ Auth::user()?->name ?? old('customer_name') }}"
                                   class="w-full px-4 py-2.5 rounded-xl border-2 border-stone-200/90 focus:outline-none focus:border-[#E52E2E]">
                        </div>
                        <div>
                            <label class="block font-bold text-stone-700 mb-1">Phone Number (WhatsApp) *</label>
                            <input type="text" name="customer_phone" required placeholder="e.g. +255 768 123 456" value="{{ old('customer_phone') }}"
                                   class="w-full px-4 py-2.5 rounded-xl border-2 border-stone-200/90 focus:outline-none focus:border-[#E52E2E]">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block font-bold text-stone-700 mb-1">Delivery Address *</label>
                            <input type="text" name="delivery_address" required placeholder="Street name, house/office number, landmarks" value="{{ old('delivery_address') }}"
                                   class="w-full px-4 py-2.5 rounded-xl border-2 border-stone-200/90 focus:outline-none focus:border-[#E52E2E]">
                        </div>
                        <div>
                            <label class="block font-bold text-stone-700 mb-1">City *</label>
                            <input type="text" name="delivery_city" required value="Dar es Salaam"
                                   class="w-full px-4 py-2.5 rounded-xl border-2 border-stone-200/90 focus:outline-none focus:border-[#E52E2E]">
                        </div>
                        <div>
                            <label class="block font-bold text-stone-700 mb-1">Area / Neighborhood *</label>
                            <input type="text" name="delivery_area" required placeholder="e.g. Oysterbay / Masaki / City Center" value="{{ old('delivery_area', 'Oysterbay') }}"
                                   class="w-full px-4 py-2.5 rounded-xl border-2 border-stone-200/90 focus:outline-none focus:border-[#E52E2E]">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block font-bold text-stone-700 mb-1">Order Notes (Optional)</label>
                            <textarea name="notes" rows="2" placeholder="e.g. Extra napkins, no pickles, please call upon arrival"
                                      class="w-full px-4 py-2 rounded-xl border-2 border-stone-200/90 focus:outline-none focus:border-[#E52E2E]"></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Area: Order Summary & Instant Checkout with Classic Modified Border (5 cols) -->
            <div class="lg:col-span-5 space-y-5 sticky top-24">
                
                <div class="bg-white rounded-3xl p-6 border-2 border-red-200/90 shadow-[0_8px_30px_rgba(255,107,0,0.08)] ring-4 ring-red-100/40 space-y-5">
                    <h2 class="text-base font-extrabold text-[#1E1E1E] flex items-center justify-between border-b border-stone-200/70 pb-3">
                        <span>Order Summary</span>
                        <span class="text-xs text-stone-400 font-normal">Fresh Delivery</span>
                    </h2>

                    <!-- Calculation table -->
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between text-stone-600">
                            <span>Subtotal</span>
                            <span class="font-bold text-stone-900" x-text="formatTshs(subtotal)"></span>
                        </div>
                        <div class="flex justify-between text-stone-600">
                            <span>Delivery Fee</span>
                            <span class="font-bold text-emerald-600" x-text="deliveryFee === 0 ? 'FREE' : formatTshs(deliveryFee)"></span>
                        </div>
                        <div class="pt-2 border-t border-stone-200/70 flex justify-between text-sm">
                            <span class="font-black text-[#1E1E1E]">Total Amount</span>
                            <span class="font-black text-[#E52E2E] text-base" x-text="formatTshs(total)"></span>
                        </div>
                    </div>

                    <!-- Payment Method with Classic Borders -->
                    <div class="space-y-2 pt-2 border-t border-stone-200/70">
                        <label class="block text-xs font-bold text-stone-700">Choose Payment Method</label>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border-2 border-stone-200/90 cursor-pointer hover:border-[#E52E2E] transition"
                                   :class="paymentMethod === 'mpesa' ? 'border-[#E52E2E] bg-red-50/50' : ''">
                                <input type="radio" name="payment_method" value="mpesa" x-model="paymentMethod" checked class="text-[#E52E2E]">
                                <span class="font-semibold">M-Pesa / Tigo</span>
                            </label>
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border-2 border-stone-200/90 cursor-pointer hover:border-[#E52E2E] transition"
                                   :class="paymentMethod === 'cod' ? 'border-[#E52E2E] bg-red-50/50' : ''">
                                <input type="radio" name="payment_method" value="cod" x-model="paymentMethod" class="text-[#E52E2E]">
                                <span class="font-semibold">Cash on Delivery</span>
                            </label>
                        </div>
                        <input type="hidden" name="delivery_method" value="dar_express">
                    </div>

                    <!-- Actions -->
                    <div class="space-y-2 pt-2">
                        <button type="submit" 
                                :disabled="subtotal === 0"
                                class="w-full py-3.5 rounded-full bg-[#E52E2E] hover:bg-[#C61A1A] disabled:opacity-50 text-white font-extrabold text-xs uppercase tracking-wider transition shadow-md shadow-red-500/25 border-2 border-white/40 ring-2 ring-red-300/30 flex items-center justify-center gap-2">
                            <span>Place Order Now</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>

                        <button type="button" 
                                @click="sendToWhatsApp()"
                                class="w-full py-3.5 rounded-full bg-[#25D366] hover:bg-[#20ba5a] text-white font-extrabold text-xs transition flex items-center justify-center gap-2 shadow-md shadow-emerald-500/20 border-2 border-white/50 active:scale-95">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Tuma Oda WhatsApp Moja kwa Moja (06621990)</span>
                        </button>
                    </div>

                    <!-- Trust checklist -->
                    <div class="pt-3 border-t border-stone-100 flex items-center justify-between text-[11px] text-stone-500">
                        <span class="flex items-center gap-1">✓ Made Fresh</span>
                        <span class="flex items-center gap-1">✓ Fast Thermal Delivery</span>
                        <span class="flex items-center gap-1">✓ 100% Halal</span>
                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection
