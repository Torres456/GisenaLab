<x-guest-layout>
    <x-header />

    <x-authentication-card>

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <div class="text-center p-4 font-bold">
            <h1>Registro de persona moral</h1>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <x-input id="tipo" class="block mt-1 w-full" type="hidden" name="tipo" value="moral" />

            <div>
                <x-label for="nombre_moral" value="{{ __('Nombre, denominación o razón social.') }}" />
                <x-input id="nombre_moral" class="block mt-1 w-full" type="text" name="nombre_moral"
                    :value="old('nombre_moral')" autofocus autocomplete="nombre_moral" required maxlength=255 />
            </div>

            <div class="mt-4">
                <x-label-tooltip value="{{ __('RFC') }}"
                    message-text="El RFC de una persona moral debe tener 12 caracteres y estar en mayúsculas." />
                <x-input id="rfc" class="block mt-1 w-full" type="text" name="rfc" :value="old('rfc')"
                    autofocus autocomplete="rfc" required
                    onkeypress="return (event.charCode >= 48 && event.charCode <=57 || event.charCode >= 65 && event.charCode <=90)"
                    maxlength=12 />
            </div>

            <div class="mt-4">
                <x-label for="correo" value="{{ __(' Correo') }}" />
                <x-input id="correo" class="block mt-1 w-full" type="email" name="correo" :value="old('correo')"
                    autocomplete="username" required maxlength=255 />
            </div>

            <div class="mt-4">
                <x-label-tooltip value="{{ __('Contraseña') }}"
                    message-text="Tu contraseña debe contener, minimo 8 caracteres, conbinación de números y letras, utilizar almenos una mayúscula y un simbolo." />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" maxlength=255 />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirmar contraseña') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Registrarse') }}
                </x-button>
            </div>

            <div class="p-5 text-center">
                <a class="inline-flex items-center gap-2 rounded border border-blue-800 bg-blue-800 px-8 py-3 text-white hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
                    href="{{ route('tipo-persona') }}">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" transform="rotate(180)">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>

                    <span class="text-sm font-medium">Elegir otro tipo de persona.</span>

                </a>
            </div>
        </form>

    </x-authentication-card>

</x-guest-layout>
