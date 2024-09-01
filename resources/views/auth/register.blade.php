<x-guest-layout>

    <x-header />

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="nombre" value="{{ __('Nombre') }}" />
                <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" autofocus
                    placeholder="Introduce tu nombre" autocomplete="nombre"
                    onkeypress="return (event.charCode >= 65 && event.charCode <= 122 || event.charCode >= 32 && event.charCode <= 32 || event.charCode >= 225 && event.charCode <= 225 || event.charCode >= 233 && event.charCode <= 237 || event.charCode >= 243 && event.charCode <= 250 || event.charCode >= 192 && event.charCode <= 218 || event.charCode >= 209 && event.charCode <= 209 || event.charCode >= 241 && event.charCode <= 241)"
                    maxlength=255 />
                <x-input-error for="nombre" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="paterno" value="{{ __('Apellido paterno') }}" />
                <x-input id="paterno" class="block mt-1 w-full" type="text" name="paterno" :value="old('paterno')"
                    required autofocus autocomplete="apellido paterno" max="255"
                    placeholder="Introduce tu apellido paterno"
                    onkeypress="return (event.charCode >= 65 && event.charCode <= 122 || event.charCode >= 32 && event.charCode <= 32 || event.charCode >= 225 && event.charCode <= 225 || event.charCode >= 233 && event.charCode <= 237 || event.charCode >= 243 && event.charCode <= 250 || event.charCode >= 192 && event.charCode <= 218 || event.charCode >= 209 && event.charCode <= 209 || event.charCode >= 241 && event.charCode <= 241)"
                    maxlength=255 />
                <x-input-error for="paterno" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="materno" value="{{ __('Apellido materno') }}" />
                <x-input id="materno" class="block mt-1 w-full" type="text" name="materno" :value="old('materno')"
                    required autofocus autocomplete="apellido materno" min="255"
                    placeholder="Introduce tu apellido materno"
                    onkeypress="return (event.charCode >= 65 && event.charCode <= 122 || event.charCode >= 32 && event.charCode <= 32 || event.charCode >= 225 && event.charCode <= 225 || event.charCode >= 233 && event.charCode <= 237 || event.charCode >= 243 && event.charCode <= 250 || event.charCode >= 192 && event.charCode <= 218 || event.charCode >= 209 && event.charCode <= 209 || event.charCode >= 241 && event.charCode <= 241)"
                    maxlength=255 />
                <x-input-error for="materno" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label-tooltip value="{{ __('RFC') }}"
                    message-text="El RFC debe tener como minimo 13 caracteres para persona fisica y 12 para persona moral." />
                <x-input id="rfc" class="block mt-1 w-full" type="text" name="rfc" :value="old('rfc')"
                    required autofocus autocomplete="rfc" placeholder="Ejemplo: ABCD123456XYZ"
                    onkeypress="return (event.charCode >= 65 && event.charCode <=90 || event.charCode >= 97 && eve
                    nt.charCode <=122 )"
                    onkeyup="javascript:this.value = this.value.toUpperCase();" maxlength=13 />
                <x-input-error for="rfc" class="mt-2" />
            </div>


            <div class="mt-4">
                <x-label for="correo" value="{{ __(' Correo') }}" />
                <x-input id="correo" class="block mt-1 w-full" type="email" name="correo" :value="old('correo')"
                    required autocomplete="username" placeholder="nombre@dominio.com" />
                <x-input-error for="correo" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error for="password" class="mt-2" />
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
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

    </x-authentication-card>
</x-guest-layout>
