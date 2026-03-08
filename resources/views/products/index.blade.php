@extends('layouts.app')

@section('title', 'Shop Developer Apparel - DevThreads')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <h1 class="text-3xl font-bold">
            @if(request('category'))
                {{ ucfirst(str_replace('-', ' ', request('category'))) }}
            @elseif(request('search'))
                Results for "{{ request('search') }}"
            @else
                All Products
            @endif
        </h1>

        {{-- Search & Sort --}}
        <div class="mt-4 md:mt-0 flex gap-3">
            <form action="{{ route('products.index') }}" method="GET" class="flex">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search products..."
                       class="border border-gray-300 rounded-l-lg px-4 py-2 focus:ring-brand-500 focus:border-brand-500">
                <button type="submit" class="bg-brand-600 text-white px-4 py-2 rounded-r-lg hover:bg-brand-700">
                    Search
                </button>
            </form>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-8">

        {{-- Sidebar Filters --}}
        <aside class="md:w-56 shrink-0">
            <h3 class="font-semibold mb-3">Categories</h3>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('products.index') }}"
                       class="block py-1 px-2 rounded {{ !request('category') ? 'bg-brand-100 text-brand-700 font-medium' : 'hover:bg-gray-100' }}">
                        All
                    </a>
                </li>
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                           class="block py-1 px-2 rounded {{ request('category') === $category->slug ? 'bg-brand-100 text-brand-700 font-medium' : 'hover:bg-gray-100' }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <h3 class="font-semibold mt-6 mb-3">Sort By</h3>
            <ul class="space-y-2">
                <li><a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'newest'])) }}"
                       class="block py-1 px-2 rounded {{ request('sort', 'newest') === 'newest' ? 'bg-brand-100 text-brand-700 font-medium' : 'hover:bg-gray-100' }}">Newest</a></li>
                <li><a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}"
                       class="block py-1 px-2 rounded {{ request('sort') === 'price_low' ? 'bg-brand-100 text-brand-700 font-medium' : 'hover:bg-gray-100' }}">Price: Low → High</a></li>
                <li><a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}"
                       class="block py-1 px-2 rounded {{ request('sort') === 'price_high' ? 'bg-brand-100 text-brand-700 font-medium' : 'hover:bg-gray-100' }}">Price: High → Low</a></li>
            </ul>
        </aside>

        {{-- Product Grid --}}
        <div class="flex-1">
            @if($products->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
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

                <div class="mt-8">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-16 text-gray-500">
                    <p class="text-xl">No products found.</p>
                    <a href="{{ route('products.index') }}" class="text-brand-600 hover:underline mt-2 inline-block">Clear filters</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
