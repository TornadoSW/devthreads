<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DevThreads - Developer T-Shirts & Hoodies')</title>
    <meta name="description" content="@yield('meta_description', 'Funny developer t-shirts and hoodies. Git push your style with coding humor apparel.')">

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        accent: { 400: '#22d3ee', 500: '#06b6d4', 600: '#0891b2' },
                        glow: { purple: '#a855f7', cyan: '#06b6d4', pink: '#ec4899' },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

    {{-- Particles.js --}}
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        body {
            background: #050510;
            font-family: 'Inter', system-ui, sans-serif;
        }

        /* Animated gradient background */
        .bg-mesh {
            background:
                radial-gradient(ellipse at 20% 50%, rgba(120, 50, 255, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(6, 182, 212, 0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 80%, rgba(236, 72, 153, 0.08) 0%, transparent 50%),
                #050510;
        }

        /* Glassmorphism classes */
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .glass-light {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(6, 182, 212, 0.3);
            box-shadow: 0 0 30px rgba(6, 182, 212, 0.1), 0 20px 60px rgba(0, 0, 0, 0.3);
            transform: translateY(-4px);
        }

        /* Glow effects */
        .glow-cyan { box-shadow: 0 0 20px rgba(6, 182, 212, 0.3), 0 0 60px rgba(6, 182, 212, 0.1); }
        .glow-purple { box-shadow: 0 0 20px rgba(168, 85, 247, 0.3), 0 0 60px rgba(168, 85, 247, 0.1); }
        .glow-text { text-shadow: 0 0 40px rgba(6, 182, 212, 0.5); }

        .btn-glow {
            background: linear-gradient(135deg, #06b6d4, #a855f7);
            transition: all 0.3s ease;
        }
        .btn-glow:hover {
            box-shadow: 0 0 25px rgba(6, 182, 212, 0.4), 0 0 50px rgba(168, 85, 247, 0.2);
            transform: translateY(-2px);
        }

        .btn-outline-glow {
            border: 1px solid rgba(6, 182, 212, 0.4);
            transition: all 0.3s ease;
        }
        .btn-outline-glow:hover {
            border-color: rgba(6, 182, 212, 0.8);
            box-shadow: 0 0 20px rgba(6, 182, 212, 0.2);
            background: rgba(6, 182, 212, 0.1);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #06b6d4, #a855f7, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Particles container */
        #particles-js {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #050510; }
        ::-webkit-scrollbar-thumb { background: rgba(6, 182, 212, 0.3); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(6, 182, 212, 0.5); }

        /* Smooth image loading */
        .img-fade { opacity: 0; transition: opacity 0.5s ease; }
        .img-fade.loaded { opacity: 1; }

        /* Animated border gradient */
        .border-gradient {
            position: relative;
        }
        .border-gradient::before {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: inherit;
            padding: 1px;
            background: linear-gradient(135deg, rgba(6, 182, 212, 0.3), rgba(168, 85, 247, 0.3), rgba(236, 72, 153, 0.1));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-mesh text-white min-h-screen flex flex-col">

    {{-- Particles Background --}}
    <div id="particles-js"></div>

    {{-- Navigation --}}
    <nav class="glass fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <span class="text-2xl font-mono font-bold text-accent-400 group-hover:glow-text transition-all">&lt;/&gt;</span>
                    <span class="text-xl font-bold">Dev<span class="gradient-text">Threads</span></span>
                </a>

                {{-- Nav Links --}}
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-accent-400 transition-colors duration-300 text-sm font-medium">Home</a>
                    <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-accent-400 transition-colors duration-300 text-sm font-medium">Shop</a>
                    <a href="{{ route('cart.index') }}" class="relative text-gray-300 hover:text-accent-400 transition-colors duration-300 flex items-center gap-2 text-sm font-medium">
                        <img src="https://api.iconify.design/lucide:shopping-bag.svg?color=%2394a3b8&width=20&height=20" alt="Cart" class="w-5 h-5">
                        Cart
                    </a>
                </div>

                {{-- Mobile menu button --}}
                <button id="mobileMenuBtn" class="md:hidden text-gray-300 hover:text-accent-400">
                    <img src="https://api.iconify.design/lucide:menu.svg?color=%2394a3b8&width=24&height=24" alt="Menu">
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div id="mobileMenu" class="hidden md:hidden glass-light px-4 pb-4 border-t border-white/5">
            <a href="{{ route('home') }}" class="block py-3 text-gray-300 hover:text-accent-400 transition text-sm">Home</a>
            <a href="{{ route('products.index') }}" class="block py-3 text-gray-300 hover:text-accent-400 transition text-sm">Shop</a>
            <a href="{{ route('cart.index') }}" class="block py-3 text-gray-300 hover:text-accent-400 transition text-sm">Cart</a>
        </div>
    </nav>

    {{-- Spacer for fixed nav --}}
    <div class="h-16"></div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-4 relative z-10">
            <div class="glass-light rounded-xl p-4 border-l-4 border-accent-500 text-accent-400" role="alert">
                <div class="flex items-center gap-2">
                    <img src="https://api.iconify.design/lucide:check-circle.svg?color=%2306b6d4&width=20&height=20" alt="">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-1 relative z-10">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="glass mt-20 relative z-10 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <span class="text-xl font-mono font-bold text-accent-400">&lt;/&gt;</span>
                        <span class="text-lg font-bold">Dev<span class="gradient-text">Threads</span></span>
                    </a>
                    <p class="mt-3 text-sm text-gray-500 leading-relaxed">Premium developer apparel. Wear your code with pride.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-300 mb-4 text-sm uppercase tracking-wider">Shop</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('products.index') }}" class="text-gray-500 hover:text-accent-400 transition">All Products</a></li>
                        <li><a href="{{ route('products.index', ['category' => 't-shirts']) }}" class="text-gray-500 hover:text-accent-400 transition">T-Shirts</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'hoodies']) }}" class="text-gray-500 hover:text-accent-400 transition">Hoodies</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-300 mb-4 text-sm uppercase tracking-wider">Connect</h3>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="https://github.com/TornadoSW" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-accent-400 transition flex items-center gap-2">
                                <img src="https://api.iconify.design/mdi:github.svg?color=%236b7280&width=18&height=18" alt="GitHub">
                                GitHub
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-10 pt-8 border-t border-white/5 text-xs text-gray-600 text-center">
                &copy; {{ date('Y') }} DevThreads. Built with Laravel & Tailwind CSS.
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuBtn')?.addEventListener('click', () => {
            document.getElementById('mobileMenu')?.classList.toggle('hidden');
        });

        // Particles configuration
        if (typeof particlesJS !== 'undefined') {
            particlesJS('particles-js', {
                particles: {
                    number: { value: 60, density: { enable: true, value_area: 1000 } },
                    color: { value: ['#06b6d4', '#a855f7', '#ec4899'] },
                    shape: { type: 'circle' },
                    opacity: { value: 0.15, random: true, anim: { enable: true, speed: 0.5, opacity_min: 0.05 } },
                    size: { value: 2, random: true, anim: { enable: true, speed: 1, size_min: 0.5 } },
                    line_linked: { enable: true, distance: 150, color: '#06b6d4', opacity: 0.05, width: 1 },
                    move: { enable: true, speed: 0.8, direction: 'none', random: true, out_mode: 'out' }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: {
                        onhover: { enable: true, mode: 'grab' },
                        onclick: { enable: false },
                        resize: true
                    },
                    modes: { grab: { distance: 140, line_linked: { opacity: 0.15 } } }
                },
                retina_detect: true
            });
        }

        // Lazy load images with fade-in
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.img-fade').forEach(img => {
                if (img.complete) { img.classList.add('loaded'); }
                else { img.addEventListener('load', () => img.classList.add('loaded')); }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
