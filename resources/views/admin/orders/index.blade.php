@extends('layouts.admin')

@section('title', 'Orders Management')
@section('page_title', 'Customer & Dispatch Orders')

@section('content')

    <div class="space-y-6">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-editorial text-2xl font-bold text-brand-cream">Customer Orders</h2>
                <span class="text-xs text-brand-muted">Track order status, customer delivery addresses and mobile payments</span>
            </div>
            
            <!-- Status filter tabs -->
            <div class="flex flex-wrap items-center gap-1.5 text-xs">
                @php $cur = request('status', 'all'); @endphp
                <a href="{{ route('admin.orders.index') }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'all' ? 'bg-brand-red text-white font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">All</a>
                <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'pending' ? 'bg-amber-500 text-black font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">Pending</a>
                <a href="{{ route('admin.orders.index', ['status' => 'confirmed']) }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'confirmed' ? 'bg-blue-500 text-white font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">Confirmed</a>
                <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'processing' ? 'bg-purple-500 text-white font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">Processing</a>
                <a href="{{ route('admin.orders.index', ['status' => 'dispatched']) }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'dispatched' ? 'bg-indigo-500 text-white font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">Dispatched</a>
                <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'delivered' ? 'bg-emerald-500 text-black font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">Delivered</a>
            </div>
        </div>

        <div class="rounded-2xl bg-brand-card border border-brand-border overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-brand-border bg-brand-dark/80 text-brand-muted uppercase text-[10px] tracking-wider">
                            <th class="py-3.5 px-6">Order #</th>
                            <th class="py-3.5 px-4">Date</th>
                            <th class="py-3.5 px-4">Customer</th>
                            <th class="py-3.5 px-4">Area</th>
                            <th class="py-3.5 px-4">Total</th>
                            <th class="py-3.5 px-4">Payment</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-6 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-border/60">
                        @forelse($orders as $order)
                            <tr class="hover:bg-brand-dark/40 transition">
                                <td class="py-4 px-6 font-bold text-brand-red">
                                    <a href="{{ route('admin.orders.show', $order) }}">#{{ $order->order_number }}</a>
                                </td>
                                <td class="py-4 px-4 text-brand-muted">
                                    {{ $order->created_at->format('M d, H:i') }}
                                </td>
                                <td class="py-4 px-4">
                                    <span class="font-bold text-brand-cream block">{{ $order->customer_name }}</span>
                                    <span class="text-[11px] text-brand-muted">{{ $order->customer_phone }}</span>
                                </td>
                                <td class="py-4 px-4 text-brand-cream/80">
                                    {{ $order->delivery_area }}
                                </td>
                                <td class="py-4 px-4 font-bold text-brand-cream">
                                    {{ $order->formatted_total }}
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $order->payment_status === 'paid' ? 'bg-emerald-950 text-emerald-400' : 'bg-amber-950 text-amber-400' }}">
                                        {{ strtoupper($order->payment_method) }}: {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $order->status_badge_class }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="px-3 py-1.5 rounded-lg bg-brand-dark text-brand-red hover:text-white transition font-semibold text-xs inline-block">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-8 text-center text-brand-muted">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="p-4 border-t border-brand-border bg-brand-dark">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection
