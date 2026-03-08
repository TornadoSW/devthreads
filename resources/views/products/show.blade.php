@extends('layouts.app')

@section('title', $product->meta_title ?? $product->name . ' - DevThreads')
@section('meta_description', $product->meta_description ?? Str::limit($product->description, 160))

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-accent-400 transition flex items-center gap-1">
            <img src="https://api.iconify.design/lucide:home.svg?color=%236b7280&width=14&height=14" alt="">
            Home
        </a>
        <img src="https://api.iconify.design/lucide:chevron-right.svg?color=%234b5563&width=14&height=14" alt="">
        <a href="{{ route('products.index') }}" class="hover:text-accent-400 transition">Shop</a>
        <img src="https://api.iconify.design/lucide:chevron-right.svg?color=%234b5563&width=14&height=14" alt="">
        <span class="text-gray-300">{{ $product->name }}</span>
    </nav>

    <div class="grid md:grid-cols-2 gap-12">
        {{-- Product Image --}}
        <div class="glass-card rounded-2xl overflow-hidden aspect-square relative group">
            @php
                $detailImages = [
                    'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1576566588028-4147f3842f27?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1622445275576-721325763afe?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1564557287817-3785e38ec1f5?auto=format&fit=crop&w=800&q=80',
                ];
            @endphp
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 img-fade"
                     loading="lazy" onload="this.classList.add('loaded')">
            @else
                <img src="{{ $detailImages[$product->id % count($detailImages)] }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 img-fade"
                     loading="lazy" onload="this.classList.add('loaded')">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-[#050510]/40 via-transparent"></div>
            <div class="absolute top-4 left-4">
                <span class="glass rounded-full px-3 py-1 text-xs font-medium text-accent-400 uppercase tracking-wider">
                    {{ $product->category->name ?? '' }}
                </span>
            </div>
        </div>

        {{-- Product Details --}}
        <div>
            <span class="text-xs font-medium text-accent-400 uppercase tracking-widest">{{ $product->category->name ?? '' }}</span>
            <h1 class="text-3xl md:text-4xl font-bold mt-2 text-gray-100">{{ $product->name }}</h1>
            <p class="text-4xl font-bold mt-4 gradient-text">${{ number_format($product->price, 2) }}</p>

            <div class="mt-6 text-gray-400 leading-relaxed">
                {!! nl2br(e($product->description)) !!}
            </div>

            {{-- Add to Cart Form --}}
            <form action="{{ route('cart.add') }}" method="POST" class="mt-8 space-y-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                {{-- Size Selector --}}
                <div>
                    <label class="block font-semibold text-gray-300 mb-3 text-sm uppercase tracking-wider">Size</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($product->sizes_array as $size)
                            <label class="cursor-pointer">
                                <input type="radio" name="size" value="{{ trim($size) }}" class="sr-only peer" {{ $loop->first ? 'checked' : '' }}>
                                <span class="inline-block px-5 py-2.5 glass border border-white/10 rounded-xl peer-checked:border-accent-400 peer-checked:text-accent-400 peer-checked:bg-accent-400/10 font-medium text-gray-400 hover:border-white/20 transition text-sm">
                                    {{ trim($size) }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('size') <p class="text-red-400 text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                {{-- Quantity --}}
                <div>
                    <label for="quantity" class="block font-semibold text-gray-300 mb-3 text-sm uppercase tracking-wider">Quantity</label>
                    <select name="quantity" id="quantity"
                            class="glass rounded-xl px-4 py-2.5 border border-white/10 text-gray-300 bg-transparent focus:border-accent-400/50 focus:outline-none">
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" class="bg-[#0a0a1a]">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <button type="submit"
                        class="w-full btn-glow text-white font-semibold py-4 px-8 rounded-xl text-lg inline-flex items-center justify-center gap-3">
                    <img src="https://api.iconify.design/lucide:shopping-bag.svg?color=white&width=20&height=20" alt="">
                    Add to Cart
                </button>
            </form>

            {{-- Trust badges --}}
            <div class="mt-8 flex items-center gap-6 text-xs text-gray-500">
                <span class="flex items-center gap-1.5">
                    <img src="https://api.iconify.design/lucide:truck.svg?color=%236b7280&width=14&height=14" alt="">
                    Free shipping $50+
                </span>
                <span class="flex items-center gap-1.5">
                    <img src="https://api.iconify.design/lucide:rotate-ccw.svg?color=%236b7280&width=14&height=14" alt="">
                    30-day returns
                </span>
                <span class="flex items-center gap-1.5">
                    <img src="https://api.iconify.design/lucide:shield-check.svg?color=%236b7280&width=14&height=14" alt="">
                    Secure checkout
                </span>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->count())
    <section class="mt-20">
        <h2 class="text-2xl font-bold mb-8">You Might Also <span class="gradient-text">Like</span></h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @php
                $relImages = [
                    'https://images.unsplash.com/photo-1571945153237-4929e783af4a?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=400&q=80',
                    'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=400&q=80',
                ];
            @endphp
            @foreach($relatedProducts as $ri => $related)
                <a href="{{ route('products.show', $related->slug) }}"
                   class="glass-card rounded-2xl overflow-hidden group">
                    <div class="aspect-square relative overflow-hidden">
                        @if($related->image)
                            <img src="{{ asset('storage/' . $related->image) }}"
                                 alt="{{ $related->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 img-fade"
                                 loading="lazy" onload="this.classList.add('loaded')">
                        @else
                            <img src="{{ $relImages[$ri % count($relImages)] }}"
                                 alt="{{ $related->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 img-fade"
                                 loading="lazy" onload="this.classList.add('loaded')">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#050510] via-transparent opacity-60"></div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-sm text-gray-300 group-hover:text-accent-400 transition-colors">{{ $related->name }}</h3>
                        <p class="text-sm font-bold gradient-text mt-1">${{ number_format($related->price, 2) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
