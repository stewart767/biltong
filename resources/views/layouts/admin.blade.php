<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') | Burger House Operations</title>

    @php 
        $siteFavicon = \App\Models\SiteSetting::get('site_favicon'); 
        $siteLogo = \App\Models\SiteSetting::get('site_logo');
    @endphp
    @if($siteFavicon && file_exists(public_path($siteFavicon)))
        <link rel="icon" href="{{ asset($siteFavicon) }}">
    @endif

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#141414] text-[#F5F5F5] font-sans antialiased selection:bg-[#E52E2E] selection:text-white" 
      x-data="{ sidebarOpen: false }"
      x-init="lucide.createIcons()">

    <div class="min-h-screen flex">
        
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-[#1C1C1C] border-r border-[#2A2A2A] flex flex-col transition-transform duration-300 md:translate-x-0"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
            
            <!-- Logo area -->
            <div class="h-20 flex items-center justify-between px-6 border-b border-[#2A2A2A] bg-[#141414]">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    @if($siteLogo && file_exists(public_path($siteLogo)))
                        <img src="{{ asset($siteLogo) }}" alt="Burger House" class="h-10 w-auto object-contain">
                    @else
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#DC2626] to-[#EF4444] flex items-center justify-center text-white shadow-sm border border-white/30 flex-shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4c-4.418 0-8 2.239-8 5v1h16V9c0-2.761-3.582-5-8-5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 14h16v1c0 2.761-3.582 5-8 5s-8-2.239-8-5v-1z" />
                                <line x1="3" y1="12" x2="21" y2="12" stroke-linecap="round" />
                            </svg>
                        </div>
                    @endif
                    <div>
                        <span class="font-extrabold tracking-wider text-white text-base">BURGER HOUSE</span>
                        <p class="text-[9px] text-[#E52E2E] font-bold uppercase tracking-widest -mt-0.5">Admin Operations</p>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="md:hidden text-stone-400 hover:text-white">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto text-xs">
                
                <div class="px-3 pb-2 text-[10px] font-bold text-stone-400 uppercase tracking-widest">
                    Kitchen & Storefront
                </div>

                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard*') ? 'bg-[#E52E2E] text-white font-bold shadow-md shadow-red-500/20' : 'text-stone-300 hover:bg-[#2A2A2A] hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.products*') ? 'bg-[#E52E2E] text-white font-bold shadow-md shadow-red-500/20' : 'text-stone-300 hover:bg-[#2A2A2A] hover:text-white' }}">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    <span>Burgers & Menu Items</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.categories*') ? 'bg-[#E52E2E] text-white font-bold shadow-md shadow-red-500/20' : 'text-stone-300 hover:bg-[#2A2A2A] hover:text-white' }}">
                    <i data-lucide="tags" class="w-4 h-4"></i>
                    <span>Menu Categories</span>
                </a>

                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.orders*') ? 'bg-[#E52E2E] text-white font-bold shadow-md shadow-red-500/20' : 'text-stone-300 hover:bg-[#2A2A2A] hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                        <span>Live Orders & Delivery</span>
                    </div>
                    @php $pendingCount = \App\Models\Order::whereIn('order_status', ['Pending', 'pending', 'Awaiting Payment', 'processing'])->count(); @endphp
                    @if($pendingCount > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#E52E2E] text-white">{{ $pendingCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.customers.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.customers*') ? 'bg-[#E52E2E] text-white font-bold shadow-md shadow-red-500/20' : 'text-stone-300 hover:bg-[#2A2A2A] hover:text-white' }}">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>Customers</span>
                </a>

                <div class="px-3 pt-4 pb-2 text-[10px] font-bold text-stone-400 uppercase tracking-widest">
                    Deals & Content
                </div>

                <a href="{{ route('admin.content.banners') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.content.banners*') ? 'bg-[#E52E2E] text-white font-bold shadow-md shadow-red-500/20' : 'text-stone-300 hover:bg-[#2A2A2A] hover:text-white' }}">
                    <i data-lucide="sliders" class="w-4 h-4"></i>
                    <span>Hero Sliders & Banners</span>
                </a>

                <a href="{{ route('admin.content.testimonials') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.content.testimonials*') ? 'bg-[#E52E2E] text-white font-bold shadow-md shadow-red-500/20' : 'text-stone-300 hover:bg-[#2A2A2A] hover:text-white' }}">
                    <i data-lucide="message-square" class="w-4 h-4"></i>
                    <span>Customer Reviews</span>
                </a>

                <a href="{{ route('admin.reports.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.reports*') ? 'bg-[#E52E2E] text-white font-bold shadow-md shadow-red-500/20' : 'text-stone-300 hover:bg-[#2A2A2A] hover:text-white' }}">
                    <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                    <span>Sales & Reports</span>
                </a>

                <div class="px-3 pt-4 pb-2 text-[10px] font-bold text-stone-400 uppercase tracking-widest">
                    Communication & Settings
                </div>

                <a href="{{ route('admin.wholesale.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.wholesale*') ? 'bg-[#E52E2E] text-white font-bold shadow-md shadow-red-500/20' : 'text-stone-300 hover:bg-[#2A2A2A] hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="briefcase" class="w-4 h-4"></i>
                        <span>Catering & Bulk Leads</span>
                    </div>
                    @php $newLeads = \App\Models\WholesaleEnquiry::where('status', 'new')->count(); @endphp
                    @if($newLeads > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#E52E2E] text-white">{{ $newLeads }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.messages.index') }}" 
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.messages*') ? 'bg-[#E52E2E] text-white font-bold shadow-md shadow-red-500/20' : 'text-stone-300 hover:bg-[#2A2A2A] hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                        <span>Customer Messages</span>
                    </div>
                    @php $unreadMsgs = \App\Models\ContactMessage::where('status', 'unread')->count(); @endphp
                    @if($unreadMsgs > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#E52E2E] text-white animate-pulse">{{ $unreadMsgs }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.subscribers.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.subscribers*') ? 'bg-[#E52E2E] text-white font-bold shadow-md shadow-red-500/20' : 'text-stone-300 hover:bg-[#2A2A2A] hover:text-white' }}">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                    <span>Subscribers</span>
                </a>

                <a href="{{ route('admin.settings.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.settings*') ? 'bg-[#E52E2E] text-white font-bold shadow-md shadow-red-500/20' : 'text-stone-300 hover:bg-[#2A2A2A] hover:text-white' }}">
                    <i data-lucide="settings" class="w-4 h-4"></i>
                    <span>Kitchen & Site Settings</span>
                </a>
            </nav>

            <!-- Bottom User Card -->
            <div class="p-4 border-t border-[#2A2A2A] bg-[#141414]">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5 overflow-hidden">
                        <div class="w-8 h-8 rounded-full bg-[#E52E2E] text-white font-bold flex items-center justify-center text-xs flex-shrink-0 shadow-xs">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name ?? 'Administrator' }}</p>
                            <p class="text-[10px] text-stone-400 truncate">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="p-1.5 rounded-lg text-stone-400 hover:text-red-400 hover:bg-[#2A2A2A] transition" title="Log Out">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>

        </aside>

        <!-- Main Workspace Area -->
        <div class="flex-1 md:pl-64 flex flex-col min-w-0">
            
            <!-- Admin Topbar -->
            <header class="h-20 bg-[#1C1C1C] border-b border-[#2A2A2A] flex items-center justify-between px-4 sm:px-8 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="md:hidden text-stone-400 hover:text-white">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div class="flex items-center gap-2 text-xs text-stone-300">
                        <span class="w-2 h-2 rounded-full bg-[#E52E2E] animate-pulse"></span>
                        <span class="font-bold text-white">Burger House Operations Desk</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.products.create') }}" class="px-3.5 py-1.5 rounded-xl bg-[#E52E2E] hover:bg-[#C61A1A] text-white text-xs font-bold transition flex items-center gap-1.5 shadow-sm shadow-red-500/25">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                        <span class="hidden sm:inline">Add Item</span>
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="px-3.5 py-1.5 rounded-xl bg-[#2A2A2A] hover:bg-[#333333] text-stone-300 hover:text-white text-xs font-medium transition flex items-center gap-1.5 border border-[#383838]">
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                        <span class="hidden sm:inline">Live Storefront</span>
                    </a>
                </div>
            </header>

            <!-- Main Content Container -->
            <main class="flex-1 p-4 sm:p-8 bg-[#141414] overflow-y-auto">
                
                @if(session('success'))
                    <div class="mb-6 bg-emerald-900/40 border border-emerald-500 text-emerald-200 px-4 py-3 rounded-xl flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white">
                            <i data-lucide="x" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-red-900/40 border border-red-500 text-red-200 px-4 py-3 rounded-xl flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-red-400"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-white">
                            <i data-lucide="x" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
