@extends('layouts.app')

@section('title', 'Order Confirmed #' . $order->order_number . ' | INAS Premium Beef Biltong')

@section('content')

    <!-- Header Section -->
    <section class="py-14 bg-brand-charcoal border-b border-brand-border text-center" 
             x-data="{ init() { $store.cart.clearCart(); } }">
        <div class="max-w-3xl mx-auto px-4 space-y-3">
            <div class="w-16 h-16 mx-auto rounded-full bg-emerald-950 border-2 border-emerald-500/70 text-emerald-400 flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span class="inline-block px-3 py-1 rounded-full text-xs uppercase tracking-widest bg-emerald-900/50 text-emerald-300 border border-emerald-500/40 font-bold">
                Order Confirmed
            </span>
            <h1 class="font-editorial text-3xl sm:text-5xl font-bold text-white">
                Thank You, {{ $order->customer_name }}!
            </h1>
            <p class="text-zinc-300 text-sm sm:text-base max-w-xl mx-auto">
                Your biltong order <strong class="text-brand-red">#{{ $order->order_number }}</strong> has been registered in our Buguruni Malapa dispatch queue.
            </p>
        </div>
    </section>

    <!-- Main Confirmation Container -->
    <section class="py-14 bg-zinc-100 text-zinc-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 space-y-8">
            
            <!-- WhatsApp Action Banner -->
            <div class="p-6 sm:p-8 rounded-2xl bg-white border border-emerald-300 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="space-y-1 text-center sm:text-left">
                    <span class="text-xs uppercase font-bold text-emerald-700 tracking-wider flex items-center gap-1.5 justify-center sm:justify-start">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Fast-Track Dispatch
                    </span>
                    <h3 class="font-editorial text-xl font-bold text-zinc-900">Send Order Directly to Dispatch Desk</h3>
                    <p class="text-xs text-zinc-500">Tap below to notify our butchery dispatch team on WhatsApp (+255 682 869 629).</p>
                </div>
                <a href="{{ $order->whatsapp_url }}" 
                   target="_blank" 
                   class="px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm transition flex items-center gap-2 flex-shrink-0 shadow-md">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span>Send Order to WhatsApp</span>
                </a>
            </div>

            <!-- Summary Details Box -->
            <div class="p-6 sm:p-8 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-8">
                
                <!-- Reference Row -->
                <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-zinc-100">
                    <div>
                        <span class="text-xs text-zinc-500 block uppercase tracking-wider font-semibold">Order Reference</span>
                        <span class="font-editorial text-2xl font-extrabold text-brand-red">#{{ $order->order_number }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-zinc-500 block uppercase tracking-wider font-semibold">Status</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $order->status_badge_class }}">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </div>
                    <div>
                        <span class="text-xs text-zinc-500 block uppercase tracking-wider font-semibold">Payment Method</span>
                        <span class="text-sm font-bold text-zinc-900 uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                    </div>
                </div>

                <!-- Delivery Info -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                    <div class="space-y-1">
                        <span class="text-xs text-zinc-500 uppercase tracking-wider font-bold block">Delivery Recipient</span>
                        <p class="font-bold text-zinc-900">{{ $order->customer_name }}</p>
                        <p class="text-xs text-zinc-600">{{ $order->customer_phone }}</p>
                        @if($order->customer_email)
                            <p class="text-xs text-zinc-600">{{ $order->customer_email }}</p>
                        @endif
                    </div>

                    <div class="space-y-1">
                        <span class="text-xs text-zinc-500 uppercase tracking-wider font-bold block">Delivery Destination</span>
                        <p class="font-bold text-zinc-900">{{ $order->delivery_area }}, {{ $order->delivery_city }}</p>
                        <p class="text-xs text-zinc-600">{{ $order->delivery_address }}</p>
                        <p class="text-xs text-brand-red font-semibold mt-1">Method: {{ $order->delivery_method }}</p>
                    </div>
                </div>

                <!-- Ordered Items Table -->
                <div class="space-y-3">
                    <span class="text-xs text-zinc-500 uppercase tracking-wider font-bold block">Items Ordered</span>
                    <div class="rounded-xl bg-zinc-50 border border-zinc-200 divide-y divide-zinc-200 overflow-hidden">
                        @foreach($order->items as $item)
                            <div class="p-4 flex items-center justify-between text-xs sm:text-sm">
                                <div>
                                    <span class="font-bold text-zinc-900 block">{{ $item->product_name }}</span>
                                    <span class="text-xs text-zinc-500">Pack: {{ $item->pack_size }} × {{ $item->quantity }}</span>
                                </div>
                                <span class="font-bold text-zinc-900">
                                    TZS {{ number_format($item->subtotal, 0) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Totals -->
                <div class="space-y-2 pt-4 border-t border-zinc-100 text-sm">
                    <div class="flex justify-between text-zinc-600">
                        <span>Items Subtotal</span>
                        <span class="font-bold text-zinc-900">TZS {{ number_format($order->subtotal, 0) }}</span>
                    </div>
                    <div class="flex justify-between text-zinc-600">
                        <span>Delivery Fee</span>
                        <span class="font-bold text-zinc-900">
                            {{ $order->delivery_fee == 0 ? 'FREE' : 'TZS ' . number_format($order->delivery_fee, 0) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-baseline pt-3 border-t border-zinc-200 text-base">
                        <span class="font-bold text-zinc-900">Total Amount</span>
                        <span class="font-editorial text-3xl font-extrabold text-brand-red">
                            {{ $order->formatted_total }}
                        </span>
                    </div>
                </div>

                <!-- Mobile Money Payment Prompt Instructions -->
                <div class="p-6 rounded-xl bg-red-50 border border-red-200 space-y-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-brand-red flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-brand-red"></span>
                        <span>Payment Instructions: {{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</span>
                    </span>
                    <p class="text-xs text-zinc-700 leading-relaxed">
                        @if($order->payment_method === 'mpesa')
                            Please pay to <strong>Vodacom M-Pesa Lipa Namba (Till): 5829100 - INAS Company Limited</strong>. Reference: <strong>{{ $order->order_number }}</strong>.
                        @elseif($order->payment_method === 'tigopesa')
                            Please pay to <strong>Tigo Pesa (Mixx): 6182900 - INAS Company Limited</strong>. Reference: <strong>{{ $order->order_number }}</strong>.
                        @elseif($order->payment_method === 'airtel')
                            Please pay to <strong>Airtel Money Merchant: 712900 - INAS Company Limited</strong>. Reference: <strong>{{ $order->order_number }}</strong>.
                        @elseif($order->payment_method === 'halopesa')
                            Please pay to <strong>Halopesa Till: 489200 - INAS Company Limited</strong>. Reference: <strong>{{ $order->order_number }}</strong>.
                        @else
                            You have selected Cash on Delivery. Please have <strong>{{ $order->formatted_total }}</strong> ready when our courier arrives, or pay via mobile money directly upon inspection.
                        @endif
                    </p>
                </div>

            </div>

            <!-- Action buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                <a href="{{ route('track', ['order_number' => $order->order_number]) }}" 
                   class="px-6 py-3.5 rounded-full bg-white border border-zinc-300 hover:border-brand-red text-zinc-900 hover:text-brand-red text-xs font-bold uppercase tracking-wider transition shadow-sm">
                    Track Live Delivery Status
                </a>
                <a href="{{ route('shop') }}" 
                   class="px-6 py-3.5 rounded-full bg-brand-red hover:bg-brand-red-dark text-white text-xs font-bold uppercase tracking-wider shadow-md transition">
                    Continue Shopping
                </a>
            </div>

        </div>
    </section>

@endsection
