@extends('layouts.app')

@section('title', 'Track Your Order | INAS Premium Beef Biltong')

@section('content')

    <!-- Header Section -->
    <section class="py-14 bg-brand-charcoal border-b border-brand-border text-center">
        <div class="max-w-4xl mx-auto px-4 space-y-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-red/20 text-brand-red border border-brand-red/30">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-red"></span>
                Real-Time Dispatch Tracking
            </span>
            <h1 class="font-editorial text-3xl sm:text-5xl font-bold text-white tracking-wide">
                Track Your Biltong Order
            </h1>
            <p class="text-zinc-400 text-xs sm:text-sm max-w-md mx-auto">
                Enter your INAS order reference number (e.g. INAS-202611-01) or customer phone number to check live status.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-14 bg-zinc-100 text-zinc-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 space-y-10">
            
            <!-- Lookup Form -->
            <div class="p-6 sm:p-8 rounded-2xl bg-white border border-zinc-200 shadow-sm">
                <form action="{{ route('track') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <input type="text" name="query" value="{{ request('query', request('order_number')) }}" required 
                           placeholder="Enter Order # (e.g. INAS-202611-01) or Phone (e.g. 0754...)"
                           class="flex-1 px-4 py-3.5 rounded-xl bg-zinc-50 border border-zinc-300 text-sm text-zinc-900 placeholder-zinc-400 focus:bg-white focus:border-brand-red focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                    <button type="submit" class="px-8 py-3.5 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span>Track Status</span>
                    </button>
                </form>
            </div>

            @if(isset($order) && $order)
                <!-- Order Result Box -->
                <div class="p-6 sm:p-8 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-8">
                    
                    <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-zinc-100">
                        <div>
                            <span class="text-xs text-zinc-500 uppercase tracking-wider block font-semibold">Found Order</span>
                            <span class="font-editorial text-2xl font-extrabold text-brand-red">#{{ $order->order_number }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-zinc-500 uppercase tracking-wider block font-semibold">Order Placed</span>
                            <span class="text-xs font-bold text-zinc-800">{{ $order->created_at->format('M d, Y - h:i A') }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-zinc-500 uppercase tracking-wider block font-semibold">Current Status</span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $order->status_badge_class }}">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Step-by-Step Progress Pipeline -->
                    @php
                        $stages = [
                            'pending' => '1. Received',
                            'confirmed' => '2. Confirmed',
                            'processing' => '3. Sliced & Sealed',
                            'dispatched' => '4. Out for Delivery',
                            'delivered' => '5. Delivered',
                        ];
                        $statusOrder = ['pending', 'confirmed', 'processing', 'dispatched', 'delivered'];
                        $currentIndex = array_search($order->order_status, $statusOrder);
                        if ($currentIndex === false) $currentIndex = 0;
                    @endphp

                    <div class="space-y-4">
                        <span class="text-xs text-zinc-500 uppercase tracking-wider font-bold block">Delivery Pipeline</span>
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 text-center text-xs">
                            @foreach($statusOrder as $idx => $st)
                                <div class="p-3 rounded-xl border {{ $idx <= $currentIndex ? 'bg-red-50 border-brand-red text-brand-red font-bold' : 'bg-zinc-50 border-zinc-200 text-zinc-400' }}">
                                    <div class="w-6 h-6 mx-auto mb-1.5 rounded-full flex items-center justify-center text-[11px] {{ $idx <= $currentIndex ? 'bg-brand-red text-white' : 'bg-zinc-200 text-zinc-500' }}">
                                        {{ $idx + 1 }}
                                    </div>
                                    <span>{{ $stages[$st] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Details Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-zinc-100 text-xs sm:text-sm">
                        <div class="space-y-1">
                            <span class="text-xs text-zinc-500 uppercase tracking-wider font-bold block">Recipient</span>
                            <p class="font-bold text-zinc-900">{{ $order->customer_name }} ({{ $order->customer_phone }})</p>
                            <p class="text-xs text-zinc-600">{{ $order->delivery_area }}, {{ $order->delivery_city }}</p>
                            <p class="text-xs text-zinc-500">{{ $order->delivery_address }}</p>
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-zinc-500 uppercase tracking-wider font-bold block">Delivery & Payment</span>
                            <p class="text-xs text-zinc-700"><strong class="text-zinc-900">Method:</strong> {{ $order->delivery_method }}</p>
                            <p class="text-xs text-zinc-700"><strong class="text-zinc-900">Payment:</strong> {{ strtoupper($order->payment_method) }} ({{ ucfirst($order->payment_status) }})</p>
                            <p class="text-xs text-brand-red font-bold mt-1"><strong class="text-zinc-900">Total:</strong> {{ $order->formatted_total }}</p>
                        </div>
                    </div>

                    <!-- Items -->
                    <div class="space-y-2 pt-4 border-t border-zinc-100">
                        <span class="text-xs text-zinc-500 uppercase tracking-wider font-bold block">Items in this Delivery</span>
                        <div class="divide-y divide-zinc-200 rounded-xl bg-zinc-50 border border-zinc-200 overflow-hidden">
                            @foreach($order->items as $item)
                                <div class="p-3.5 flex items-center justify-between text-xs">
                                    <span class="font-medium text-zinc-900">{{ $item->product_name }} ({{ $item->pack_size }}) × {{ $item->quantity }}</span>
                                    <span class="font-bold text-brand-red">TZS {{ number_format($item->subtotal, 0) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Dispatch Help -->
                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <span class="text-xs text-zinc-500">Need to modify delivery address or time?</span>
                        <a href="https://wa.me/255682869629?text=Hello%20INAS!%20I%20am%20checking%20on%20my%20order%20%23{{ $order->order_number }}" 
                           target="_blank" 
                           class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs transition flex items-center gap-1.5 shadow">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span>Chat with Dispatch Desk (+255 682 869 629)</span>
                        </a>
                    </div>

                </div>
            @elseif(request('query'))
                <div class="p-8 rounded-2xl bg-white border border-zinc-200 text-center space-y-4 shadow-sm">
                    <p class="text-sm text-zinc-600">
                        No order found matching "<strong class="text-zinc-900">{{ request('query') }}</strong>". Please double-check your order number or phone number.
                    </p>
                    <a href="https://wa.me/255682869629?text=Hello%20INAS!%20I%20am%20trying%20to%20track%20my%20order%20query:%20{{ urlencode(request('query')) }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 text-xs text-brand-red font-bold hover:underline">
                        <span>Contact Dispatch Support on WhatsApp</span>
                    </a>
                </div>
            @endif

        </div>
    </section>

@endsection
