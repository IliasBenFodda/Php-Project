<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Left: logo + primary links --}}
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800"/>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                        {{ __('Products') }}
                    </x-nav-link>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <x-nav-link :href="route('admin.users.index')"
                                        :active="request()->routeIs('admin.users.*')">
                                {{ __('Users') }}
                            </x-nav-link>

                            <x-nav-link :href="route('admin.orders.index')"
                                        :active="request()->routeIs('admin.orders.*')">
                                {{ __('Orders') }}
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->isUser())
                            <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                                {{ __('Cart') }}
                            </x-nav-link>
                        @endif
                    @endauth

                    <x-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.index')">
                        {{ __('Faq') }}
                    </x-nav-link>

                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                        {{ __('Contact') }}
                    </x-nav-link>

                </div>
            </div>

            {{-- Right: notification bell + user dropdown --}}
            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">

                    @if(auth()->user()->isAdmin())
                        <x-dropdown align="right" width="64">

                            <x-slot name="trigger">
                                <button class="relative p-2 text-gray-500 hover:text-gray-700 focus:outline-none transition">
                                    <i class="fa-solid fa-bell text-lg"></i>

                                    @if($adminNotifications->count() > 0)
                                        <span class="absolute top-0 right-0 bg-red-600 text-white text-xs font-semibold rounded-full px-1.5 py-0.5">
                                            {{ $adminNotifications->count() }}
                                        </span>
                                    @endif
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-2 border-b bg-gray-50">
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                        {{ __('Notifications') }}
                                    </span>
                                </div>

                                @forelse($adminNotifications as $notification)
                                    <a href="{{ route('admin.notifications.read', $notification->id) }}"
                                       class="block px-4 py-3 border-b last:border-b-0 hover:bg-gray-100 transition">
                                        <div class="text-sm font-medium text-gray-800">
                                            New order #{{ $notification->data['order_id'] }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $notification->data['customer'] }} — €{{ number_format($notification->data['total'], 2) }}
                                        </div>
                                        <div class="text-xs text-gray-400 mt-1">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </div>
                                    </a>
                                @empty
                                    <div class="px-4 py-6 text-sm text-gray-500 text-center">
                                        {{ __('No new notifications') }}
                                    </div>
                                @endforelse
                            </x-slot>

                        </x-dropdown>
                    @endif

                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.show', Auth::user())">
                                {{ __('Publiek profiel') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>

                        </x-slot>

                    </x-dropdown>

                </div>
            @endauth

            @guest
                <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">{{ __('Login') }}</a>
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900">{{ __('Register') }}</a>
                </div>
            @endguest

            {{-- Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        @auth
            <div class="pt-2 pb-3 space-y-1">

                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                    {{ __('Products') }}
                </x-responsive-nav-link>

                @if(auth()->user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.users.index')"
                                           :active="request()->routeIs('admin.users.*')">
                        {{ __('Users') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('admin.orders.index')"
                                           :active="request()->routeIs('admin.orders.*')">
                        {{ __('Orders') }}
                        @if($adminNotifications->count() > 0)
                            <span class="ms-2 bg-red-600 text-white text-xs font-semibold rounded-full px-1.5 py-0.5">
                                {{ $adminNotifications->count() }}
                            </span>
                        @endif
                    </x-responsive-nav-link>
                @endif

                @if(auth()->user()->isUser())
                    <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                        {{ __('Cart') }}
                    </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.index')">
                    {{ __('Faq') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                    {{ __('Contact') }}
                </x-responsive-nav-link>

            </div>

            <div class="pt-4 pb-1 border-t border-gray-200">

                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">

                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('profile.show', Auth::user())">
                        {{ __('Publiek profiel') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                </div>
            </div>
        @endauth

        @guest
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                    {{ __('Products') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.index')">
                    {{ __('Faq') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                    {{ __('Contact') }}
                </x-responsive-nav-link>

                <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-600">{{ __('Login') }}</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-600">{{ __('Register') }}</a>
            </div>
        @endguest

    </div>
</nav>
