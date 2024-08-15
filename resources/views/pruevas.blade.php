<x-guest-layout>

    <nav x-data="{ open: false, open2: false }" x-init="open = window.outerWidth > 1020 ? true : false" :class="{ 'ml-[244px]': open, 'ml-0': !open }"
        @resize.window="open = window.outerWidth < 1010 ? false : true, $dispatch('custom-event',open)"
        class="fixed top-0 left-0 right-0 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        {{-- header --}}
        <div class="px-2 py-3 lg:px-5 lg:pl-3"> {{-- tamaño header --}}
            <div class="flex items-center justify-between"> {{-- Acomo padre1 --}}
                <div class="flex items-center justify-start rtl:justify-end"> {{-- caja1 hijo padre1 --}}
                    <button @click="open = ! open, $dispatch('custom-event',open)"
                        @click.away="open = false, $dispatch('custom-event',open)" type="button"
                        class="inline-flex items-center p-1 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                        {{-- <x-application-mark class="block h-6 me-3" /> --}}
                        <img src="{{ asset('images/Gisena_Logo.png') }}" alt="" class="h-7 me-3">
                    </a>
                </div>

                <div class="flex items-center"> {{-- caja2 hijo padre2 --}}

                    <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-lime-300 dark:focus:ring-gray-600"
                            @click="open = ! open">
                            <img class="w-8 h-8 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600 absolute right-[0%]"
                            style="display: none;">

                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    Neil Sims
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    neil.sims@flowbite.com
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Earnings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </nav>




    <div x-data="{ open: false, hasClass: false }" x-init="open = window.outerWidth > 1020 ? true : false" @custom-event.window="open = $event.detail">
        <aside :class="{ 'transition-transform translate-x-0': open, 'transition-transform -translate-x-full': !open }"
            class="fixed top-0 left-0 z-60 w-[244px] h-screen bg-zinc-700 transition-transform -translate-x-full px-3 py-2">
            <div class="">
                <div class="flex items-center border-b-[0.1px] border-gray-500 w-full h-[50px]">
                    <img src="{{ asset('images/G_Logo.png') }}" alt="" class="min-h-10 h-[40px]">
                    <span class="ml-3 text-xl text-slate-300">GisenaLabs</span>
                </div>

                <div class="flex items-center border-b-[0.1px] border-gray-500 w-full h-[50px] justify-center">
                    <h2 class="ml-3 text-sm text-slate-300">Jovanny Torres</h2>
                </div>
            </div>

            <div class="mt-3">
                <ul>
                    <li class="">
                        <a href="#"
                            class="flex items-center p-2 text-white rounded-lg dark:text-white bg-blue-600 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li class="mt-1">
                        <a href="#"
                            class="flex items-center p-2 text-gray-500 rounded-lg dark:text-white hover:bg-gray-400 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>



        </aside>

    </div>

    {{-- sm:translate-x-0 --}}
</x-guest-layout>
