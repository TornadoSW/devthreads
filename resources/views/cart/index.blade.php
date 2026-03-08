@extends('layouts.app')

@section('title', 'Your Cart - DevThreads')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Your Cart</h1>

    @if($cartItems->count())
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left py-3 px-4 font-semibold text-sm text-gray-600">Product</th>
                        <th class="text-center py-3 px-4 font-semibold text-sm text-gray-600">Size</th>
                        <th class="text-center py-3 px-4 font-semibold text-sm text-gray-600">Qty</th>
                        <th class="text-right py-3 px-4 font-semibold text-sm text-gray-600">Price</th>
                        <th class="py-3 px-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($cartItems as $item)
                        <tr>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-2xl shrink-0">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="" class="w-full h-full object-cover rounded">
                                        @else
                                            👕
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('products.show', $item->product->slug) }}" class="font-medium hover:text-brand-600">
                                            {{ $item->product->name }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-center">{{ $item->size }}</td>
                            <td class="py-4 px-4 text-center">{{ $item->quantity }}</td>
                            <td class="py-4 px-4 text-right font-medium">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            <td class="py-4 px-4 text-right">
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Total --}}
        <div class="mt-6 bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center text-xl font-bold">
                <span>Total</span>
                <span class="text-brand-700">${{ number_format($total, 2) }}</span>
            </div>
            <button disabled
                    class="mt-4 w-full bg-brand-600 text-white font-semibold py-3 px-8 rounded-lg opacity-75 cursor-not-allowed">
                Checkout (Coming Soon)
            </button>
            <p class="text-xs text-gray-500 text-center mt-2">Stripe checkout integration coming in next update.</p>
        </div>
    @else
        <div class="text-center py-16">
            <p class="text-6xl mb-4">🛒</p>
            <p class="text-xl text-gray-500 mb-4">Your cart is empty</p>
            <a href="{{ route('products.index') }}"
               class="bg-brand-600 hover:bg-brand-700 text-white font-semibold px-8 py-3 rounded-lg inline-block transition">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection
