@extends('layouts.admin')

@section('title', 'Edit Category')
@section('page_title', 'Edit Category: ' . $category->name)

@section('content')

    <div class="max-w-xl space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="font-editorial text-2xl font-bold text-brand-cream">Edit: {{ $category->name }}</h2>
            <a href="{{ route('admin.categories.index') }}" class="text-xs text-brand-muted hover:text-white">&larr; Back to Categories</a>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-5 shadow-xl">
            @csrf
            @method('PUT')

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Category Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                       class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
            </div>

            <!-- Category Photo with Current Preview -->
            <div class="space-y-2">
                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Category Photo / Cut Image</label>
                <div class="flex items-center gap-4 p-3 rounded-xl bg-brand-dark/60 border border-brand-border">
                    <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-brand-red shadow bg-brand-dark flex-shrink-0">
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 space-y-1">
                        <input type="file" name="image" accept="image/*"
                               class="w-full text-xs text-brand-muted file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-red file:text-white hover:file:bg-brand-red-dark cursor-pointer">
                        <p class="text-[11px] text-brand-muted">Upload a new photo to change the circular picture shown in "Explore by Cut & Craft" on the homepage.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Description / Subtitle</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}"
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>
                <div class="flex items-center gap-2 pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="text-brand-red focus:ring-brand-red rounded">
                        <span class="text-xs text-brand-cream font-medium">Active on Storefront</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-brand-border/60 flex items-center justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 rounded-xl bg-brand-dark text-brand-muted text-xs font-semibold">Cancel</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs uppercase tracking-wider">Update Category & Photo</button>
            </div>
        </form>
    </div>

@endsection
