<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('admin.dashboard') }}">
                        {{-- Admin --}}
                        <x-admin-logo class="w-auto h-10 text-gray-600 fill-current xblock" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    <x-nav-link :href="route('admin.subscription-requests.index')" :active="request()->routeIs('admin.subscription-requests.index')">
                        {{ __('Requests') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.subscriptions.index')" :active="request()->routeIs('admin.subscriptions.index')">
                        {{ __('Subscriptions') }}
                    </x-nav-link>

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">


                @guest
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>

                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-nav-link>
                    </div>
                @else



                {{-- @permission('option_create')
                    <x-nav-link :href="route('admin.options.index')" :active="request()->routeIs('admin.options.index')">
                        {{ __('Options') }}
                    </x-nav-link>
                @endpermission --}}



                {{-- @permission('term_create')
                    <x-nav-link :href="route('admin.terms.index')" :active="request()->routeIs('terms.index')">
                        {{ __('Terms') }}
                    </x-nav-link>
                @endpermission --}}

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                                    <div>bKash</div>

                                    <div class="ml-1">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>


                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.payment-amounts.index')">
                                    {{ __('Payment Amounts') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('admin.payment-frequencies.index')">
                                    {{ __('Payment Frequencies') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('admin.payment-sectors.index')">
                                    {{ __('Payment Sectors') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>



                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                                    <div>Security</div>

                                    <div class="ml-1">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>


                            <x-slot name="content">

                                @permission('user_create')
                                    <x-dropdown-link :href="route('admin.users.index')">
                                        {{ __('Users') }}
                                    </x-dropdown-link>
                                @endpermission


                                @permission('role_create')
                                    <x-dropdown-link :href="route('admin.roles.index')">
                                        {{ __('Roles') }}
                                    </x-dropdown-link>
                                @endpermission

                                @permission('permission_create')
                                    <x-dropdown-link :href="route('admin.permissions.index')">
                                        {{ __('Permissions') }}
                                    </x-dropdown-link>
                                @endpermission

                            </x-slot>
                        </x-dropdown>
                    </div>


                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                                    <div>Logs</div>

                                    <div class="ml-1">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>


                            <x-slot name="content">

                                <x-dropdown-link :href="route('admin.otcs.index')">
                                    {{ __('Otc Logs') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('admin.activity-logs.index')">
                                    {{ __('Activity Logs') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.activity-ips.index')">
                                    {{ __('activity-ips') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('admin.audits.index')">
                                    {{ __('Audit Logs') }}
                                </x-dropdown-link>


                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>


                            <x-slot name="content">

                                <x-dropdown-link :href="route('/')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

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
                    </div>

                @endguest


            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>


    </div>
</nav>
