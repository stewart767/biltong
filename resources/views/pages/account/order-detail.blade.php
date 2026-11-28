@extends('layouts.app')

@section('title', 'Order #' . $order->order_number . ' | COY BILTONG')

@section('content')

<div class="bg-[#171717] text-white py-8 border-b border-[#262626]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <nav class="flex items-center gap-2 text-xs text-stone-400 mb-1">
                <a href="{{ route('account.orders') }}" class="hover:text-white transition">My Orders</a>
                <span>/</span>
                <span class="text-[#B77B3B] font-semibold">#{{ $order->order_number }}</span>
            </nav>
            <h1 class="font-display font-extrabold text-2xl sm:text-3xl text-white">Order Details</h1>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $order->status_color }}">
                Status: {{ $order->order_status }}
            </span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Items and Delivery Tracking (8 cols) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Items Box -->
            <div class="bg-white rounded-3xl border border-[#ECE2D2] p-6 shadow-xs">
                <h3 class="font-display font-bold text-lg text-[#171717] pb-4 border-b border-[#ECE2D2]">
                    Ordered Items
                </h3>

                <div class="divide-y divide-[#ECE2D2]">
                    @foreach($order->items as $item)
                        <div class="py-4 flex items-center justify-between gap-4 text-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-[#F6F0E6] overflow-hidden flex-shrink-0">
                                    <img src="{{ $item->product?->image_url ?? asset('images/biltong-original-1.jpg') }}" alt="" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-[#171717]">{{ $item->product_name }}</p>
                                    <p class="text-stone-400 text-[11px]">{{ $item->pack_size }} • Unit: TZS {{ number_format($item->unit_price, 0) }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="font-bold text-[#171717] block">TZS {{ number_format($item->subtotal, 0) }}</span>
                                <span class="text-stone-400 text-[11px]">Qty: {{ $item->quantity }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Delivery & Courier Tracking Box -->
            <div class="bg-white rounded-3xl border border-[#ECE2D2] p-6 shadow-xs space-y-4">
                <h3 class="font-display font-bold text-lg text-[#171717] pb-4 border-b border-[#ECE2D2]">
                    Delivery Information
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-stone-400 uppercase tracking-wider block font-bold text-[10px]">Recipient</span>
                        <p class="font-bold text-sm text-[#171717] mt-1">{{ $order->customer_name }}</p>
                        <p class="text-stone-600">{{ $order->customer_phone }}</p>
                    </div>
                    <div>
                        <span class="text-stone-400 uppercase tracking-wider block font-bold text-[10px]">Destination Address</span>
                        <p class="text-stone-700 mt-1">{{ $order->delivery_address }}</p>
                        <p class="text-stone-500">{{ $order->delivery_area }}, {{ $order->delivery_city }}</p>
                    </div>
                </div>

                @if($order->delivery)
                    <div class="p-4 bg-[#FCF9F4] rounded-2xl border border-[#ECE2D2] text-xs space-y-1">
                        <span class="font-bold text-[#68734B] uppercase tracking-wider text-[10px]">Courier Status</span>
                        <p><strong>Carrier:</strong> {{ $order->delivery->carrier }}</p>
                        <p><strong>Tracking #:</strong> <span class="font-mono text-[#B77B3B] font-bold">{{ $order->delivery->tracking_number }}</span></p>
                        <p><strong>Status:</strong> <span class="capitalize">{{ $order->delivery->status }}</span></p>
                        @if($order->delivery->notes)
                            <p class="text-stone-500 italic mt-1">{{ $order->delivery->notes }}</p>
                        @endif
                    </div>
                @endif
            </div>

        </div>

        <!-- Right Column: Financial Summary & WhatsApp Help (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-3xl border border-[#ECE2D2] p-6 shadow-xs">
                <h3 class="font-display font-bold text-lg text-[#171717] pb-4 border-b border-[#ECE2D2]">
                    Payment Summary
                </h3>

                <div class="mt-4 space-y-2.5 text-xs text-stone-600">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span class="font-bold text-[#171717]">{{ $order->formatted_subtotal }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                        <div class="flex justify-between text-emerald-700 font-semibold">
                            <span>Discount</span>
                            <span>-{{ $order->formatted_discount }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span>Delivery</span>
                        <span class="font-bold text-[#171717]">{{ $order->formatted_delivery_fee }}</span>
                    </div>
                    <div class="pt-3 border-t border-[#ECE2D2] flex justify-between items-baseline font-bold text-base text-[#171717]">
                        <span>Total Paid</span>
                        <span class="font-display font-extrabold text-xl">{{ $order->formatted_total }}</span>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-[#ECE2D2] text-xs space-y-1.5">
                    <p><strong>Method:</strong> <span class="uppercase">{{ $order->payment_method }}</span></p>
                    <p><strong>Payment Status:</strong> <span class="capitalize font-semibold">{{ $order->payment_status }}</span></p>
                    @if($order->payment_reference)
                        <p><strong>Ref Code:</strong> <span class="font-mono">{{ $order->payment_reference }}</span></p>
                    @endif
                </div>

                <div class="mt-6 pt-4 border-t border-[#ECE2D2]">
                    <a href="https://wa.me/{{ \App\Models\SiteSetting::get('company_whatsapp', '255768123456') }}?text={{ urlencode("Hello COY BILTONG, I have a question regarding order #" . $order->order_number) }}" 
                       target="_blank" 
                       class="w-full py-3 bg-[#25D366] hover:bg-[#1EBE5D] text-white rounded-xl text-xs font-bold uppercase tracking-wider transition flex items-center justify-center gap-2">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>WhatsApp Butchery Desk</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
