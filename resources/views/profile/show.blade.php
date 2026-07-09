<x-app-layout>
    <div>

        <h1>{{ $user->name }}</h1>

        @if($user->profile_picture)
            <img
                src="{{ asset('storage/' . $user->profile_picture) }}"
                alt="Profile picture"
                class="w-24 h-24 rounded-full object-cover"
            >
        @endif

        @if($user->birthday)
            <p>Geboortedatum: {{ $user->birthday }}</p>
        @endif

        @if($user->about_me)
            <p>Over mij: {{ $user->about_me }}</p>
        @endif

        <p>Lid sinds: {{ $user->created_at->format('d/m/Y') }}</p>

    </div>
</x-app-layout>
