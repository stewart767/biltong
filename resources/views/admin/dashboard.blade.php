@extends('layouts.admin')

@section('title', 'Operations Dashboard')
@section('page_title', 'Operations Dashboard')

@section('content')

    <div class="space-y-8">
        
        <!-- Header & Quick Jump -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-editorial text-2xl font-bold text-brand-cream">INAS Operations Center</h2>
                <p class="text-xs text-brand-muted">Comprehensive management for butchery stock, storefront editorial, incoming orders and customer inquiries</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.products.create') }}" class="px-4 py-2 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs uppercase tracking-wider transition shadow-md flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Add Product</span>
                </a>
                <a href="{{ route('admin.categories.create') }}" class="px-3.5 py-2 rounded-xl bg-brand-dark hover:bg-brand-card text-brand-cream border border-brand-border font-semibold text-xs transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-brand-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>New Category</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="px-3.5 py-2 rounded-xl bg-brand-dark hover:bg-brand-card text-brand-cream border border-brand-border font-semibold text-xs transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-brand-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Storefront Content</span>
                </a>
            </div>
        </div>

        <!-- 6 Key Metrics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
            
            <!-- 1. Total Revenue -->
            <div class="p-5 rounded-2xl bg-brand-card border border-brand-border space-y-2">
                <div class="flex items-center justify-between text-brand-muted text-[11px] uppercase tracking-wider font-semibold">
                    <span>Total Sales</span>
                    <span class="w-7 h-7 rounded-lg bg-emerald-950 text-emerald-400 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                </div>
                <div class="text-xl font-bold text-emerald-400">
                    TZS {{ number_format($totalRevenue, 0) }}
                </div>
                <span class="text-[10px] text-emerald-400/80 font-medium">Paid orders</span>
            </div>

            <!-- 2. Orders Count -->
            <a href="{{ route('admin.orders.index') }}" class="p-5 rounded-2xl bg-brand-card border border-brand-border space-y-2 hover:border-brand-red/50 transition">
                <div class="flex items-center justify-between text-brand-muted text-[11px] uppercase tracking-wider font-semibold">
                    <span>Store Orders</span>
                    <span class="w-7 h-7 rounded-lg bg-brand-dark text-brand-red flex items-center justify-center">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </span>
                </div>
                <div class="text-2xl font-bold text-brand-cream">
                    {{ $allOrdersCount }}
                </div>
                <div class="text-[10px] text-amber-400 font-medium">
                    {{ $pendingOrdersCount }} pending dispatch
                </div>
            </a>

            <!-- 3. Active Products -->
            <a href="{{ route('admin.products.index') }}" class="p-5 rounded-2xl bg-brand-card border border-brand-border space-y-2 hover:border-brand-red/50 transition">
                <div class="flex items-center justify-between text-brand-muted text-[11px] uppercase tracking-wider font-semibold">
                    <span>Catalogue Cuts</span>
                    <span class="w-7 h-7 rounded-lg bg-brand-dark text-brand-red flex items-center justify-center">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </span>
                </div>
                <div class="text-2xl font-bold text-brand-cream">
                    {{ $productsCount }}
                </div>
                <span class="text-[10px] text-brand-muted">{{ $categoriesCount }} active categories</span>
            </a>

            <!-- 4. Wholesale Inquiries -->
            <a href="{{ route('admin.wholesale.index') }}" class="p-5 rounded-2xl bg-brand-card border border-brand-border space-y-2 hover:border-brand-red/50 transition">
                <div class="flex items-center justify-between text-brand-muted text-[11px] uppercase tracking-wider font-semibold">
                    <span>Wholesale Leads</span>
                    <span class="w-7 h-7 rounded-lg bg-purple-950 text-purple-300 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </span>
                </div>
                <div class="text-2xl font-bold text-brand-cream">
                    {{ $wholesaleCount }}
                </div>
                <span class="text-[10px] text-purple-300 font-medium">B2B inquiries</span>
            </a>

            <!-- 5. Customer Messages -->
            <a href="{{ route('admin.messages.index') }}" class="p-5 rounded-2xl bg-brand-card border border-brand-border space-y-2 hover:border-brand-red/50 transition">
                <div class="flex items-center justify-between text-brand-muted text-[11px] uppercase tracking-wider font-semibold">
                    <span>Customer Inquiries</span>
                    <span class="w-7 h-7 rounded-lg bg-red-950 text-brand-red flex items-center justify-center">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </span>
                </div>
                <div class="text-2xl font-bold text-brand-cream">
                    {{ $unreadMessagesCount }}
                </div>
                <span class="text-[10px] text-red-400 font-medium">Unread messages</span>
            </a>

            <!-- 6. Newsletter Subscribers -->
            <a href="{{ route('admin.subscribers.index') }}" class="p-5 rounded-2xl bg-brand-card border border-brand-border space-y-2 hover:border-brand-red/50 transition">
                <div class="flex items-center justify-between text-brand-muted text-[11px] uppercase tracking-wider font-semibold">
                    <span>Subscribers</span>
                    <span class="w-7 h-7 rounded-lg bg-blue-950 text-blue-300 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </span>
                </div>
                <div class="text-2xl font-bold text-brand-cream">
                    {{ $subscribersCount }}
                </div>
                <span class="text-[10px] text-blue-300 font-medium">The Butcher's Club</span>
            </a>

        </div>

        <!-- Recent Activity 3-Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: Recent Orders (7 cols) -->
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

            <!-- Right: Wholesale Enquiries & Inquiries (5 cols) -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- Wholesale Leads -->
                <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="font-editorial text-lg font-bold text-brand-cream">B2B Wholesale Inquiries</h2>
                            <span class="text-xs text-brand-muted">Commercial distribution leads</span>
                        </div>
                        <a href="{{ route('admin.wholesale.index') }}" class="text-xs font-semibold text-brand-red hover:underline">
                            View All &rarr;
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentWholesale as $lead)
                            <div class="p-3.5 rounded-xl bg-brand-dark border border-brand-border/70 space-y-1.5 hover:border-brand-red/40 transition">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="font-bold text-brand-cream text-xs">{{ $lead->business_name }}</h3>
                                        <span class="text-[11px] text-brand-red">{{ $lead->business_type }} • {{ $lead->contact_person }}</span>
                                    </div>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold border {{ $lead->status_badge_class }}">
                                        {{ ucfirst($lead->status) }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between pt-1 text-[11px]">
                                    <span class="text-brand-muted">Est. Volume: <strong>{{ $lead->estimated_quantity }}</strong></span>
                                    <a href="{{ route('admin.wholesale.show', $lead) }}" class="text-brand-red font-semibold hover:underline">
                                        Respond &rarr;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-brand-muted text-center py-4">No wholesale inquiries yet.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Customer Messages -->
                <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="font-editorial text-lg font-bold text-brand-cream">Latest Customer Messages</h2>
                            <span class="text-xs text-brand-muted">Contact page messages</span>
                        </div>
                        <a href="{{ route('admin.messages.index') }}" class="text-xs font-semibold text-brand-red hover:underline">
                            View All &rarr;
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentMessages as $msg)
                            <div class="p-3.5 rounded-xl bg-brand-dark border border-brand-border/70 space-y-1.5 hover:border-brand-red/40 transition">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="font-bold text-brand-cream text-xs">{{ $msg->name }}</h3>
                                        <span class="text-[11px] text-brand-muted">{{ $msg->subject }}</span>
                                    </div>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $msg->status === 'unread' ? 'bg-amber-500/20 text-amber-400' : 'bg-emerald-500/20 text-emerald-400' }}">
                                        {{ ucfirst($msg->status) }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between pt-1 text-[11px]">
                                    <span class="text-brand-muted">{{ $msg->created_at->diffForHumans() }}</span>
                                    <a href="{{ route('admin.messages.show', $msg) }}" class="text-brand-red font-semibold hover:underline">
                                        Read &rarr;
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-brand-muted text-center py-4">No customer messages received yet.</p>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
