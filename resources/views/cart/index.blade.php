<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Cart</h1>

        @if (empty($cart))
            <p class="text-gray-500">
                Your cart is empty.
                <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">
                    Browse products
                </a>
            </p>
        @else
            <div class="bg-white rounded-lg shadow divide-y">
                @php $total = 0; @endphp

                @foreach ($cart as $id => $item)
                    @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp

                    <div class="flex items-center justify-between p-4">
                        {{-- Product info --}}
                        <div class="flex-1">
                            <h2 class="font-semibold text-gray-800">{{ $item['name'] }}</h2>
                            <p class="text-gray-500 text-sm">
                                ${{ number_format($item['price'], 2) }} each
                            </p>
                        </div>

                        {{-- Quantity controls (- qty +) --}}
                        <div class="flex items-center gap-2 mx-6">
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="action" value="decrease">
                                <button type="submit"
                                        class="w-8 h-8 rounded bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold">
                                    −
                                </button>
                            </form>

                            <span class="w-8 text-center font-semibold">
                                {{ $item['quantity'] }}
                            </span>

                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="action" value="increase">
                                <button type="submit"
                                        class="w-8 h-8 rounded bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold">
                                    +
                                </button>
                            </form>
                        </div>

                        {{-- Subtotal --}}
                        <span class="w-24 text-right font-semibold text-indigo-600">
                            ${{ number_format($subtotal, 2) }}
                        </span>

                        {{-- Remove --}}
                        <form action="{{ route('cart.remove', $id) }}" method="POST" class="ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-500 hover:text-red-700 text-sm font-medium">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            {{-- Total --}}
            <div class="flex items-center justify-between mt-6 bg-white rounded-lg shadow p-4">
                <span class="text-xl font-bold text-gray-800">Total</span>
                <span class="text-xl font-bold text-indigo-600">
                    ${{ number_format($total, 2) }}
                </span>
            </div>
        @endif
    </div>
</x-app-layout>
