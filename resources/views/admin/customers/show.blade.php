@extends('layouts.admin')

@section('title', 'Customer Profile: ' . $customer->name)

@section('content')

<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <span class="text-xs text-stone-400 uppercase tracking-wider font-semibold block">Customer Details</span>
            <h2 class="font-display text-2xl font-bold text-white">{{ $customer->name }}</h2>
        </div>
        <a href="{{ route('admin.customers.index') }}" class="text-xs text-stone-400 hover:text-white">&larr; Back to Customers</a>
    </div>

    <!-- Overview Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-5 rounded-2xl bg-[#1F1F1F] border border-[#2A2A2A]">
            <span class="text-[10px] text-stone-400 uppercase font-bold tracking-wider">Total Verified Spend</span>
            <p class="font-extrabold text-xl text-emerald-400 mt-1">TZS {{ number_format($totalSpent, 0) }}</p>
        </div>
        <div class="p-5 rounded-2xl bg-[#1F1F1F] border border-[#2A2A2A]">
            <span class="text-[10px] text-stone-400 uppercase font-bold tracking-wider">Total Orders</span>
            <p class="font-extrabold text-xl text-white mt-1">{{ $customer->orders->count() }}</p>
        </div>
        <div class="p-5 rounded-2xl bg-[#1F1F1F] border border-[#2A2A2A]">
            <span class="text-[10px] text-stone-400 uppercase font-bold tracking-wider">Saved Addresses</span>
            <p class="font-extrabold text-xl text-white mt-1">{{ $customer->addresses->count() }}</p>
        </div>
    </div>

    <!-- Contact & Profile Box -->
    <div class="p-6 rounded-3xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-3 text-xs">
        <h3 class="font-display font-bold text-base text-white pb-2 border-b border-[#2A2A2A]">Contact Information</h3>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Phone:</strong> {{ $customer->phone }}</p>
        @if($customer->profile?->company)
            <p><strong>Company:</strong> {{ $customer->profile->company }}</p>
        @endif
        @if($customer->profile?->notes)
            <p class="text-stone-400"><strong>Notes:</strong> {{ $customer->profile->notes }}</p>
        @endif
    </div>

    <!-- Order History Table -->
    <div class="p-6 rounded-3xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-4">
        <h3 class="font-display font-bold text-base text-white pb-2 border-b border-[#2A2A2A]">Order History</h3>
        <div class="divide-y divide-[#2A2A2A] text-xs">
            @forelse($customer->orders as $o)
                <div class="py-3 flex items-center justify-between">
                    <div>
                        <span class="font-mono font-bold text-white text-sm">#{{ $o->order_number }}</span>
                        <span class="text-stone-400 text-[10px] block">{{ $o->created_at->format('M d, Y') }} • {{ $o->order_status }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="font-bold text-white">{{ $o->formatted_total }}</span>
                        <a href="{{ route('admin.orders.show', $o) }}" class="text-[#B77B3B] hover:underline font-semibold">View Order →</a>
                    </div>
                </div>
            @empty
                <p class="text-stone-500 py-3">No orders placed by this customer.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
