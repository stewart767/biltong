@extends('layouts.admin')

@section('title', 'Order #' . $order->order_number)

@section('content')

<div class="max-w-5xl space-y-8">
    
    <!-- Top Bar -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <span class="text-xs text-stone-400 block uppercase tracking-wider font-semibold">Order Management</span>
            <h2 class="font-display text-3xl font-extrabold text-white">#{{ $order->order_number }}</h2>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-[#2A2A2A] hover:bg-stone-700 text-stone-200 font-semibold text-xs flex items-center gap-1.5 transition">
                <i data-lucide="printer" class="w-4 h-4 text-[#B77B3B]"></i>
                <span>Print Invoice</span>
            </a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}?text={{ urlencode("Hello " . $order->customer_name . ", updating you on your COY BILTONG order #" . $order->order_number) }}" 
               target="_blank" 
               class="px-4 py-2.5 rounded-xl bg-[#25D366] hover:bg-[#1EBE5D] text-white font-bold text-xs flex items-center gap-1.5 transition">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>WhatsApp Customer</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="text-xs text-stone-400 hover:text-white">&larr; Back to Orders</a>
        </div>
    </div>

    <!-- Status Management Card -->
    <div class="p-6 rounded-3xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-4">
        <h3 class="font-display font-bold text-sm text-white uppercase tracking-wider">Update Order Status</h3>
        <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-stone-400 mb-1">Order Pipeline Status</label>
                <select name="order_status" class="w-full px-3 py-2.5 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                    @foreach($allStatuses as $st)
                        <option value="{{ $st }}" {{ $order->order_status === $st ? 'selected' : '' }}>{{ $st }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-stone-400 mb-1">Payment Status</label>
                <select name="payment_status" class="w-full px-3 py-2.5 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                    <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid (Verified)</option>
                    <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-stone-400 mb-1">Payment Ref / Code</label>
                <input type="text" name="payment_reference" value="{{ old('payment_reference', $order->payment_reference) }}" placeholder="e.g. QA983JK201" class="w-full px-3 py-2.5 rounded-xl bg-[#171717] border border-[#333333] text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
            </div>

            <button type="submit" class="py-2.5 px-6 rounded-xl bg-[#B77B3B] hover:bg-[#C98E4F] text-white font-bold text-xs uppercase tracking-wider transition">
                Save Status
            </button>
        </form>
    </div>

    <!-- Confirm Payment & Delivery Courier Setup (2 cols) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        
        <!-- Payment Verification Form -->
        <div class="p-6 rounded-3xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-[#2A2A2A]">
                <h4 class="font-display font-bold text-sm text-white">Payment Verification</h4>
                <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $order->payment_status === 'paid' ? 'bg-emerald-950 text-emerald-400' : 'bg-amber-950 text-amber-400' }} uppercase">
                    {{ $order->payment_status }}
                </span>
            </div>

            <form action="{{ route('admin.orders.payment.confirm', $order) }}" method="POST" class="space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block text-stone-400 mb-1 font-semibold">Payment Method</label>
                    <input type="text" name="payment_method" value="{{ $order->payment_method }}" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white">
                </div>
                <div>
                    <label class="block text-stone-400 mb-1 font-semibold">Confirmed Amount (TZS)</label>
                    <input type="number" step="0.01" name="amount" value="{{ $order->total }}" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white">
                </div>
                <div>
                    <label class="block text-stone-400 mb-1 font-semibold">Transaction Reference Number *</label>
                    <input type="text" name="transaction_reference" required value="{{ $order->payment_reference ?? 'MPESA-' . date('YmdHis') }}" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white font-mono">
                </div>
                <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs uppercase tracking-wider transition">
                    Confirm & Verify Payment
                </button>
            </form>
        </div>

        <!-- Delivery Tracking Form -->
        <div class="p-6 rounded-3xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-[#2A2A2A]">
                <h4 class="font-display font-bold text-sm text-white">Courier Dispatch & Delivery</h4>
                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#171717] text-stone-300 border border-[#333333] capitalize">
                    {{ $order->delivery?->status ?? 'pending' }}
                </span>
            </div>

            <form action="{{ route('admin.orders.delivery', $order) }}" method="POST" class="space-y-3 text-xs">
                @csrf
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-stone-400 mb-1 font-semibold">Carrier / Rider</label>
                        <input type="text" name="carrier" value="{{ $order->delivery?->carrier ?? 'COY Express Dispatch' }}" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white">
                    </div>
                    <div>
                        <label class="block text-stone-400 mb-1 font-semibold">Rider Name</label>
                        <input type="text" name="rider_name" value="{{ $order->delivery?->rider_name }}" placeholder="e.g. Juma" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-stone-400 mb-1 font-semibold">Tracking #</label>
                        <input type="text" name="tracking_number" value="{{ $order->delivery?->tracking_number }}" placeholder="TRK-..." class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white font-mono">
                    </div>
                    <div>
                        <label class="block text-stone-400 mb-1 font-semibold">Delivery Status</label>
                        <select name="delivery_status" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white">
                            <option value="pending" {{ $order->delivery?->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="dispatched" {{ $order->delivery?->status === 'dispatched' ? 'selected' : '' }}>Dispatched</option>
                            <option value="delivered" {{ $order->delivery?->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="failed" {{ $order->delivery?->status === 'failed' ? 'selected' : '' }}>Failed / Returned</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-stone-400 mb-1 font-semibold">Delivery Notes</label>
                    <input type="text" name="delivery_notes" value="{{ $order->delivery?->notes }}" placeholder="e.g. Delivered to reception" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white">
                </div>

                <button type="submit" class="w-full py-2.5 rounded-xl bg-[#2A2A2A] hover:bg-[#B77B3B] text-white font-bold text-xs uppercase tracking-wider transition">
                    Save Courier Tracking
                </button>
            </form>
        </div>

    </div>

    <!-- Customer Profile & Delivery Details -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="p-6 rounded-3xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-3">
            <span class="text-xs uppercase tracking-wider font-bold text-[#B77B3B] block">Customer Details</span>
            <p class="font-bold text-white text-base">{{ $order->customer_name }}</p>
            <div class="text-xs text-stone-300 space-y-1">
                <p>Phone: <a href="tel:{{ $order->customer_phone }}" class="text-[#B77B3B] hover:underline">{{ $order->customer_phone }}</a></p>
                @if($order->customer_email)
                    <p>Email: {{ $order->customer_email }}</p>
                @endif
                <p class="text-stone-400">Order Placed: {{ $order->created_at->format('M d, Y h:i A') }}</p>
            </div>
        </div>

        <div class="p-6 rounded-3xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-3">
            <span class="text-xs uppercase tracking-wider font-bold text-[#B77B3B] block">Delivery Location</span>
            <p class="font-bold text-white text-base">{{ $order->delivery_area }}, {{ $order->delivery_city }}</p>
            <p class="text-xs text-stone-300">{{ $order->delivery_address }}</p>
            <div class="text-xs text-stone-400 space-y-1 pt-1 border-t border-[#2A2A2A]">
                <p>Method: <strong class="text-white">{{ $order->delivery_method }}</strong></p>
                @if($order->notes)
                    <p class="text-amber-400">Notes: "{{ $order->notes }}"</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="p-6 rounded-3xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-4">
        <span class="text-xs uppercase tracking-wider font-bold text-[#B77B3B] block">Order Cuts</span>
        <div class="divide-y divide-[#2A2A2A] rounded-2xl bg-[#171717] border border-[#2A2A2A] overflow-hidden">
            @foreach($order->items as $item)
                <div class="p-4 flex items-center justify-between text-xs sm:text-sm">
                    <div>
                        <span class="font-bold text-white block">{{ $item->product_name }}</span>
                        <span class="text-xs text-stone-400">Pack: {{ $item->pack_size }} • Unit: TZS {{ number_format($item->unit_price, 0) }} • Qty: {{ $item->quantity }}</span>
                    </div>
                    <span class="font-bold text-white">TZS {{ number_format($item->subtotal, 0) }}</span>
                </div>
            @endforeach
        </div>

        <div class="pt-4 space-y-2 text-xs text-stone-300">
            <div class="flex justify-between">
                <span>Subtotal</span>
                <span>{{ $order->formatted_subtotal }}</span>
            </div>
            @if($order->discount_amount > 0)
                <div class="flex justify-between text-emerald-400">
                    <span>Discount</span>
                    <span>-{{ $order->formatted_discount }}</span>
                </div>
            @endif
            <div class="flex justify-between">
                <span>Delivery</span>
                <span>{{ $order->formatted_delivery_fee }}</span>
            </div>
            <div class="pt-2 border-t border-[#2A2A2A] flex justify-between font-bold text-base text-white">
                <span>Total Amount</span>
                <span class="text-emerald-400">{{ $order->formatted_total }}</span>
            </div>
        </div>
    </div>

</div>

@endsection
