<div>
    <div class="bg-blue-800 text-white text-center">
        <h1>gisenalabs@gisena.com.mx</h1>
    </div>
    <header x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        {{-- Contenedor-todo-ancho --}}
        <div class="max-w-screen-xl mx-auto px-1 mini:px-4 sm:px-6 lg:px-8">
            {{-- Contenedor-todo-display --}}
            <div class="flex h-28 justify-between">
                {{-- contenedor-logo-botton --}}
                <div class="flex gap-2 mini:gap-4 items-center">
                    <div class="md:hidden">
                        <button @click="open = ! open" x-on:click.away="open=false"
                            class=" bg-lime-600 p-2 rounded-md text-white dark:text-gray-500 dark:hover:text-gray-400 hover:bg-blue-800 dark:hover:bg-gray-900 focus:outline-none focus:bg-blue-800 dark:focus:bg-gray-900 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            {{-- h-6 w-6 --}}
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
                    <div class="">
                        <a href="">
                            {{-- max-w-[150px] --}}
                            <x-application-mark class="max-w-[70px] mini:max-w-[160px]  md:max-w-[200px]" />
                        </a>
                    </div>
                </div>

                {{-- contenedor-links --}}
                <div class="hidden space-x-6 sm:-my-px md:flex ">
                    <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Empresa') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Servicios') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Reconocimientos') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Noticias') }}
                    </x-nav-link>

                </div>

                {{-- contenedor imagenes --}}
                <div class="flex items-center gap-1 mini:gap-3">

                    <div class="">
                        <button type="button" class="inline-flex items-center relative hover:shadow rounded-xl">
                            {{-- 36px --}}
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                fill="#5f6368" class="w-9 h-5 mini:h-9">
                                <path
                                    d="M286.15-97.69q-29.15 0-49.57-20.43-20.42-20.42-20.42-49.57 0-29.16 20.42-49.58 20.42-20.42 49.57-20.42 29.16 0 49.58 20.42 20.42 20.42 20.42 49.58 0 29.15-20.42 49.57-20.42 20.43-49.58 20.43Zm387.7 0q-29.16 0-49.58-20.43-20.42-20.42-20.42-49.57 0-29.16 20.42-49.58 20.42-20.42 49.58-20.42 29.15 0 49.57 20.42t20.42 49.58q0 29.15-20.42 49.57Q703-97.69 673.85-97.69ZM240.61-730 342-517.69h272.69q3.46 0 6.16-1.73 2.69-1.73 4.61-4.81l107.31-195q2.31-4.23.38-7.5-1.92-3.27-6.54-3.27h-486Zm-28.76-60h555.38q24.54 0 37.11 20.89 12.58 20.88 1.2 42.65L677.38-494.31q-9.84 17.31-26.03 26.96-16.2 9.66-35.5 9.66H324l-46.31 84.61q-3.08 4.62-.19 10 2.88 5.39 8.65 5.39h457.69v60H286.15q-40 0-60.11-34.5-20.12-34.5-1.42-68.89l57.07-102.61L136.16-810H60v-60h113.85l38 80ZM342-517.69h280-280Z" />
                            </svg>
                            {{-- w-5 h-5 border-2 text-xs -top-1 -end-1 --}}
                            <div
                                class="absolute inline-flex items-center justify-center w-4 h-4 mini:w-5 mini:h-5 text-[6px] mini:text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-0 -end-0 mini:-top-1 mini:-end-1 dark:border-gray-900">
                                30</div>

                        </button>

                    </div>

                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex">
                                    <button type="button"
                                        class="inline-flex  rounded-xl items-center border hover:shadow border-transparent text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#5f6368"
                                            class="w-9 h-5 mini:h-9">
                                            <path
                                                d="M240.92-268.31q51-37.84 111.12-59.77Q412.15-350 480-350t127.96 21.92q60.12 21.93 111.12 59.77 37.3-41 59.11-94.92Q800-417.15 800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 62.85 21.81 116.77 21.81 53.92 59.11 94.92ZM480.01-450q-54.78 0-92.39-37.6Q350-525.21 350-579.99t37.6-92.39Q425.21-710 479.99-710t92.39 37.6Q610-634.79 610-580.01t-37.6 92.39Q534.79-450 480.01-450ZM480-100q-79.15 0-148.5-29.77t-120.65-81.08q-51.31-51.3-81.08-120.65Q100-400.85 100-480t29.77-148.5q29.77-69.35 81.08-120.65 51.3-51.31 120.65-81.08Q400.85-860 480-860t148.5 29.77q69.35 29.77 120.65 81.08 51.31 51.3 81.08 120.65Q860-559.15 860-480t-29.77 148.5q-29.77 69.35-81.08 120.65-51.3 51.31-120.65 81.08Q559.15-100 480-100Zm0-60q54.15 0 104.42-17.42 50.27-17.43 89.27-48.73-39-30.16-88.11-47Q536.46-290 480-290t-105.77 16.65q-49.31 16.66-87.92 47.2 39 31.3 89.27 48.73Q425.85-160 480-160Zm0-350q29.85 0 49.92-20.08Q550-550.15 550-580t-20.08-49.92Q509.85-650 480-650t-49.92 20.08Q410-609.85 410-580t20.08 49.92Q450.15-510 480-510Zm0-70Zm0 355Z" />
                                        </svg>
                                        {{-- w-4 h-4 --}}
                                        <div
                                            class="absolute inline-flex items-center justify-center w-3 h-3 mini:w-4 mini:h-4  {{ Auth::check() ? 'bg-green-500' : 'bg-red-500' }} rounded-full -top-0 -end-0  mini:-top-0 mini:-end-0 dark:border-gray-900">
                                        </div>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">

                                @if (Auth::check())
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Administrar cuenta') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

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


                                    <x-dropdown-link href="{{ route('login') }}">
                                        {{ __('Inicia sesión') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('register') }}">
                                        {{ __('Crea una cuenta') }}
                                    </x-dropdown-link>
                                @endif

                            </x-slot>
                        </x-dropdown>
                    </div>


                </div>

            </div>
        </div>
        <div :class="{
            'block': open,
            'hidden': !open
        }" class="hidden md:hidden ">

            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                    {{ __('inicio') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Empresa') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Servicios') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Reconocimeintos') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Empresa') }}
                </x-responsive-nav-link>
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
</div>
