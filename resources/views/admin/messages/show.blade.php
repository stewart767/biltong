@extends('layouts.admin')

@section('title', 'Inquiry Details: ' . $message->name)
@section('page_title', 'Inquiry Details')

@section('content')

    <div class="max-w-4xl space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-brand-muted hover:text-brand-cream transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                <span>Back to All Inquiries</span>
            </a>

            <div class="flex items-center gap-2">
                @if($message->status === 'unread')
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-400 border border-amber-500/30">Unread</span>
                @elseif($message->status === 'read')
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-500/20 text-blue-400 border border-blue-500/30">Read</span>
                @else
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">Replied</span>
                @endif
            </div>
        </div>

        <!-- Message Details Card -->
        <div class="p-8 rounded-2xl bg-brand-card border border-brand-border shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-brand-border/60">
                <div>
                    <h2 class="font-editorial text-2xl font-bold text-brand-cream">{{ $message->name }}</h2>
                    <p class="text-xs text-brand-muted mt-1">Submitted on {{ $message->created_at->format('l, F d, Y \a\t h:i A') }}</p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="mailto:{{ $message->email }}?subject=Re: {{ rawurlencode($message->subject) }}" 
                       class="px-4 py-2 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs uppercase tracking-wider transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Reply by Email</span>
                    </a>

                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}?text=Hello%20{{ rawurlencode($message->name) }}%2C%20thank%20you%20for%20contacting%20INAS%20Beef%20Biltong." 
                       target="_blank"
                       class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        <span>WhatsApp Customer</span>
                    </a>
                </div>
            </div>

            <!-- Sender Info Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 rounded-xl bg-brand-dark/60 border border-brand-border text-xs">
                <div>
                    <span class="text-brand-muted block uppercase text-[10px] font-bold">Email Address</span>
                    <a href="mailto:{{ $message->email }}" class="text-brand-cream hover:text-brand-red font-semibold break-all">{{ $message->email }}</a>
                </div>
                <div>
                    <span class="text-brand-muted block uppercase text-[10px] font-bold">Phone Number</span>
                    <span class="text-brand-cream font-semibold">{{ $message->phone }}</span>
                </div>
                <div>
                    <span class="text-brand-muted block uppercase text-[10px] font-bold">Inquiry Subject</span>
                    <span class="text-brand-red font-bold">{{ $message->subject }}</span>
                </div>
            </div>

            <!-- Message Body -->
            <div class="space-y-2">
                <span class="text-[10px] uppercase font-bold tracking-wider text-brand-muted">Message Content</span>
                <div class="p-5 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream leading-relaxed whitespace-pre-line">
                    {{ $message->message }}
                </div>
            </div>

            <!-- Status & Notes Form -->
            <form action="{{ route('admin.messages.status', $message) }}" method="POST" class="pt-6 border-t border-brand-border/60 space-y-4">
                @csrf
                <div class="flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-red"></span>
                    <h3 class="font-editorial text-lg font-bold text-brand-cream">Update Status & Internal Notes</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Inquiry Status</label>
                        <select name="status" class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                            <option value="unread" {{ $message->status === 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ $message->status === 'read' ? 'selected' : '' }}>Read</option>
                            <option value="replied" {{ $message->status === 'replied' ? 'selected' : '' }}>Replied</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2 space-y-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Admin Notes</label>
                        <input type="text" name="admin_notes" value="{{ $message->admin_notes }}" placeholder="e.g. Called customer on WhatsApp, sent quotation..."
                               class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-6 py-3 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs uppercase tracking-wider transition">
                        Save Status & Notes
                    </button>
                </div>
            </form>
        </div>

    </div>

@endsection
