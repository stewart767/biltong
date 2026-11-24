@extends('layouts.admin')

@section('title', 'Wholesale Enquiries')
@section('page_title', 'B2B Wholesale Enquiries')

@section('content')

    <div class="space-y-6">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-editorial text-2xl font-bold text-brand-cream">Wholesale Distributor Leads</h2>
                <span class="text-xs text-brand-muted">Applications from supermarkets, safari lodges, gyms and hospitality</span>
            </div>
            
            <div class="flex items-center gap-2 text-xs">
                @php $cur = request('status', 'all'); @endphp
                <a href="{{ route('admin.wholesale.index') }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'all' ? 'bg-brand-red text-white font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">All</a>
                <a href="{{ route('admin.wholesale.index', ['status' => 'new']) }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'new' ? 'bg-amber-500 text-black font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">New Leads</a>
                <a href="{{ route('admin.wholesale.index', ['status' => 'contacted']) }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'contacted' ? 'bg-blue-500 text-white font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">Contacted</a>
                <a href="{{ route('admin.wholesale.index', ['status' => 'negotiating']) }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'negotiating' ? 'bg-purple-500 text-white font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">Negotiating</a>
                <a href="{{ route('admin.wholesale.index', ['status' => 'approved']) }}" class="px-3 py-1.5 rounded-lg {{ $cur === 'approved' ? 'bg-emerald-500 text-black font-bold' : 'bg-brand-card text-brand-cream hover:bg-brand-border' }}">Approved</a>
            </div>
        </div>

        <div class="rounded-2xl bg-brand-card border border-brand-border overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-brand-border bg-brand-dark/80 text-brand-muted uppercase text-[10px] tracking-wider">
                            <th class="py-3.5 px-6">Business</th>
                            <th class="py-3.5 px-4">Contact</th>
                            <th class="py-3.5 px-4">Business Type</th>
                            <th class="py-3.5 px-4">Est. Volume</th>
                            <th class="py-3.5 px-4">Location</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-border/60">
                        @forelse($enquiries as $lead)
                            <tr class="hover:bg-brand-dark/40 transition">
                                <td class="py-4 px-6">
                                    <span class="font-bold text-brand-cream text-sm block">{{ $lead->business_name }}</span>
                                    <span class="text-[11px] text-brand-muted">{{ $lead->created_at->format('M d, Y') }}</span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="font-semibold text-brand-cream block">{{ $lead->contact_person }}</span>
                                    <a href="tel:{{ $lead->phone }}" class="text-brand-red hover:underline">{{ $lead->phone }}</a>
                                </td>
                                <td class="py-4 px-4 text-brand-cream/80">
                                    {{ $lead->business_type }}
                                </td>
                                <td class="py-4 px-4 font-bold text-brand-cream">
                                    {{ $lead->estimated_quantity }}
                                </td>
                                <td class="py-4 px-4 text-brand-muted">
                                    {{ $lead->delivery_location }}
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $lead->status_badge_class }}">
                                        {{ ucfirst($lead->status) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('admin.wholesale.show', $lead) }}" class="px-3 py-1.5 rounded-lg bg-brand-dark text-brand-red hover:text-white transition font-semibold text-xs inline-block">
                                        Review Lead
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-brand-muted">No wholesale enquiries recorded.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($enquiries->hasPages())
                <div class="p-4 border-t border-brand-border bg-brand-dark">
                    {{ $enquiries->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection
