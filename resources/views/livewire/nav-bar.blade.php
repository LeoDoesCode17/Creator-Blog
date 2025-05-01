<nav class="bg-gray-800" x-data="{ displayed: false, notificationDisplayed: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img class="size-8" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @livewire('nav-link', [
                        'name' => 'Home',
                        'routeName' => 'home',
                        'smallScreen' => 'false'
                        ])
                        @livewire('nav-link', [
                        'name' => 'Search',
                        'routeName' => 'search',
                        'smallScreen' => 'false'
                        ])
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <!-- NOTIFICATION DROPDOWN -->
                    <div class="relative ml-3">
                        <!-- NOTIFICATION ICON -->
                        <button type="button" @click="notificationDisplayed = !notificationDisplayed" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">View notifications</span>
                            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                        </button>
                        <!-- END NOTIFICATION ICON -->
                        <!-- NOTIFICATION POPUP -->
                        <div x-show="notificationDisplayed" x-cloak @click.away="notificationDisplayed = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100 outline-hidden", Not Active: "" -->
                            @forelse ($friendshipRequests as $request)
                            <a href="{{ route('search') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Friend request from user {{ $request->sender_id }}</a>
                            @empty
                            <p class="block px-4 py-2 text-sm text-gray-700">No notifications</p>
                            @endforelse
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-blue-700" role="menuitem" tabindex="-1" id="user-menu-item-0">See All Notifications</a>
                        </div>
                        <!-- END NOTIFICATION POPUP -->
                    </div>
                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- PROFILE DROPDOWN -->
                    <div class="relative ml-3">
                        <button @click="displayed = !displayed" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="size-8 rounded-full" src="{{ asset($user->avatar) }}" alt="">
                        </button>

                        <!--
                                        Dropdown menu, show/hide based on menu state.

                                        Entering: "transition ease-out duration-100"
                                        From: "transform opacity-0 scale-95"
                                        To: "transform opacity-100 scale-100"
                                        Leaving: "transition ease-in duration-75"
                                        From: "transform opacity-100 scale-100"
                                        To: "transform opacity-0 scale-95"
                                    -->
                        <div x-show="displayed" x-cloak @click.away="displayed = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100 outline-hidden", Not Active: "" -->
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                            <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700"> Sign Out</button>
                            </form>
                        </div>
                    </div>
                    <!-- END PROFILE DROPDOWN -->
                </div>
            </div>
            <!-- MOBILE MENU BUTTON -->
            <div class="-mr-2 flex md:hidden">
                <button @click="displayed = !displayed" type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- END MOBILE MENU BUTTON -->
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="displayed" class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            @livewire('nav-link', [
            'name' => 'Home',
            'routeName' => 'home',
            'smallScreen' => 'true'
            ])
            @livewire('nav-link', [
            'name' => 'Search',
            'routeName' => 'search',
            'smallScreen' => 'true'
            ])
        </div>
        <div class="border-t border-gray-700 pt-4 pb-3">
            <div class="flex items-center px-5">
                <div class="shrink-0">
                    <img class="size-10 rounded-full" src="{{ asset($user->avatar) }}" alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base/5 font-medium text-white">{{ $user->name }}</div>
                    <div class="text-sm font-medium text-gray-400">{{ $user->email }}</div>
                </div>
                <!-- MOBILE NOTIFICATION ICON -->
                <a href="{{ route('search') }}" class="relative ml-auto shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                </a>
                <!-- END MOBILE NOTIFICATION ICON -->
            </div>
            <div class="mt-3 space-y-1 px-2">
                <a href="{{ route('profile') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
                <a href="{{ route('settings') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"> Sign Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>