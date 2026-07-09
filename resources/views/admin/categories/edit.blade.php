<x-admin-layout title="Edit Category">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Category</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <x-status-alert type="error"/>

                <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="name" value="Category Name"/>
                        <x-text-input id="name" name="name" class="block mt-1 w-full"
                                      value="{{ old('name', $category->name) }}" required maxlength="255"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>

                    <div class="flex gap-3">
                        <x-primary-button>Update Category</x-primary-button>
                        <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
