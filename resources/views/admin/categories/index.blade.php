@extends('layouts.admin')

@section('title', 'Categories Management')
@section('page_title', 'Product Categories')

@section('content')

    <div class="space-y-6">
        
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-editorial text-2xl font-bold text-brand-cream">Catalogue Categories</h2>
                <span class="text-xs text-brand-muted">Manage circular dish photos and titles for "Explore by Cut & Craft" on the homepage</span>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs hover:shadow-lg transition flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Add Category</span>
            </a>
        </div>

        <div class="rounded-2xl bg-brand-card border border-brand-border overflow-hidden shadow-xl">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-brand-border bg-brand-dark/80 text-brand-muted uppercase text-[10px] tracking-wider">
                        <th class="py-3.5 px-6">Photo</th>
                        <th class="py-3.5 px-4">Name</th>
                        <th class="py-3.5 px-4">Slug</th>
                        <th class="py-3.5 px-4">Products</th>
                        <th class="py-3.5 px-4">Order</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border/60">
                    @forelse($categories as $cat)
                        <tr class="hover:bg-brand-dark/40 transition">
                            <td class="py-3 px-6">
                                <div class="w-12 h-12 rounded-full overflow-hidden border border-brand-border shadow bg-brand-dark">
                                    <img src="{{ $cat->image_url }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="py-4 px-4 font-bold text-brand-cream text-sm">
                                <a href="{{ route('admin.categories.edit', $cat) }}" class="hover:text-brand-red transition">
                                    {{ $cat->name }}
                                </a>
                                <span class="block text-[11px] text-brand-muted font-normal truncate max-w-xs">{{ $cat->description }}</span>
                            </td>
                            <td class="py-4 px-4 font-mono text-brand-red text-xs">
                                {{ $cat->slug }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2 py-0.5 rounded bg-brand-dark text-brand-cream font-bold">
                                    {{ $cat->products_count }} products
                                </span>
                            </td>
                            <td class="py-4 px-4 text-brand-muted">
                                {{ $cat->sort_order }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $cat->is_active ? 'bg-emerald-950 text-emerald-300' : 'bg-zinc-800 text-zinc-400' }}">
                                    {{ $cat->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $cat) }}" class="p-1.5 rounded-lg bg-brand-dark text-brand-red hover:text-white transition" title="Edit Category & Photo">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Delete this category?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg bg-brand-dark text-brand-muted hover:text-red-400 transition" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-brand-muted">No categories created yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection
