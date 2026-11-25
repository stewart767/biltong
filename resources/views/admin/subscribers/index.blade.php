@extends('layouts.admin')

@section('title', 'Newsletter Subscribers')
@section('page_title', 'Newsletter Subscribers')

@section('content')

    <div class="space-y-6">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-editorial text-2xl font-bold text-brand-cream">The Butcher’s Club Subscribers</h2>
                <span class="text-xs text-brand-muted">Registered customer emails receiving fresh batch alerts and promos</span>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="px-4 py-2 rounded-xl bg-brand-card border border-brand-border text-xs">
                    <span class="text-brand-muted">Total Subscribers:</span>
                    <strong class="text-brand-cream ml-1">{{ $totalSubscribers }}</strong>
                </div>
                <div class="px-4 py-2 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-xs">
                    <span class="text-emerald-400">Active:</span>
                    <strong class="text-emerald-300 ml-1">{{ $activeSubscribers }}</strong>
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-brand-card border border-brand-border overflow-hidden shadow-xl">
            <div class="p-4 border-b border-brand-border bg-brand-dark/40 flex items-center justify-between gap-4">
                <form action="{{ route('admin.subscribers.index') }}" method="GET" class="flex-1 max-w-sm">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search subscriber email..."
                           class="w-full px-4 py-2 rounded-xl bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-brand-border bg-brand-dark/80 text-brand-muted uppercase text-[10px] tracking-wider">
                            <th class="py-3.5 px-6">#</th>
                            <th class="py-3.5 px-6">Subscriber Email</th>
                            <th class="py-3.5 px-6">Subscribed Date</th>
                            <th class="py-3.5 px-6">Status</th>
                            <th class="py-3.5 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-border/60">
                        @forelse($subscribers as $sub)
                            <tr class="hover:bg-brand-dark/40 transition">
                                <td class="py-4 px-6 text-brand-muted">
                                    {{ $loop->iteration + ($subscribers->currentPage() - 1) * $subscribers->perPage() }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-bold text-brand-cream text-sm">{{ $sub->email }}</span>
                                </td>
                                <td class="py-4 px-6 text-brand-muted">
                                    {{ $sub->created_at->format('M d, Y • h:i A') }}
                                </td>
                                <td class="py-4 px-6">
                                    @if($sub->status === 'subscribed')
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">Subscribed</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-zinc-500/20 text-zinc-400 border border-zinc-500/30">Unsubscribed</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <form action="{{ route('admin.subscribers.destroy', $sub) }}" method="POST" onsubmit="return confirm('Remove this subscriber?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg bg-brand-dark hover:bg-red-500/20 text-brand-muted hover:text-red-400 transition border border-brand-border" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-brand-muted">
                                    No newsletter subscribers registered yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($subscribers->hasPages())
                <div class="p-4 border-t border-brand-border bg-brand-dark/40">
                    {{ $subscribers->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection
