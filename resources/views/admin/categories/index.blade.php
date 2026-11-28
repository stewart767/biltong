@extends('layouts.admin')

@section('title', 'Categories Management')

@section('content')

<div class="space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-display text-2xl font-bold text-white">Product Categories</h2>
            <span class="text-xs text-stone-400">Manage categories, descriptions, images and storefront sort order</span>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="px-4 py-2.5 rounded-xl bg-[#B77B3B] hover:bg-[#C98E4F] text-white font-bold text-xs uppercase tracking-wider transition flex items-center gap-1.5 shadow-md">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Add Category</span>
        </a>
    </div>

    <div class="rounded-3xl bg-[#1F1F1F] border border-[#2A2A2A] overflow-hidden shadow-xs">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="border-b border-[#2A2A2A] bg-[#171717] text-stone-400 uppercase text-[10px] tracking-wider">
                    <th class="py-3.5 px-6">Image</th>
                    <th class="py-3.5 px-4">Category Name</th>
                    <th class="py-3.5 px-4">Slug</th>
                    <th class="py-3.5 px-4">Products</th>
                    <th class="py-3.5 px-4">Order</th>
                    <th class="py-3.5 px-4">Status</th>
                    <th class="py-3.5 px-6 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#2A2A2A]">
                @forelse($categories as $cat)
                    <tr class="hover:bg-[#262626] transition">
                        <td class="py-3 px-6">
                            <div class="w-12 h-12 rounded-xl overflow-hidden border border-[#333333] bg-[#171717]">
                                <img src="{{ $cat->image_url }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-4 px-4 font-bold text-white text-sm">
                            <a href="{{ route('admin.categories.edit', $cat) }}" class="hover:text-[#B77B3B] transition">
                                {{ $cat->name }}
                            </a>
                            <span class="block text-[11px] text-stone-400 font-normal truncate max-w-xs">{{ $cat->description }}</span>
                        </td>
                        <td class="py-4 px-4 font-mono text-[#B77B3B] text-xs">
                            {{ $cat->slug }}
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2 py-0.5 rounded-full bg-[#171717] text-stone-300 font-bold">
                                {{ $cat->products_count }} cuts
                            </span>
                        </td>
                        <td class="py-4 px-4 text-stone-400">
                            {{ $cat->sort_order }}
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $cat->is_active ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : 'bg-stone-800 text-stone-400' }}">
                                {{ $cat->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.categories.edit', $cat) }}" class="p-1.5 rounded-lg bg-[#2A2A2A] text-stone-300 hover:text-white transition" title="Edit">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Delete this category?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg bg-[#2A2A2A] text-stone-400 hover:text-red-400 transition" title="Delete">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-stone-500">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
