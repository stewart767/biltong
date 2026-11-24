@extends('layouts.admin')

@section('title', 'Product Management')
@section('page_title', 'Product Catalogue Management')

@section('content')

    <div class="space-y-6">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-editorial text-2xl font-bold text-brand-cream">Beef Cuts & Biltong Varieties</h2>
                <span class="text-xs text-brand-muted">Configure prices, pack sizes, weight options, stock levels and nutritional facts</span>
            </div>
            <a href="{{ route('admin.products.create') }}" class="px-4 py-2.5 rounded-xl bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs font-bold hover:shadow-lg transition flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Add New Biltong Cut</span>
            </a>
        </div>

        <div class="rounded-2xl bg-brand-card border border-brand-border overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-brand-border bg-brand-dark/80 text-brand-muted uppercase text-[10px] tracking-wider">
                            <th class="py-3.5 px-6">Product</th>
                            <th class="py-3.5 px-4">Category</th>
                            <th class="py-3.5 px-4">Pack Size</th>
                            <th class="py-3.5 px-4">Price</th>
                            <th class="py-3.5 px-4">Stock</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-border/60">
                        @forelse($products as $product)
                            <tr class="hover:bg-brand-dark/40 transition">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover bg-brand-dark border border-brand-border">
                                        <div>
                                            <span class="font-bold text-brand-cream text-sm block">{{ $product->name }}</span>
                                            <span class="text-xs text-brand-red font-mono">{{ $product->sku }}</span>
                                            @if($product->is_featured)
                                                <span class="inline-block px-2 py-0.2 rounded text-[9px] bg-brand-red text-white font-bold uppercase ml-1">Featured</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-brand-cream/80">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </td>
                                <td class="py-4 px-4 font-semibold text-brand-cream">
                                    {{ $product->pack_size }}
                                </td>
                                <td class="py-4 px-4">
                                    <span class="font-bold text-brand-cream">{{ $product->formatted_price }}</span>
                                    @if($product->formatted_original_price)
                                        <span class="block text-[11px] text-brand-muted line-through">{{ $product->formatted_original_price }}</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2 py-0.5 rounded text-[11px] font-bold {{ $product->stock > 10 ? 'bg-emerald-950 text-emerald-400 border border-emerald-500/40' : 'bg-red-950 text-red-400 border border-red-500/40' }}">
                                        {{ $product->stock }} packs
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $product->is_active ? 'bg-emerald-950 text-emerald-300' : 'bg-zinc-800 text-zinc-400' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="p-1.5 rounded-lg bg-brand-dark text-brand-red hover:text-white transition" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this product?');">
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
                                <td colspan="7" class="py-8 text-center text-brand-muted">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="p-4 border-t border-brand-border bg-brand-dark">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection
