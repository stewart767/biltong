@extends('layouts.admin')

@section('title', 'Order #' . $order->order_number)
@section('page_title', 'Order Details: #' . $order->order_number)

@section('content')

    <div class="max-w-4xl space-y-8">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs text-brand-muted block uppercase tracking-wider">Order Reference</span>
                <h2 class="font-editorial text-3xl font-bold text-brand-red">#{{ $order->order_number }}</h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ $order->whatsapp_url }}" target="_blank" 
                   class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs flex items-center gap-1.5 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span>Message Customer on WhatsApp</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="text-xs text-brand-muted hover:text-white">&larr; Back</a>
            </div>
        </div>

        <!-- Status Management Card -->
        <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-4">
            <h3 class="font-bold text-sm text-brand-cream uppercase tracking-wider">Update Order & Payment Status</h3>
            <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
                @csrf
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-brand-muted">Order Dispatch Status</label>
                    <select name="order_status" class="w-full px-4 py-2.5 rounded-xl bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        <option value="pending" {{ $order->order_status === 'pending' ? 'selected' : '' }}>Pending (Received)</option>
                        <option value="confirmed" {{ $order->order_status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="processing" {{ $order->order_status === 'processing' ? 'selected' : '' }}>Processing (Sliced & Sealed)</option>
                        <option value="dispatched" {{ $order->order_status === 'dispatched' ? 'selected' : '' }}>Dispatched (With Rider)</option>
                        <option value="delivered" {{ $order->order_status === 'delivered' ? 'selected' : '' }}>Delivered (Complete)</option>
                        <option value="cancelled" {{ $order->order_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-brand-muted">Payment Status</label>
                    <select name="payment_status" class="w-full px-4 py-2.5 rounded-xl bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                        <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed / Refunded</option>
                    </select>
                </div>

                <button type="submit" class="py-2.5 px-6 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs font-bold uppercase tracking-wider hover:shadow-lg transition">
                    Update Status
                </button>
            </form>
        </div>

        <!-- Customer & Delivery Info -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-3">
                <span class="text-xs uppercase tracking-wider font-bold text-brand-red block">Customer Profile</span>
                <p class="font-bold text-brand-cream text-base">{{ $order->customer_name }}</p>
                <div class="text-xs text-brand-cream/80 space-y-1">
                    <p>Phone: <a href="tel:{{ $order->customer_phone }}" class="text-brand-red hover:underline">{{ $order->customer_phone }}</a></p>
                    @if($order->customer_email)
                        <p>Email: {{ $order->customer_email }}</p>
                    @endif
                    <p class="text-brand-muted">Order Placed: {{ $order->created_at->format('M d, Y h:i A') }}</p>
                </div>
            </div>

            <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-3">
                <span class="text-xs uppercase tracking-wider font-bold text-brand-red block">Delivery Destination</span>
                <p class="font-bold text-brand-cream text-base">{{ $order->delivery_area }}, {{ $order->delivery_city }}</p>
                <p class="text-xs text-brand-cream/80">{{ $order->delivery_address }}</p>
                <div class="text-xs text-brand-muted space-y-1 pt-1 border-t border-brand-border/60">
                    <p>Method: <strong class="text-brand-cream">{{ $order->delivery_method }}</strong></p>
                    @if($order->notes)
                        <p class="text-amber-300">Customer Note: "{{ $order->notes }}"</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-4">
            <span class="text-xs uppercase tracking-wider font-bold text-brand-red block">Order Items</span>
            <div class="divide-y divide-brand-border/60 rounded-xl bg-brand-dark border border-brand-border overflow-hidden">
                @foreach($order->items as $item)
                    <div class="p-4 flex items-center justify-between text-xs sm:text-sm">
                        <div>
                            <span class="font-bold text-brand-cream block">{{ $item->product_name }}</span>
                            <span class="text-xs text-brand-red">Pack: {{ $item->pack_size }} &bull; Unit: TZS {{ number_format($item->unit_price, 0) }} &bull; Qty: {{ $item->quantity }}</span>
                        </div>
                        <span class="font-bold text-brand-cream">TZS {{ number_format($item->subtotal, 0) }}</span>
                    </div>
                @endforeach
            </div>

            <div class="pt-4 space-y-2 text-xs sm:text-sm">
                <div class="flex justify-between text-brand-muted">
                    <span>Subtotal</span>
                    <span class="text-brand-cream font-bold">TZS {{ number_format($order->subtotal, 0) }}</span>
                </div>
                <div class="flex justify-between text-brand-muted">
                    <span>Delivery Fee</span>
                    <span class="text-brand-cream font-bold">{{ $order->delivery_fee == 0 ? 'FREE' : 'TZS ' . number_format($order->delivery_fee, 0) }}</span>
                </div>
                <div class="flex justify-between items-baseline pt-2 border-t border-brand-border/60 text-base">
                    <span class="font-bold text-brand-cream">Total Payable</span>
                    <span class="font-editorial text-2xl font-bold text-brand-red">{{ $order->formatted_total }}</span>
                </div>
            </div>
        </div>

    </div>

@endsection
