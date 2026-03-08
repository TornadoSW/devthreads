@extends('admin.layouts.app')

@section('title', 'Manage Products - Admin')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold">All <span class="gradient-text">Products</span></h1>
            <p class="text-gray-500 text-sm mt-1">{{ $products->total() }} products total</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
           class="btn-glow text-white font-semibold px-6 py-2.5 rounded-xl text-sm inline-flex items-center gap-2">
            <img src="https://api.iconify.design/lucide:plus.svg?color=white&width=16&height=16" alt="">
            Add Product
        </a>
    </div>

    <div class="glass rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/5">
                    <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Category</th>
                    <th class="text-left py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="text-center py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Featured</th>
                    <th class="text-center py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Active</th>
                    <th class="text-right py-4 px-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($products as $product)
                    <tr class="hover:bg-white/[0.02] transition">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg overflow-hidden bg-white/5 shrink-0">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <img src="https://api.iconify.design/lucide:image.svg?color=%234b5563&width=20&height=20" alt="">
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-200">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-600 font-mono">{{ $product->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-5 hidden md:table-cell">
                            <span class="glass rounded-full px-2.5 py-0.5 text-xs text-accent-400">{{ $product->category->name ?? '—' }}</span>
                        </td>
                        <td class="py-4 px-5">
                            <span class="font-semibold gradient-text">${{ number_format($product->price, 2) }}</span>
                        </td>
                        <td class="py-4 px-5 text-center hidden md:table-cell">
                            @if($product->is_featured)
                                <img src="https://api.iconify.design/lucide:star.svg?color=%23eab308&width=16&height=16" alt="Featured" class="inline">
                            @else
                                <img src="https://api.iconify.design/lucide:star.svg?color=%233f3f46&width=16&height=16" alt="" class="inline">
                            @endif
                        </td>
                        <td class="py-4 px-5 text-center hidden md:table-cell">
                            @if($product->is_active)
                                <span class="inline-block w-2 h-2 bg-emerald-400 rounded-full"></span>
                            @else
                                <span class="inline-block w-2 h-2 bg-red-400 rounded-full"></span>
                            @endif
                        </td>
                        <td class="py-4 px-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="glass rounded-lg p-2 hover:bg-white/5 transition" title="Edit">
                                    <img src="https://api.iconify.design/lucide:pencil.svg?color=%2306b6d4&width=14&height=14" alt="Edit">
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Delete {{ addslashes($product->name) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="glass rounded-lg p-2 hover:bg-red-500/10 transition" title="Delete">
                                        <img src="https://api.iconify.design/lucide:trash-2.svg?color=%23ef4444&width=14&height=14" alt="Delete">
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @endif
@endsection
