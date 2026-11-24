@extends('layouts.app')

@section('title', 'Checkout & Delivery | INAS Premium Beef Biltong')

@section('content')

    <!-- Header Banner -->
    <section class="py-12 bg-brand-charcoal border-b border-brand-border text-center">
        <div class="max-w-4xl mx-auto px-4 space-y-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-red/20 text-brand-red border border-brand-red/30">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-red"></span>
                Secure Checkout & Dispatch
            </span>
            <h1 class="font-editorial text-3xl sm:text-5xl font-bold text-white tracking-wide">
                Checkout Your Order
            </h1>
            <p class="text-xs sm:text-sm text-zinc-400">Direct dispatch from our facility at Buguruni Malapa, Dar es Salaam</p>
        </div>
    </section>

    <!-- Main Checkout Section -->
    <section class="py-14 bg-zinc-100 text-zinc-900" x-data="{
        deliveryMethod: 'dar_express',
        customerName: '',
        customerPhone: '',
        customerEmail: '',
        deliveryArea: 'Buguruni / Malapa',
        deliveryAddress: '',
        orderNotes: '',
        paymentMethod: 'mpesa',
        
        get deliveryFee() {
            if (this.deliveryMethod === 'pickup') return 0;
            if (this.deliveryMethod === 'upcountry') return 12000;
            // dar_express: free over 50k
            return $store.cart.subtotal >= 50000 ? 0 : 5000;
        },

        get orderTotal() {
            return $store.cart.subtotal + this.deliveryFee;
        },

        get formattedOrderTotal() {
            return 'TZS ' + Number(this.orderTotal).toLocaleString();
        },

        get cartPayload() {
            return JSON.stringify($store.cart.items);
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- If cart is empty -->
            <div x-show="$store.cart.items.length === 0" class="text-center py-20 bg-white rounded-3xl border border-zinc-200 shadow-sm p-8 space-y-4">
                <div class="w-16 h-16 mx-auto rounded-full bg-red-50 text-brand-red flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-zinc-900">Your bag is currently empty</h3>
                <p class="text-zinc-500 text-sm max-w-sm mx-auto">Select from our freshly cured biltong cuts before proceeding to checkout.</p>
                <a href="{{ route('shop') }}" class="px-7 py-3.5 rounded-full bg-brand-red hover:bg-brand-red-dark text-white font-bold text-sm inline-block shadow-md transition">
                    Explore Our Biltong Cuts
                </a>
            </div>

            <!-- Checkout Form -->
            <form x-show="$store.cart.items.length > 0" 
                  action="{{ route('checkout.process') }}" 
                  method="POST" 
                  class="grid grid-cols-1 lg:grid-cols-12 gap-8"
                  style="display: none;">
                @csrf
                <input type="hidden" name="cart_data" :value="cartPayload">

                <!-- Left: Customer Information & Delivery Address -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <!-- 1. Customer Contact Details -->
                    <div class="p-6 sm:p-8 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-zinc-100">
                            <span class="w-8 h-8 rounded-full bg-brand-red text-white font-bold text-xs flex items-center justify-center shadow">1</span>
                            <h2 class="font-editorial text-2xl font-bold text-zinc-900">Customer Information</h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Full Name *</label>
                                <input type="text" name="customer_name" x-model="customerName" required placeholder="e.g. Juma Hamisi"
                                       class="w-full px-4 py-3 rounded-xl bg-zinc-50 border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-brand-red focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                            </div>

                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Phone / WhatsApp *</label>
                                <input type="tel" name="customer_phone" x-model="customerPhone" required placeholder="e.g. 0754 000 000"
                                       class="w-full px-4 py-3 rounded-xl bg-zinc-50 border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-brand-red focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Email Address (Optional)</label>
                            <input type="email" name="customer_email" x-model="customerEmail" placeholder="e.g. juma@example.com"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-50 border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-brand-red focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                        </div>
                    </div>

                    <!-- 2. Delivery Method & Destination -->
                    <div class="p-6 sm:p-8 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-zinc-100">
                            <span class="w-8 h-8 rounded-full bg-brand-red text-white font-bold text-xs flex items-center justify-center shadow">2</span>
                            <h2 class="font-editorial text-2xl font-bold text-zinc-900">Delivery Method & Location</h2>
                        </div>

                        <!-- Method Selector Radio Cards -->
                        <div class="space-y-3">
                            <label class="block p-4 rounded-xl border cursor-pointer transition"
                                   :class="deliveryMethod === 'dar_express' ? 'bg-red-50/60 border-brand-red ring-2 ring-brand-red' : 'bg-white border-zinc-200 hover:border-zinc-300'">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="delivery_method" value="dar_express" x-model="deliveryMethod" class="text-brand-red focus:ring-brand-red accent-brand-red">
                                        <div>
                                            <span class="block text-sm font-bold text-zinc-900">Dar es Salaam Express Delivery</span>
                                            <span class="text-xs text-zinc-500">Fast motorcycle/van delivery right to your doorstep</span>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold" 
                                          :class="$store.cart.subtotal >= 50000 ? 'text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full' : 'text-brand-red font-bold'"
                                          x-text="$store.cart.subtotal >= 50000 ? 'FREE' : 'TZS 5,000'">
                                    </span>
                                </div>
                            </label>

                            <label class="block p-4 rounded-xl border cursor-pointer transition"
                                   :class="deliveryMethod === 'pickup' ? 'bg-red-50/60 border-brand-red ring-2 ring-brand-red' : 'bg-white border-zinc-200 hover:border-zinc-300'">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="delivery_method" value="pickup" x-model="deliveryMethod" class="text-brand-red focus:ring-brand-red accent-brand-red">
                                        <div>
                                            <span class="block text-sm font-bold text-zinc-900">Pick-up at Buguruni Malapa</span>
                                            <span class="text-xs text-zinc-500">Collect fresh at our production facility in Dar es Salaam</span>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">FREE</span>
                                </div>
                            </label>

                            <label class="block p-4 rounded-xl border cursor-pointer transition"
                                   :class="deliveryMethod === 'upcountry' ? 'bg-red-50/60 border-brand-red ring-2 ring-brand-red' : 'bg-white border-zinc-200 hover:border-zinc-300'">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="delivery_method" value="upcountry" x-model="deliveryMethod" class="text-brand-red focus:ring-brand-red accent-brand-red">
                                        <div>
                                            <span class="block text-sm font-bold text-zinc-900">Upcountry Regional Parcel Dispatch</span>
                                            <span class="text-xs text-zinc-500">Arusha, Dodoma, Mwanza, Zanzibar, Mbeya, Morogoro via bus/air</span>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-zinc-900">TZS 12,000</span>
                                </div>
                            </label>
                        </div>

                        <!-- Address Inputs -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">City / Region *</label>
                                <input type="text" name="delivery_city" value="Dar es Salaam" required
                                       class="w-full px-4 py-3 rounded-xl bg-zinc-50 border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-brand-red focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                            </div>

                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">District / Area *</label>
                                <select name="delivery_area" x-model="deliveryArea" class="w-full px-4 py-3 rounded-xl bg-zinc-50 border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-brand-red focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                                    <option value="Buguruni / Malapa">Buguruni / Malapa</option>
                                    <option value="Masaki / Peninsula">Masaki / Peninsula</option>
                                    <option value="Oysterbay">Oysterbay</option>
                                    <option value="Mikocheni A / B">Mikocheni A / B</option>
                                    <option value="Upanga">Upanga</option>
                                    <option value="City Centre / Posta">City Centre / Posta</option>
                                    <option value="Ilala">Ilala</option>
                                    <option value="Kinondoni">Kinondoni</option>
                                    <option value="Sinza">Sinza</option>
                                    <option value="Mwenge / Mlimani">Mwenge / Mlimani</option>
                                    <option value="Mbezi Beach / Tegeta">Mbezi Beach / Tegeta</option>
                                    <option value="Kigamboni">Kigamboni</option>
                                    <option value="Other Area (Specify in Address)">Other Area (Specify below)</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Delivery Address / Landmark *</label>
                            <textarea name="delivery_address" x-model="deliveryAddress" rows="2" required placeholder="e.g. Plot 24, Chole Road near Shoppers Plaza, or House / Office details"
                                      class="w-full px-4 py-3 rounded-xl bg-zinc-50 border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-brand-red focus:ring-1 focus:ring-brand-red focus:outline-none transition"></textarea>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Delivery Notes / Preferences</label>
                            <input type="text" name="notes" x-model="orderNotes" placeholder="e.g. Call before arrival, leave at reception"
                                   class="w-full px-4 py-3 rounded-xl bg-zinc-50 border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-brand-red focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                        </div>
                    </div>

                    <!-- 3. Tanzanian Payment Methods -->
                    <div class="p-6 sm:p-8 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-zinc-100">
                            <span class="w-8 h-8 rounded-full bg-brand-red text-white font-bold text-xs flex items-center justify-center shadow">3</span>
                            <h2 class="font-editorial text-2xl font-bold text-zinc-900">Payment Option</h2>
                        </div>

                        <div class="space-y-3">
                            <!-- M-Pesa -->
                            <label class="block p-4 rounded-xl border cursor-pointer transition"
                                   :class="paymentMethod === 'mpesa' ? 'bg-red-50/60 border-brand-red ring-2 ring-brand-red' : 'bg-white border-zinc-200 hover:border-zinc-300'">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="payment_method" value="mpesa" x-model="paymentMethod" class="text-brand-red focus:ring-brand-red accent-brand-red">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="block text-sm font-bold text-zinc-900">Vodacom M-Pesa (Lipa Namba / Till)</span>
                                            <span class="text-[10px] font-bold uppercase tracking-wider bg-red-100 text-brand-red px-2 py-0.5 rounded">Popular</span>
                                        </div>
                                        <span class="text-xs text-zinc-500">Direct mobile prompt / till transfer upon confirmation</span>
                                    </div>
                                </div>
                            </label>

                            <!-- Tigo Pesa -->
                            <label class="block p-4 rounded-xl border cursor-pointer transition"
                                   :class="paymentMethod === 'tigopesa' ? 'bg-red-50/60 border-brand-red ring-2 ring-brand-red' : 'bg-white border-zinc-200 hover:border-zinc-300'">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="payment_method" value="tigopesa" x-model="paymentMethod" class="text-brand-red focus:ring-brand-red accent-brand-red">
                                    <div>
                                        <span class="block text-sm font-bold text-zinc-900">Tigo Pesa (Mixx by Yas)</span>
                                        <span class="text-xs text-zinc-500">Fast Tigo mobile money merchant payment</span>
                                    </div>
                                </div>
                            </label>

                            <!-- Airtel Money -->
                            <label class="block p-4 rounded-xl border cursor-pointer transition"
                                   :class="paymentMethod === 'airtel' ? 'bg-red-50/60 border-brand-red ring-2 ring-brand-red' : 'bg-white border-zinc-200 hover:border-zinc-300'">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="payment_method" value="airtel" x-model="paymentMethod" class="text-brand-red focus:ring-brand-red accent-brand-red">
                                    <div>
                                        <span class="block text-sm font-bold text-zinc-900">Airtel Money</span>
                                        <span class="text-xs text-zinc-500">Airtel merchant wallet transfer</span>
                                    </div>
                                </div>
                            </label>

                            <!-- Halopesa -->
                            <label class="block p-4 rounded-xl border cursor-pointer transition"
                                   :class="paymentMethod === 'halopesa' ? 'bg-red-50/60 border-brand-red ring-2 ring-brand-red' : 'bg-white border-zinc-200 hover:border-zinc-300'">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="payment_method" value="halopesa" x-model="paymentMethod" class="text-brand-red focus:ring-brand-red accent-brand-red">
                                    <div>
                                        <span class="block text-sm font-bold text-zinc-900">Halopesa</span>
                                        <span class="text-xs text-zinc-500">Halotel mobile money transfer</span>
                                    </div>
                                </div>
                            </label>

                            <!-- Cash on Delivery -->
                            <label class="block p-4 rounded-xl border cursor-pointer transition"
                                   :class="paymentMethod === 'cash_on_delivery' ? 'bg-red-50/60 border-brand-red ring-2 ring-brand-red' : 'bg-white border-zinc-200 hover:border-zinc-300'">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="payment_method" value="cash_on_delivery" x-model="paymentMethod" class="text-brand-red focus:ring-brand-red accent-brand-red">
                                    <div>
                                        <span class="block text-sm font-bold text-zinc-900">Cash on Delivery / Direct Bank Transfer</span>
                                        <span class="text-xs text-zinc-500">Pay courier rider directly upon inspecting sealed pouch</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Right: Order Summary & Placement -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="p-6 sm:p-8 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-6 sticky top-28">
                        <div class="flex items-center justify-between pb-4 border-b border-zinc-100">
                            <h3 class="font-editorial text-2xl font-bold text-zinc-900">
                                Order Summary
                            </h3>
                            <span class="px-2.5 py-1 rounded-full bg-brand-red text-white text-xs font-bold" x-text="$store.cart.count + ' items'"></span>
                        </div>

                        <!-- Items in cart preview -->
                        <div class="space-y-3 max-h-60 overflow-y-auto pr-1 divide-y divide-zinc-100">
                            <template x-for="item in $store.cart.items" :key="item.id + '-' + item.pack_size">
                                <div class="pt-3 first:pt-0 flex items-center justify-between text-xs">
                                    <div class="flex items-center gap-3">
                                        <img :src="item.image" :alt="item.name" class="w-12 h-12 rounded-lg object-cover bg-zinc-100 border border-zinc-200">
                                        <div>
                                            <span class="font-bold text-zinc-900 block" x-text="item.name"></span>
                                            <span class="text-zinc-500 font-medium" x-text="item.pack_size + ' × ' + item.quantity"></span>
                                        </div>
                                    </div>
                                    <span class="font-bold text-zinc-900" x-text="'TZS ' + Number(item.price * item.quantity).toLocaleString()"></span>
                                </div>
                            </template>
                        </div>

                        <!-- Calculations -->
                        <div class="space-y-3 text-sm border-t border-zinc-100 pt-4">
                            <div class="flex justify-between text-zinc-600">
                                <span>Bag Subtotal</span>
                                <span class="font-bold text-zinc-900" x-text="$store.cart.formattedSubtotal"></span>
                            </div>
                            <div class="flex justify-between text-zinc-600">
                                <span>Delivery Fee</span>
                                <span class="font-bold" 
                                      :class="deliveryFee === 0 ? 'text-emerald-600' : 'text-zinc-900'"
                                      x-text="deliveryFee === 0 ? 'FREE' : 'TZS ' + Number(deliveryFee).toLocaleString()">
                                </span>
                            </div>
                        </div>

                        <!-- Grand Total -->
                        <div class="flex justify-between items-baseline border-t border-zinc-200 pt-4 bg-zinc-50 -mx-6 -mb-6 p-6 rounded-b-2xl">
                            <div>
                                <span class="font-bold text-zinc-800 text-sm block">Total Payable</span>
                                <span class="text-[11px] text-zinc-500">VAT & packaging included</span>
                            </div>
                            <span class="font-editorial text-3xl font-extrabold text-brand-red" x-text="formattedOrderTotal"></span>
                        </div>

                        <!-- Submit Order Buttons -->
                        <div class="space-y-3 pt-4">
                            <button type="submit" 
                                    class="w-full py-4 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-sm shadow-lg hover:shadow-xl transition flex items-center justify-center gap-2 cursor-pointer">
                                <span>Confirm & Place Order</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </button>

                            <button type="button" 
                                    @click="window.open($store.cart.generateWhatsAppLink({
                                        name: customerName,
                                        phone: customerPhone,
                                        delivery_area: deliveryArea,
                                        notes: orderNotes
                                    }), '_blank')"
                                    class="w-full py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow transition flex items-center justify-center gap-2 cursor-pointer">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                <span>Order Directly via WhatsApp</span>
                            </button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </section>

@endsection
