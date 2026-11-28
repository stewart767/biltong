@extends('layouts.admin')

@section('title', 'Reports & Analytics')

@section('content')

<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-display text-2xl font-bold text-white">Reports & Business Analytics</h2>
            <p class="text-xs text-stone-400">Sales performance, inventory velocity, product revenue, and customer metrics.</p>
        </div>

        <!-- Period selector -->
        <form action="{{ route('admin.reports.index') }}" method="GET" class="flex items-center gap-2">
            <select name="period" onchange="this.form.submit()" class="px-4 py-2 bg-[#1F1F1F] border border-[#2A2A2A] rounded-xl text-xs font-semibold text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                <option value="7days" {{ $period === '7days' ? 'selected' : '' }}>Last 7 Days</option>
                <option value="30days" {{ $period === '30days' ? 'selected' : '' }}>Last 30 Days</option>
                <option value="90days" {{ $period === '90days' ? 'selected' : '' }}>Last 90 Days</option>
                <option value="this_year" {{ $period === 'this_year' ? 'selected' : '' }}>Year to Date</option>
            </select>
        </form>
    </div>

    <!-- 4 High Level Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="p-5 rounded-2xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-1">
            <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400">Period Sales</span>
            <p class="font-extrabold text-2xl text-emerald-400">TZS {{ number_format($totalSales, 0) }}</p>
            <span class="text-[10px] text-stone-500">Excluding cancelled</span>
        </div>

        <div class="p-5 rounded-2xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-1">
            <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400">Total Orders Placed</span>
            <p class="font-extrabold text-2xl text-white">{{ $totalOrdersCount }}</p>
            <span class="text-[10px] text-stone-500">{{ $completedOrdersCount }} fulfilled</span>
        </div>

        <div class="p-5 rounded-2xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-1">
            <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400">Average Order Value</span>
            <p class="font-extrabold text-2xl text-white">TZS {{ number_format($avgOrderValue, 0) }}</p>
            <span class="text-[10px] text-stone-500">Per transaction</span>
        </div>

        <div class="p-5 rounded-2xl bg-[#1F1F1F] border border-[#2A2A2A] space-y-1">
            <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400">New Customers</span>
            <p class="font-extrabold text-2xl text-blue-400">{{ $newCustomersCount }}</p>
            <span class="text-[10px] text-stone-500">Acquired this period</span>
        </div>
    </div>

    <!-- 2 Column Analytics: Product Performance & Inventory Report -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Product Performance (Top Selling Cuts) - 7 cols -->
        <div class="lg:col-span-7 bg-[#1F1F1F] p-6 rounded-3xl border border-[#2A2A2A] space-y-4 shadow-xs">
            <div class="flex items-center justify-between pb-3 border-b border-[#2A2A2A]">
                <h3 class="font-display font-bold text-base text-white">Top Performing Biltong Cuts</h3>
                <span class="text-[10px] text-stone-400">By sales volume</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-stone-400 border-b border-[#2A2A2A]">
                            <th class="pb-2.5 font-semibold">Product Cut</th>
                            <th class="pb-2.5 font-semibold text-center">Packs Sold</th>
                            <th class="pb-2.5 font-semibold text-right">Revenue Generated</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2A2A2A]">
                        @forelse($topProducts as $tp)
                            <tr class="hover:bg-[#262626] transition">
                                <td class="py-3 font-bold text-white">{{ $tp->product_name }}</td>
                                <td class="py-3 text-center text-stone-300 font-bold">{{ $tp->total_qty }}</td>
                                <td class="py-3 text-right font-bold text-emerald-400">TZS {{ number_format($tp->total_revenue, 0) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-6 text-center text-stone-500">No order item records for this period.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Low Stock / Inventory Velocity - 5 cols -->
        <div class="lg:col-span-5 bg-[#1F1F1F] p-6 rounded-3xl border border-[#2A2A2A] space-y-4 shadow-xs">
            <div class="flex items-center justify-between pb-3 border-b border-[#2A2A2A]">
                <h3 class="font-display font-bold text-base text-white">Inventory Restock Watchlist</h3>
                <i data-lucide="alert-circle" class="w-4 h-4 text-amber-400"></i>
            </div>

            <div class="divide-y divide-[#2A2A2A] text-xs">
                @forelse($lowStockProducts as $lsp)
                    <div class="py-3 flex items-center justify-between">
                        <div>
                            <span class="font-bold text-white block">{{ $lsp->name }}</span>
                            <span class="text-[10px] text-stone-400">Default: {{ $lsp->pack_size }} • SKU: {{ $lsp->sku }}</span>
                        </div>
                        <div class="text-right">
                            <span class="px-2.5 py-1 rounded text-[10px] font-bold {{ $lsp->stock <= 5 ? 'bg-red-950 text-red-400 border border-red-800' : 'bg-amber-950 text-amber-400 border border-amber-800' }}">
                                {{ $lsp->stock }} in stock
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="py-6 text-center text-stone-500 text-xs">All products currently have healthy inventory levels.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>

@endsection
