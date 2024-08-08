<x-guest-layout>

    <x-header />

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña que te permitirá elegir una nueva.') }}
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="correo" value="{{ __('Correo') }}" />
                <x-input id="correo" class="block mt-1 w-full" type="email" name="correo" :value="old('correo')"
                    required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-button>
                    {{ __('Enviar enlace para restablecer contraseña') }}
                </x-button>
            </div>
        </form>
        <div class="p-5 text-center">
            <a class="inline-flex items-center gap-2 rounded border border-blue-800 bg-blue-800 px-8 py-3 text-white hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
                href="{{ route('login') }}">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" transform="rotate(180)">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
                <span class="text-sm font-medium">Regresar.</span>
            </a>
        </div>
    </x-authentication-card>
</x-guest-layout>
