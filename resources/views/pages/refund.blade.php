@extends('layouts.app')

@section('title', 'Refund & Returns Policy | Burger House')
@section('meta_description', 'Burger House refund and cancellation policy for orders and delivery.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
    <div class="bg-white rounded-3xl p-6 sm:p-10 border-2 border-stone-200/85 shadow-sm space-y-6">
        <div class="border-b border-stone-200/80 pb-4">
            <span class="text-xs font-extrabold uppercase tracking-widest text-[#E52E2E]">Customer Care</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1E1E1E] mt-1">Refund & Returns Policy</h1>
            <p class="text-xs text-stone-500 mt-1">Last updated: {{ date('F Y') }}</p>
        </div>

        <div class="space-y-4 text-xs sm:text-sm text-stone-600 leading-relaxed">
            <h2 class="text-base font-bold text-stone-900">1. Fresh Food Guarantee</h2>
            <p>At Burger House, we prepare all meals fresh to order. If your order arrives incorrect, damaged, or unsatisfactory, please notify our team within 1 hour of delivery via WhatsApp or phone.</p>

            <h2 class="text-base font-bold text-stone-900">2. Replacement & Refunds</h2>
            <p>Eligible orders can be immediately remade and dispatched free of charge, or refunded to your original payment method (M-Pesa / Tigo Pesa / Airtel Money / Card) within 24 to 48 hours.</p>

            <h2 class="text-base font-bold text-stone-900">3. Order Cancellations</h2>
            <p>Orders may be canceled prior to kitchen dispatch. Once the delivery driver has collected your order, cancellation may not be possible.</p>

            <h2 class="text-base font-bold text-stone-900">4. Contact Kitchen Hotline</h2>
            <p>For immediate assistance with any order, contact our hotline at <strong>{{ \App\Models\SiteSetting::get('company_phone', '06621990') }}</strong> or via WhatsApp at <strong>{{ \App\Models\SiteSetting::get('company_whatsapp', '2556621990') }}</strong>.</p>
        </div>
    </div>
</div>
@endsection
