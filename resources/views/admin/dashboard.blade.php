@extends('layouts.admin')

@section('title', 'Overview & Analytics')
@section('page_title', 'Operations Dashboard')

@section('content')

    <div class="space-y-8">
        
        <!-- Metrics Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Revenue -->
            <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-2">
                <div class="flex items-center justify-between text-brand-muted text-xs uppercase tracking-wider font-semibold">
                    <span>Paid Revenue</span>
                    <span class="w-8 h-8 rounded-lg bg-emerald-950 text-emerald-400 flex items-center justify-center font-bold text-sm">TZS</span>
                </div>
                <div class="text-2xl sm:text-3xl font-bold text-brand-cream">
                    TZS {{ number_format($totalRevenue, 0) }}
                </div>
                <span class="text-[11px] text-emerald-400 font-medium">From confirmed retail & wholesale</span>
            </div>

            <!-- Orders Count -->
            <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-2">
                <div class="flex items-center justify-between text-brand-muted text-xs uppercase tracking-wider font-semibold">
                    <span>Total Orders</span>
                    <span class="w-8 h-8 rounded-lg bg-brand-dark text-brand-red flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </span>
                </div>
                <div class="text-2xl sm:text-3xl font-bold text-brand-cream">
                    {{ $allOrdersCount }}
                </div>
                <div class="text-[11px] text-amber-400 font-medium">
                    {{ $pendingOrdersCount }} pending dispatch
                </div>
            </div>

            <!-- Active Products -->
            <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-2">
                <div class="flex items-center justify-between text-brand-muted text-xs uppercase tracking-wider font-semibold">
                    <span>Catalogue Cuts</span>
                    <span class="w-8 h-8 rounded-lg bg-brand-dark text-brand-red flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </span>
                </div>
                <div class="text-2xl sm:text-3xl font-bold text-brand-cream">
                    {{ $productsCount }}
                </div>
                <span class="text-[11px] text-brand-muted">Flagship: Biltong Original 100g</span>
            </div>

            <!-- Wholesale Inquiries -->
            <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-2">
                <div class="flex items-center justify-between text-brand-muted text-xs uppercase tracking-wider font-semibold">
                    <span>New Wholesale Leads</span>
                    <span class="w-8 h-8 rounded-lg bg-purple-950 text-purple-300 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </span>
                </div>
                <div class="text-2xl sm:text-3xl font-bold text-brand-cream">
                    {{ $wholesaleCount }}
                </div>
                <span class="text-[11px] text-purple-300 font-medium">Supermarkets, Lodges & Gyms</span>
            </div>
        </div>

        <!-- Recent Orders & Wholesale Leads Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: Recent Orders -->
            <div class="lg:col-span-7 p-6 rounded-2xl bg-brand-card border border-brand-border space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-editorial text-xl font-bold text-brand-cream">Recent Storefront Orders</h2>
                        <span class="text-xs text-brand-muted">Latest deliveries registered in Dar es Salaam</span>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-semibold text-brand-red hover:underline">
                        View All Orders &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="border-b border-brand-border/60 text-brand-muted uppercase text-[10px] tracking-wider">
                                <th class="pb-3">Order #</th>
                                <th class="pb-3">Customer</th>
                                <th class="pb-3">Area</th>
                                <th class="pb-3">Total</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-brand-border/60">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-brand-dark/40 transition">
                                    <td class="py-3 font-bold text-brand-red">
                                        <a href="{{ route('admin.orders.show', $order) }}">#{{ $order->order_number }}</a>
                                    </td>
                                    <td class="py-3 text-brand-cream font-medium">
                                        {{ $order->customer_name }}
                                    </td>
                                    <td class="py-3 text-brand-cream/80">
                                        {{ $order->delivery_area }}
                                    </td>
                                    <td class="py-3 font-bold text-brand-cream">
                                        {{ $order->formatted_total }}
                                    </td>
                                    <td class="py-3">
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $order->status_badge_class }}">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="text-brand-red hover:underline font-semibold">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-brand-muted">No orders placed yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right: Wholesale Enquiries Leads -->
            <div class="lg:col-span-5 p-6 rounded-2xl bg-brand-card border border-brand-border space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-editorial text-xl font-bold text-brand-cream">B2B Wholesale Inquiries</h2>
                        <span class="text-xs text-brand-muted">Commercial distribution leads</span>
                    </div>
                    <a href="{{ route('admin.wholesale.index') }}" class="text-xs font-semibold text-brand-red hover:underline">
                        View All &rarr;
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($recentWholesale as $lead)
                        <div class="p-4 rounded-xl bg-brand-dark border border-brand-border/70 space-y-2 hover:border-brand-red/40 transition">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="font-bold text-brand-cream text-xs">{{ $lead->business_name }}</h3>
                                    <span class="text-[11px] text-brand-red">{{ $lead->business_type }} • {{ $lead->contact_person }}</span>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold border {{ $lead->status_badge_class }}">
                                    {{ ucfirst($lead->status) }}
                                </span>
                            </div>
                            <p class="text-[11px] text-brand-muted line-clamp-2">
                                "{{ $lead->message }}"
                            </p>
                            <div class="flex items-center justify-between pt-1 text-[11px]">
                                <span class="text-brand-muted">Est. Volume: <strong>{{ $lead->estimated_quantity }}</strong></span>
                                <a href="{{ route('admin.wholesale.show', $lead) }}" class="text-brand-red font-semibold hover:underline">
                                    Respond &rarr;
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-brand-muted text-center py-6">No wholesale inquiries yet.</p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

@endsection
