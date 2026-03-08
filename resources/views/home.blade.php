@extends('layouts.app')

@section('title', 'DevThreads - Code. Commit. Wear.')

@section('content')
    {{-- Hero Section --}}
    <section class="bg-dark-900 text-white">
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold">
                Code. Commit. <span class="text-brand-500">Wear.</span>
            </h1>
            <p class="mt-4 text-lg md:text-xl text-gray-400 max-w-2xl mx-auto">
                Funny developer t-shirts and hoodies for programmers who push code — and push style.
            </p>
            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('products.index') }}"
                   class="bg-brand-600 hover:bg-brand-700 text-white font-semibold px-8 py-3 rounded-lg transition">
                    Shop Now
                </a>
                <a href="{{ route('products.index', ['category' => 'hoodies']) }}"
                   class="border border-gray-600 hover:border-brand-500 text-gray-300 hover:text-brand-500 font-semibold px-8 py-3 rounded-lg transition">
                    Browse Hoodies
                </a>
            </div>
        </div>
    </section>

    {{-- Categories --}}
    @if($categories->count())
    <section class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-center mb-10">Shop by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                   class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="text-4xl mb-3">
                        @switch($category->slug)
                            @case('t-shirts') 👕 @break
                            @case('hoodies') 🧥 @break
                            @case('mugs') ☕ @break
                            @case('stickers') 🏷️ @break
                            @default 🛍️
                        @endswitch
                    </div>
                    <h3 class="font-semibold">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $category->products_count }} products</p>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Featured Products --}}
    @if($featuredProducts->count())
    <section class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center mb-10">Featured Drops</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProducts as $product)
                    <a href="{{ route('products.show', $product->slug) }}"
                       class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition group">
                        <div class="aspect-square bg-gray-200 flex items-center justify-center text-6xl group-hover:scale-105 transition">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                👕
                            @endif
                        </div>
                        <div class="p-4">
                            <span class="text-xs text-brand-600 font-medium uppercase">{{ $product->category->name ?? '' }}</span>
                            <h3 class="font-semibold mt-1">{{ $product->name }}</h3>
                            <p class="text-brand-700 font-bold mt-2">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('products.index') }}"
                   class="bg-dark-900 hover:bg-gray-800 text-white font-semibold px-8 py-3 rounded-lg transition">
                    View All Products
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- SEO Content / Value Proposition --}}
    <section class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-4xl mb-3">🚀</div>
                <h3 class="font-semibold text-lg">Premium Quality</h3>
                <p class="text-gray-600 mt-2">Soft, comfortable fabrics printed with eco-friendly inks that last wash after wash.</p>
            </div>
            <div>
                <div class="text-4xl mb-3">💻</div>
                <h3 class="font-semibold text-lg">Made for Developers</h3>
                <p class="text-gray-600 mt-2">Designs that speak your language — from git jokes to CSS puns.</p>
            </div>
            <div>
                <div class="text-4xl mb-3">📦</div>
                <h3 class="font-semibold text-lg">Fast Shipping</h3>
                <p class="text-gray-600 mt-2">Printed on demand and shipped directly to your door.</p>
            </div>
        </div>
    </section>
@endsection
