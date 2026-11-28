@extends('layouts.admin')

@section('title', 'New Category')
@section('page_title', 'Create Category')

@section('content')

    <div class="max-w-xl space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="font-serif text-2xl font-bold text-stone-100">New Category</h2>
            <a href="{{ route('admin.categories.index') }}" class="text-xs text-stone-400 hover:text-white transition flex items-center gap-1.5">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back to Categories
            </a>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="p-8 rounded-2xl bg-stone-900 border border-stone-800 space-y-5 shadow-xl">
            @csrf

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Category Name *</label>
                <input type="text" name="name" required placeholder="e.g. Original Beef Biltong"
                       class="w-full px-4 py-3 rounded-xl bg-stone-950 border border-stone-800 text-sm text-stone-100 placeholder-stone-600 focus:border-[#B77B3B] focus:outline-none">
            </div>

            <!-- Category Photo / Dish Cut Image -->
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Category Photo / Cut Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-xs text-stone-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#B77B3B] file:text-white hover:file:bg-[#9E652E] cursor-pointer">
                <p class="text-[11px] text-stone-500">Image will appear on category tiles and shop navigation.</p>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Description / Subtitle</label>
                <textarea name="description" rows="3" placeholder="Brief subtitle shown on the shop filter..."
                          class="w-full px-4 py-3 rounded-xl bg-stone-950 border border-stone-800 text-sm text-stone-100 placeholder-stone-600 focus:border-[#B77B3B] focus:outline-none"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Sort Order</label>
                    <input type="number" name="sort_order" value="0"
                           class="w-full px-4 py-3 rounded-xl bg-stone-950 border border-stone-800 text-sm text-stone-100 focus:border-[#B77B3B] focus:outline-none">
                </div>
                <div class="flex items-center gap-2 pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="text-[#B77B3B] focus:ring-[#B77B3B] rounded bg-stone-950 border-stone-800">
                        <span class="text-xs text-stone-300 font-medium">Active on Storefront</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-stone-800/80 flex items-center justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 rounded-xl bg-stone-800 hover:bg-stone-700 text-stone-300 text-xs font-semibold transition">Cancel</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#B77B3B] hover:bg-[#9E652E] text-white font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-[#B77B3B]/20">Save Category</button>
            </div>
        </form>
    </div>

@endsection
