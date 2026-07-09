<x-admin-layout title="FAQ Management">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">FAQ Management</h2>
            <a href="{{ route('admin.faq.create') }}" class="text-blue-600 hover:underline">Create FAQ</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-status-alert type="success"/>
                    <x-status-alert type="error"/>

                    <table class="w-full border-collapse">
                        <thead>
                        <tr class="border-b text-left">
                            <th class="p-2">Question</th>
                            <th class="p-2">Category</th>
                            <th class="p-2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($faqs as $faq)
                            <tr class="border-b">
                                <td class="p-2">{{ $faq->question }}</td>
                                <td class="p-2">{{ $faq->category?->name ?? 'No category' }}</td>
                                <td class="p-2 flex gap-3 items-center">
                                    <a class="text-blue-600 hover:underline" href="{{ route('admin.faq.edit', $faq) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.faq.destroy', $faq) }}"
                                          onsubmit="return confirm('Delete this FAQ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-2 text-gray-500" colspan="3">No FAQs found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">{{ $faqs->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
