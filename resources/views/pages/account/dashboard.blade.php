@extends('layouts.app')

@section('title', 'Customer Portal | COY BILTONG')

@section('content')

<div class="bg-[#171717] text-white py-10 border-b border-[#262626]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-[#B77B3B]">Customer Account Portal</span>
            <h1 class="font-display font-extrabold text-2xl sm:text-3xl text-white mt-0.5">Welcome, {{ $user->name }}</h1>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('shop') }}" class="px-5 py-2.5 bg-[#B77B3B] hover:bg-[#C98E4F] text-white rounded-xl text-xs font-bold uppercase tracking-wider transition">
                Order Biltong
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2.5 bg-[#262626] hover:bg-stone-700 text-stone-300 rounded-xl text-xs font-semibold transition">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Account Sidebar Navigation (3 cols) -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-3xl border border-[#ECE2D2] p-4 shadow-xs space-y-1">
                <a href="{{ route('account.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold bg-[#171717] text-white">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 text-[#B77B3B]"></i>
                    <span>Dashboard Overview</span>
                </a>
                <a href="{{ route('account.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-semibold text-stone-700 hover:bg-[#F6F0E6] transition">
                    <i data-lucide="package" class="w-4 h-4 text-stone-500"></i>
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

        <!-- Main Account Content (9 cols) -->
        <div class="lg:col-span-9 space-y-8">
            
            <!-- Metrics Row -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-3xl border border-[#ECE2D2] shadow-xs">
                    <span class="text-xs text-stone-500 font-semibold uppercase tracking-wider block">Total Orders</span>
                    <span class="font-display font-extrabold text-3xl text-[#171717] mt-1 block">{{ $totalOrdersCount }}</span>
                    <span class="text-[11px] text-stone-400 mt-1 block">Lifetime purchases</span>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-[#ECE2D2] shadow-xs">
                    <span class="text-xs text-stone-500 font-semibold uppercase tracking-wider block">Total Biltong Spent</span>
                    <span class="font-display font-extrabold text-2xl text-[#171717] mt-1 block">TZS {{ number_format($totalSpent, 0) }}</span>
                    <span class="text-[11px] text-emerald-600 mt-1 block font-medium">Verified orders</span>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-[#ECE2D2] shadow-xs">
                    <span class="text-xs text-stone-500 font-semibold uppercase tracking-wider block">Delivery Addresses</span>
                    <span class="font-display font-extrabold text-3xl text-[#171717] mt-1 block">{{ $user->addresses()->count() }}</span>
                    <a href="{{ route('account.addresses') }}" class="text-[11px] text-[#B77B3B] font-bold mt-1 block hover:underline">Manage Locations →</a>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="bg-white rounded-3xl border border-[#ECE2D2] p-6 shadow-xs">
                <div class="flex items-center justify-between pb-4 border-b border-[#ECE2D2]">
                    <h3 class="font-display font-bold text-lg text-[#171717]">Recent Orders</h3>
                    <a href="{{ route('account.orders') }}" class="text-xs font-bold text-[#B77B3B] hover:underline">View All Orders →</a>
                </div>

                @if($recentOrders->isEmpty())
                    <div class="py-10 text-center text-xs text-stone-500">
                        <i data-lucide="package-x" class="w-8 h-8 mx-auto mb-2 text-stone-400"></i>
                        <p>You haven’t placed any orders yet.</p>
                        <a href="{{ route('shop') }}" class="inline-block mt-3 px-4 py-2 bg-[#171717] text-white rounded-xl font-bold uppercase text-[10px]">Start Shopping</a>
                    </div>
                @else
                    <div class="divide-y divide-[#ECE2D2]">
                        @foreach($recentOrders as $order)
                            <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono font-bold text-sm text-[#171717]">#{{ $order->order_number }}</span>
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $order->status_color }}">
                                            {{ $order->order_status }}
                                        </span>
                                    </div>
                                    <p class="text-stone-400 text-[11px] mt-0.5">{{ $order->created_at->format('M d, Y - h:i A') }} • {{ $order->items->count() }} cut(s)</p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="font-bold text-sm text-[#171717]">{{ $order->formatted_total }}</span>
                                    <a href="{{ route('account.orders.show', $order->order_number) }}" class="px-3 py-1.5 bg-[#F6F0E6] hover:bg-[#B77B3B] hover:text-white rounded-lg font-bold text-xs transition">
                                        Details →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Default Address & Profile Card -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-3xl border border-[#ECE2D2] shadow-xs">
                    <span class="text-xs text-[#68734B] font-bold uppercase tracking-wider block">Default Delivery Location</span>
                    @if($defaultAddress)
                        <h4 class="font-bold text-sm text-[#171717] mt-2">{{ $defaultAddress->recipient_name }} ({{ $defaultAddress->phone }})</h4>
                        <p class="text-xs text-stone-600 mt-1">{{ $defaultAddress->address_line }}</p>
                        <p class="text-xs text-stone-500">{{ $defaultAddress->area }}, {{ $defaultAddress->city }}</p>
                    @else
                        <p class="text-xs text-stone-500 mt-2">No default address configured yet.</p>
                        <a href="{{ route('account.addresses') }}" class="text-xs text-[#B77B3B] font-bold mt-2 inline-block hover:underline">+ Add Address</a>
                    @endif
                </div>

                <div class="bg-white p-6 rounded-3xl border border-[#ECE2D2] shadow-xs flex flex-col justify-between">
                    <div>
                        <span class="text-xs text-[#68734B] font-bold uppercase tracking-wider block">Customer Details</span>
                        <h4 class="font-bold text-sm text-[#171717] mt-2">{{ $user->name }}</h4>
                        <p class="text-xs text-stone-600 mt-0.5">{{ $user->email }}</p>
                        <p class="text-xs text-stone-500">{{ $user->phone }}</p>
                    </div>
                    <a href="{{ route('account.profile') }}" class="text-xs text-[#B77B3B] font-bold hover:underline mt-4">Edit Profile & Password →</a>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
