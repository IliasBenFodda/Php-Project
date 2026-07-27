<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Cart</h1>

        @if (empty($cart))
            <p class="text-gray-500">Your cart is empty.
                <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">Browse products</a>
            </p>
        @else
            <div class="bg-white rounded-lg shadow divide-y">
                @foreach ($cart as $item)
                    <div class="flex items-center justify-between p-4">
                        <div>
                            <h2 class="font-semibold text-gray-800">{{ $item['name'] }}</h2>
                            <p class="text-gray-500 text-sm">Quantity: {{ $item['quantity'] }}</p>
                        </div>
                        <span class="font-semibold text-indigo-600">
                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                        </span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
