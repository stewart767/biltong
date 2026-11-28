@extends('layouts.app')

@section('title', 'Contact Us | COY BILTONG — Butchery Enquiries & Support')
@section('meta_description', 'Contact COY BILTONG for general questions, custom butchery orders, corporate gift boxes, and WhatsApp ordering assistance.')

@section('content')

<div class="bg-[#171717] text-white py-16 border-b border-[#262626]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-2xl">
        <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#B77B3B] mb-2 inline-block">We Are Here For You</span>
        <h1 class="font-display font-extrabold text-4xl sm:text-5xl text-white">
            GET IN TOUCH
        </h1>
        <p class="mt-4 text-sm sm:text-base text-stone-300 font-light">
            Questions about our biltong cuts, custom office pantries, wholesale or orders? Our Dar es Salaam team is delighted to assist.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Contact Information (5 cols) -->
        <div class="lg:col-span-5 flex flex-col justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-[#68734B]">Direct Channels</span>
                <h2 class="font-display font-bold text-2xl text-[#171717] mt-1 mb-6">Connect with Our Team</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4 p-5 bg-white rounded-2xl border border-[#ECE2D2] shadow-xs">
                        <div class="w-10 h-10 rounded-xl bg-[#F6F0E6] text-[#B77B3B] flex items-center justify-center flex-shrink-0">
                            <i data-lucide="message-circle" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-[#171717]">WhatsApp Fast Assistance</h4>
                            <p class="text-xs text-stone-500 mt-0.5">Quick order questions & live status</p>
                            <a href="https://wa.me/{{ \App\Models\SiteSetting::get('company_whatsapp', '255768123456') }}" target="_blank" class="text-xs font-bold text-[#B77B3B] hover:underline mt-2 inline-block">
                                +255 768 123 456 →
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-5 bg-white rounded-2xl border border-[#ECE2D2] shadow-xs">
                        <div class="w-10 h-10 rounded-xl bg-[#F6F0E6] text-[#B77B3B] flex items-center justify-center flex-shrink-0">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-[#171717]">Email Desk</h4>
                            <p class="text-xs text-stone-500 mt-0.5">Corporate & general inquiries</p>
                            <a href="mailto:{{ \App\Models\SiteSetting::get('company_email', 'info@coybiltong.co.tz') }}" class="text-xs font-bold text-[#B77B3B] hover:underline mt-2 inline-block">
                                {{ \App\Models\SiteSetting::get('company_email', 'info@coybiltong.co.tz') }}
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-5 bg-white rounded-2xl border border-[#ECE2D2] shadow-xs">
                        <div class="w-10 h-10 rounded-xl bg-[#F6F0E6] text-[#B77B3B] flex items-center justify-center flex-shrink-0">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-[#171717]">Dar es Salaam Butchery Kitchen</h4>
                            <p class="text-xs text-stone-500 mt-0.5">{{ \App\Models\SiteSetting::get('company_location', 'Dar es Salaam, Tanzania') }}</p>
                            <span class="text-xs text-stone-400 mt-2 block">Mon - Sat: 8:00 AM - 7:00 PM</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 p-6 bg-[#171717] text-white rounded-2xl border border-[#B77B3B]/30">
                <h4 class="font-display font-bold text-base text-white">Wholesale & Hospitality</h4>
                <p class="text-xs text-stone-300 mt-2 leading-relaxed">
                    Supply your supermarket, safari camp, gym, or bar with premium COY BILTONG retail packs.
                </p>
                <a href="{{ route('wholesale') }}" class="inline-block mt-4 text-xs font-bold text-[#B77B3B] hover:underline">
                    Explore Wholesale Accounts →
                </a>
            </div>
        </div>

        <!-- Contact Form (7 cols) -->
        <div class="lg:col-span-7 bg-white p-8 sm:p-10 rounded-3xl border border-[#ECE2D2] shadow-xs">
            <h3 class="font-display font-bold text-2xl text-[#171717] mb-2">Send Us a Direct Message</h3>
            <p class="text-xs text-stone-500 mb-6">Fill in the form below and we will get back to you within a few business hours.</p>

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Your Full Name *</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Phone Number *</label>
                        <input type="text" name="phone" required placeholder="+255 ..." class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Email Address *</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Subject *</label>
                        <input type="text" name="subject" required placeholder="Order inquiry, feedback, tasting..." class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Your Message *</label>
                    <textarea name="message" rows="5" required placeholder="How can we assist you today?" class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B]"></textarea>
                </div>

                <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-[#171717] hover:bg-[#B77B3B] text-white font-bold rounded-xl text-xs uppercase tracking-wider transition shadow-md">
                    SEND MESSAGE
                </button>
            </form>
        </div>

    </div>
</div>

@endsection
