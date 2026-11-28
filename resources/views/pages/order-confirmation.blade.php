@extends('layouts.app')

@section('title', 'Order Received #' . $order->order_number . ' | COY BILTONG')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    
    <!-- Celebration Hero Card -->
    <div class="bg-white rounded-3xl border border-[#ECE2D2] p-8 sm:p-12 text-center shadow-sm">
        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center mx-auto mb-4">
            <i data-lucide="check" class="w-8 h-8"></i>
        </div>
        <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#68734B]">Order Placed Successfully</span>
        <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-[#171717] mt-1">
            Thank You, {{ $order->customer_name }}!
        </h1>
        <p class="text-sm text-stone-600 mt-2 max-w-md mx-auto">
            Your COY BILTONG order has been recorded. Our butchery kitchen is preparing your prime cuts for packaging.
        </p>

        <div class="inline-block mt-4 px-4 py-2 bg-red-50 rounded-xl border border-red-200 text-xs">
            Order Reference: <strong class="text-[#E52E2E] font-mono text-sm">#{{ $order->order_number }}</strong>
        </div>

        @php
            $waPhone = \App\Models\SiteSetting::get('company_whatsapp', '2556621990');
            $msg = "🍔 *ODA MPYA YA BURGER HOUSE*\n";
            $msg .= "━━━━━━━━━━━━━━━━━━━━\n";
            $msg .= "📋 *Namba ya Oda:* #" . $order->order_number . "\n";
            $msg .= "👤 *Jina la Mteja:* " . $order->customer_name . "\n";
            $msg .= "📞 *Namba ya Simu:* " . $order->customer_phone . "\n";
            $msg .= "📍 *Eneo / Location:* " . $order->delivery_area . ", " . $order->delivery_city . "\n";
            $msg .= "🏠 *Anwani Kamili:* " . $order->delivery_address . "\n";
            if ($order->notes) {
                $msg .= "📝 *Maelezo:* " . $order->notes . "\n";
            }
            $msg .= "━━━━━━━━━━━━━━━━━━━━\n";
            $msg .= "🛒 *Vyakula Vilivyoagizwa:*\n";
            foreach ($order->items as $i) {
                $msg .= "• {$i->product_name} x{$i->quantity} — Tshs " . number_format($i->subtotal, 0) . "\n";
            }
            $msg .= "━━━━━━━━━━━━━━━━━━━━\n";
            $msg .= "🛵 *Usafirishaji:* " . ($order->delivery_fee > 0 ? 'Tshs ' . number_format($order->delivery_fee, 0) : 'BURE (FREE)') . "\n";
            if ($order->discount_amount > 0) {
                $msg .= "🏷️ *Punguzo:* -Tshs " . number_format($order->discount_amount, 0) . "\n";
            }
            $msg .= "💰 *JUMLA KUU:* " . $order->formatted_total . "\n";
            $msg .= "💳 *Malipo:* " . strtoupper($order->payment_method) . "\n";
            $msg .= "━━━━━━━━━━━━━━━━━━━━\n";
            $msg .= "Habari Burger House! Nimetuma oda yangu hapa, naomba uthibitisho na kuanza kuandaliwa.";
            $finalWaUrl = session('whatsapp_url') ?: ('https://wa.me/' . $waPhone . '?text=' . urlencode($msg));
        @endphp

        <!-- Prominent WhatsApp Dispatch Card -->
        <div class="mt-8 p-6 sm:p-8 bg-emerald-50/80 rounded-3xl border-2 border-emerald-400 shadow-lg max-w-xl mx-auto text-center space-y-4">
            <div class="w-14 h-14 rounded-full bg-[#25D366] text-white flex items-center justify-center mx-auto shadow-md">
                <i data-lucide="message-circle" class="w-8 h-8"></i>
            </div>
            
            <div>
                <h4 class="font-extrabold text-base sm:text-lg text-emerald-950">Tuma Oda Yako WhatsApp (06621990)</h4>
                <p class="text-xs text-emerald-800 mt-1 max-w-md mx-auto">
                    Kamilisha oda yako kwa kuituma moja kwa moja kwenye namba rasmi ya WhatsApp ya biashara <strong>(06621990)</strong> pamoja na maelezo ya eneo ulipo kwa uthibitisho wa haraka.
                </p>
            </div>

            <div class="p-4 bg-white/90 rounded-2xl border border-emerald-200 text-left text-xs space-y-1.5 text-stone-700">
                <div class="flex justify-between">
                    <span class="text-stone-500">Mteja:</span>
                    <span class="font-bold text-stone-900">{{ $order->customer_name }} ({{ $order->customer_phone }})</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-500">Eneo / Location:</span>
                    <span class="font-semibold text-stone-900">{{ $order->delivery_area }}, {{ $order->delivery_city }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-stone-500">Anwani:</span>
                    <span class="text-stone-800 truncate max-w-xs">{{ $order->delivery_address }}</span>
                </div>
                <div class="flex justify-between pt-1 border-t border-emerald-100">
                    <span class="font-bold text-stone-900">Jumla Kuu:</span>
                    <span class="font-extrabold text-[#E52E2E] text-sm">{{ $order->formatted_total }}</span>
                </div>
            </div>

            <div>
                <a href="{{ $finalWaUrl }}" 
                   target="_blank" 
                   id="whatsappOrderBtn"
                   class="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-[#25D366] hover:bg-[#20ba5a] text-white font-extrabold rounded-full text-xs sm:text-sm uppercase tracking-wider transition-all duration-300 hover:scale-105 shadow-xl shadow-emerald-500/30 border-2 border-white ring-2 ring-emerald-300 w-full sm:w-auto">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    <span>TUMA ODA WHATSAPP SASA (06621990)</span>
                </a>
            </div>

            <p class="text-[11px] text-emerald-700 italic">Oda yako itafunguka WhatsApp ikiwa imejaa maelezo yote kiotomatiki.</p>
        </div>
    </div>

    <!-- Payment Instructions Card -->
    <div class="mt-8 bg-white rounded-3xl border border-[#ECE2D2] p-8 shadow-sm">
        <div class="flex items-center gap-3 pb-4 border-b border-[#ECE2D2]">
            <div class="w-8 h-8 rounded-lg bg-[#F6F0E6] text-[#B77B3B] flex items-center justify-center">
                <i data-lucide="credit-card" class="w-4 h-4"></i>
            </div>
            <div>
                <h3 class="font-display font-bold text-lg text-[#171717]">Payment Instructions</h3>
                <p class="text-xs text-stone-500">Method selected: <strong class="text-[#171717] uppercase">{{ $order->payment_method }}</strong></p>
            </div>
        </div>

        <div class="mt-6 text-sm text-stone-700 space-y-4">
            @if($order->payment_method === 'mpesa')
                <div class="p-4 bg-[#FCF9F4] rounded-2xl border border-[#ECE2D2] space-y-2">
                    <p class="font-bold text-xs text-[#171717]">Pay via Vodacom M-Pesa:</p>
                    <ol class="list-decimal list-inside text-xs text-stone-600 space-y-1">
                        <li>Dial <strong>*150*00#</strong> on your Vodacom line</li>
                        <li>Select <strong>4: Lipa kwa Simu</strong></li>
                        <li>Select <strong>1: Lipa Namba (Merchant / Till)</strong></li>
                        <li>Enter Merchant Number: <strong class="text-[#B77B3B] font-mono text-sm">5821940</strong> (COY BILTONG LTD)</li>
                        <li>Enter Exact Amount: <strong class="text-[#171717] text-sm">{{ $order->formatted_total }}</strong></li>
                        <li>Enter your Reference: <strong class="text-[#171717] font-mono">{{ $order->order_number }}</strong></li>
                        <li>Enter your M-Pesa PIN to complete payment</li>
                    </ol>
                </div>
            @elseif($order->payment_method === 'airtel_money')
                <div class="p-4 bg-[#FCF9F4] rounded-2xl border border-[#ECE2D2] space-y-2">
                    <p class="font-bold text-xs text-[#171717]">Pay via Airtel Money:</p>
                    <ol class="list-decimal list-inside text-xs text-stone-600 space-y-1">
                        <li>Dial <strong>*150*60#</strong></li>
                        <li>Select <strong>5: Lipa kwa Airtel Money</strong></li>
                        <li>Enter Business Number: <strong class="text-[#B77B3B] font-mono text-sm">7192301</strong></li>
                        <li>Enter Amount: <strong>{{ $order->formatted_total }}</strong></li>
                        <li>Enter Reference: <strong>{{ $order->order_number }}</strong></li>
                    </ol>
                </div>
            @elseif($order->payment_method === 'bank')
                <div class="p-4 bg-[#FCF9F4] rounded-2xl border border-[#ECE2D2] space-y-2 text-xs">
                    <p class="font-bold text-[#171717]">CRDB Bank Transfer Details:</p>
                    <p>Bank: <strong>CRDB Bank Tanzania</strong></p>
                    <p>Account Name: <strong>COY BILTONG LIMITED</strong></p>
                    <p>Account Number: <strong class="text-[#B77B3B] font-mono text-sm">0150493821000</strong></p>
                    <p>Amount: <strong>{{ $order->formatted_total }}</strong></p>
                    <p>Reference: <strong>{{ $order->order_number }}</strong></p>
                </div>
            @else
                <p class="text-xs text-stone-600">
                    Payment of <strong>{{ $order->formatted_total }}</strong> will be collected upon arrival by our delivery courier. Please prepare exact cash.
                </p>
            @endif

            <p class="text-xs text-stone-500 italic">
                * Note: Orders are dispatched promptly once payment is verified by our system.
            </p>
        </div>
    </div>

    <!-- Order Items & Delivery Breakdown -->
    <div class="mt-8 bg-white rounded-3xl border border-[#ECE2D2] p-8 shadow-sm">
        <h3 class="font-display font-bold text-lg text-[#171717] pb-4 border-b border-[#ECE2D2]">
            Order Summary
        </h3>

        <div class="mt-4 divide-y divide-[#ECE2D2]">
            @foreach($order->items as $item)
                <div class="py-3 flex items-center justify-between text-xs">
                    <div>
                        <span class="font-bold text-[#171717]">{{ $item->product_name }}</span>
                        <span class="text-stone-400 block text-[11px]">{{ $item->pack_size }} x {{ $item->quantity }}</span>
                    </div>
                    <span class="font-bold text-[#171717]">TZS {{ number_format($item->subtotal, 0) }}</span>
                </div>
            @endforeach
        </div>

        <div class="mt-4 pt-4 border-t border-[#ECE2D2] space-y-2 text-xs text-stone-600">
            <div class="flex justify-between">
                <span>Subtotal</span>
                <span class="font-bold text-[#171717]">{{ $order->formatted_subtotal }}</span>
            </div>
            @if($order->discount_amount > 0)
                <div class="flex justify-between text-emerald-700">
                    <span>Discount</span>
                    <span>-{{ $order->formatted_discount }}</span>
                </div>
            @endif
            <div class="flex justify-between">
                <span>Delivery ({{ $order->delivery_method }})</span>
                <span class="font-bold text-[#171717]">{{ $order->formatted_delivery_fee }}</span>
            </div>
            <div class="pt-2 border-t border-[#ECE2D2] flex justify-between font-bold text-base text-[#171717]">
                <span>Total</span>
                <span>{{ $order->formatted_total }}</span>
            </div>
        </div>

        <!-- Recipient Details -->
        <div class="mt-6 pt-6 border-t border-[#ECE2D2] grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-stone-600">
            <div>
                <span class="font-bold text-stone-700 block uppercase tracking-wider text-[10px]">Deliver To:</span>
                <p class="font-semibold text-[#171717] mt-1">{{ $order->customer_name }}</p>
                <p>{{ $order->customer_phone }}</p>
                <p class="text-stone-500">{{ $order->delivery_address }}, {{ $order->delivery_area }}, {{ $order->delivery_city }}</p>
            </div>
            <div>
                <span class="font-bold text-stone-700 block uppercase tracking-wider text-[10px]">Order Status:</span>
                <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-bold border {{ $order->status_color }}">
                    {{ $order->order_status }}
                </span>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 pt-6 border-t border-[#ECE2D2] flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('track', ['query' => $order->order_number]) }}" class="px-6 py-3 bg-[#171717] hover:bg-[#B77B3B] text-white rounded-xl text-xs font-bold uppercase tracking-wider transition">
                Track This Order Live
            </a>
            <a href="{{ route('shop') }}" class="text-xs font-bold text-[#B77B3B] hover:underline">
                Return to Shop →
            </a>
        </div>
    </div>

</div>

@endsection
