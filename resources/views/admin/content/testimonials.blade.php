@extends('layouts.admin')

@section('title', 'Manage Customer Testimonials')

@section('content')

<div class="space-y-8" x-data="{ showModal: false }">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-display text-2xl font-bold text-white">Customer Reviews & Testimonials</h2>
            <p class="text-xs text-stone-400">Curate genuine customer feedback and demonstration quotes shown on the storefront.</p>
        </div>
        <button type="button" @click="showModal = true" class="px-4 py-2 bg-[#B77B3B] hover:bg-[#C98E4F] text-white rounded-xl text-xs font-bold uppercase tracking-wider transition flex items-center gap-1.5 shadow-md">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Add Testimonial</span>
        </button>
    </div>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($testimonials as $t)
            <div class="bg-[#1F1F1F] rounded-3xl border border-[#2A2A2A] p-6 shadow-xs flex flex-col justify-between">
                <div>
                    <!-- Stars -->
                    <div class="flex items-center gap-1 text-[#B77B3B] mb-3">
                        @for($i = 0; $i < $t->rating; $i++)
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                        @endfor
                    </div>
                    <p class="text-xs text-stone-300 leading-relaxed italic">
                        “{{ $t->comment }}”
                    </p>
                </div>

                <div class="mt-6 pt-4 border-t border-[#2A2A2A] flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-sm text-white">{{ $t->customer_name }}</h4>
                        <p class="text-[10px] text-stone-400">{{ $t->customer_role }} ({{ $t->location }})</p>
                    </div>

                    <form action="{{ route('admin.content.testimonials.destroy', $t) }}" method="POST" onsubmit="return confirm('Remove testimonial?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-stone-400 hover:text-red-400 transition">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal to Add Testimonial -->
    <div x-show="showModal" 
         x-transition 
         class="fixed inset-0 z-50 bg-[#171717]/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div @click.away="showModal = false" class="bg-[#1F1F1F] w-full max-w-lg rounded-3xl p-8 shadow-2xl border border-[#2A2A2A] relative text-xs">
            <button @click="showModal = false" class="absolute top-6 right-6 text-stone-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <h3 class="font-display font-bold text-lg text-white mb-4">Add Customer Testimonial</h3>

            <form action="{{ route('admin.content.testimonials.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-stone-400 font-semibold mb-1">Customer Name *</label>
                        <input type="text" name="customer_name" required placeholder="e.g. Faraja M." class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white">
                    </div>
                    <div>
                        <label class="block text-stone-400 font-semibold mb-1">City / Location *</label>
                        <input type="text" name="location" required value="Dar es Salaam" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white">
                    </div>
                </div>

                <div>
                    <label class="block text-stone-400 font-semibold mb-1">Customer Profession / Title (Optional)</label>
                    <input type="text" name="customer_role" placeholder="e.g. Corporate Executive" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white">
                </div>

                <div>
                    <label class="block text-stone-400 font-semibold mb-1">Rating</label>
                    <select name="rating" class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white">
                        <option value="5">5 Stars - Outstanding</option>
                        <option value="4">4 Stars - Excellent</option>
                    </select>
                </div>

                <div>
                    <label class="block text-stone-400 font-semibold mb-1">Customer Review Quote *</label>
                    <textarea name="comment" rows="4" required placeholder="Write review..." class="w-full px-3 py-2 bg-[#171717] border border-[#333333] rounded-xl text-white"></textarea>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" @click="showModal = false" class="px-4 py-2 text-stone-400 hover:text-white">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-[#B77B3B] hover:bg-[#C98E4F] text-white rounded-xl font-bold uppercase transition">Save Testimonial</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
