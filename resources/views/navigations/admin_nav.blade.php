<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}">
                        {{-- Admin --}}
                        <x-admin-logo class="xblock h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    {{-- <x-nav-link :href="route('/')" :active="request()->routeIs('/')">
                        {{ __('Home') }}
                    </x-nav-link> --}}

                    {{-- <x-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.index')">
                        {{ __('Posts') }}
                    </x-nav-link> --}}

{{--
                    <x-nav-link :href="route('admin.images.index')" :active="request()->routeIs('admin.images.index')">
                        {{ __('Images') }}
                    </x-nav-link> --}}

                    {{-- <x-nav-link :href="route('admin.videos.index')" :active="request()->routeIs('admin.videos.index')">
                        {{ __('Videos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.tags.index')" :active="request()->routeIs('admin.tags.index')">
                        {{ __('Tags') }}
                    </x-nav-link> --}}

                    {{-- @permission('comment_create')
                        <x-nav-link :href="route('admin.comments.index')" :active="request()->routeIs('comments.index')">
                            {{ __('Comments') }}
                        </x-nav-link>
                    @endpermission --}}



                    @permission('option_create')
                        <x-nav-link :href="route('admin.options.index')" :active="request()->routeIs('admin.options.index')">
                            {{ __('Options') }}
                        </x-nav-link>
                    @endpermission

                    @permission('user_create')
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('users.index')">
                            {{ __('Users') }}
                        </x-nav-link>
                    @endpermission


                    @permission('term_create')
                        <x-nav-link :href="route('admin.terms.index')" :active="request()->routeIs('terms.index')">
                            {{ __('Terms') }}
                        </x-nav-link>
                    @endpermission

                    @permission('role_create')
                        <x-nav-link :href="route('admin.roles.index')" :active="request()->routeIs('roles.index')">
                            {{ __('Roles') }}
                        </x-nav-link>
                    @endpermission

                    @permission('permission_create')
                        <x-nav-link :href="route('admin.permissions.index')" :active="request()->routeIs('permissions.index')">
                            {{ __('Permissions') }}
                        </x-nav-link>
                    @endpermission

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
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
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
                                    {{ __('Preview') }}
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
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
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
