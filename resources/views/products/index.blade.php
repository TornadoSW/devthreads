@extends('layouts.app')

@section('title', 'Shop Developer Apparel - DevThreads')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">

    {{-- Page Header --}}
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold">
            @if(request('category'))
                <span class="gradient-text">{{ ucfirst(str_replace('-', ' ', request('category'))) }}</span>
            @elseif(request('search'))
                Results for "<span class="gradient-text">{{ request('search') }}</span>"
            @else
                All <span class="gradient-text">Products</span>
            @endif
        </h1>

        {{-- Search Bar --}}
        <form action="{{ route('products.index') }}" method="GET" class="mt-6 max-w-md">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search products..."
                       class="w-full glass rounded-xl pl-12 pr-4 py-3 text-gray-200 placeholder-gray-500 border border-white/10 focus:border-accent-400/50 focus:outline-none bg-transparent">
                <img src="https://api.iconify.design/lucide:search.svg?color=%236b7280&width=18&height=18"
                     alt="" class="absolute left-4 top-1/2 -translate-y-1/2">
            </div>
        </form>
    </div>

    <div class="flex flex-col md:flex-row gap-8">

        {{-- Sidebar Filters --}}
        <aside class="md:w-60 shrink-0">
            <div class="glass rounded-2xl p-6 sticky top-24">
                <h3 class="font-semibold text-gray-300 text-sm uppercase tracking-wider mb-4 flex items-center gap-2">
                    <img src="https://api.iconify.design/lucide:layers.svg?color=%2306b6d4&width=16&height=16" alt="">
                    Categories
                </h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="flex items-center gap-2 py-2 px-3 rounded-lg text-sm transition {{ !request('category') ? 'bg-accent-400/10 text-accent-400 font-medium' : 'text-gray-400 hover:text-gray-200 hover:bg-white/5' }}">
                            <img src="https://api.iconify.design/lucide:grid-3x3.svg?color={{ !request('category') ? '%2306b6d4' : '%239ca3af' }}&width=16&height=16" alt="">
                            All Products
                        </a>
                    </li>
                    @php
                        $catIcons = ['t-shirts' => 'lucide:shirt', 'hoodies' => 'mdi:hoodie', 'mugs' => 'lucide:coffee', 'stickers' => 'lucide:sticker'];
                    @endphp
                    @foreach($categories as $category)
                        @php $active = request('category') === $category->slug; @endphp
                        <li>
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                               class="flex items-center gap-2 py-2 px-3 rounded-lg text-sm transition {{ $active ? 'bg-accent-400/10 text-accent-400 font-medium' : 'text-gray-400 hover:text-gray-200 hover:bg-white/5' }}">
                                <img src="https://api.iconify.design/{{ $catIcons[$category->slug] ?? 'lucide:package' }}.svg?color={{ $active ? '%2306b6d4' : '%239ca3af' }}&width=16&height=16" alt="">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="border-t border-white/5 my-5"></div>

                <h3 class="font-semibold text-gray-300 text-sm uppercase tracking-wider mb-4 flex items-center gap-2">
                    <img src="https://api.iconify.design/lucide:arrow-up-down.svg?color=%23a855f7&width=16&height=16" alt="">
                    Sort By
                </h3>
                <ul class="space-y-1">
                    @php
                        $sorts = [
                            'newest'     => ['label' => 'Newest', 'icon' => 'lucide:sparkles'],
                            'price_low'  => ['label' => 'Price: Low → High', 'icon' => 'lucide:trending-up'],
                            'price_high' => ['label' => 'Price: High → Low', 'icon' => 'lucide:trending-down'],
                        ];
                    @endphp
                    @foreach($sorts as $key => $sort)
                        @php $active = request('sort', 'newest') === $key; @endphp
                        <li>
                            <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => $key])) }}"
                               class="flex items-center gap-2 py-2 px-3 rounded-lg text-sm transition {{ $active ? 'bg-purple-400/10 text-purple-400 font-medium' : 'text-gray-400 hover:text-gray-200 hover:bg-white/5' }}">
                                <img src="https://api.iconify.design/{{ $sort['icon'] }}.svg?color={{ $active ? '%23a855f7' : '%239ca3af' }}&width=16&height=16" alt="">
                                {{ $sort['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        {{-- Product Grid --}}
        <div class="flex-1">
            @if($products->count())
                @php
                    $shopImages = [
                        'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1576566588028-4147f3842f27?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1622445275576-721325763afe?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1564557287817-3785e38ec1f5?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1571945153237-4929e783af4a?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?auto=format&fit=crop&w=500&q=80',
                    ];
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $index => $product)
                        <a href="{{ route('products.show', $product->slug) }}"
                           class="glass-card rounded-2xl overflow-hidden group">
                            <div class="aspect-square relative overflow-hidden">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 img-fade"
                                         loading="lazy" onload="this.classList.add('loaded')">
                                @else
                                    <img src="{{ $shopImages[$index % count($shopImages)] }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 img-fade"
                                         loading="lazy" onload="this.classList.add('loaded')">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-[#050510] via-transparent opacity-60"></div>
                                <div class="absolute top-3 left-3">
                                    <span class="glass rounded-full px-3 py-1 text-xs font-medium text-accent-400 uppercase tracking-wider">
                                        {{ $product->category->name ?? '' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="font-semibold text-gray-200 group-hover:text-accent-400 transition-colors">{{ $product->name }}</h3>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-xl font-bold gradient-text">${{ number_format($product->price, 2) }}</span>
                                    <span class="glass rounded-full p-2 group-hover:glow-cyan transition-shadow">
                                        <img src="https://api.iconify.design/lucide:arrow-right.svg?color=%2306b6d4&width=16&height=16" alt="">
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                <div class="glass rounded-2xl text-center py-20">
                    <img src="https://api.iconify.design/lucide:search-x.svg?color=%236b7280&width=48&height=48" alt="" class="mx-auto mb-4">
                    <p class="text-xl text-gray-400">No products found.</p>
                    <a href="{{ route('products.index') }}" class="text-accent-400 hover:text-accent-500 mt-3 inline-block transition">
                        Clear filters
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
