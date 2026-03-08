<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - DevThreads')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        accent: { 400: '#22d3ee', 500: '#06b6d4', 600: '#0891b2' },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body { background: #050510; font-family: 'Inter', system-ui, sans-serif; }
        .glass { background: rgba(255,255,255,0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.06); }
        .glass-light { background: rgba(255,255,255,0.05); backdrop-filter: blur(24px); border: 1px solid rgba(255,255,255,0.08); }
        .gradient-text { background: linear-gradient(135deg, #06b6d4, #a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .btn-glow { background: linear-gradient(135deg, #06b6d4, #a855f7); box-shadow: 0 0 20px rgba(6,182,212,0.3); transition: all 0.3s; }
        .btn-glow:hover { box-shadow: 0 0 30px rgba(6,182,212,0.5); transform: translateY(-1px); }
        .input-glass { background: rgba(255,255,255,0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); color: #e5e7eb; }
        .input-glass:focus { border-color: rgba(6,182,212,0.5); outline: none; box-shadow: 0 0 0 2px rgba(6,182,212,0.1); }
        .input-glass::placeholder { color: #6b7280; }
    </style>
</head>
<body class="text-gray-300 min-h-screen">

    {{-- Admin Navbar --}}
    <nav class="glass sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-6">
                    <a href="{{ route('admin.products.index') }}" class="font-bold text-lg">
                        <span class="gradient-text">DevThreads</span>
                        <span class="text-xs text-gray-600 ml-2 font-mono">ADMIN</span>
                    </a>
                    <div class="hidden md:flex items-center gap-4 text-sm">
                        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-1.5 text-gray-400 hover:text-accent-400 transition">
                            <img src="https://api.iconify.design/lucide:package.svg?color=%239ca3af&width=16&height=16" alt="">
                            Products
                        </a>
                        <a href="{{ route('admin.products.create') }}" class="flex items-center gap-1.5 text-gray-400 hover:text-accent-400 transition">
                            <img src="https://api.iconify.design/lucide:plus-circle.svg?color=%239ca3af&width=16&height=16" alt="">
                            Add Product
                        </a>
                    </div>
                </div>
                <a href="{{ route('home') }}" class="text-xs text-gray-500 hover:text-accent-400 transition flex items-center gap-1">
                    <img src="https://api.iconify.design/lucide:external-link.svg?color=%236b7280&width=14&height=14" alt="">
                    View Store
                </a>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="glass rounded-xl p-4 border-l-4 border-emerald-400 flex items-center gap-3">
                <img src="https://api.iconify.design/lucide:check-circle.svg?color=%2334d399&width=20&height=20" alt="">
                <span class="text-emerald-300 text-sm">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

</body>
</html>
