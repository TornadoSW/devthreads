@extends('admin.layouts.app')

@section('title', 'Edit ' . $product->name . ' - Admin')

@section('content')
    <div class="mb-8">
        <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-accent-400 transition inline-flex items-center gap-1">
            <img src="https://api.iconify.design/lucide:arrow-left.svg?color=%236b7280&width=14&height=14" alt="">
            Back to Products
        </a>
        <h1 class="text-2xl font-bold mt-3">
            Edit <span class="gradient-text">{{ $product->name }}</span>
        </h1>
    </div>

    <form action="{{ route('admin.products.update', $product) }}"
          method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl">
        @csrf
        @method('PUT')

        <div class="glass rounded-2xl p-6 space-y-5">
            <h2 class="font-semibold text-gray-300 text-sm uppercase tracking-wider flex items-center gap-2">
                <img src="https://api.iconify.design/lucide:info.svg?color=%2306b6d4&width=16&height=16" alt="">
                Basic Info
            </h2>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-400 mb-1.5">Product Name *</label>
                <input type="text" name="name" id="name" required
                       value="{{ old('name', $product->name) }}"
                       class="w-full input-glass rounded-xl px-4 py-3 text-sm">
                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-400 mb-1.5">Category *</label>
                <select name="category_id" id="category_id" required class="w-full input-glass rounded-xl px-4 py-3 text-sm">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-400 mb-1.5">Description *</label>
                <textarea name="description" id="description" rows="4" required
                          class="w-full input-glass rounded-xl px-4 py-3 text-sm resize-y">{{ old('description', $product->description) }}</textarea>
                @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-400 mb-1.5">Price (USD) *</label>
                    <input type="number" name="price" id="price" step="0.01" min="0.01" required
                           value="{{ old('price', $product->price) }}"
                           class="w-full input-glass rounded-xl px-4 py-3 text-sm">
                    @error('price') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="sizes" class="block text-sm font-medium text-gray-400 mb-1.5">Sizes (comma-separated) *</label>
                    <input type="text" name="sizes" id="sizes" required
                           value="{{ old('sizes', $product->sizes) }}"
                           class="w-full input-glass rounded-xl px-4 py-3 text-sm">
                    @error('sizes') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="glass rounded-2xl p-6 space-y-5">
            <h2 class="font-semibold text-gray-300 text-sm uppercase tracking-wider flex items-center gap-2">
                <img src="https://api.iconify.design/lucide:image.svg?color=%23a855f7&width=16&height=16" alt="">
                Product Image
            </h2>
            @if($product->image)
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-24 h-24 rounded-xl object-cover">
                    <p class="text-xs text-gray-500">Current image. Upload a new one to replace it.</p>
                </div>
            @endif
            <div>
                <input type="file" name="image" accept="image/*"
                       class="block w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-accent-400/10 file:text-accent-400 hover:file:bg-accent-400/20 file:cursor-pointer file:transition">
                <p class="text-xs text-gray-600 mt-2">PNG, JPG, or WebP. Max 2MB.</p>
                @error('image') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="glass rounded-2xl p-6 space-y-5">
            <h2 class="font-semibold text-gray-300 text-sm uppercase tracking-wider flex items-center gap-2">
                <img src="https://api.iconify.design/lucide:search.svg?color=%23eab308&width=16&height=16" alt="">
                SEO (Optional)
            </h2>
            <div>
                <label for="meta_title" class="block text-sm font-medium text-gray-400 mb-1.5">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title"
                       value="{{ old('meta_title', $product->meta_title) }}"
                       class="w-full input-glass rounded-xl px-4 py-3 text-sm">
            </div>
            <div>
                <label for="meta_description" class="block text-sm font-medium text-gray-400 mb-1.5">Meta Description</label>
                <textarea name="meta_description" id="meta_description" rows="2"
                          class="w-full input-glass rounded-xl px-4 py-3 text-sm resize-y">{{ old('meta_description', $product->meta_description) }}</textarea>
            </div>
        </div>

        <div class="glass rounded-2xl p-6">
            <div class="flex flex-wrap gap-6 mb-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1"
                           {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                           class="w-4 h-4 rounded accent-cyan-500">
                    <span class="text-sm text-gray-300">Featured Product</span>
                    <img src="https://api.iconify.design/lucide:star.svg?color=%23eab308&width=14&height=14" alt="">
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 rounded accent-cyan-500">
                    <span class="text-sm text-gray-300">Active (visible in store)</span>
                </label>
            </div>

            <button type="submit"
                    class="btn-glow text-white font-semibold px-8 py-3 rounded-xl text-sm inline-flex items-center gap-2">
                <img src="https://api.iconify.design/lucide:save.svg?color=white&width=16&height=16" alt="">
                Update Product
            </button>
        </div>
    </form>
@endsection
