<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Cart</h1>

        {{-- Success flash message (after checkout) --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (empty($cart))
            {{-- Empty cart state --}}
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <p class="text-gray-500 mb-4">Your cart is empty.</p>
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Browse products
                </a>
            </div>
        @else
            {{-- Cart items --}}
            <div class="bg-white rounded-lg shadow divide-y">
                @php $total = 0; @endphp

                @foreach ($cart as $id => $item)
                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp

                    <div class="flex items-center justify-between p-4">
                        {{-- Product info --}}
                        <div class="flex-1">
                            <h2 class="font-semibold text-gray-800">{{ $item['name'] }}</h2>
                            <p class="text-gray-500 text-sm">
                                ${{ number_format($item['price'], 2) }} each
                            </p>
                        </div>

                        {{-- Quantity controls: − qty + --}}
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
                                Remove
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            {{-- Total row --}}
            <div class="flex items-center justify-between mt-6 bg-white rounded-lg shadow p-4">
                <span class="text-xl font-bold text-gray-800">Total</span>
                <span class="text-xl font-bold text-indigo-600">
                    ${{ number_format($total, 2) }}
                </span>
            </div>

            {{-- Checkout form --}}
            <div class="mt-6 bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Checkout</h2>

                {{-- Validation errors --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded mb-4">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('cart.checkout') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Shipping section --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">Shipping details</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Full name</label>
                                <input type="text" name="name"
                                       required
                                       value="{{ old('name', auth()->user()->name) }}"
                                       class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Email</label>
                                <input type="email" name="email"
                                       required
                                       value="{{ old('email', auth()->user()->email) }}"
                                       class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm text-gray-600 mb-1">Address</label>
                            <textarea name="address" rows="2"
                                      required
                                      placeholder="Street, city, postal code, country"
                                      class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    {{-- Payment section (fake) --}}
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">Payment</h3>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Card number</label>
                            <input type="text" name="card"
                                   required
                                   placeholder="1234 5678 9012 3456"
                                   value="{{ old('card') }}"
                                   class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Expiry (MM/YY)</label>
                                <input type="text" name="expiry"
                                       required
                                       placeholder="12/28"
                                       value="{{ old('expiry') }}"
                                       class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">CVV</label>
                                <input type="text" name="cvv"
                                       required
                                       placeholder="123"
                                       value="{{ old('cvv') }}"
                                       class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            </div>
                        </div>

                        <p class="text-xs text-gray-400 italic mt-3">
                            This is a demo webshop. No real payment is processed — any values are accepted.
                        </p>
                    </div>

                    {{-- Place order button --}}
                    <button type="submit"
                            class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                        Place Order — ${{ number_format($total, 2) }}
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-app-layout>
