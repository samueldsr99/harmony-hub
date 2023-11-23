<nav x-data="{ mobile_menu_visible: false }" class="bg-gray-50">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo />
                </a>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @foreach($menu_items as $item)
                            @if(request()->routeIs($item['route']))
                                <a href="{!! $item['url'] ?? route($item['route']) !!}" class="font-bold underline text-[#ff3850]" aria-current="page">{{$item['label']}}</a>
                            @else
                                <a href="{!! $item['url'] ?? route($item['route']) !!}" class="font-bold text-gray-600">{{$item['label']}}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <!-- Profile dropdown -->
                    @guest
                        <div class="text-white">
                            <a href="{{route('signup')}}" class="text-[#ff3850] font-semibold py-.5 px-2">Signup</a>
                        </div>

                        <div class="text-white">
                            <a href="{{route('signin')}}" class="text-[#ff3850] font-semibold py-.5 px-2">Signin</a>
                        </div>
                    @endguest

                    @auth
                        <div class="relative ml-3 " x-data="{ admin_menu_visible: false }">
                            <div>
                                <button @click="admin_menu_visible = !admin_menu_visible" type="button" class="flex items-center font-semibold" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span>Admin</span>
                                    <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" class="ml-3 h-3 w-3 stroke-[#ff3850]"><path d="M9.75 4.125 6 7.875l-3.75-3.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </button>
                            </div>

                            <!--
                              Dropdown menu, show/hide based on menu state.

                              Entering: "transition ease-out duration-100"
                                From: "transform opacity-0 scale-95"
                                To: "transform opacity-100 scale-100"
                              Leaving: "transition ease-in duration-75"
                                From: "transform opacity-100 scale-100"
                                To: "transform opacity-0 scale-95"
                            -->
                            <div x-show="admin_menu_visible" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

                                @auth
                                    <span class="block px-4 py-2 text-xs text-gray-400 font-semibold">My data</span>
                                    @foreach($home_menu_items as $item)
                                        @if(request()->routeIs($item['route']))
                                            <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block px-4 pt-2 text-sm bg-gray-100 text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">{{$item['label']}}</a>
                                        @else
                                            <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block px-4 py-2 text-sm text-[#ff3850]" role="menuitem" tabindex="-1" id="user-menu-item-0">{{$item['label']}}</a>
                                        @endif
                                    @endforeach
                                    <hr class="mt-2">
                                @endauth

                                @if( auth()->user()->is_admin)
                                    <span class="block px-4 py-2 text-xs uppercase text-[#ff3850] font-semibold">Manage data</span>
                                    @foreach($admin_menu_items as $item)
                                        @if(request()->routeIs($item['route']))
                                            <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block px-4 pt-2 text-sm bg-[#ff3850] text-[#ff3850]" role="menuitem" tabindex="-1" id="user-menu-item-0">{{$item['label']}}</a>
                                        @else
                                            <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block px-4 py-2 text-sm text-[#ff3850]" role="menuitem" tabindex="-1" id="user-menu-item-0">{{$item['label']}}</a>
                                        @endif
                                    @endforeach
                                    <hr class="mt-2">
                                @endif

                                <a href="{{ route('playlists.create') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Create playlist</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Profile</a>

                                <form method="POST" action="{{ route('signout') }}">
                                    @csrf
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2" onclick="event.preventDefault();
                                                this.closest('form').submit();">Sign out</a>
                                </form>

                            </div>
                        </div>
                    @endauth

                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button @click="mobile_menu_visible = !mobile_menu_visible" type="button" class="relative inline-flex items-center justify-center rounded-md bg-[#ff3850] p-2 text-white hover:bg-[#ff3850] hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#ff3850]" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden" id="mobile-menu" x-show="mobile_menu_visible">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            @foreach($menu_items as $item)
                @if(request()->routeIs($item['route']))
                    <a href="{!! $item['url'] ?? route($item['route']) !!}" class="bg-[#ff3850] text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">{{$item['label']}}</a>
                @else
                    <a href="{!! $item['url'] ?? route($item['route']) !!}" class="text-[#ff3850] hover:bg-[#ff3850] hover:text-white block rounded-md px-3 py-2 text-base font-medium">{{$item['label']}}</a>
                @endif
            @endforeach

        </div>
        <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="flex items-center px-5">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium leading-none text-white">Tom Cook</div>
                    <div class="text-sm font-medium leading-none text-gray-400">tom@example.com</div>
                </div>
            </div>
            <div class="mt-3 space-y-1 px-2">
                @foreach($admin_menu_items as $item)
                    @if(request()->routeIs($item['route']))
                        <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block rounded-md px-3 py-2 text-base font-medium bg-gray-900 text-white hover:text-white">{{$item['label']}}</a>
                    @else
                        <a href="{!! $item['url'] ?? route($item['route']) !!}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">{{$item['label']}}</a>
                    @endif
                @endforeach



                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
            </div>
        </div>
    </div>
</nav>
