<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" name="name" type="text"
                          class="mt-1 block w-full"
                          :value="old('name', $user->name)"
                          required autofocus autocomplete="name"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" name="email" type="email"
                          class="mt-1 block w-full"
                          :value="old('email', $user->email)"
                          required autocomplete="username"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
        </div>

        <div>
            <x-input-label for="birthday" value="Verjaardag"/>
            <x-text-input id="birthday" name="birthday" type="date"
                          class="mt-1 block w-full"
                          :value="old('birthday', $user->birthday)"/>
            <x-input-error class="mt-2" :messages="$errors->get('birthday')"/>
        </div>

        <div>
            <x-input-label for="about_me" value="Over mij"/>
            <textarea id="about_me" name="about_me"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                {{ old('about_me', $user->about_me) }}
            </textarea>
            <x-input-error class="mt-2" :messages="$errors->get('about_me')"/>
        </div>

        <div>
            <x-input-label for="profile_picture" value="Profielfoto"/>

            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}"
                     class="w-20 h-20 rounded-full mt-2 mb-2" alt="huidige profiel foto">
            @endif

            <input id="profile_picture" name="profile_picture" type="file"
                   class="mt-1 block w-full"/>

            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
