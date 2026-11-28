@extends('layouts.app')

@section('title', 'Contact Biltong East Africa Corporation (BEAC) | +255 749 901 907')

@section('content')

    <!-- Header Banner (Red, White & Cream) -->
    <section class="rounded-[32px] bg-gradient-to-br from-[#FAF5EE] via-white to-[#F6E4DE]/60 border border-[#E8DDD0] p-8 sm:p-12 lg:p-14 text-center space-y-4 shadow-sm">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider bg-red-600 text-white shadow-xs">
            Get In Touch
        </span>
        <h1 class="text-3xl sm:text-5xl font-black text-zinc-900 tracking-tight">
            Contact <span class="text-red-600">BEAC / INAS</span>
        </h1>
        <p class="text-zinc-600 text-sm sm:text-base max-w-2xl mx-auto">
            Visit our Buguruni Malapa facility in Dar es Salaam, call or WhatsApp our dispatch desk, or send us an online inquiry.
        </p>
    </section>

    <!-- Main Contact Grid -->
    <section class="mt-10 grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Contact Details Card -->
        <div class="lg:col-span-5 space-y-6">
            <div class="p-8 rounded-[32px] bg-white border border-[#E8DDD0] shadow-sm space-y-6">
                <h2 class="text-2xl font-black text-zinc-900">
                    Biltong East Africa Corporation
                </h2>

                <div class="space-y-4 text-sm">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-[#FAF5EE] flex items-center justify-center text-red-600 border border-[#E8DDD0] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <span class="block text-xs text-zinc-500 uppercase font-bold tracking-wider">Location</span>
                            <span class="text-zinc-900 font-bold">Buguruni Malapa, Ilala District</span>
                            <p class="text-zinc-600 text-xs mt-0.5">Dar es Salaam, Tanzania</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-[#FAF5EE] flex items-center justify-center text-red-600 border border-[#E8DDD0] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <span class="block text-xs text-zinc-500 uppercase font-bold tracking-wider">Phone &amp; WhatsApp</span>
                            <a href="tel:+255749901907" class="text-zinc-900 font-bold hover:text-red-600 transition block">
                                +255 749 901 907
                            </a>
                            <a href="https://wa.me/255749901907" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-red-600 font-bold hover:underline mt-1">
                                <span>Chat on WhatsApp now &rarr;</span>
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-[#FAF5EE] flex items-center justify-center text-red-600 border border-[#E8DDD0] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <span class="block text-xs text-zinc-500 uppercase font-bold tracking-wider">Official Email &amp; Web</span>
                            <a href="mailto:info@biltong.co.tz" class="text-zinc-900 font-bold hover:text-red-600 transition block">
                                info@biltong.co.tz
                            </a>
                            <span class="text-xs text-zinc-500">www.biltong.co.tz</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-[#FAF5EE] flex items-center justify-center text-red-600 border border-[#E8DDD0] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                        </div>
                        <div class="text-xs space-y-1">
                            <span class="block text-zinc-500 uppercase font-bold tracking-wider">Social Media</span>
                            <div class="text-zinc-800 font-semibold">Instagram: @biltongeastafrica</div>
                            <div class="text-zinc-800 font-semibold">Facebook: BILTONG East Africa</div>
                            <div class="text-zinc-800 font-semibold">YouTube: BILTONG EAST AFRICA</div>
                        </div>
                    </div>
                </div>

                <!-- Direct WhatsApp Quick Action -->
                <div class="pt-4 border-t border-[#F0E6D8]">
                    <a href="https://wa.me/255749901907?text=Hello%20BEAC%20Biltong!%20I%20have%20an%20inquiry." 
                       target="_blank" 
                       class="w-full flex items-center justify-center gap-2 py-3.5 px-4 rounded-full bg-red-600 hover:bg-red-700 text-white font-bold text-sm transition shadow-md">
                        <span>Send Direct WhatsApp Message</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact Message Form -->
        <div class="lg:col-span-7">
            <div class="p-8 sm:p-10 rounded-[32px] bg-white border border-[#E8DDD0] shadow-sm space-y-6">
                <div class="space-y-2">
                    <span class="text-xs uppercase tracking-widest text-red-600 font-black">Online Inquiry</span>
                    <h2 class="text-3xl font-black text-zinc-900">
                        Send Us a Message
                    </h2>
                    <p class="text-xs text-zinc-500">
                        Fill out the form below. For bulk or wholesale orders, please visit our <a href="{{ route('wholesale') }}" class="text-red-600 underline font-bold">Wholesale Portal</a>.
                    </p>
                </div>

                @if(session('contact_success'))
                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-sm">
                        {{ session('contact_success') }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Your Full Name</label>
                            <input type="text" name="name" required placeholder="e.g. Salim Bakari"
                                   class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Phone / WhatsApp</label>
                            <input type="text" name="phone" required placeholder="e.g. +255 749 901 907"
                                   class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Email Address</label>
                        <input type="email" name="email" required placeholder="e.g. salim@example.com"
                               class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Subject / Purpose</label>
                        <select name="subject" class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition">
                            <option value="General Inquiry">General Product Inquiry</option>
                            <option value="Retail Order Status">Question About an Existing Order</option>
                            <option value="Buguruni Pickup">Buguruni Malapa Pickup Inquiry</option>
                            <option value="Distributor Question">Distribution or Event Catering</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Your Message</label>
                        <textarea name="message" rows="4" required placeholder="Tell us how we can help you..."
                                  class="w-full px-4 py-3 rounded-xl bg-[#FAF5EE] border border-[#E8DDD0] text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:outline-none transition"></textarea>
                    </div>

                    <button type="submit" class="w-full py-4 rounded-full bg-red-600 hover:bg-red-700 text-white font-bold text-sm shadow-md hover:shadow-lg transition flex items-center justify-center gap-2 cursor-pointer">
                        <span>Send Message to BEAC Team</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>
            </div>
        </div>

    </section>

@endsection
