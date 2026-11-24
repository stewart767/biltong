@extends('layouts.admin')

@section('title', 'Wholesale Lead: ' . $wholesale->business_name)
@section('page_title', 'Wholesale Inquiry: ' . $wholesale->business_name)

@section('content')

    <div class="max-w-4xl space-y-8">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs text-brand-muted block uppercase tracking-wider">B2B Commercial Lead</span>
                <h2 class="font-editorial text-3xl font-bold text-brand-cream">{{ $wholesale->business_name }}</h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wholesale->phone) }}?text=Hello%20{{ urlencode($wholesale->contact_person) }}!%20This%20is%20INAS%20Company%20Limited%20regarding%20your%20wholesale%20biltong%20inquiry." 
                   target="_blank" 
                   class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs flex items-center gap-1.5 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span>Chat on WhatsApp</span>
                </a>
                <a href="{{ route('admin.wholesale.index') }}" class="text-xs text-brand-muted hover:text-white">&larr; Back to Leads</a>
            </div>
        </div>

        <!-- Status & Notes form -->
        <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-4">
            <h3 class="font-bold text-sm text-brand-cream uppercase tracking-wider">Lead Management & Notes</h3>
            <form action="{{ route('admin.wholesale.update', $wholesale) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-brand-muted">Lead Status</label>
                        <select name="status" class="w-full px-4 py-2.5 rounded-xl bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                            <option value="new" {{ $wholesale->status === 'new' ? 'selected' : '' }}>New Inquiry</option>
                            <option value="contacted" {{ $wholesale->status === 'contacted' ? 'selected' : '' }}>Contacted / Quotation Sent</option>
                            <option value="negotiating" {{ $wholesale->status === 'negotiating' ? 'selected' : '' }}>Negotiating Volume & Samples</option>
                            <option value="approved" {{ $wholesale->status === 'approved' ? 'selected' : '' }}>Approved & Supplying</option>
                            <option value="closed" {{ $wholesale->status === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-brand-muted">Internal Admin Notes</label>
                        <input type="text" name="admin_notes" value="{{ old('admin_notes', $wholesale->admin_notes) }}" placeholder="e.g. Tasting samples sent on Nov 22, agreed on 50kg monthly"
                               class="w-full px-4 py-2.5 rounded-xl bg-brand-dark border border-brand-border text-xs text-brand-cream focus:border-brand-red focus:outline-none">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="py-2.5 px-6 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs font-bold uppercase tracking-wider hover:shadow-lg transition">
                        Save Lead Status & Notes
                    </button>
                </div>
            </form>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-3">
                <span class="text-xs uppercase tracking-wider font-bold text-brand-red block">Business Profile</span>
                <p class="font-bold text-brand-cream text-lg">{{ $wholesale->business_name }}</p>
                <div class="text-xs text-brand-cream/80 space-y-1.5">
                    <p><strong class="text-brand-muted">Business Type:</strong> {{ $wholesale->business_type }}</p>
                    <p><strong class="text-brand-muted">Estimated Volume:</strong> <span class="text-brand-red font-bold">{{ $wholesale->estimated_quantity }}</span></p>
                    <p><strong class="text-brand-muted">Dispatch Location:</strong> {{ $wholesale->delivery_location }}</p>
                    <p><strong class="text-brand-muted">Applied On:</strong> {{ $wholesale->created_at->format('M d, Y h:i A') }}</p>
                </div>
            </div>

            <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-3">
                <span class="text-xs uppercase tracking-wider font-bold text-brand-red block">Contact Person</span>
                <p class="font-bold text-brand-cream text-lg">{{ $wholesale->contact_person }}</p>
                <div class="text-xs text-brand-cream/80 space-y-1.5">
                    <p><strong class="text-brand-muted">Phone / WhatsApp:</strong> <a href="tel:{{ $wholesale->phone }}" class="text-brand-red hover:underline">{{ $wholesale->phone }}</a></p>
                    <p><strong class="text-brand-muted">Email:</strong> <a href="mailto:{{ $wholesale->email }}" class="text-brand-red hover:underline">{{ $wholesale->email }}</a></p>
                </div>
            </div>
        </div>

        <!-- Message -->
        <div class="p-6 rounded-2xl bg-brand-card border border-brand-border space-y-3">
            <span class="text-xs uppercase tracking-wider font-bold text-brand-red block">Client's Inquiry Message</span>
            <div class="p-4 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream/90 leading-relaxed font-serif italic">
                "{{ $wholesale->message }}"
            </div>
        </div>

    </div>

@endsection
