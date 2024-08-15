<div>
    <header x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">

        <div class="max-w-screen-xl mx-auto px-1 mini:px-4 sm:px-6 lg:px-8">

            <div class="flex h-16 justify-between">

                <div class="flex">
                    <div class="flex gap-2 mini:gap-4 items-center">
                        <a href="">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    </div>

                    <div class="space-x-8 sm:-my-px sm:ms-10 md:flex hidden">
                        <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                            {{ __('Inicio') }}
                        </x-nav-link>

                        <x-nav-link href="https://gisenalabs.com.mx/empresa/">
                            {{ __('Empresa') }}
                        </x-nav-link>

                        <x-nav-link href="https://gisenalabs.com.mx/servicios/">
                            {{ __('Servicios') }}
                        </x-nav-link>

                        <x-nav-link href="https://gisenalabs.com.mx/reconocimientos/">
                            {{ __('Reconocimientos') }}
                        </x-nav-link>

                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @if (!Auth::check() || Auth::user()->idtipo_usuario != 1)
                        <div class="relative mt-2">
                            <a
                                class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M17 17h-11v-14h-2" />
                                    <path d="M6 5l14 1l-1 7h-13" />
                                </svg>
                            </a>
                            <div
                                class="absolute inline-flex items-center justify-center w-4 h-4 mini:w-5 mini:h-5 text-[6px] mini:text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-0 -end-0 mini:-top-1 mini:-end-1 dark:border-gray-900">
                                <samp>30</samp>
                            </div>
                        </div>
                    @endif

                    <div class="ms-3 relative max-md:hidden mt-2">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                        {{-- Perfile --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                        </svg>
                                        {{-- <div
                                            class="absolute inline-flex items-center justify-center w-3 h-3 mini:w-4 mini:h-4  {{ Auth::check() ? 'bg-green-500' : 'bg-red-500' }} rounded-full -top-0 -end-0  mini:-top-0 mini:-end-0 dark:border-gray-900">
                                        </div> --}}
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">

                                @if (Auth::check())
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Email') }}
                                    </div>
                                    <div class="block px-4 py-2 text-base text-gray-400">
                                        {{ Auth::user()->correo }}
                                    </div>

                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Administrar cuenta') }}
                                    </div>

                                    {{-- <x-dropdown-link href="{{ route('dashboard') }}" wire:navigate.hover>
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('profile.show') }}" wire:navigate.hover>
                                        {{ __('Profile') }}
                                    </x-dropdown-link> --}}


                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>


                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                @else
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('GisenaLabs') }}
                                    </div>


                                    <x-dropdown-link href="{{ route('login') }}" wire:navigate.hover>
                                        {{ __('Inicia sesión') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('register') }}" wire:navigate.hover>
                                        {{ __('Crea una cuenta') }}
                                    </x-dropdown-link>
                                @endif

                            </x-slot>
                        </x-dropdown>
                    </div>
                    <div class="md:hidden ml-3">
                        <button @click="open = ! open" x-on:click.away="open=false"
                            class="bg-lime-600 p-2 rounded-md text-white dark:text-white dark:hover:text-gray-400 hover:bg-blue-800 dark:hover:bg-gray-900 focus:outline-none focus:bg-blue-800 dark:focus:bg-gray-900 dark:focus:text-gray-400 transition duration-150 ease-in-out">

                            <svg class="h-3 w-3 mini:h-6 mini:w-6" stroke="currentColor" fill="none"
                                viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>

                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ======================================================Responsive menu================================================== --}}
        <div :class="{
            'block': open,
            'hidden': !open
        }" class="hidden md:hidden ">

            <div class="pt-2 pb-3 space-y-1">
                @if (Auth::check())
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Email') }}
                    </div>
                    <div class="block px-4 py-2 text-base text-gray-400">
                        {{ Auth::user()->correo }}
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-600"></div>
                @endif
                <x-responsive-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                    {{ __('inicio') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="https://gisenalabs.com.mx/empresa/">
                    {{ __('Empresa') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="https://gisenalabs.com.mx/servicios/">
                    {{ __('Servicios') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="https://gisenalabs.com.mx/reconocimientos/">
                    {{ __('Reconocimeintos') }}
                </x-responsive-nav-link>
                @if (Auth::check())
                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Administrar cuenta') }}
                    </div>

                    {{-- <x-dropdown-link href="{{ route('dashboard') }}" wire:navigate.hover>
                        {{ __('Dashboard') }}
                    </x-dropdown-link> --}}

                    <x-dropdown-link href="{{ route('profile.show') }}" wire:navigate.hover>
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    <div class="border-t border-gray-200 dark:border-gray-600"></div>


                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                @else
                    <div class="border-t border-gray-200 dark:border-gray-600"></div>
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('GisenaLabs') }}
                    </div>
                    <x-dropdown-link href="{{ route('login') }}" wire:navigate.hover>
                        {{ __('Inicia sesión') }}
                    </x-dropdown-link>

                    <x-dropdown-link href="{{ route('register') }}" wire:navigate.hover>
                        {{ __('Crea una cuenta') }}
                    </x-dropdown-link>
                @endif
            </div>
            @if (Auth::check())
                <div class="pt-4 pb-1 border-t border-lime-600 dark:border-gray-600">
                    <div class="flex items-center px-4">
                        <div>
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                {{ Auth::user()->nombre }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ Auth::user()->correo }}</div>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </header>

    {{-- ======================================================site web================================================== --}}

    @if (!Auth::user() || auth()->user()->idtipo_usuario != 1)
        <div class="w-full p-1 bg-white dark:bg-gray-800 grid place-items-center shadow">
            <a href="https://gisenalabs.com.mx/"
                class="hover:text-lime-600 duration-300 font-semibold">gisenalabs.com.mx</a>
        </div>
    @endif
</div>
