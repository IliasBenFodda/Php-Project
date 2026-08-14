<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-10">
        <div class="flex justify-between">
        <a href="{{ route('products.index') }}"
           class="text-indigo-600 hover:underline text-sm">&larr; Back to shop</a>
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.products.edit', $product) }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>

                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
            @endif
        @endauth
        </div>
        <div class="bg-white rounded-lg shadow mt-4 overflow-hidden md:flex">
            <div class="md:w-1/2">
                <img src="{{ $product->image
                        ? asset('storage/' . $product->image)
                        : 'https://placehold.co/600x600?text=' . urlencode($product->name) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover">
            </div>

            <div class="md:w-1/2 p-6 flex flex-col">
                <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>

                <p class="text-3xl font-bold text-indigo-600 mt-3">
                    ${{ number_format($product->price, 2) }}
                </p>

                <p class="text-gray-600 mt-4 leading-relaxed">
                    {{ $product->description }}
                </p>

                <div class="mt-4">
                    @if ($product->stock > 0)
                        <span class="text-green-600 font-medium">
                            {{ $product->stock }} in stock
                        </span>
                    @else
                        <span class="text-red-500 font-medium">Out of stock</span>
                    @endif
                </div>

                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-6">
                    @csrf
                    @auth
                        @if(auth()->user()->isUser())
                            <button type="submit"
                                    @disabled($product->stock < 1)
                                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold
                                   hover:bg-indigo-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                                Add to Cart
                            </button>
                        @endif
                    @endauth
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
