<x-guest-layout>

    <x-authenticationemail-card>

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Actualiza tu correo electrónico para que podamos enviarte el enlace de verificación.') }}
        </div>

        @livewire('EnvioCorreo')

    </x-authenticationemail-card>

</x-guest-layout>
