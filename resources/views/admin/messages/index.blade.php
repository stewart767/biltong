@extends('layouts.admin')

@section('title', 'Customer Inquiries & Messages')
@section('page_title', 'Customer Inquiries')

@section('content')

    <div class="space-y-6">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-editorial text-2xl font-bold text-brand-cream">Customer Messages & Contact Inquiries</h2>
                <span class="text-xs text-brand-muted">Direct messages submitted via the Contact Us page</span>
            </div>
            
            <div class="flex items-center gap-2 text-xs">
                @php $cur = request('status', 'all'); @endphp
                <a href="{{ route('admin.messages.index') }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'all' ? 'bg-brand-red text-white font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">All</a>
                <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'unread' ? 'bg-amber-500 text-black font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">Unread</a>
                <a href="{{ route('admin.messages.index', ['status' => 'read']) }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'read' ? 'bg-blue-500 text-white font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">Read</a>
                <a href="{{ route('admin.messages.index', ['status' => 'replied']) }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'replied' ? 'bg-emerald-500 text-black font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">Replied</a>
            </div>
        </div>

        <div class="rounded-2xl bg-brand-card border border-brand-border overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-brand-border bg-brand-dark/80 text-brand-muted uppercase text-[10px] tracking-wider">
                            <th class="py-3.5 px-6">Sender</th>
                            <th class="py-3.5 px-4">Contact</th>
                            <th class="py-3.5 px-4">Subject</th>
                            <th class="py-3.5 px-4">Message Snippet</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-border/60">
                        @forelse($messages as $msg)
                            <tr class="hover:bg-brand-dark/40 transition {{ $msg->status === 'unread' ? 'bg-brand-red/5' : '' }}">
                                <td class="py-4 px-6">
                                    <span class="font-bold text-brand-cream text-sm block">{{ $msg->name }}</span>
                                    <span class="text-[11px] text-brand-muted">{{ $msg->created_at->format('M d, Y • h:i A') }}</span>
                                </td>
                                <td class="py-4 px-4">
                                    <a href="mailto:{{ $msg->email }}" class="text-brand-cream hover:text-brand-red block">{{ $msg->email }}</a>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" class="text-brand-red hover:underline font-medium text-[11px] flex items-center gap-1 mt-0.5">
                                        <span>{{ $msg->phone }}</span>
                                    </a>
                                </td>
                                <td class="py-4 px-4 font-semibold text-brand-cream">
                                    {{ $msg->subject }}
                                </td>
                                <td class="py-4 px-4 text-brand-muted max-w-xs truncate">
                                    {{ Str::limit($msg->message, 60) }}
                                </td>
                                <td class="py-4 px-4">
                                    @if($msg->status === 'unread')
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/20 text-amber-400 border border-amber-500/30">Unread</span>
                                    @elseif($msg->status === 'read')
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-500/20 text-blue-400 border border-blue-500/30">Read</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">Replied</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.messages.show', $msg) }}" class="px-3 py-1.5 rounded-lg bg-brand-dark hover:bg-brand-red hover:text-white text-brand-cream text-xs font-semibold transition border border-brand-border">
                                            View
                                        </a>
                                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg bg-brand-dark hover:bg-red-500/20 text-brand-muted hover:text-red-400 transition border border-brand-border">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-brand-muted">
                                    No customer inquiries found for this filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($messages->hasPages())
                <div class="p-4 border-t border-brand-border bg-brand-dark/40">
                    {{ $messages->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection
