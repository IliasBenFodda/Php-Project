<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
Order #{{ $order->id }}
</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <p class="mb-2"><strong>Name:</strong> {{ $order->name }}</p>
<p class="mb-2"><strong>Email:</strong> {{ $order->email }}</p>
<p class="mb-2"><strong>Address:</strong> {{ $order->address }}</p>
<p class="mb-2"><strong>Status:</strong> {{ $order->status }}</p>
<p><strong>Date:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
</div>
</div>

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <table class="w-full text-left">
            <thead>
            <tr class="border-b">
                <th class="px-4 py-3">Product</th>
                <th class="px-4 py-3">Price</th>
                <th class="px-4 py-3">Quantity</th>
                <th class="px-4 py-3">Subtotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->items as $item)
                <tr class="border-b">
                    <td class="px-4 py-3">
                        {{ $item->product->name ?? 'Deleted product' }}
                    </td>
                    <td class="px-4 py-3">€{{ number_format($item->price, 2) }}</td>
                    <td class="px-4 py-3">{{ $item->quantity }}</td>
                    <td class="px-4 py-3">
                        €{{ number_format($item->price * $item->quantity, 2) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <p class="mt-6 font-semibold">
            Total: €{{ number_format($order->total, 2) }}
        </p>

        <a href="{{ route('admin.orders.index') }}" class="inline-block mt-6">
            Back to orders
        </a>
    </div>
</div>
</div>
</div>
</x-app-layout>
