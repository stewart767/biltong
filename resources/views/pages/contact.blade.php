@extends('layouts.app')

@section('title', 'Contact INAS Company Limited | Buguruni Malapa, Dar es Salaam | +255 682 869 629')

@section('content')

    <!-- Header Banner -->
    <section class="py-16 bg-brand-charcoal border-b border-brand-border text-center">
        <div class="max-w-4xl mx-auto px-4 space-y-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-red-600/20 text-red-600 border border-red-600/30">
                <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                Get In Touch
            </span>
            <h1 class="font-editorial text-4xl sm:text-6xl font-bold text-white tracking-wide">
                Contact INAS Company Limited
            </h1>
            <p class="text-zinc-300 text-base sm:text-lg max-w-2xl mx-auto">
                Visit our production office in Buguruni Malapa, speak to our dispatch desk, or place orders directly via WhatsApp.
            </p>
        </div>
    </section>

    <!-- Main Contact Grid -->
    <section class="py-16 bg-zinc-100 text-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Contact Details & Map Card -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="p-8 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-6">
                        <h2 class="font-editorial text-2xl font-bold text-zinc-900">
                            Headquarters & Butchery
                        </h2>

                        <div class="space-y-4 text-sm">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-600 border border-red-100 flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <span class="block text-xs text-zinc-500 uppercase font-bold tracking-wider">Company & Location</span>
                                    <span class="text-zinc-900 font-bold">INAS Company Limited</span>
                                    <p class="text-zinc-600 text-xs mt-0.5">Buguruni Malapa, Ilala District,<br>Dar es Salaam, Tanzania</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-600 border border-red-100 flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <div>
                                    <span class="block text-xs text-zinc-500 uppercase font-bold tracking-wider">Direct Hotline & WhatsApp</span>
                                    <a href="tel:+255682869629" class="text-zinc-900 font-bold hover:text-red-600 transition block">
                                        +255 682 869 629
                                    </a>
                                    <a href="https://wa.me/255682869629" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-emerald-600 font-semibold hover:underline mt-1">
                                        <span>Chat on WhatsApp now</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-600 border border-red-100 flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <span class="block text-xs text-zinc-500 uppercase font-bold tracking-wider">Official Email</span>
                                    <a href="mailto:sales@inasbiltong.co.tz" class="text-zinc-900 font-bold hover:text-red-600 transition">
                                        sales@inasbiltong.co.tz
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-600 border border-red-100 flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <span class="block text-xs text-zinc-500 uppercase font-bold tracking-wider">Business & Dispatch Hours</span>
                                    <span class="text-zinc-900 font-bold block">Monday – Saturday: 8:00 AM – 6:30 PM (EAT)</span>
                                    <span class="text-xs text-zinc-500">Sundays: Dedicated to wholesale dispatch prep</span>
                                </div>
                            </div>
                        </div>

                        <!-- Direct WhatsApp Quick Action -->
                        <div class="pt-4 border-t border-zinc-100">
                            <a href="https://wa.me/255682869629?text=Hello%20INAS%20Biltong!%20I%20have%20an%20inquiry." 
                               target="_blank" 
                               class="w-full flex items-center justify-center gap-2 py-3.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm transition shadow-md">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                <span>Send Direct WhatsApp Message</span>
                            </a>
                        </div>
                    </div>

                    <!-- Pickup Notice -->
                    <div class="p-6 rounded-2xl bg-white border border-red-200 shadow-sm space-y-2">
                        <span class="text-xs uppercase tracking-wider text-red-600 font-bold flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span>Direct Customer Pickup Available</span>
                        </span>
                        <p class="text-xs text-zinc-600 leading-relaxed">
                            Need fresh biltong today? You can select "Pick-up at Buguruni Malapa" during checkout to collect your sealed packs directly from our facility with zero delivery fee.
                        </p>
                    </div>
                </div>

                <!-- Contact Message Form -->
                <div class="lg:col-span-7">
                    <div class="p-8 sm:p-10 rounded-2xl bg-white border border-zinc-200 shadow-sm space-y-6">
                        <div class="space-y-2">
                            <span class="text-xs uppercase tracking-widest text-red-600 font-bold">Online Inquiry</span>
                            <h2 class="font-editorial text-3xl font-bold text-zinc-900">
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
                                           class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Phone / WhatsApp</label>
                                    <input type="text" name="phone" required placeholder="e.g. +255 754 000 000"
                                           class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Email Address</label>
                                <input type="email" name="email" required placeholder="e.g. salim@example.com"
                                       class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                            </div>

                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Subject / Purpose</label>
                                <select name="subject" class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition">
                                    <option value="General Inquiry">General Product Inquiry</option>
                                    <option value="Retail Order Status">Question About an Existing Order</option>
                                    <option value="Buguruni Pickup">Buguruni Malapa Pickup Inquiry</option>
                                    <option value="Distributor Question">Distribution or Event Catering</option>
                                </select>
                            </div>

                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">Your Message</label>
                                <textarea name="message" rows="4" required placeholder="Tell us how we can help you..."
                                          class="w-full px-4 py-3 rounded-xl bg-[#FAF6F0] border border-zinc-300 text-sm text-zinc-900 focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-brand-red focus:outline-none transition"></textarea>
                            </div>

                            <button type="submit" class="w-full py-4 rounded-xl bg-red-600 hover:bg-red-600-dark text-white font-bold text-sm shadow-md hover:shadow-lg transition flex items-center justify-center gap-2 cursor-pointer">
                                <span>Send Message to INAS Team</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
