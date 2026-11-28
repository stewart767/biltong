@extends('layouts.admin')

@section('title', 'Customer Management')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-display text-2xl font-bold text-white">Registered Customers</h2>
            <p class="text-xs text-stone-400">View customer accounts, order histories, contact information and lifetime spending.</p>
        </div>
    </div>

    <!-- Search bar -->
    <form action="{{ route('admin.customers.index') }}" method="GET" class="p-4 rounded-2xl bg-[#1F1F1F] border border-[#2A2A2A] flex gap-3 max-w-xl">
        <input type="text" 
               name="search" 
               value="{{ request('search') }}" 
               placeholder="Search customers by name, email or phone..." 
               class="flex-1 px-4 py-2.5 bg-[#171717] border border-[#333333] rounded-xl text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
        <button type="submit" class="px-5 py-2.5 bg-[#B77B3B] hover:bg-[#C98E4F] text-white rounded-xl text-xs font-bold uppercase transition">
            Search
        </button>
    </form>

    <!-- Table -->
    <div class="bg-[#1F1F1F] rounded-3xl border border-[#2A2A2A] overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="text-stone-400 border-b border-[#2A2A2A] bg-[#171717]">
                        <th class="py-3.5 px-6 font-semibold">Customer</th>
                        <th class="py-3.5 px-4 font-semibold">Contact</th>
                        <th class="py-3.5 px-4 font-semibold">Company</th>
                        <th class="py-3.5 px-4 font-semibold">Orders Count</th>
                        <th class="py-3.5 px-4 font-semibold">Total Spent</th>
                        <th class="py-3.5 px-6 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#2A2A2A]">
                    @forelse($customers as $c)
                        <tr class="hover:bg-[#262626] transition">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#B77B3B] text-white font-bold flex items-center justify-center text-xs">
                                        {{ substr($c->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-white">{{ $c->name }}</p>
                                        <p class="text-[10px] text-stone-400">Joined {{ $c->created_at->format('M Y') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <p class="text-white">{{ $c->phone }}</p>
                                <p class="text-stone-400 text-[11px]">{{ $c->email }}</p>
                            </td>
                            <td class="py-4 px-4 text-stone-300">
                                {{ $c->profile?->company ?? '—' }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2 py-0.5 rounded-full bg-[#2A2A2A] text-stone-300 font-bold text-[11px]">
                                    {{ $c->orders_count }} orders
                                </span>
                            </td>
                            <td class="py-4 px-4 font-bold text-emerald-400">
                                TZS {{ number_format($c->orders_sum_total ?? 0, 0) }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('admin.customers.show', $c) }}" class="px-3 py-1.5 bg-[#2A2A2A] hover:bg-[#B77B3B] text-white rounded-lg text-xs font-bold transition">
                                    Profile →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-stone-500">No registered customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-[#2A2A2A]">
            {{ $customers->links() }}
        </div>
    </div>
</div>

@endsection
