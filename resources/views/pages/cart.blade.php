@extends('layouts.app')

@section('title', 'Your Gourmet Bag | INAS Premium Beef Biltong')

@section('content')

    <section class="py-14 bg-brand-black border-b border-zinc-800 text-center">
        <div class="max-w-4xl mx-auto px-4 space-y-2">
            <span class="text-xs uppercase tracking-widest text-brand-red font-black">Review Your Cuts</span>
            <h1 class="font-editorial text-3xl sm:text-5xl font-extrabold text-white">
                Your Gourmet Bag
            </h1>
        </div>
    </section>

    <section class="py-16 bg-zinc-50 text-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Empty state -->
            <div x-show="$store.cart.items.length === 0" class="text-center py-20 space-y-6">
                <div class="w-20 h-20 mx-auto rounded-full bg-white flex items-center justify-center text-zinc-400 border border-zinc-200 shadow-sm">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <h2 class="font-editorial text-2xl font-bold text-zinc-900">Your bag is currently empty</h2>
                <p class="text-sm text-zinc-500 max-w-md mx-auto">
                    Explore our range of small-batch pasture beef biltong, whole slabs, and traditional droëwors.
                </p>
                <a href="{{ route('shop') }}" class="inline-block px-8 py-3.5 rounded-xl bg-brand-red text-white font-bold text-xs uppercase tracking-wider hover:bg-brand-red-dark transition shadow-lg">
                    Explore Catalogue
                </a>
            </div>

            <!-- Filled Bag state -->
            <div x-show="$store.cart.items.length > 0" class="grid grid-cols-1 lg:grid-cols-12 gap-12" style="display: none;">
                
                <!-- Items list -->
                <div class="lg:col-span-8 space-y-4">
                    <!-- Delivery progress bar -->
                    <div class="p-4 rounded-2xl bg-white border border-zinc-200 shadow-sm">
                        <div class="flex items-center justify-between text-xs mb-2">
                            <span x-show="$store.cart.freeDeliveryRemaining > 0" class="text-zinc-700 font-medium">
                                Add <strong class="text-brand-red">TZS <span x-text="Number($store.cart.freeDeliveryRemaining).toLocaleString()"></span></strong> to unlock <span class="text-brand-red font-bold">FREE Dar es Salaam Delivery</span>
                            </span>
                            <span x-show="$store.cart.freeDeliveryRemaining === 0" class="text-emerald-600 font-bold flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Qualified for FREE Dar Delivery!
                            </span>
                        </div>
                        <div class="w-full bg-zinc-200 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-brand-red to-brand-red-light h-2 rounded-full transition-all duration-500"
                                 :style="`width: ${$store.cart.freeDeliveryProgress}%`"></div>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="rounded-2xl bg-white border border-zinc-200 divide-y divide-zinc-200 overflow-hidden shadow-sm">
                        <template x-for="item in $store.cart.items" :key="item.id + '-' + item.pack_size">
                            <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 hover:bg-zinc-50 transition">
                                <div class="flex items-center gap-4">
                                    <img :src="item.image" :alt="item.name" class="w-20 h-20 rounded-xl object-cover bg-zinc-100 border border-zinc-200 flex-shrink-0">
                                    <div>
                                        <h3 class="font-bold text-zinc-900 text-base" x-text="item.name"></h3>
                                        <span class="text-xs text-brand-red font-bold uppercase tracking-wider block" x-text="'Pack: ' + item.pack_size"></span>
                                        <span class="text-xs text-zinc-500 font-medium" x-text="'Unit: TZS ' + Number(item.price).toLocaleString()"></span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between w-full sm:w-auto gap-6">
                                    <!-- Stepper -->
                                    <div class="flex items-center border border-zinc-300 rounded-xl bg-white p-1">
                                        <button @click="$store.cart.updateQuantity(item.id, item.pack_size, -1)" class="w-8 h-8 flex items-center justify-center text-zinc-600 hover:text-black font-black transition">−</button>
                                        <span class="w-8 text-center text-xs font-bold text-zinc-900" x-text="item.quantity"></span>
                                        <button @click="$store.cart.updateQuantity(item.id, item.pack_size, 1)" class="w-8 h-8 flex items-center justify-center text-zinc-600 hover:text-black font-black transition">+</button>
                                    </div>

                                    <!-- Line total -->
                                    <span class="text-base font-black text-brand-red min-w-[100px] text-right" x-text="'TZS ' + Number(item.price * item.quantity).toLocaleString()"></span>

                                    <!-- Remove -->
                                    <button @click="$store.cart.removeItem(item.id, item.pack_size)" class="text-zinc-400 hover:text-brand-red p-2 transition" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="flex justify-between items-center pt-2">
                        <a href="{{ route('shop') }}" class="text-xs font-bold text-brand-red hover:underline flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            <span>Add More Cuts from Shop</span>
                        </a>
                        <button @click="$store.cart.clearCart()" class="text-xs text-zinc-400 hover:text-brand-red transition">
                            Clear Entire Bag
                        </button>
                    </div>
                </div>

                <!-- Summary Panel -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="p-8 rounded-2xl bg-white border border-zinc-200 shadow-md space-y-6 sticky top-28">
                        <h3 class="font-editorial text-2xl font-bold text-zinc-900">Order Summary</h3>

                        <div class="space-y-3 text-sm border-b border-zinc-200 pb-6">
                            <div class="flex justify-between text-zinc-600">
                                <span>Bag Subtotal</span>
                                <span class="font-bold text-zinc-900" x-text="$store.cart.formattedSubtotal"></span>
                            </div>
                            <div class="flex justify-between text-zinc-600">
                                <span>Estimated Dar Delivery</span>
                                <span x-text="$store.cart.subtotal >= 50000 ? 'FREE' : 'TZS 5,000'" 
                                      :class="$store.cart.subtotal >= 50000 ? 'text-emerald-600 font-bold' : 'text-zinc-900 font-bold'"></span>
                            </div>
                        </div>

                        <div class="flex justify-between items-baseline text-base">
                            <span class="font-bold text-zinc-900">Estimated Total</span>
                            <span class="font-editorial text-2xl font-black text-brand-red" 
                                  x-text="'TZS ' + Number($store.cart.subtotal + ($store.cart.subtotal >= 50000 ? 0 : 5000)).toLocaleString()"></span>
                        </div>

                        <div class="space-y-3 pt-2">
                            <a href="{{ route('checkout') }}" 
                               class="w-full py-4 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs uppercase tracking-wider shadow-lg transition flex items-center justify-center gap-2">
                                <span>Proceed to Delivery & Checkout</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>

                            <button @click="window.open($store.cart.generateWhatsAppLink(), '_blank')" 
                                    class="w-full py-3 rounded-xl bg-zinc-900 text-white font-semibold text-xs hover:bg-zinc-800 transition flex items-center justify-center gap-2">
                                <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                <span>Instant 1-Click WhatsApp Order</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection
