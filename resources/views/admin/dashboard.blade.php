@extends('layouts.admin')

@section('title', 'Operations Dashboard')

@section('content')

<div class="space-y-8">
    
    <!-- Top Greeting & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-orange-950/60 border border-red-500/40 text-[#E52E2E] text-[10px] font-bold uppercase tracking-wider mb-2">
                <span class="w-1.5 h-1.5 rounded-full bg-[#E52E2E] animate-pulse"></span>
                <span>Kitchen & Store Operations</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-white">Burger House Operations</h1>
            <p class="text-xs text-stone-400 mt-1">COY BILTONG Operations: Real-time kitchen orders, menu inventory, customer dispatches and daily revenue.</p>
        </div>
        
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.products.create') }}" class="px-4 py-2 rounded-xl bg-[#E52E2E] hover:bg-[#C61A1A] text-white font-bold text-xs uppercase tracking-wider transition shadow-md shadow-red-500/20 border-2 border-white/20 flex items-center gap-1.5">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Add Item</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="px-3.5 py-2 rounded-xl bg-[#1C1C1C] hover:bg-stone-800 text-stone-200 border-2 border-[#2A2A2A] hover:border-[#E52E2E] font-semibold text-xs transition flex items-center gap-1.5">
                <i data-lucide="shopping-bag" class="w-4 h-4 text-[#E52E2E]"></i>
                <span>Orders</span>
            </a>
            <a href="{{ route('admin.reports.index') }}" class="px-3.5 py-2 rounded-xl bg-[#1C1C1C] hover:bg-stone-800 text-stone-200 border-2 border-[#2A2A2A] hover:border-[#E52E2E] font-semibold text-xs transition flex items-center gap-1.5">
                <i data-lucide="bar-chart-2" class="w-4 h-4 text-[#E52E2E]"></i>
                <span>Reports</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="px-3.5 py-2 rounded-xl bg-[#1C1C1C] hover:bg-stone-800 text-stone-200 border-2 border-[#2A2A2A] hover:border-[#E52E2E] font-semibold text-xs transition flex items-center gap-1.5">
                <i data-lucide="settings" class="w-4 h-4 text-[#E52E2E]"></i>
                <span>Settings</span>
            </a>
        </div>
    </div>

    <!-- 7 Key Overview Metrics with Classic Modified Borders -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-7 gap-4">
        
        <!-- 1. Total Sales -->
        <div class="p-5 rounded-2xl bg-[#1C1C1C] border-2 border-[#2A2A2A] hover:border-[#E52E2E]/70 transition-all space-y-1.5 flex flex-col justify-between shadow-xs">
            <div class="flex items-center justify-between text-stone-400 text-[10px] uppercase font-bold tracking-wider">
                <span>Total Sales</span>
                <i data-lucide="trending-up" class="w-3.5 h-3.5 text-emerald-400"></i>
            </div>
            <div class="text-lg font-black text-emerald-400 truncate">
                Tshs {{ number_format($totalSales, 0) }}
            </div>
            <span class="text-[10px] text-stone-500">Gross sales volume</span>
        </div>

        <!-- 2. Total Orders -->
        <a href="{{ route('admin.orders.index') }}" class="p-5 rounded-2xl bg-[#1C1C1C] border-2 border-[#2A2A2A] hover:border-[#E52E2E]/70 transition-all space-y-1.5 flex flex-col justify-between shadow-xs">
            <div class="flex items-center justify-between text-stone-400 text-[10px] uppercase font-bold tracking-wider">
                <span>Total Orders</span>
                <i data-lucide="shopping-bag" class="w-3.5 h-3.5 text-[#E52E2E]"></i>
            </div>
            <div class="text-2xl font-black text-white">
                {{ $totalOrders }}
            </div>
            <span class="text-[10px] text-stone-500">All customer orders</span>
        </a>

        <!-- 3. Pending Orders -->
        <a href="{{ route('admin.orders.index', ['status' => 'Pending']) }}" class="p-5 rounded-2xl bg-[#1C1C1C] border-2 border-[#2A2A2A] hover:border-amber-500/70 transition-all space-y-1.5 flex flex-col justify-between shadow-xs">
            <div class="flex items-center justify-between text-stone-400 text-[10px] uppercase font-bold tracking-wider">
                <span>Pending Orders</span>
                <i data-lucide="clock" class="w-3.5 h-3.5 text-amber-400"></i>
            </div>
            <div class="text-2xl font-black text-amber-400">
                {{ $pendingOrders }}
            </div>
            <span class="text-[10px] text-amber-400/80 font-medium">Needs kitchen prep</span>
        </a>

        <!-- 4. Completed Orders -->
        <a href="{{ route('admin.orders.index', ['status' => 'Delivered']) }}" class="p-5 rounded-2xl bg-[#1C1C1C] border-2 border-[#2A2A2A] hover:border-emerald-500/70 transition-all space-y-1.5 flex flex-col justify-between shadow-xs">
            <div class="flex items-center justify-between text-stone-400 text-[10px] uppercase font-bold tracking-wider">
                <span>Delivered</span>
                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-400"></i>
            </div>
            <div class="text-2xl font-black text-emerald-400">
                {{ $completedOrders }}
            </div>
            <span class="text-[10px] text-stone-500">Fulfilled orders</span>
        </a>

        <!-- 5. Total Customers -->
        <a href="{{ route('admin.customers.index') }}" class="p-5 rounded-2xl bg-[#1C1C1C] border-2 border-[#2A2A2A] hover:border-blue-500/70 transition-all space-y-1.5 flex flex-col justify-between shadow-xs">
            <div class="flex items-center justify-between text-stone-400 text-[10px] uppercase font-bold tracking-wider">
                <span>Customers</span>
                <i data-lucide="users" class="w-3.5 h-3.5 text-blue-400"></i>
            </div>
            <div class="text-2xl font-black text-white">
                {{ $totalCustomers }}
            </div>
            <span class="text-[10px] text-stone-500">Registered users</span>
        </a>

        <!-- 6. Low-Stock Products -->
        <a href="{{ route('admin.products.index') }}" class="p-5 rounded-2xl bg-[#1C1C1C] border-2 border-[#2A2A2A] hover:border-red-500/70 transition-all space-y-1.5 flex flex-col justify-between shadow-xs">
            <div class="flex items-center justify-between text-stone-400 text-[10px] uppercase font-bold tracking-wider">
                <span>Low Stock</span>
                <i data-lucide="alert-triangle" class="w-3.5 h-3.5 text-red-400"></i>
            </div>
            <div class="text-2xl font-black {{ $lowStockProducts->count() > 0 ? 'text-red-400' : 'text-stone-300' }}">
                {{ $lowStockProducts->count() }}
            </div>
            <span class="text-[10px] text-stone-500">< 15 portions left</span>
        </a>

        <!-- 7. Active Products -->
        <a href="{{ route('admin.products.index') }}" class="p-5 rounded-2xl bg-[#1C1C1C] border-2 border-[#2A2A2A] hover:border-[#E52E2E]/70 transition-all space-y-1.5 flex flex-col justify-between shadow-xs">
            <div class="flex items-center justify-between text-stone-400 text-[10px] uppercase font-bold tracking-wider">
                <span>Menu Items</span>
                <i data-lucide="package" class="w-3.5 h-3.5 text-[#E52E2E]"></i>
            </div>
            <div class="text-2xl font-black text-white">
                {{ $productsCount }}
            </div>
            <span class="text-[10px] text-stone-500">{{ $categoriesCount }} categories</span>
        </a>

    </div>

    <!-- Main Grid: Recent Orders & Recent Transactions with Classic Borders -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Recent Orders (8 cols) -->
        <div class="lg:col-span-8 bg-[#1C1C1C] rounded-3xl border-2 border-[#2A2A2A] p-6 shadow-sm">
            <div class="flex items-center justify-between pb-4 border-b border-[#2A2A2A]">
                <div>
                    <h3 class="font-bold text-lg text-white">Live Kitchen Orders</h3>
                    <p class="text-[11px] text-stone-400">Incoming online delivery requests and customer payments</p>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-[#E52E2E] hover:underline flex items-center gap-1">
                    <span>View All Orders</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <div class="mt-4 overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-stone-400 border-b border-[#2A2A2A]">
                            <th class="pb-3 font-semibold">Order #</th>
                            <th class="pb-3 font-semibold">Customer</th>
                            <th class="pb-3 font-semibold">Total</th>
                            <th class="pb-3 font-semibold">Payment</th>
                            <th class="pb-3 font-semibold">Status</th>
                            <th class="pb-3 font-semibold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2A2A2A]">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-[#242424] transition">
                                <td class="py-3.5 font-mono font-bold text-[#E52E2E]">
                                    {{ $order->order_number }}
                                </td>
                                <td class="py-3.5">
                                    <p class="font-bold text-white">{{ $order->customer_name }}</p>
                                    <p class="text-[10px] text-stone-400">{{ $order->customer_phone }}</p>
                                </td>
                                <td class="py-3.5 font-bold text-white">
                                    {{ $order->formatted_total }}
                                </td>
                                <td class="py-3.5">
                                    <span class="uppercase text-[10px] font-bold text-stone-300 block">{{ $order->payment_method }}</span>
                                    <span class="text-[10px] {{ $order->payment_status === 'paid' ? 'text-emerald-400' : 'text-amber-400' }} capitalize font-medium">{{ $order->payment_status }}</span>
                                </td>
                                <td class="py-3.5">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $order->status_color }}">
                                        {{ $order->order_status }}
                                    </span>
                                </td>
                                <td class="py-3.5 text-right">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="px-3 py-1.5 rounded-lg bg-[#2A2A2A] hover:bg-[#E52E2E] text-white font-bold text-[10px] border border-[#3A3A3A] hover:border-[#E52E2E] transition">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-stone-500 text-xs">No orders recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Transactions & Low Stock Alerts (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Recent Transactions Card with Classic Border -->
            <div class="bg-[#1C1C1C] rounded-3xl border-2 border-[#2A2A2A] p-6 shadow-sm">
                <div class="flex items-center justify-between pb-3 border-b border-[#2A2A2A]">
                    <h3 class="font-bold text-base text-white">Recent Transactions</h3>
                    <i data-lucide="receipt" class="w-4 h-4 text-[#E52E2E]"></i>
                </div>

                <div class="mt-3 divide-y divide-[#2A2A2A] text-xs">
                    @forelse($recentTransactions as $tx)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <p class="font-bold text-white">Tshs {{ number_format($tx->amount, 0) }}</p>
                                <p class="text-[10px] text-stone-400 uppercase">{{ $tx->payment_method }} • {{ $tx->order?->order_number }}</p>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $tx->status === 'verified' ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-amber-950 text-amber-400 border border-amber-800' }}">
                                {{ ucfirst($tx->status) }}
                            </span>
                        </div>
                    @empty
                        <p class="py-4 text-xs text-stone-500 text-center">No transactions recorded yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Low Stock Warnings with Classic Border -->
            @if($lowStockProducts->count() > 0)
                <div class="bg-[#1C1C1C] rounded-3xl border-2 border-red-900/60 p-6 shadow-sm">
                    <div class="flex items-center gap-2 pb-3 border-b border-[#2A2A2A] text-red-400">
                        <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                        <h3 class="font-bold text-base text-white">Low Kitchen Inventory</h3>
                    </div>

                    <div class="mt-3 divide-y divide-[#2A2A2A] text-xs">
                        @foreach($lowStockProducts->take(4) as $low)
                            <div class="py-2.5 flex items-center justify-between">
                                <span class="text-stone-300 font-medium truncate max-w-[150px]">{{ $low->name }}</span>
                                <span class="px-2 py-0.5 rounded bg-red-950 text-red-400 font-bold text-[10px] border border-red-800">
                                    {{ $low->stock }} left
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

    </div>

</div>

@endsection
