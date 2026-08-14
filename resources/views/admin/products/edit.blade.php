<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Product</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.products.update', $product) }}" method="POST"
                  enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                           class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Description</label>
                    <textarea name="description" rows="3"
                              class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Price ($)</label>
                        <input type="number" name="price" step="0.01" min="0"
                               value="{{ old('price', $product->price) }}" required
                               class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Stock</label>
                        <input type="number" name="stock" min="0"
                               value="{{ old('stock', $product->stock) }}" required
                               class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Image</label>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                             class="w-32 h-32 object-cover rounded mb-2">
                    @endif
                    <input type="file" name="image" accept="image/*"
                           class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <p class="text-xs text-gray-400 mt-1">Leave empty to keep the current image.</p>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                        Update Product
                    </button>
                    <a href="{{ route('products.index') }}"
                       class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
