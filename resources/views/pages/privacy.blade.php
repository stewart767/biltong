@extends('layouts.app')

@section('title', 'Privacy Policy | COY BILTONG')

@section('content')

<div class="bg-[#171717] text-white py-12 border-b border-[#262626]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-white">Privacy Policy</h1>
        <p class="text-xs text-stone-400 mt-2">Last updated: November 2026</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-white p-8 sm:p-12 rounded-3xl border border-[#ECE2D2] prose prose-stone max-w-none text-sm text-stone-600 leading-relaxed space-y-6">
        <h2 class="font-display font-bold text-xl text-[#171717]">1. Information We Collect</h2>
        <p>When you place an order or create an account with COY BILTONG, we collect details necessary to process and deliver your order, including your full name, phone number, delivery address, city, and email address.</p>

        <h2 class="font-display font-bold text-xl text-[#171717]">2. How We Use Your Information</h2>
        <p>Your information is used strictly to fulfill your meat snack orders, coordinate courier deliveries, process mobile money payments (M-Pesa, Airtel Money, Tigo Pesa), and send transaction confirmations.</p>

        <h2 class="font-display font-bold text-xl text-[#171717]">3. Data Security & Storage</h2>
        <p>We implement secure server-side controls and password hashing. We never sell, rent, or trade your personal data to third-party marketing brokers.</p>

        <h2 class="font-display font-bold text-xl text-[#171717]">4. Contact Us</h2>
        <p>For questions regarding your data privacy, reach out to <a href="mailto:info@coybiltong.co.tz" class="text-[#B77B3B] font-semibold">info@coybiltong.co.tz</a>.</p>
    </div>
</div>

@endsection
