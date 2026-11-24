@extends('layouts.app')

@section('title', 'Product Catalogue | INAS Premium Beef Biltong | Dar es Salaam')

@section('content')

    <!-- Shop Hero Header (Dark with Red Accent) -->
    <section class="py-16 bg-brand-black border-b border-zinc-800 text-center">
        <div class="max-w-4xl mx-auto px-4 space-y-3">
            <span class="text-xs uppercase tracking-widest text-brand-red font-black">The Butcher’s Range</span>
            <h1 class="font-editorial text-4xl sm:text-5xl font-black text-white">
                Artisanal Beef Biltong & Dried Snacks
            </h1>
            <p class="text-zinc-400 text-sm sm:text-base max-w-xl mx-auto">
                Small-batch cured pasture beef, hand-sliced and sealed in Buguruni Malapa. Free delivery in Dar es Salaam on orders over TZS 50,000.
            </p>
        </div>
    </section>

    <!-- Catalogue Container (Light Crisp White Area) -->
    <section class="py-16 bg-zinc-50 text-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <!-- Filters Toolbar -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 pb-6 border-b border-zinc-200">
                
                <!-- Category Tabs (Red Active Pills) -->
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('shop') }}" 
                       class="px-5 py-2.5 rounded-xl text-xs font-bold transition shadow-sm {{ !request('category') ? 'bg-brand-red text-white' : 'bg-white text-zinc-800 hover:bg-zinc-200 border border-zinc-200' }}">
                        All Varieties ({{ $products->count() }})
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('shop', ['category' => $category->slug]) }}" 
                           class="px-5 py-2.5 rounded-xl text-xs font-bold transition shadow-sm {{ request('category') === $category->slug ? 'bg-brand-red text-white' : 'bg-white text-zinc-800 hover:bg-zinc-200 border border-zinc-200' }}">
                            {{ $category->name }} ({{ $category->products_count }})
                        </a>
                    @endforeach
                </div>

                <!-- Info summary -->
                <div class="text-xs text-zinc-500 font-medium">
                    Showing <span class="font-bold text-zinc-900">{{ $products->count() }}</span> items
                </div>
            </div>

            <!-- Products Grid (Matching User Screenshot Layout) -->
            @if($products->isEmpty())
                <div class="text-center py-20 space-y-4">
                    <p class="text-base text-zinc-500">No products found in this category.</p>
                    <a href="{{ route('shop') }}" class="px-5 py-2.5 rounded-xl bg-brand-red text-white font-bold text-xs inline-block">
                        View All Products
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-2xl border border-zinc-200 overflow-hidden shadow-sm hover:shadow-xl hover:border-brand-red transition duration-300 flex flex-col justify-between group">
                            
                            <!-- Top Image with Badges -->
                            <div class="relative h-56 bg-zinc-100 overflow-hidden">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <img src="{{ $product->image_url }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-500">
                                </a>

                                <!-- Favorite Heart Icon -->
                                <div class="absolute top-2.5 right-2.5">
                                    <span class="w-7 h-7 rounded-full bg-white/90 text-brand-red flex items-center justify-center shadow-md">
                                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                                    </span>
                                </div>

                                <!-- Pack Size Badge -->
                                <div class="absolute top-2.5 left-2.5">
                                    <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-zinc-900 text-white">
                                        {{ $product->pack_size }}
                                    </span>
                                </div>
                            </div>

                            <!-- Full-Width Red "Add to Cart" Button Bar (Matching uploaded screenshot) -->
                            <button @click="$store.cart.addItem({
                                        id: {{ $product->id }},
                                        name: '{{ addslashes($product->name) }}',
                                        slug: '{{ $product->slug }}',
                                        image: '{{ $product->image_url }}',
                                        pack_size: '{{ $product->pack_size }}',
                                        price: {{ $product->effective_price }},
                                        quantity: 1
                                    })"
                                    class="w-full py-2.5 bg-brand-red hover:bg-brand-red-dark text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition duration-150">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                <span>Add to Cart</span>
                            </button>

                            <!-- Bottom Info: Title, Pack Size, Price -->
                            <div class="p-4 text-center space-y-1.5 bg-white">
                                <h3 class="font-bold text-sm text-zinc-900 line-clamp-1 group-hover:text-brand-red transition">
                                    <a href="{{ route('product.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-base font-black text-brand-red">
                                        {{ $product->formatted_price }}
                                    </span>
                                    @if($product->formatted_original_price)
                                        <span class="text-xs text-zinc-400 line-through">
                                            {{ $product->formatted_original_price }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

@endsection
