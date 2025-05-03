<!-- Navigation Bar -->
<nav class="bg-blue-600 shadow-md p-4 flex justify-between items-center text-white">
    <!-- Logo or Title -->
    <div class="text-lg font-bold">
        {{ __('Support Ticket System') }}
    </div>

    <!-- Navigation Links -->
    <div class="flex space-x-8">
        @auth
            @if (Auth::user()->role === 'admin')
                <x-nav-link :href="route('admin.tickets.index')" :active="request()->routeIs('admin.tickets.*')" class="text-white hover:text-gray-200">
                    {{ __('Admin Dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="text-white hover:text-gray-200">
                    {{ __('Manage Users') }}
                </x-nav-link>
            @elseif (Auth::user()->role === 'support_engineer')
                <x-nav-link :href="route('support.tickets.index')" :active="request()->routeIs('support.tickets.*')" class="text-white hover:text-gray-200">
                    {{ __('Support Dashboard') }}
                </x-nav-link>
            @else
                <x-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')" class="text-white hover:text-gray-200">
                    {{ __('My Tickets') }}
                </x-nav-link>
            @endif
        @endauth
    </div>

    <!-- Settings Dropdown -->
    <div class="flex items-center">
        @auth
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ml-1">
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
                        <x-dropdown-link :href="route('admin.users.index')">
                            {{ __('Manage Users') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.users.create')">
                            {{ __('Create New User') }}
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
            <a href="{{ route('login') }}" class="text-sm text-white underline hover:text-gray-200">Log in</a>
            <a href="{{ route('register') }}" class="ml-4 text-sm text-white underline hover:text-gray-200">Register</a>
        @endauth
    </div>
</nav>
