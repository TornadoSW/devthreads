@extends('layouts.app')

@section('title', $product->meta_title ?? $product->name . ' - DevThreads')
@section('meta_description', $product->meta_description ?? Str::limit($product->description, 160))

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-brand-600">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('products.index') }}" class="hover:text-brand-600">Shop</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ $product->name }}</span>
    </nav>

    <div class="grid md:grid-cols-2 gap-10">
        {{-- Product Image --}}
        <div class="aspect-square bg-gray-200 rounded-xl flex items-center justify-center text-8xl">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-xl">
            @else
                👕
            @endif
        </div>

        {{-- Product Details --}}
        <div>
            <span class="text-sm text-brand-600 font-medium uppercase">{{ $product->category->name ?? '' }}</span>
            <h1 class="text-3xl font-bold mt-1">{{ $product->name }}</h1>
            <p class="text-3xl text-brand-700 font-bold mt-4">${{ number_format($product->price, 2) }}</p>

            <div class="mt-6 text-gray-600 leading-relaxed">
                {!! nl2br(e($product->description)) !!}
            </div>

            {{-- Add to Cart Form --}}
            <form action="{{ route('cart.add') }}" method="POST" class="mt-8 space-y-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                {{-- Size Selector --}}
                <div>
                    <label class="block font-semibold mb-2">Size</label>
                    <div class="flex gap-2">
                        @foreach($product->sizes_array as $size)
                            <label class="cursor-pointer">
                                <input type="radio" name="size" value="{{ trim($size) }}" class="sr-only peer" {{ $loop->first ? 'checked' : '' }}>
                                <span class="inline-block px-4 py-2 border-2 border-gray-300 rounded-lg peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-700 font-medium hover:border-gray-400 transition">
                                    {{ trim($size) }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('size') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Quantity --}}
                <div>
                    <label for="quantity" class="block font-semibold mb-2">Quantity</label>
                    <select name="quantity" id="quantity" class="border border-gray-300 rounded-lg px-4 py-2">
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <button type="submit"
                        class="w-full bg-brand-600 hover:bg-brand-700 text-white font-semibold py-3 px-8 rounded-lg transition text-lg">
                    Add to Cart
                </button>
            </form>
        </div>
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->count())
    <section class="mt-16">
        <h2 class="text-2xl font-bold mb-6">You Might Also Like</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
                <a href="{{ route('products.show', $related->slug) }}"
                   class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition">
                    <div class="aspect-square bg-gray-200 flex items-center justify-center text-4xl">
                        @if($related->image)
                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                        @else
                            👕
                        @endif
                    </div>
                    <div class="p-3">
                        <h3 class="font-medium text-sm">{{ $related->name }}</h3>
                        <p class="text-brand-700 font-bold text-sm mt-1">${{ number_format($related->price, 2) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
