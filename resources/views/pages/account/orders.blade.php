@extends('layouts.app')

@section('title', 'My Orders | COY BILTONG')

@section('content')

<div class="bg-[#171717] text-white py-10 border-b border-[#262626]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display font-extrabold text-2xl sm:text-3xl text-white">Order History</h1>
        <p class="text-xs text-stone-300 mt-1">Review all your previous and active COY BILTONG orders.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-3xl border border-[#ECE2D2] p-4 shadow-xs space-y-1">
                <a href="{{ route('account.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold text-stone-700 hover:bg-[#F6F0E6] transition">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 text-stone-500"></i>
                    <span>Dashboard Overview</span>
                </a>
                <a href="{{ route('account.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold bg-[#171717] text-white">
                    <i data-lucide="package" class="w-4 h-4 text-[#B77B3B]"></i>
                    <span>My Orders</span>
                </a>
                <a href="{{ route('account.addresses') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold text-stone-700 hover:bg-[#F6F0E6] transition">
                    <i data-lucide="map-pin" class="w-4 h-4 text-stone-500"></i>
                    <span>Delivery Addresses</span>
                </a>
                <a href="{{ route('account.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold text-stone-700 hover:bg-[#F6F0E6] transition">
                    <i data-lucide="user" class="w-4 h-4 text-stone-500"></i>
                    <span>Account Profile</span>
                </a>
            </div>
        </div>

        <!-- Orders List (9 cols) -->
        <div class="lg:col-span-9 space-y-6">
            
            <!-- Filters & Search -->
            <form action="{{ route('account.orders') }}" method="GET" class="bg-white p-4 rounded-2xl border border-[#ECE2D2] shadow-xs flex flex-col sm:flex-row gap-3">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Search by Order # (e.g. COY-202611...)" 
                       class="flex-1 px-4 py-2.5 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-xs text-[#171717] focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                
                <select name="status" onchange="this.form.submit()" class="px-4 py-2.5 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-xs font-semibold text-[#171717]">
                    <option value="">All Statuses</option>
                    @foreach(\App\Models\Order::getStatuses() as $st)
                        <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ $st }}</option>
                    @endforeach
                </select>

                <button type="submit" class="px-5 py-2.5 bg-[#171717] hover:bg-[#B77B3B] text-white rounded-xl text-xs font-bold uppercase transition">
                    Filter
                </button>
            </form>

            @if($orders->isEmpty())
                <div class="bg-white p-12 rounded-3xl border border-[#ECE2D2] text-center text-xs text-stone-500">
                    <i data-lucide="package-search" class="w-10 h-10 mx-auto mb-2 text-stone-300"></i>
                    <p class="font-bold text-sm text-[#171717]">No matching orders found</p>
                    <p class="mt-1">Try adjusting your search criteria or explore our collection.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-3xl border border-[#ECE2D2] p-6 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-mono font-bold text-base text-[#171717]">#{{ $order->order_number }}</span>
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $order->status_color }}">
                                        {{ $order->order_status }}
                                    </span>
                                </div>
                                <p class="text-xs text-stone-500">
                                    Placed on {{ $order->created_at->format('M d, Y - h:i A') }} • Payment: <strong class="uppercase text-[#171717]">{{ $order->payment_method }}</strong> ({{ $order->payment_status }})
                                </p>
                                <p class="text-xs text-stone-600 line-clamp-1">
                                    {{ $order->items->pluck('product_name')->implode(', ') }}
                                </p>
                            </div>

                            <div class="flex items-center gap-4 border-t sm:border-t-0 pt-3 sm:pt-0 border-[#ECE2D2]">
                                <div class="text-right">
                                    <span class="block font-black text-base text-[#171717]">{{ $order->formatted_total }}</span>
                                    <span class="text-[10px] text-stone-400">{{ $order->items->count() }} item(s)</span>
                                </div>
                                <a href="{{ route('account.orders.show', $order->order_number) }}" class="px-4 py-2.5 bg-[#171717] hover:bg-[#B77B3B] text-white rounded-xl font-bold text-xs uppercase tracking-wider transition">
                                    View
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            @endif

        </div>

    </div>
</div>

@endsection
