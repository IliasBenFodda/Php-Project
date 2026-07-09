<x-admin-layout title="User Management">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create User</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="name" value="Name"/>
                        <x-text-input id="name" name="name" class="block mt-1 w-full" value="{{ old('name') }}"
                                      required/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>

                    <div>
                        <x-input-label for="email" value="Email"/>
                        <x-text-input id="email" name="email" type="email" class="block mt-1 w-full"
                                      value="{{ old('email') }}" required/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    <div>
                        <x-input-label for="role" value="Role"/>
                        <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="user" @selected(old('role') === 'user')>User</option>
                            <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                    </div>

                    <div>
                        <x-input-label for="password" value="Password"/>
                        <x-text-input id="password" name="password" type="password" class="block mt-1 w-full" required
                                      minlength="8"/>
                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" value="Confirm Password"/>
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                      class="block mt-1 w-full" required/>
                    </div>

                    <div class="flex gap-3">
                        <x-primary-button>Create</x-primary-button>
                        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
