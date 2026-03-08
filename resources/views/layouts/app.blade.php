<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DevThreads - Developer T-Shirts & Hoodies')</title>
    <meta name="description" content="@yield('meta_description', 'Funny developer t-shirts and hoodies. Git push your style with coding humor apparel.')">

    {{-- Tailwind CSS via CDN (swap for Vite build in production) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 50: '#f0fdf4', 100: '#dcfce7', 500: '#22c55e', 600: '#16a34a', 700: '#15803d', 900: '#14532d' },
                        dark: { 800: '#1e1e2e', 900: '#11111b' }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">

    {{-- Navigation --}}
    <nav class="bg-dark-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="text-brand-500 text-2xl font-bold">&lt;/&gt;</span>
                    <span class="text-xl font-bold">Dev<span class="text-brand-500">Threads</span></span>
                </a>

                {{-- Nav Links --}}
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="hover:text-brand-500 transition">Home</a>
                    <a href="{{ route('products.index') }}" class="hover:text-brand-500 transition">Shop</a>
                    <a href="{{ route('cart.index') }}" class="relative hover:text-brand-500 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        Cart
                    </a>
                </div>

                {{-- Mobile menu button --}}
                <button id="mobileMenuBtn" class="md:hidden text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div id="mobileMenu" class="hidden md:hidden bg-dark-800 px-4 pb-4">
            <a href="{{ route('home') }}" class="block py-2 hover:text-brand-500">Home</a>
            <a href="{{ route('products.index') }}" class="block py-2 hover:text-brand-500">Shop</a>
            <a href="{{ route('cart.index') }}" class="block py-2 hover:text-brand-500">Cart</a>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 max-w-7xl mx-auto mt-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-dark-900 text-gray-400 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <span class="text-xl font-bold text-white">Dev<span class="text-brand-500">Threads</span></span>
                    <p class="mt-2 text-sm">Funny developer t-shirts and hoodies. Wear your code with pride.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-3">Shop</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('products.index') }}" class="hover:text-brand-500">All Products</a></li>
                        <li><a href="{{ route('products.index', ['sort' => 'price_low']) }}" class="hover:text-brand-500">Budget Picks</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-3">Connect</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="https://github.com/TornadoSW" target="_blank" rel="noopener noreferrer" class="hover:text-brand-500">GitHub</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-sm text-center">
                &copy; {{ date('Y') }} DevThreads. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobileMenuBtn')?.addEventListener('click', () => {
            document.getElementById('mobileMenu')?.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>
