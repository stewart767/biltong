@extends('layouts.admin')

@section('title', 'Edit Category')
@section('page_title', 'Edit Category: ' . $category->name)

@section('content')

    <div class="max-w-xl space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="font-serif text-2xl font-bold text-stone-100">Edit: {{ $category->name }}</h2>
            <a href="{{ route('admin.categories.index') }}" class="text-xs text-stone-400 hover:text-white transition flex items-center gap-1.5">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back to Categories
            </a>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="p-8 rounded-2xl bg-stone-900 border border-stone-800 space-y-5 shadow-xl">
            @csrf
            @method('PUT')

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Category Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                       class="w-full px-4 py-3 rounded-xl bg-stone-950 border border-stone-800 text-sm text-stone-100 placeholder-stone-600 focus:border-[#B77B3B] focus:outline-none">
            </div>

            <!-- Category Photo with Current Preview -->
            <div class="space-y-2">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Category Photo / Cut Image</label>
                <div class="flex items-center gap-4 p-3 rounded-xl bg-stone-950/60 border border-stone-800">
                    <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-[#B77B3B] shadow bg-stone-950 flex-shrink-0">
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 space-y-1">
                        <input type="file" name="image" accept="image/*"
                               class="w-full text-xs text-stone-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#B77B3B] file:text-white hover:file:bg-[#9E652E] cursor-pointer">
                        <p class="text-[11px] text-stone-500">Upload a new photo to replace the current category banner image.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Description / Subtitle</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 rounded-xl bg-stone-950 border border-stone-800 text-sm text-stone-100 placeholder-stone-600 focus:border-[#B77B3B] focus:outline-none">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-stone-400">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}"
                           class="w-full px-4 py-3 rounded-xl bg-stone-950 border border-stone-800 text-sm text-stone-100 focus:border-[#B77B3B] focus:outline-none">
                </div>
                <div class="flex items-center gap-2 pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="text-[#B77B3B] focus:ring-[#B77B3B] rounded bg-stone-950 border-stone-800">
                        <span class="text-xs text-stone-300 font-medium">Active on Storefront</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-stone-800/80 flex items-center justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 rounded-xl bg-stone-800 hover:bg-stone-700 text-stone-300 text-xs font-semibold transition">Cancel</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#B77B3B] hover:bg-[#9E652E] text-white font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-[#B77B3B]/20">Update Category</button>
            </div>
        </form>
    </div>

@endsection
