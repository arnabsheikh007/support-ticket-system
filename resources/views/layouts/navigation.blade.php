<!-- Navigation Links -->
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
        {{ __('Home') }}
    </x-nav-link>
</div>

<!-- Settings Dropdown -->
<div class="hidden sm:flex sm:items-center sm:ms-6">
    @auth
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                @if (Auth::user()->role === 'admin')
                    <x-dropdown-link :href="route('admin.tickets.index')">
                        {{ __('Admin Dashboard') }}
                    </x-dropdown-link>
                @elseif (Auth::user()->role === 'support_engineer')
                    <x-dropdown-link :href="route('support.tickets.index')">
                        {{ __('Support Dashboard') }}
                    </x-dropdown-link>
                @else
                    <x-dropdown-link :href="route('tickets.index')">
                        {{ __('My Tickets') }}
                    </x-dropdown-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                     this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
        <a href="{{ route('register') }}" class="ms-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
    @endauth
</div>
