<x-guest-layout>
    <x-header />

    <x-authentication-card>

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="text-center ">

            <h1 class="font-black text-xl mb-4">Selecciona tu tipo de contribuyente.</h1>
            <p>Selecciona como el SAT te clasifica como contribuyente.</p>
        </div>

        <div class="flex gap-10 justify-center mt-5">
            <a class="group flex items-center justify-between gap-4 rounded-lg border border-lime-600 bg-lime-600 px-5 py-3 transition-colors hover:bg-transparent focus:outline-none focus:ring"
                href="{{ route('persona-fisica') }}">
                <span
                    class="font-medium text-white transition-colors group-hover:text-lime-600 group-active:text-lime-500">
                    Persona fisica.
                </span>

                <span
                    class="shrink-0 rounded-full border border-current bg-white p-2 text-lime-600 group-active:text-lime-500">
                    <svg class="size-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </span>
            </a>

            <a class="group flex items-center justify-between gap-4 rounded-lg border border-blue-800 bg-blue-800 px-5 py-3 transition-colors hover:bg-transparent focus:outline-none focus:ring"
                href="{{ route('persona-moral') }}">
                <span
                    class="font-medium text-white transition-colors group-hover:text-blue-800 group-active:text-blue-500">
                    Persona moral.
                </span>

                <span
                    class="shrink-0 rounded-full border border-current bg-white p-2 text-blue-800 group-active:text-blue-500">
                    <svg class="size-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </span>
            </a>
        </div>





    </x-authentication-card>




</x-guest-layout>
