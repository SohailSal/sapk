<nav x-data="{ open: false }" class=" border-b border-gray-200">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between max-h-10">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/dashboard">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if(session('company_id'))
                    <x-jet-nav-link href="/doc" :active="request()->routeIs('doc')">
                        {{ __('Transactions') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="/account" :active="request()->routeIs('account')">
                        {{ __('Accounts') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="/entry" :active="request()->routeIs('entry')">
                        {{ __('Ledger') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="/group" :active="request()->routeIs('group')">
                        {{ __('Groups') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="/doctype" :active="request()->routeIs('doctype')">
                        {{ __('Vouchers') }}
                    </x-jet-nav-link>
                    @endif
                    <x-jet-nav-link href="/company" :active="request()->routeIs('company')">
                        {{ __('Companies') }}
                    </x-jet-nav-link>
                    @if(session('company_id'))
                    <x-jet-nav-link href="/report" :active="request()->routeIs('report')">
                        {{ __('Reports') }}
                    </x-jet-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-600">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="/user/profile">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>
<!--
                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="/user/api-tokens">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                        @endif
-->
                        <div class="border-t border-gray-100"></div>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Team') }}
                            </div>

                            <!-- Team Settings -->
                            <x-jet-dropdown-link href="/teams/{{ Auth::user()->currentTeam->id }}">
                                {{ __('Team Settings') }}
                            </x-jet-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="/teams/create">
                                    {{ __('Create New Team') }}
                                </x-jet-dropdown-link>
                            @endcan

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                            @endforeach

                            <div class="border-t border-gray-100"></div>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(session('company_id'))
            <x-jet-responsive-nav-link class="bg-white hover:bg-gray-200" href="/doc" :active="request()->routeIs('doc')">
                {{ __('Transactions') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link class="bg-white hover:bg-gray-200" href="/account" :active="request()->routeIs('account')">
                {{ __('Accounts') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link class="bg-white hover:bg-gray-200" href="/entry" :active="request()->routeIs('entry')">
                {{ __('Ledger') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link class="bg-white hover:bg-gray-200" href="/group" :active="request()->routeIs('group')">
                {{ __('Groups') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link class="bg-white hover:bg-gray-200" href="/doctype" :active="request()->routeIs('doctype')">
                {{ __('Vouchers') }}
            </x-jet-responsive-nav-link>
            @endif
            <x-jet-responsive-nav-link class="bg-white hover:bg-gray-200" href="/company" :active="request()->routeIs('company')">
                {{ __('Companies') }}
            </x-jet-responsive-nav-link>
            @if(session('company_id'))
            <x-jet-responsive-nav-link class="bg-white hover:bg-gray-200" href="/report" :active="request()->routeIs('report')">
                {{ __('Reports') }}
            </x-jet-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-white">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link class="bg-white hover:bg-gray-200" href="/user/profile" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>
<!--
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="/user/api-tokens" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif
-->
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link class="bg-white hover:bg-gray-200" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="/teams/{{ Auth::user()->currentTeam->id }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="/teams/create" :active="request()->routeIs('teams.create')">
                        {{ __('Create New Team') }}
                    </x-jet-responsive-nav-link>

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
