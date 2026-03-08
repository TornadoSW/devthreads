@extends('layouts.app')

@section('title', 'DevThreads - Code. Commit. Wear.')

@section('content')
    {{-- Hero Section with Background Image --}}
    <section class="relative min-h-[90vh] flex items-center overflow-hidden -mt-16 pt-16">
        {{-- Background image --}}
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1920&q=80"
                 alt="" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-b from-[#050510]/80 via-[#050510]/60 to-[#050510]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/5 via-transparent to-purple-500/5"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 glass rounded-full px-4 py-1.5 mb-8">
                <span class="w-2 h-2 bg-accent-400 rounded-full animate-pulse"></span>
                <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">New Collection Dropped</span>
            </div>

            <h1 class="text-5xl md:text-7xl lg:text-8xl font-black leading-tight">
                Code. Commit.
                <br>
                <span class="gradient-text">Wear.</span>
            </h1>

            <p class="mt-6 text-lg md:text-xl text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Premium developer apparel for engineers who push code — and push style.
                Designed by devs, for devs.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('products.index') }}"
                   class="btn-glow text-white font-semibold px-10 py-4 rounded-xl text-lg inline-flex items-center justify-center gap-2">
                    <img src="https://api.iconify.design/lucide:shopping-bag.svg?color=white&width=20&height=20" alt="">
                    Shop Now
                </a>
                <a href="{{ route('products.index', ['category' => 'hoodies']) }}"
                   class="btn-outline-glow text-gray-300 font-semibold px-10 py-4 rounded-xl text-lg inline-flex items-center justify-center gap-2">
                    <img src="https://api.iconify.design/lucide:flame.svg?color=%2306b6d4&width=20&height=20" alt="">
                    Browse Hoodies
                </a>
            </div>

            {{-- Stats --}}
            <div class="mt-16 grid grid-cols-3 gap-6 max-w-lg mx-auto">
                <div>
                    <div class="text-2xl md:text-3xl font-bold gradient-text">16+</div>
                    <div class="text-xs text-gray-500 mt-1">Unique Designs</div>
                </div>
                <div>
                    <div class="text-2xl md:text-3xl font-bold gradient-text">100%</div>
                    <div class="text-xs text-gray-500 mt-1">Premium Quality</div>
                </div>
                <div>
                    <div class="text-2xl md:text-3xl font-bold gradient-text">Fast</div>
                    <div class="text-xs text-gray-500 mt-1">Shipping</div>
                </div>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <img src="https://api.iconify.design/lucide:chevrons-down.svg?color=%2306b6d4&width=24&height=24" alt="" class="opacity-50">
        </div>
    </section>

    {{-- Categories Section --}}
    @if($categories->count())
    <section class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-bold">Shop by <span class="gradient-text">Category</span></h2>
            <p class="text-gray-500 mt-3">Find your perfect developer gear</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @php
                $categoryImages = [
                    't-shirts' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=400&q=80',
                    'hoodies'  => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=400&q=80',
                    'mugs'     => 'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?auto=format&fit=crop&w=400&q=80',
                    'stickers' => 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?auto=format&fit=crop&w=400&q=80',
                ];
                $categoryIcons = [
                    't-shirts' => 'lucide:shirt',
                    'hoodies'  => 'mdi:hoodie',
                    'mugs'     => 'lucide:coffee',
                    'stickers' => 'lucide:sticker',
                ];
            @endphp
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                   class="glass-card rounded-2xl overflow-hidden group relative">
                    {{-- Background image --}}
                    <div class="absolute inset-0">
                        <img src="{{ $categoryImages[$category->slug] ?? 'https://picsum.photos/seed/' . $category->slug . '/400/300' }}"
                             alt="{{ $category->name }}" class="w-full h-full object-cover opacity-20 group-hover:opacity-30 transition-opacity duration-500 img-fade"
                             loading="lazy" onload="this.classList.add('loaded')">
                    </div>
                    <div class="relative p-6 md:p-8 text-center">
                        <img src="https://api.iconify.design/{{ $categoryIcons[$category->slug] ?? 'lucide:package' }}.svg?color=%2306b6d4&width=40&height=40"
                             alt="" class="mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <h3 class="font-semibold text-gray-200 text-lg">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $category->products_count }} products</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Featured Products --}}
    @if($featuredProducts->count())
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-14">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold">Featured <span class="gradient-text">Drops</span></h2>
                    <p class="text-gray-500 mt-3">Our most popular developer apparel</p>
                </div>
                <a href="{{ route('products.index') }}"
                   class="hidden md:inline-flex items-center gap-2 text-accent-400 hover:text-accent-500 font-medium transition">
                    View All
                    <img src="https://api.iconify.design/lucide:arrow-right.svg?color=%2306b6d4&width=16&height=16" alt="">
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $productImages = [
                        'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1576566588028-4147f3842f27?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1622445275576-721325763afe?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1564557287817-3785e38ec1f5?auto=format&fit=crop&w=500&q=80',
                    ];
                @endphp
                @foreach($featuredProducts as $index => $product)
                    <a href="{{ route('products.show', $product->slug) }}"
                       class="glass-card rounded-2xl overflow-hidden group">
                        {{-- Product Image --}}
                        <div class="aspect-square relative overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 img-fade"
                                     loading="lazy" onload="this.classList.add('loaded')">
                            @else
                                <img src="{{ $productImages[$index % count($productImages)] }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 img-fade"
                                     loading="lazy" onload="this.classList.add('loaded')">
                            @endif
                            {{-- Overlay gradient --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-[#050510] via-transparent opacity-60"></div>
                            {{-- Category badge --}}
                            <div class="absolute top-3 left-3">
                                <span class="glass rounded-full px-3 py-1 text-xs font-medium text-accent-400 uppercase tracking-wider">
                                    {{ $product->category->name ?? '' }}
                                </span>
                            </div>
                        </div>

                        {{-- Info --}}
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

            <div class="text-center mt-12 md:hidden">
                <a href="{{ route('products.index') }}"
                   class="btn-glow text-white font-semibold px-8 py-3 rounded-xl inline-flex items-center gap-2">
                    View All Products
                    <img src="https://api.iconify.design/lucide:arrow-right.svg?color=white&width=16&height=16" alt="">
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Features / Value Props --}}
    <section class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-6">
            @php
                $features = [
                    ['icon' => 'lucide:zap', 'title' => 'Premium Quality', 'desc' => 'Soft, comfortable fabrics with eco-friendly inks that survive hundreds of washes.', 'color' => '%23eab308'],
                    ['icon' => 'lucide:code-2', 'title' => 'Made for Developers', 'desc' => 'Designs that speak your language — from git jokes to CSS puns and beyond.', 'color' => '%2306b6d4'],
                    ['icon' => 'lucide:truck', 'title' => 'Fast Shipping', 'desc' => 'Printed on demand and shipped directly to your door within 3-5 business days.', 'color' => '%23a855f7'],
                ];
            @endphp
            @foreach($features as $feature)
                <div class="glass-card rounded-2xl p-8 text-center border-gradient">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl glass mb-5">
                        <img src="https://api.iconify.design/{{ $feature['icon'] }}.svg?color={{ $feature['color'] }}&width=28&height=28" alt="">
                    </div>
                    <h3 class="font-semibold text-gray-200 text-lg">{{ $feature['title'] }}</h3>
                    <p class="text-gray-500 mt-3 text-sm leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CTA Banner --}}
    <section class="max-w-7xl mx-auto px-4 pb-20 sm:px-6 lg:px-8">
        <div class="glass-light rounded-3xl p-10 md:p-16 text-center relative overflow-hidden border-gradient">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1607799279861-4dd421887fc9?auto=format&fit=crop&w=1200&q=80"
                     alt="" class="w-full h-full object-cover opacity-10">
            </div>
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold">Ready to <span class="gradient-text">git push</span> your style?</h2>
                <p class="text-gray-400 mt-4 max-w-xl mx-auto">Join thousands of developers wearing code-inspired apparel. New drops every month.</p>
                <a href="{{ route('products.index') }}"
                   class="btn-glow text-white font-semibold px-10 py-4 rounded-xl text-lg inline-flex items-center gap-2 mt-8">
                    <img src="https://api.iconify.design/lucide:rocket.svg?color=white&width=20&height=20" alt="">
                    Start Shopping
                </a>
            </div>
        </div>
    </section>
@endsection
