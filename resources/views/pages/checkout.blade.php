@extends('layouts.app')

@section('title', 'Secure Checkout | COY BILTONG')

@section('content')

<div class="bg-[#171717] text-white py-8 border-b border-[#262626]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display font-extrabold text-2xl sm:text-3xl text-white">Checkout & Delivery Details</h1>
        <p class="text-xs text-stone-300 mt-1">Provide your delivery location and preferred mobile or bank payment option.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"
     x-data="{
         deliveryMethod: '{{ request('delivery_method', 'dar_express') }}',
         paymentMethod: 'mpesa',
         isWhatsappOrder: true,
         fillSavedAddress(addr) {
             document.getElementById('recipient_name').value = addr.recipient_name;
             document.getElementById('customer_phone').value = addr.phone;
             document.getElementById('delivery_city').value = addr.city;
             document.getElementById('delivery_area').value = addr.area;
             document.getElementById('delivery_address').value = addr.address_line;
         }
     }">

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <input type="hidden" name="delivery_method" :value="deliveryMethod">
        <input type="hidden" name="order_type" :value="isWhatsappOrder ? 'whatsapp' : 'standard'">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Left Form Details (8 cols) -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Guest vs Registered Banner -->
                @guest
                    <div class="bg-white p-5 rounded-2xl border border-[#ECE2D2] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                        <div>
                            <span class="font-bold text-[#171717]">Already have an account?</span>
                            <span class="text-stone-500 ml-1">Sign in for faster checkout with saved delivery addresses.</span>
                        </div>
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-[#F6F0E6] hover:bg-[#B77B3B] hover:text-white text-[#171717] rounded-xl font-bold transition">
                            Sign In
                        </a>
                    </div>
                @endguest

                <!-- Saved Addresses Picker (for logged in customers) -->
                @if(isset($savedAddresses) && $savedAddresses->count() > 0)
                    <div class="bg-white p-6 rounded-3xl border border-[#ECE2D2] shadow-xs">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#68734B]">Saved Addresses</span>
                        <h3 class="font-display font-bold text-lg text-[#171717] mt-1 mb-4">Select a Delivery Location</h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($savedAddresses as $addr)
                                <button type="button" 
                                        @click="fillSavedAddress({{ json_encode($addr) }})" 
                                        class="p-4 rounded-xl border border-[#ECE2D2] hover:border-[#B77B3B] text-left transition bg-[#FCF9F4] flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold text-xs text-[#171717]">{{ $addr->label }}</span>
                                            @if($addr->is_default)
                                                <span class="text-[10px] bg-[#B77B3B] text-white px-1.5 py-0.5 rounded">Default</span>
                                            @endif
                                        </div>
                                        <p class="text-xs text-stone-600 mt-1 font-semibold">{{ $addr->recipient_name }} ({{ $addr->phone }})</p>
                                        <p class="text-[11px] text-stone-500 mt-1">{{ $addr->address_line }}, {{ $addr->area }}, {{ $addr->city }}</p>
                                    </div>
                                    <span class="text-[10px] text-[#B77B3B] font-bold mt-2">Click to Use This Address →</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Section 1: Customer Contact Details -->
                <div class="bg-white p-8 rounded-3xl border border-[#ECE2D2] shadow-xs">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#68734B]">Step 1</span>
                    <h3 class="font-display font-bold text-xl text-[#171717] mt-1 mb-6">Customer Contact Information</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Full Name *</label>
                            <input type="text" 
                                   id="recipient_name"
                                   name="customer_name" 
                                   value="{{ old('customer_name', $user?->name) }}" 
                                   required 
                                   placeholder="e.g. Neema Mushi" 
                                   class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Phone Number (M-Pesa/Mobile) *</label>
                            <input type="text" 
                                   id="customer_phone"
                                   name="customer_phone" 
                                   value="{{ old('customer_phone', $user?->phone) }}" 
                                   required 
                                   placeholder="+255 7XX XXX XXX" 
                                   class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Email Address (Optional, for confirmation receipt)</label>
                        <input type="email" 
                               name="customer_email" 
                               value="{{ old('customer_email', $user?->email) }}" 
                               placeholder="your.email@example.com" 
                               class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                    </div>
                </div>

                <!-- Section 2: Delivery Destination -->
                <div class="bg-white p-8 rounded-3xl border border-[#ECE2D2] shadow-xs">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#68734B]">Step 2</span>
                    <h3 class="font-display font-bold text-xl text-[#171717] mt-1 mb-6">Delivery Address</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">City / Region *</label>
                            <select id="delivery_city" 
                                    name="delivery_city" 
                                    required 
                                    class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                                <option value="Dar es Salaam" selected>Dar es Salaam</option>
                                <option value="Arusha">Arusha</option>
                                <option value="Dodoma">Dodoma</option>
                                <option value="Mwanza">Mwanza</option>
                                <option value="Zanzibar">Zanzibar</option>
                                <option value="Morogoro">Morogoro</option>
                                <option value="Kilimanjaro / Moshi">Kilimanjaro / Moshi</option>
                                <option value="Other Regional City">Other Regional City</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Area / Ward / Neighborhood *</label>
                            <input type="text" 
                                   id="delivery_area"
                                   name="delivery_area" 
                                   value="{{ old('delivery_area') }}" 
                                   required 
                                   placeholder="e.g. Masaki, Mikocheni, Sinza, Upanga..." 
                                   class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Street Address / Building / Landmark *</label>
                        <input type="text" 
                               id="delivery_address"
                               name="delivery_address" 
                               value="{{ old('delivery_address') }}" 
                               required 
                               placeholder="e.g. Plot 12 Haile Selassie Road, Opp. Golden Tulip" 
                               class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Special Order & Delivery Notes (Optional)</label>
                        <textarea name="notes" rows="2" placeholder="e.g. Gate code, deliver after 2 PM, extra serviettes..." class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B] text-[#171717]">{{ old('notes') }}</textarea>
                    </div>

                    @auth
                        <div class="mt-4 flex items-center gap-2">
                            <input type="checkbox" name="save_address" value="1" id="save_address" class="w-4 h-4 text-[#B77B3B] rounded">
                            <label for="save_address" class="text-xs text-stone-600">Save this address to my profile for future orders</label>
                        </div>
                    @endauth
                </div>

                <!-- Section 3: Payment Method Selection -->
                <div class="bg-white p-8 rounded-3xl border border-[#ECE2D2] shadow-xs">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#68734B]">Step 3</span>
                    <h3 class="font-display font-bold text-xl text-[#171717] mt-1 mb-2">Select Payment Method</h3>
                    <p class="text-xs text-stone-500 mb-6">Payment instructions will be provided immediately upon placing the order.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        
                        <!-- M-Pesa -->
                        <label class="relative p-4 rounded-2xl border-2 cursor-pointer transition flex flex-col justify-between"
                               :class="paymentMethod === 'mpesa' ? 'border-[#B77B3B] bg-[#FCF9F4]' : 'border-[#ECE2D2] hover:border-stone-400 bg-white'">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-sm text-[#171717]">Vodacom M-Pesa</span>
                                <input type="radio" name="payment_method" value="mpesa" x-model="paymentMethod" class="text-[#B77B3B]">
                            </div>
                            <span class="text-[11px] text-stone-500 mt-2">Lipa Namba / Till 5821940</span>
                        </label>

                        <!-- Airtel Money -->
                        <label class="relative p-4 rounded-2xl border-2 cursor-pointer transition flex flex-col justify-between"
                               :class="paymentMethod === 'airtel_money' ? 'border-[#B77B3B] bg-[#FCF9F4]' : 'border-[#ECE2D2] hover:border-stone-400 bg-white'">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-sm text-[#171717]">Airtel Money</span>
                                <input type="radio" name="payment_method" value="airtel_money" x-model="paymentMethod" class="text-[#B77B3B]">
                            </div>
                            <span class="text-[11px] text-stone-500 mt-2">Airtel Pay 7192301</span>
                        </label>

                        <!-- Tigo Pesa -->
                        <label class="relative p-4 rounded-2xl border-2 cursor-pointer transition flex flex-col justify-between"
                               :class="paymentMethod === 'tigo_pesa' ? 'border-[#B77B3B] bg-[#FCF9F4]' : 'border-[#ECE2D2] hover:border-stone-400 bg-white'">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-sm text-[#171717]">Tigo Pesa</span>
                                <input type="radio" name="payment_method" value="tigo_pesa" x-model="paymentMethod" class="text-[#B77B3B]">
                            </div>
                            <span class="text-[11px] text-stone-500 mt-2">Lipa Kwa Simu</span>
                        </label>

                        <!-- HaloPesa -->
                        <label class="relative p-4 rounded-2xl border-2 cursor-pointer transition flex flex-col justify-between"
                               :class="paymentMethod === 'halopesa' ? 'border-[#B77B3B] bg-[#FCF9F4]' : 'border-[#ECE2D2] hover:border-stone-400 bg-white'">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-sm text-[#171717]">HaloPesa</span>
                                <input type="radio" name="payment_method" value="halopesa" x-model="paymentMethod" class="text-[#B77B3B]">
                            </div>
                            <span class="text-[11px] text-stone-500 mt-2">Halotel Mobile Money</span>
                        </label>

                        <!-- Bank Transfer -->
                        <label class="relative p-4 rounded-2xl border-2 cursor-pointer transition flex flex-col justify-between"
                               :class="paymentMethod === 'bank' ? 'border-[#B77B3B] bg-[#FCF9F4]' : 'border-[#ECE2D2] hover:border-stone-400 bg-white'">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-sm text-[#171717]">Bank Transfer</span>
                                <input type="radio" name="payment_method" value="bank" x-model="paymentMethod" class="text-[#B77B3B]">
                            </div>
                            <span class="text-[11px] text-stone-500 mt-2">CRDB Bank Tanzania</span>
                        </label>

                        <!-- Cash on Delivery -->
                        <label class="relative p-4 rounded-2xl border-2 cursor-pointer transition flex flex-col justify-between"
                               :class="paymentMethod === 'cod' ? 'border-[#B77B3B] bg-[#FCF9F4]' : 'border-[#ECE2D2] hover:border-stone-400 bg-white'">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-sm text-[#171717]">Cash on Delivery</span>
                                <input type="radio" name="payment_method" value="cod" x-model="paymentMethod" class="text-[#B77B3B]">
                            </div>
                            <span class="text-[11px] text-stone-500 mt-2">Dar es Salaam only</span>
                        </label>

                    </div>

                    <!-- WhatsApp Checkout Integration Checkbox -->
                    <div class="mt-6 p-4 rounded-2xl bg-[#25D366]/10 border border-[#25D366]/30 flex items-start gap-3">
                        <input type="checkbox" 
                               id="whatsapp_checkout" 
                               name="whatsapp_checkout" 
                               value="1" 
                               x-model="isWhatsappOrder" 
                               class="mt-1 w-4 h-4 text-[#25D366] rounded">
                        <div>
                            <label for="whatsapp_checkout" class="font-bold text-xs text-[#128C7E] cursor-pointer">
                                Tuma oda na eneo ulipo WhatsApp (06621990)
                            </label>
                            <p class="text-[11px] text-stone-600 mt-0.5">
                                Inafungua WhatsApp mara moja ikiwa na maelezo kamili ya vyakula, jina, simu na eneo ulipo kwa uthibitisho wa papo hapo.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Order Summary Review (4 cols) -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-3xl border border-[#ECE2D2] p-6 shadow-xs sticky top-28">
                    <h3 class="font-display font-bold text-lg text-[#171717] pb-4 border-b border-[#ECE2D2]">
                        Order Review
                    </h3>

                    <!-- Cart Item Lines -->
                    <div class="mt-4 divide-y divide-[#ECE2D2] max-h-60 overflow-y-auto pr-1 text-xs">
                        @foreach($items as $item)
                            <div class="py-3 flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-[#F6F0E6] flex-shrink-0">
                                        <img src="{{ $item->product->image_url }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-bold text-[#171717] line-clamp-1">{{ $item->product->name }}</p>
                                        <p class="text-stone-400 text-[10px]">{{ $item->weight }} x {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <span class="font-bold text-[#171717] whitespace-nowrap">
                                    Tshs {{ number_format($item->subtotal, 0) }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Totals breakdown -->
                    <div class="mt-4 pt-4 border-t border-[#ECE2D2] space-y-2.5 text-xs">
                        <div class="flex justify-between text-stone-600">
                            <span>Subtotal</span>
                            <span class="font-bold text-[#171717]">Tshs {{ number_format($summary['subtotal'], 0) }}</span>
                        </div>
                        @if($summary['discount'] > 0)
                            <div class="flex justify-between text-emerald-700 font-semibold">
                                <span>Discount ({{ $summary['coupon_code'] }})</span>
                                <span>-Tshs {{ number_format($summary['discount'], 0) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-stone-600">
                            <span>Delivery Fee</span>
                            <span class="font-bold {{ $summary['delivery_fee'] == 0 ? 'text-emerald-700' : 'text-[#171717]' }}">
                                {{ $summary['delivery_fee'] == 0 ? 'FREE' : 'Tshs ' . number_format($summary['delivery_fee'], 0) }}
                            </span>
                        </div>
                        <div class="pt-3 border-t border-[#ECE2D2] flex justify-between items-baseline">
                            <span class="font-bold text-sm text-[#171717]">Total to Pay</span>
                            <span class="font-display font-extrabold text-2xl text-[#171717]">
                                Tshs {{ number_format($summary['total'], 0) }}
                            </span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" 
                                class="w-full bg-[#171717] hover:bg-[#B77B3B] text-white py-4 rounded-xl font-bold text-xs uppercase tracking-wider transition shadow-lg flex items-center justify-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-[#B77B3B]"></i>
                            <span x-text="isWhatsappOrder ? 'CONFIRM & SEND ON WHATSAPP' : 'CONFIRM & PLACE ORDER'"></span>
                        </button>
                    </div>

                    <p class="text-[11px] text-stone-400 text-center mt-3">
                        By placing your order you agree to our Terms & Conditions.
                    </p>
                </div>
            </div>

        </div>
    </form>
</div>

@endsection
