<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') | INAS Premium Beef Biltong</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-brand-black text-brand-cream font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex">
        
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-brand-charcoal border-r border-brand-border flex flex-col transition-transform duration-300 md:translate-x-0"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
            
            <!-- Logo area -->
            <div class="h-20 flex items-center justify-between px-6 border-b border-brand-border bg-brand-dark">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded bg-brand-card flex items-center justify-center border border-brand-red/40">
                        <span class="font-editorial text-xl font-bold text-brand-red">I</span>
                    </div>
                    <div>
                        <span class="font-bold tracking-wider text-brand-cream text-base uppercase">INAS ADMIN</span>
                        <p class="text-[9px] text-brand-muted tracking-widest uppercase">Biltong Operations</p>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="md:hidden text-brand-muted hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-brand-red text-white font-semibold' : 'text-brand-cream/80 hover:bg-brand-card hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.products*') ? 'bg-brand-red text-white font-semibold' : 'text-brand-cream/80 hover:bg-brand-card hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span>Products</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.categories*') ? 'bg-brand-red text-white font-semibold' : 'text-brand-cream/80 hover:bg-brand-card hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <span>Categories</span>
                </a>

                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.orders*') ? 'bg-brand-red text-white font-semibold' : 'text-brand-cream/80 hover:bg-brand-card hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Orders</span>
                    </div>
                    @php $pendingCount = \App\Models\Order::where('order_status', 'pending')->count(); @endphp
                    @if($pendingCount > 0)
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-amber-500 text-black">{{ $pendingCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.wholesale.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.wholesale*') ? 'bg-brand-red text-white font-semibold' : 'text-brand-cream/80 hover:bg-brand-card hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>Wholesale Leads</span>
                    </div>
                    @php $newLeads = \App\Models\WholesaleEnquiry::where('status', 'new')->count(); @endphp
                    @if($newLeads > 0)
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-500 text-black">{{ $newLeads }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.messages.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.messages*') ? 'bg-brand-red text-white font-semibold' : 'text-brand-cream/80 hover:bg-brand-card hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Customer Messages</span>
                    </div>
                    @php $unreadMsgs = \App\Models\ContactMessage::where('status', 'unread')->count(); @endphp
                    @if($unreadMsgs > 0)
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-red-500 text-white animate-pulse">{{ $unreadMsgs }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.subscribers.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.subscribers*') ? 'bg-brand-red text-white font-semibold' : 'text-brand-cream/80 hover:bg-brand-card hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Subscribers</span>
                    </div>
                    @php $subCount = \App\Models\NewsletterSubscriber::count(); @endphp
                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-brand-dark text-brand-muted border border-brand-border">{{ $subCount }}</span>
                </a>

                <a href="{{ route('admin.settings.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.settings*') ? 'bg-brand-red text-white font-semibold' : 'text-brand-cream/80 hover:bg-brand-card hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Website & Content</span>
                </a>

                <div class="pt-6 pb-2 border-t border-brand-border/60">
                    <span class="px-3 text-[10px] uppercase font-bold tracking-wider text-brand-muted">Storefront</span>
                </div>

                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-medium text-brand-cream/70 hover:bg-brand-card hover:text-white transition">
                    <svg class="w-4 h-4 text-brand-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>View Live Website</span>
                </a>
            </nav>

            <!-- Admin Profile / Logout -->
            <div class="p-4 border-t border-brand-border bg-brand-dark flex items-center justify-between">
                <div class="flex items-center gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 rounded-full bg-brand-red text-white flex items-center justify-center font-bold text-xs">
                        AD
                    </div>
                    <div class="overflow-hidden">
                        <span class="block text-xs font-semibold text-brand-cream truncate">{{ auth()->user()->name ?? 'Administrator' }}</span>
                        <span class="block text-[10px] text-brand-muted truncate">Buguruni Malapa</span>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2 text-brand-muted hover:text-red-400 transition" title="Log Out">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Body -->
        <div class="flex-1 md:pl-64 flex flex-col min-w-0">
            <!-- Header bar -->
            <header class="h-20 bg-brand-charcoal/90 backdrop-blur-md border-b border-brand-border px-6 flex items-center justify-between sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="md:hidden p-2 rounded-lg bg-brand-card text-brand-cream hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="text-lg font-bold text-brand-cream">
                        @yield('page_title', 'Management Dashboard')
                    </h1>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs text-brand-muted hidden sm:inline">Dar es Salaam, Tanzania (EAT)</span>
                    <a href="{{ route('admin.products.create') }}" class="px-3.5 py-1.5 rounded-lg bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs font-semibold hover:shadow-lg transition flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>New Product</span>
                    </a>
                </div>
            </header>

            <!-- Flash alerts -->
            <div class="px-6 pt-6">
                @if(session('success'))
                    <div class="p-4 rounded-xl bg-emerald-950/70 border border-emerald-500/60 text-emerald-300 text-sm flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="p-4 rounded-xl bg-red-950/70 border border-red-500/60 text-red-300 text-sm flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Page content -->
            <main class="p-6 flex-1">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
