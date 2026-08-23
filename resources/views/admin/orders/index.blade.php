<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
Orders
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

@if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <table class="w-full text-left">
            <thead>
            <tr class="border-b">
                <th class="px-4 py-3">#</th>
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Items</th>
                <th class="px-4 py-3">Total</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Date</th>
                <th class="px-4 py-3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr class="border-b">
                    <td class="px-4 py-3">{{ $order->id }}</td>
                    <td class="px-4 py-3">{{ $order->name }}</td>
                    <td class="px-4 py-3">{{ $order->email }}</td>
                    <td class="px-4 py-3">{{ $order->items->count() }}</td>
                    <td class="px-4 py-3">€{{ number_format($order->total, 2) }}</td>
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
                            @csrf
                            @method('PATCH')
                            <select name="status"
                                    onchange="this.form.submit()"
                                    class="border-gray-300 rounded-lg text-sm">
                                @foreach(['pending','processing','shipped','completed','cancelled'] as $status)
                                    <option value="{{ $status }}" @selected($order->status === $status)>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3">{{ $order->created_at->format('d-m-Y') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.orders.show', $order) }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-4 py-3" colspan="8">No orders yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</x-app-layout>
