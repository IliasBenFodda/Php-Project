<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-10">
        @auth
            @if(auth()->user()->isAdmin())
                <div class="flex justify-between">
                    <h1 class="text-3xl font-bold mb-8 text-gray-800">Our Products</h1>
                   <a href="{{route('admin.products.create')}}">
                      + Add product
                   </a>
                </div>
            @endif
        @endauth
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($products as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">

                    <img src="{{ $product->image
                            ? asset('storage/' . $product->image)
                            : 'https://placehold.co/400x300?text=' . urlencode($product->name) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-48 object-cover">

                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
                        <p class="text-gray-500 text-sm mt-1 line-clamp-2">
                            {{ $product->description }}
                        </p>

                        <div class="flex items-center justify-between mt-4">
                            <span class="text-xl font-bold text-indigo-600">
                                ${{ number_format($product->price, 2) }}
                            </span>

                            @if ($product->stock > 0)
                                <span class="text-xs text-green-600 font-medium">In stock</span>
                            @else
                                <span class="text-xs text-red-500 font-medium">Sold out</span>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-gray-500 col-span-full">No products available yet.</p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
