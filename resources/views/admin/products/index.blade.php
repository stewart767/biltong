@extends('layouts.admin')

@section('title', 'Menu & Product Management')

@section('content')

<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-white">Burgers, Combos & Sides Catalog</h2>
            <span class="text-xs text-stone-400">Manage prices, food portions, stock levels, burger photos and menu availability</span>
        </div>
        <a href="{{ route('admin.products.create') }}" class="px-4 py-2.5 rounded-xl bg-[#E52E2E] hover:bg-[#C61A1A] text-white font-bold text-xs uppercase tracking-wider transition flex items-center gap-1.5 shadow-md shadow-red-500/20 border-2 border-white/20">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Add New Menu Item</span>
        </a>
    </div>

    <!-- Filter & Search with Classic Modified Borders -->
    <form action="{{ route('admin.products.index') }}" method="GET" class="p-4 rounded-2xl bg-[#1C1C1C] border-2 border-[#2A2A2A] flex flex-wrap gap-3 text-xs">
        <input type="text" 
               name="search" 
               value="{{ request('search') }}" 
               placeholder="Search item name or SKU..." 
               class="px-4 py-2 bg-[#141414] border-2 border-[#2A2A2A] rounded-xl text-xs text-white focus:outline-none focus:border-[#E52E2E] min-w-[220px]">

        <select name="category_id" onchange="this.form.submit()" class="px-3 py-2 bg-[#141414] border-2 border-[#2A2A2A] rounded-xl text-white focus:outline-none focus:border-[#E52E2E]">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="px-5 py-2 bg-[#E52E2E] hover:bg-[#C61A1A] text-white rounded-xl font-bold uppercase transition shadow-xs">
            Filter
        </button>
    </form>

    <div class="rounded-3xl bg-[#1C1C1C] border-2 border-[#2A2A2A] overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#2A2A2A] bg-[#141414] text-stone-400 uppercase text-[10px] tracking-wider">
                        <th class="py-3.5 px-6">Menu Item</th>
                        <th class="py-3.5 px-4">Category</th>
                        <th class="py-3.5 px-4">Portion / Weight</th>
                        <th class="py-3.5 px-4">Price (Tshs)</th>
                        <th class="py-3.5 px-4">Stock</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#2A2A2A]">
                    @forelse($products as $product)
                        <tr class="hover:bg-[#242424] transition">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-xl object-cover bg-[#141414] border border-[#333333]">
                                    <div>
                                        <span class="font-bold text-white text-sm block">{{ $product->name }}</span>
                                        <span class="text-xs text-[#E52E2E] font-mono">{{ $product->sku }}</span>
                                        @if($product->is_featured)
                                            <span class="inline-block px-2 py-0.5 rounded text-[9px] bg-[#E52E2E] text-white font-bold uppercase ml-1">Featured</span>
                                        @endif
                                        @if(!empty($product->badges))
                                            @foreach((array)$product->badges as $b)
                                                <span class="inline-block px-1.5 py-0.5 rounded text-[8px] bg-orange-950 text-orange-400 border border-orange-800 font-bold uppercase ml-1">{{ $b }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-stone-300">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </td>
                            <td class="py-4 px-4 font-semibold text-white">
                                {{ $product->pack_size }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-white">{{ $product->formatted_price }}</span>
                                @if($product->is_on_sale)
                                    <span class="block text-[10px] text-stone-400 line-through">{{ $product->formatted_regular_price }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-0.5 rounded text-[11px] font-bold {{ $product->stock > 10 ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-red-950 text-red-400 border border-red-800' }}">
                                    {{ $product->stock }} packs
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold {{ $product->is_active ? 'bg-emerald-950 text-emerald-300' : 'bg-stone-800 text-stone-400' }}">
                                    {{ $product->is_active ? 'Active' : 'Unpublished' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="p-1.5 rounded-lg bg-[#2A2A2A] text-stone-300 hover:text-white transition" title="Edit">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Remove product?');">
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
                            <td colspan="7" class="py-8 text-center text-stone-500">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="p-4 border-t border-[#2A2A2A] bg-[#171717]">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>

@endsection
