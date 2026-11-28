@extends('layouts.app')

@section('title', 'Wholesale & B2B Distribution | COY BILTONG')
@section('meta_description', 'Wholesale beef biltong supply for Tanzanian supermarkets, safari camps, luxury hotels, corporate pantries, and fitness centres.')

@section('content')

<!-- Wholesale Hero Header -->
<section class="py-16 bg-[#171717] border-b border-[#262626] text-center text-white relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 space-y-3 relative z-10">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#262626] text-[#B77B3B] border border-[#B77B3B]/30">
            <span class="w-1.5 h-1.5 rounded-full bg-[#B77B3B] animate-pulse"></span>
            Commercial Supply & Partnerships
        </span>
        <h1 class="font-display text-4xl sm:text-6xl font-extrabold text-white tracking-tight">
            Partner with COY BILTONG
        </h1>
        <p class="text-stone-300 text-base sm:text-lg max-w-2xl mx-auto font-light leading-relaxed">
            Stock East Africa’s premier artisanal dried beef snacks in your supermarket, safari camp, corporate pantry, gym, or hotel minibar.
        </p>
    </div>
</section>

<!-- Wholesale Content Grid -->
<section class="py-16 bg-[#F6F0E6]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        <!-- Industry Sectors Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 rounded-3xl bg-white border border-[#ECE2D2] shadow-xs space-y-4 hover:border-[#B77B3B] transition">
                <div class="w-12 h-12 rounded-xl bg-[#F6F0E6] flex items-center justify-center text-[#B77B3B]">
                    <i data-lucide="store" class="w-6 h-6"></i>
                </div>
                <h3 class="font-display text-xl font-bold text-[#171717]">Supermarkets & Retailers</h3>
                <p class="text-xs text-stone-600 leading-relaxed">
                    Retail-ready 100g and 250g pouches with registered barcoding, tamper-evident heat-seals, and luxury packaging. High shelf appeal and rapid inventory turnover.
                </p>
            </div>

            <div class="p-8 rounded-3xl bg-white border border-[#ECE2D2] shadow-xs space-y-4 hover:border-[#B77B3B] transition">
                <div class="w-12 h-12 rounded-xl bg-[#F6F0E6] flex items-center justify-center text-[#B77B3B]">
                    <i data-lucide="compass" class="w-6 h-6"></i>
                </div>
                <h3 class="font-display text-xl font-bold text-[#171717]">Safari Lodges & Hospitality</h3>
                <p class="text-xs text-stone-600 leading-relaxed">
                    The ultimate gourmet safari drive snack for discerning guests in Serengeti, Ngorongoro, Tarangire, and Zanzibar. Shelf-stable without requiring refrigeration.
                </p>
            </div>

            <div class="p-8 rounded-3xl bg-white border border-[#ECE2D2] shadow-xs space-y-4 hover:border-[#B77B3B] transition">
                <div class="w-12 h-12 rounded-xl bg-[#F6F0E6] flex items-center justify-center text-[#B77B3B]">
                    <i data-lucide="activity" class="w-6 h-6"></i>
                </div>
                <h3 class="font-display text-xl font-bold text-[#171717]">Gyms & Corporate Pantries</h3>
                <p class="text-xs text-stone-600 leading-relaxed">
                    Over 50g of natural complete animal protein per 100g with zero added sugar. High-productivity fueling for modern executives and athletes.
                </p>
            </div>
        </div>

        <!-- B2B Enquiry Form & Direct Contact -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-5 bg-[#171717] text-white p-8 sm:p-10 rounded-3xl border border-[#B77B3B]/30 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#B77B3B]">Fast B2B Turnaround</span>
                    <h3 class="font-display font-bold text-2xl text-white mt-1">Direct Commercial Ordering</h3>
                    <p class="text-xs text-stone-300 mt-2 leading-relaxed">
                        We offer tier-based pricing for orders starting from 5kg up to 500kg monthly. Custom packing and private labeling options available.
                    </p>
                </div>

                <div class="space-y-4 text-xs text-stone-300 pt-4 border-t border-[#262626]">
                    <div class="flex items-center gap-3">
                        <i data-lucide="phone" class="w-4 h-4 text-[#B77B3B]"></i>
                        <span>Direct Supply Desk: +255 768 123 456</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i data-lucide="mail" class="w-4 h-4 text-[#B77B3B]"></i>
                        <span>b2b@coybiltong.co.tz</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i data-lucide="truck" class="w-4 h-4 text-[#B77B3B]"></i>
                        <span>Countrywide Cargo Dispatch across Tanzania</span>
                    </div>
                </div>

                <a href="https://wa.me/{{ \App\Models\SiteSetting::get('company_whatsapp', '255768123456') }}?text=Hello%20COY%20BILTONG,%20I%20would%20like%20to%20inquire%20about%20a%20wholesale%20distribution%20account" 
                   target="_blank" 
                   class="inline-flex items-center justify-center gap-2 w-full py-3.5 rounded-xl bg-[#25D366] hover:bg-[#1EBE5D] text-white font-bold text-xs uppercase tracking-wider transition">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Chat with Wholesale Desk on WhatsApp</span>
                </a>
            </div>

            <div class="lg:col-span-7 bg-white p-8 sm:p-10 rounded-3xl border border-[#ECE2D2] shadow-xs">
                <h3 class="font-display font-bold text-2xl text-[#171717] mb-2">Request Wholesale Pricing</h3>
                <p class="text-xs text-stone-500 mb-6">Complete the brief form and our commercial accounts manager will send our trade price catalog.</p>

                <form action="{{ route('wholesale.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Company / Organization *</label>
                            <input type="text" name="company_name" required placeholder="e.g. Serengeti Safari Camps Ltd" class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Contact Person Name *</label>
                            <input type="text" name="contact_name" required placeholder="e.g. David Mwamba" class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Phone / WhatsApp *</label>
                            <input type="text" name="phone" required placeholder="+255 ..." class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Business Email *</label>
                            <input type="email" name="email" required placeholder="orders@company.com" class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Business Type</label>
                            <select name="business_type" class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                                <option value="supermarket">Supermarket / Grocery Retail</option>
                                <option value="safari_lodge">Safari Camp / Lodge</option>
                                <option value="hotel_hospitality">Hotel / Bar / Lounge</option>
                                <option value="gym_fitness">Gym / Fitness Centre</option>
                                <option value="corporate_office">Corporate Office Pantry</option>
                                <option value="distributor">Regional Food Distributor</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Estimated Volume</label>
                            <select name="estimated_volume" class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-[#B77B3B]">
                                <option value="5_10kg">5 - 10 kg per month</option>
                                <option value="10_25kg">10 - 25 kg per month</option>
                                <option value="25_50kg">25 - 50 kg per month</option>
                                <option value="50_100kg">50 - 100 kg per month</option>
                                <option value="100kg_plus">100+ kg per month</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Specific Requirements or Message</label>
                        <textarea name="notes" rows="3" placeholder="Tell us about your locations, delivery requirements or preferred cuts..." class="w-full px-4 py-3 bg-[#F6F0E6] border border-[#ECE2D2] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B77B3B]"></textarea>
                    </div>

                    <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-[#171717] hover:bg-[#B77B3B] text-white font-bold rounded-xl text-xs uppercase tracking-wider transition shadow-md">
                        SUBMIT WHOLESALE APPLICATION
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection
