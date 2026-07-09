<x-admin-layout title="User Management">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Details</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg space-y-3">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                <p><strong>Created:</strong> {{ $user->created_at?->format('d M Y') }}</p>

                <div class="flex gap-3 pt-4">
                    <a class="text-blue-600 hover:underline" href="{{ route('admin.users.edit', $user) }}">Edit</a>
                    <a class="text-gray-600 hover:underline" href="{{ route('admin.users.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
