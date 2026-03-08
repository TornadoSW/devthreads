@extends('layouts.app')

@section('title', 'Your Cart - DevThreads')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
    <h1 class="text-3xl md:text-4xl font-bold mb-10">Your <span class="gradient-text">Cart</span></h1>

    @if($cartItems->count())
        <div class="space-y-4">
            @php
                $cartImages = [
                    'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?auto=format&fit=crop&w=200&q=80',
                    'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?auto=format&fit=crop&w=200&q=80',
                    'https://images.unsplash.com/photo-1576566588028-4147f3842f27?auto=format&fit=crop&w=200&q=80',
                    'https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?auto=format&fit=crop&w=200&q=80',
                ];
            @endphp
            @foreach($cartItems as $ci => $item)
                <div class="glass rounded-2xl p-4 md:p-5 flex items-center gap-4 md:gap-6">
                    {{-- Image --}}
                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-xl overflow-hidden shrink-0 relative">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="" class="w-full h-full object-cover">
                        @else
                            <img src="{{ $cartImages[$ci % count($cartImages)] }}" alt="" class="w-full h-full object-cover">
                        @endif
                    </div>

                    {{-- Details --}}
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('products.show', $item->product->slug) }}"
                           class="font-semibold text-gray-200 hover:text-accent-400 transition truncate block">
                            {{ $item->product->name }}
                        </a>
                        <div class="flex items-center gap-3 mt-1.5 text-sm text-gray-500">
                            <span class="glass rounded-md px-2 py-0.5 text-xs text-gray-400">Size: {{ $item->size }}</span>
                            <span>Qty: {{ $item->quantity }}</span>
                        </div>
                    </div>

                    {{-- Price + Remove --}}
                    <div class="text-right shrink-0">
                        <p class="font-bold gradient-text text-lg">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                        <form action="{{ route('cart.remove', $item) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400/70 hover:text-red-400 text-xs flex items-center gap-1 ml-auto transition">
                                <img src="https://api.iconify.design/lucide:trash-2.svg?color=%23f87171&width=12&height=12" alt="">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Total --}}
        <div class="glass-light rounded-2xl p-6 md:p-8 mt-8 border-gradient">
            <div class="flex justify-between items-center">
                <span class="text-gray-400 font-medium">Subtotal</span>
                <span class="text-2xl font-bold gradient-text">${{ number_format($total, 2) }}</span>
            </div>
            <div class="flex justify-between items-center mt-2 text-sm text-gray-500">
                <span>Shipping</span>
                <span>{{ $total >= 50 ? 'Free' : 'Calculated at checkout' }}</span>
            </div>
            <div class="border-t border-white/5 my-5"></div>
            <button disabled
                    class="w-full btn-glow text-white font-semibold py-4 px-8 rounded-xl text-lg opacity-75 cursor-not-allowed inline-flex items-center justify-center gap-2">
                <img src="https://api.iconify.design/lucide:lock.svg?color=white&width=18&height=18" alt="">
                Checkout (Coming Soon)
            </button>
            <p class="text-xs text-gray-600 text-center mt-3">Stripe checkout integration coming in next update.</p>
        </div>
    @else
        <div class="glass rounded-2xl text-center py-20">
            <img src="https://api.iconify.design/lucide:shopping-cart.svg?color=%234b5563&width=64&height=64" alt="" class="mx-auto mb-5 opacity-50">
            <p class="text-xl text-gray-400 mb-2">Your cart is empty</p>
            <p class="text-sm text-gray-600 mb-8">Add some developer swag to get started</p>
            <a href="{{ route('products.index') }}"
               class="btn-glow text-white font-semibold px-8 py-3 rounded-xl inline-flex items-center gap-2">
                <img src="https://api.iconify.design/lucide:shopping-bag.svg?color=white&width=18&height=18" alt="">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection
