@extends('layouts.admin')

@section('title', 'New Category')
@section('page_title', 'Create Category')

@section('content')

    <div class="max-w-xl space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="font-editorial text-2xl font-bold text-brand-cream">New Category</h2>
            <a href="{{ route('admin.categories.index') }}" class="text-xs text-brand-muted hover:text-white">&larr; Back to Categories</a>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="p-8 rounded-2xl bg-brand-card border border-brand-border space-y-4">
            @csrf

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Category Name *</label>
                <input type="text" name="name" required placeholder="e.g. Traditional Biltong"
                       class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Description</label>
                <textarea name="description" rows="3" placeholder="Brief category description..."
                          class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-muted">Sort Order</label>
                    <input type="number" name="sort_order" value="0"
                           class="w-full px-4 py-3 rounded-xl bg-brand-dark border border-brand-border text-sm text-brand-cream focus:border-brand-red focus:outline-none">
                </div>
                <div class="flex items-center gap-2 pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="text-brand-red focus:ring-brand-red rounded">
                        <span class="text-xs text-brand-cream font-medium">Active</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-brand-border/60 flex items-center justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 rounded-xl bg-brand-dark text-brand-muted text-xs font-semibold">Cancel</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs font-bold uppercase tracking-wider">Save Category</button>
            </div>
        </form>
    </div>

@endsection
