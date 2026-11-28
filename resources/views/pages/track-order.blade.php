@extends('layouts.app')

@section('title', 'Track Your Order | COY BILTONG')

@section('content')

<!-- Header Section -->
<section class="py-14 bg-[#171717] border-b border-[#262626] text-center text-white">
    <div class="max-w-4xl mx-auto px-4 space-y-3">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#262626] text-[#B77B3B] border border-[#B77B3B]/30">
            <span class="w-1.5 h-1.5 rounded-full bg-[#B77B3B] animate-pulse"></span>
            Real-Time Butchery & Courier Tracking
        </span>
        <h1 class="font-display text-3xl sm:text-5xl font-bold text-white tracking-tight">
            Track Your Biltong Order
        </h1>
        <p class="text-stone-300 text-xs sm:text-sm max-w-md mx-auto">
            Enter your COY BILTONG reference number (e.g. COY-202611-001) or customer phone number to check status.
        </p>
    </div>
</section>

<!-- Main Tracking Content -->
<section class="py-14 bg-[#F6F0E6]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 space-y-8">
        
        <!-- Search Box -->
        <div class="p-6 sm:p-8 rounded-3xl bg-white border border-[#ECE2D2] shadow-xs">
            <form action="{{ route('track') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <input type="text" 
                       name="query" 
                       value="{{ request('query', request('order_number')) }}" 
                       required 
                       placeholder="Enter Order # (e.g. COY-202611-001) or Phone (e.g. +255 754...)"
                       class="flex-1 px-4 py-3.5 rounded-xl bg-[#F6F0E6] border border-[#ECE2D2] text-sm text-[#171717] placeholder-stone-400 focus:bg-white focus:ring-2 focus:ring-[#B77B3B] focus:outline-none transition">
                <button type="submit" class="px-8 py-3.5 rounded-xl bg-[#171717] hover:bg-[#B77B3B] text-white font-bold text-xs uppercase tracking-wider shadow-md transition flex items-center justify-center gap-2">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    <span>Track Status</span>
                </button>
            </form>
        </div>

        @if(isset($order) && $order)
            <!-- Order Found Box -->
            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-[#ECE2D2] shadow-xs space-y-8">
                
                <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-[#ECE2D2]">
                    <div>
                        <span class="text-xs text-stone-400 uppercase tracking-wider block font-semibold">Order Reference</span>
                        <span class="font-display text-2xl font-extrabold text-[#171717]">#{{ $order->order_number }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-stone-400 uppercase tracking-wider block font-semibold">Date Placed</span>
                        <span class="text-xs font-bold text-[#171717]">{{ $order->created_at->format('M d, Y - h:i A') }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-stone-400 uppercase tracking-wider block font-semibold">Current Status</span>
                        <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-bold border {{ $order->status_color }}">
                            {{ $order->order_status }}
                        </span>
                    </div>
                </div>

                <!-- Progress Pipeline -->
                @php
                    $stages = [
                        'Pending' => '1. Received',
                        'Awaiting Payment' => '2. Awaiting Payment',
                        'Paid' => '3. Paid',
                        'Processing' => '4. Butchery Prep',
                        'Ready for Delivery' => '5. Ready',
                        'Shipped' => '6. In Transit',
                        'Delivered' => '7. Delivered',
                    ];
                    $statusOrder = ['Pending', 'Awaiting Payment', 'Paid', 'Processing', 'Ready for Delivery', 'Shipped', 'Delivered'];
                    $currentIndex = array_search($order->order_status, $statusOrder);
                    if ($currentIndex === false) $currentIndex = 0;
                @endphp

                <div class="space-y-3">
                    <span class="text-xs text-stone-400 uppercase tracking-wider font-bold block">Fulfillment Journey</span>
                    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-2 text-center text-xs">
                        @foreach($statusOrder as $idx => $st)
                            <div class="p-3 rounded-xl border {{ $idx <= $currentIndex ? 'bg-[#FCF9F4] border-[#B77B3B] text-[#B77B3B] font-bold' : 'bg-[#F6F0E6] border-[#ECE2D2] text-stone-400' }}">
                                <div class="w-5 h-5 mx-auto mb-1 rounded-full flex items-center justify-center text-[10px] {{ $idx <= $currentIndex ? 'bg-[#B77B3B] text-white' : 'bg-stone-300 text-stone-600' }}">
                                    {{ $idx + 1 }}
                                </div>
                                <span class="text-[11px]">{{ $stages[$st] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Details Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-[#ECE2D2] text-xs">
                    <div class="space-y-1">
                        <span class="text-xs text-stone-400 uppercase tracking-wider font-bold block">Delivery Destination</span>
                        <p class="font-bold text-[#171717]">{{ $order->customer_name }} ({{ $order->customer_phone }})</p>
                        <p class="text-stone-600">{{ $order->delivery_address }}, {{ $order->delivery_area }}, {{ $order->delivery_city }}</p>
                        @if($order->delivery?->tracking_number)
                            <p class="text-[#B77B3B] font-mono mt-2">Courier Tracking #: {{ $order->delivery->tracking_number }} ({{ $order->delivery->carrier }})</p>
                        @endif
                    </div>
                    <div class="space-y-1">
                        <span class="text-xs text-stone-400 uppercase tracking-wider font-bold block">Payment & Method</span>
                        <p class="text-stone-700"><strong>Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                        <p class="text-stone-700"><strong>Payment Status:</strong> <span class="capitalize">{{ $order->payment_status }}</span></p>
                        <p class="text-stone-700"><strong>Total Amount:</strong> {{ $order->formatted_total }}</p>
                    </div>
                </div>

                <!-- Items Breakdown -->
                <div class="pt-4 border-t border-[#ECE2D2]">
                    <span class="text-xs text-stone-400 uppercase tracking-wider font-bold block mb-3">Items in This Order</span>
                    <div class="divide-y divide-[#ECE2D2] text-xs">
                        @foreach($order->items as $item)
                            <div class="py-2.5 flex justify-between">
                                <span class="font-medium text-[#171717]">{{ $item->product_name }} ({{ $item->pack_size }}) x {{ $item->quantity }}</span>
                                <span class="font-bold text-[#171717]">TZS {{ number_format($item->subtotal, 0) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Live Assistance via WhatsApp -->
                <div class="pt-4 border-t border-[#ECE2D2] flex flex-col sm:flex-row items-center justify-between gap-3">
                    <span class="text-xs text-stone-500">Need immediate assistance with this delivery?</span>
                    <a href="https://wa.me/{{ \App\Models\SiteSetting::get('company_whatsapp', '255768123456') }}?text={{ urlencode("Hello COY BILTONG, I would like to inquire about my order #" . $order->order_number) }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#25D366]/15 hover:bg-[#25D366]/25 text-[#128C7E] rounded-xl text-xs font-bold transition">
                        <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                        <span>WhatsApp Dispatch Desk</span>
                    </a>
                </div>

            </div>
        @elseif(request('query') || request('order_number'))
            <div class="bg-white rounded-3xl border border-[#ECE2D2] p-10 text-center">
                <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="alert-circle" class="w-6 h-6"></i>
                </div>
                <h3 class="font-display font-bold text-lg text-[#171717]">Order Not Found</h3>
                <p class="text-xs text-stone-500 mt-1 max-w-sm mx-auto">
                    We could not locate an order matching <strong>"{{ request('query', request('order_number')) }}"</strong>. Please double check the reference number or phone.
                </p>
            </div>
        @endif

    </div>
</section>

@endsection
