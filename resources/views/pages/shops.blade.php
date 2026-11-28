@extends('layouts.app')

@section('title', 'Our Kitchen & Shops | Burger House')
@section('meta_description', 'Find Burger House kitchen branches, pickup locations and delivery areas.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
    <div class="bg-white rounded-3xl p-6 sm:p-10 border-2 border-stone-200/85 shadow-sm space-y-6">
        <div class="border-b border-stone-200/80 pb-4">
            <span class="text-xs font-extrabold uppercase tracking-widest text-[#E52E2E]">Locations & Delivery</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1E1E1E] mt-1">Our Kitchen & Pickup Points</h1>
            <p class="text-xs text-stone-500 mt-1">Fresh gourmet burgers prepared across Dar es Salaam</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
            <div class="p-5 rounded-2xl bg-[#FAF6F0] border-2 border-red-200/90 space-y-2">
                <span class="inline-block px-2.5 py-0.5 rounded-full bg-[#E52E2E] text-white text-[10px] font-bold">Main Kitchen Hub</span>
                <h3 class="font-bold text-sm text-stone-900">Burger House Central Kitchen</h3>
                <p class="text-xs text-stone-600">{{ \App\Models\SiteSetting::get('company_location', 'Dar es Salaam, Tanzania') }}</p>
                <p class="text-xs text-stone-500 font-medium">Hours: {{ \App\Models\SiteSetting::get('operating_hours', 'Monday - Sunday: 10:00 AM - 11:00 PM') }}</p>
                <div class="pt-2">
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', \App\Models\SiteSetting::get('company_phone', '06621990')) }}" class="text-xs text-[#E52E2E] font-bold hover:underline">
                        Call: {{ \App\Models\SiteSetting::get('company_phone', '06621990') }}
                    </a>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-[#FAF6F0] border-2 border-red-200/90 space-y-2">
                <span class="inline-block px-2.5 py-0.5 rounded-full bg-stone-800 text-white text-[10px] font-bold">Express Delivery Zone</span>
                <h3 class="font-bold text-sm text-stone-900">City-Wide Express Delivery</h3>
                <p class="text-xs text-stone-600">Covering Masaki, Mikocheni, Upanga, City Centre, Oysterbay, Kinondoni, and Sinza.</p>
                <p class="text-xs text-stone-500 font-medium">Hot dispatch directly to your doorstep in 30-45 minutes.</p>
                <div class="pt-2">
                    <a href="{{ route('order') }}" class="text-xs text-[#E52E2E] font-bold hover:underline">
                        Order Now &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
