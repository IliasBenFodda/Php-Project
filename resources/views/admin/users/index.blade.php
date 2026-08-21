<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users
        </h2>
    </x-slot>

    <x-slot name="header">
        <button class="font-semibold leading-tight">
            Add User
        </button>
    </x-slot>

    @if(session("success"))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
        {{ session('success') }}
        </div>
    @endif

    @if(session("error"))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Pas Role Aan</th>
                        </tr>

                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.users.changeRole', $user) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit">
                                            Verander
                                        </button>
                                    </form>
                                </td>

                                <td class="flex ">
                                    <a href="{{ route('admin.users.edit', $user) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form class="ml-4" method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                        @csrf
                                        @method('delete')

                                        <button type="submit">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
