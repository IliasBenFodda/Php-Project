<x-admin-layout title="Category Management">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Category Management</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="font-semibold mb-4">Create Category</h3>
                <x-status-alert type="success"/>
                <x-status-alert type="error"/>

                <form action="{{ route('admin.categories.store') }}" method="POST" class="flex gap-3">
                    @csrf
                    <div class="flex-1">
                        <x-text-input name="name" class="w-full" placeholder="Category name" value="{{ old('name') }}"
                                      required maxlength="255"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>
                    <x-primary-button>Add</x-primary-button>
                </form>
            </div>

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="border-b text-left">
                        <th class="p-2">Name</th>
                        <th class="p-2">FAQs</th>
                        <th class="p-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                        <tr class="border-b">
                            <td class="p-2">{{ $category->name }}</td>
                            <td class="p-2">{{ $category->faqs_count }}</td>
                            <td class="p-2 flex gap-3 items-center">
                                <a class="text-blue-600 hover:underline"
                                   href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                      onsubmit="return confirm('Delete this category? FAQs will keep working without a category.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="p-2 text-gray-500" colspan="3">No categories found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $categories->links() }}</div>
            </div>
        </div>
    </div>
</x-admin-layout>
