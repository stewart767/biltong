@extends('layouts.admin')

@section('title', 'Live Orders Management')

@section('content')

<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-white">Live Orders & Delivery Dispatches</h2>
            <span class="text-xs text-stone-400">Track kitchen preparation, courier dispatches, confirm M-Pesa & Cash payments, and print invoices</span>
        </div>
    </div>

    <!-- Filter & Search Bar with Classic Modified Borders -->
    <form action="{{ route('admin.orders.index') }}" method="GET" class="p-4 rounded-2xl bg-[#1C1C1C] border-2 border-[#2A2A2A] flex flex-wrap items-center gap-3 text-xs">
        <input type="text" 
               name="search" 
               value="{{ request('search') }}" 
               placeholder="Search by Order # or Customer..." 
               class="px-4 py-2.5 bg-[#141414] border-2 border-[#2A2A2A] rounded-xl text-xs text-white focus:outline-none focus:border-[#E52E2E] min-w-[220px]">

        <select name="status" onchange="this.form.submit()" class="px-3 py-2.5 bg-[#141414] border-2 border-[#2A2A2A] rounded-xl text-white focus:outline-none focus:border-[#E52E2E]">
            <option value="">All Pipeline Statuses</option>
            @foreach($allStatuses as $st)
                <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ $st }}</option>
            @endforeach
        </select>

        <select name="payment_status" onchange="this.form.submit()" class="px-3 py-2.5 bg-[#141414] border-2 border-[#2A2A2A] rounded-xl text-white focus:outline-none focus:border-[#E52E2E]">
            <option value="">All Payment Statuses</option>
            <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="failed" {{ request('payment_status') === 'failed' ? 'selected' : '' }}>Failed</option>
        </select>

        <button type="submit" class="px-5 py-2.5 bg-[#E52E2E] hover:bg-[#C61A1A] text-white rounded-xl font-bold uppercase transition shadow-xs">
            Filter
        </button>

        @if(request('status') || request('payment_status') || request('search'))
            <a href="{{ route('admin.orders.index') }}" class="text-stone-400 hover:text-white ml-2 underline">Clear Filters</a>
        @endif
    </form>

    <!-- Orders Table with Classic Modified Borders -->
    <div class="rounded-3xl bg-[#1C1C1C] border-2 border-[#2A2A2A] overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#2A2A2A] bg-[#171717] text-stone-400 uppercase text-[10px] tracking-wider">
                        <th class="py-3.5 px-6">Order #</th>
                        <th class="py-3.5 px-4">Date</th>
                        <th class="py-3.5 px-4">Customer</th>
                        <th class="py-3.5 px-4">Destination</th>
                        <th class="py-3.5 px-4">Total</th>
                        <th class="py-3.5 px-4">Payment</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#2A2A2A]">
                    @forelse($orders as $order)
                        <tr class="hover:bg-[#242424] transition">
                            <td class="py-4 px-6 font-mono font-bold text-[#E52E2E]">
                                <a href="{{ route('admin.orders.show', $order) }}">#{{ $order->order_number }}</a>
                            </td>
                            <td class="py-4 px-4 text-stone-400">
                                {{ $order->created_at->format('M d, H:i') }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-white block">{{ $order->customer_name }}</span>
                                <span class="text-[11px] text-stone-400">{{ $order->customer_phone }}</span>
                            </td>
                            <td class="py-4 px-4 text-stone-300">
                                {{ $order->delivery_area }}, {{ $order->delivery_city }}
                            </td>
                            <td class="py-4 px-4 font-bold text-white">
                                {{ $order->formatted_total }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $order->payment_status === 'paid' ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-amber-950 text-amber-400 border border-amber-800' }}">
                                    {{ strtoupper($order->payment_method) }}: {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $order->status_color }}">
                                    {{ $order->order_status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="px-2.5 py-1 rounded bg-[#2A2A2A] hover:bg-stone-700 text-stone-300 transition text-[10px]" title="Invoice">
                                    Invoice
                                </a>
                                <a href="{{ route('admin.orders.show', $order) }}" class="px-3 py-1 rounded bg-[#2A2A2A] hover:bg-[#E52E2E] text-white transition font-bold text-[10px] border border-[#383838] hover:border-[#E52E2E]">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 text-center text-stone-500">No orders matching your criteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-4 border-t border-[#2A2A2A] bg-[#171717]">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

</div>

@endsection
