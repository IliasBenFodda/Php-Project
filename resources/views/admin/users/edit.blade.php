<x-admin-layout title="User Management">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <x-status-alert type="error"/>

                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="name" value="Name"/>
                        <x-text-input id="name" name="name" class="block mt-1 w-full"
                                      value="{{ old('name', $user->name) }}" required/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>

                    <div>
                        <x-input-label for="email" value="Email"/>
                        <x-text-input id="email" name="email" type="email" class="block mt-1 w-full"
                                      value="{{ old('email', $user->email) }}" required/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    <div>
                        <x-input-label for="role" value="Role"/>
                        <select id="role" name="role"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" @disabled(auth()->id() === $user->id)>
                            <option value="user" @selected(old('role', $user->role) === 'user')>User</option>
                            <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                        </select>
                        @if(auth()->id() === $user->id)
                            <input type="hidden" name="role" value="admin">
                            <p class="text-sm text-gray-500 mt-1">You cannot remove your own admin role.</p>
                        @endif
                        <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                    </div>

                    <div>
                        <x-input-label for="password" value="New Password"/>
                        <x-text-input id="password" name="password" type="password" class="block mt-1 w-full"
                                      minlength="8"/>
                        <p class="text-sm text-gray-500 mt-1">Leave empty to keep the current password.</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" value="Confirm New Password"/>
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                      class="block mt-1 w-full"/>
                    </div>

                    <div class="flex gap-3">
                        <x-primary-button>Update</x-primary-button>
                        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
