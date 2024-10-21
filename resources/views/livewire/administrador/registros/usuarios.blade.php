<div>
    {{-- Success is as dangerous as failure. --}}

    <x-message />

    <div class="mb-2 w-full flex gap-4 flex-col lg:flex-row">

        <div class="w-full flex gap-3  lg:w-1/2 flex-col lg:flex-row">

            <div class="">
                <label for="" class="block font-medium">Cantidad</label>
                <x-select name="" id="" class="rounded-md block w-full" wire:model.change="quantity">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </x-select>
            </div>

            <div class="flex gap-3">

                <div class="w-1/3">
                    <label for="" class="block font-medium">Tipo</label>
                    <x-select name="" id="" class="rounded-md block w-full"
                        wire:model.change="tipo_usuario" wire:change="searching">
                        <option value="">Todos</option>
                        @forelse ($tipos as $tipo)
                            @if ($tipo->descripcion == 'Usuario')
                                <option value="{{ $tipo->id_tipo_usuario }}" wire:key="{{ $tipo->id_tipo_usuario }}">
                                    Clientes</option>
                            @else
                                <option value="{{ $tipo->id_tipo_usuario }}" wire:key="{{ $tipo->id_tipo_usuario }}">
                                    {{ $tipo->descripcion }}</option>
                            @endif
                        @empty
                            <option value="">Sin resultados</option>
                        @endforelse
                    </x-select>
                </div>

                <div class="w-1/3">
                    <label for="" class="block font-medium">Correo</label>
                    <x-select name="" id="" class="rounded-md block w-full"
                        wire:model.change="email_verification" wire:change="searching">
                        <option value="0">Todos</option>
                        <option value="1">Verificado</option>
                        <option value="2">No verificado</option>
                    </x-select>
                </div>

                <div class="w-1/3">
                    <label for="" class="block font-medium">Estatus</label>
                    <x-select name="" id="" class="rounded-md block w-full" wire:model.change="status"
                        wire:change="searching">
                        <option value="0">Todos</option>
                        <option value="1">Activos</option>
                        <option value="2">Inactivos</option>
                    </x-select>
                </div>

            </div>

        </div>

        <div class="w-full flex gap-3 lg:w-1/2">
            <div class="w-1/2">
                <label for="" class="block">Buscar</label>
                <div class="relative">
                    <input type="text"
                        class="block w-full pr-8 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-lime-500 dark:focus:border-lime-600 focus:ring-lime-500 dark:focus:ring-lime-600 rounded-md shadow-sm"
                        id="search" placeholder="Buscar..."wire:model="search" wire:keydown="searching">
                    <div class="absolute flex top-0 inset-y-0 right-0 items-center pr-2">
                        @if ($estado)
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" class="cursor-pointer fill-current text-black dark:text-white"
                                id="element" wire:click="resets()">
                                <path
                                    d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                            </svg>
                        @endif
                    </div>
                </div>

            </div>

            <div class="flex w-1/2">
                <x-button wire:click="modal" class="mt-auto"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-file-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <path d="M12 11l0 6" />
                        <path d="M9 14l6 0" />
                    </svg> Nuevo</x-button>
            </div>

        </div>

    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

            <caption align="bottom">Tabla de usuarios registrados en el sistema.</caption>

            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre de usuario
                    </th>
                    <th scope="col" class="px-6 py-3">
                        correo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        verificación
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Tipo
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Estatus
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Acción
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($usuarios as $user)

                    @if ($user->id_usuario_sistema === Auth::user()->id_usuario_sistema)
                    @else
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                            wire:key="{{ $user->id_usuario_sistema }}" wire:loading.class="hidden"
                            wire:target="searching, quantity, tipo_usuario, email_verification, status, resets">

                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->id_usuario_sistema }}
                            </th>

                            <td class="px-6 py-4">
                                {{ $user->nombre }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $user->correo }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->email_verified_at == null)
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>No verificado
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>Verificado
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                @switch($user->id_tipo_usuario)
                                    @case(1)
                                        Administrador
                                    @break

                                    @case(2)
                                        Cliente
                                    @break

                                    @case(3)
                                        Gestor
                                    @break

                                    @case(4)
                                        Interesado
                                    @break

                                    @case(5)
                                        Empleado
                                    @break

                                    @case(6)
                                        SuperAdmin
                                    @break

                                    @default
                                        Personal
                                @endswitch
                            </td>

                            <td class="px-6 py-4">

                                @switch($user->id_tipo_usuario)
                                    @case(1)
                                        @if (Auth::user()->id_tipo_usuario == 6)
                                            <label for="{{ $user->id_usuario_sistema }}"
                                                class="relative inline-block h-8 w-14 cursor-pointer rounded-full bg-gray-300 transition [-webkit-tap-highlight-color:_transparent] has-[:checked]:bg-green-500"
                                                wire:click="status({{ $user->id_usuario_sistema }})"
                                                @if ($user->estatus) wire:confirm="Deseas desactivar a este usuario?" @else wire:confirm="Deseas activar a este usuario?" @endif
                                                wire:loading.class="hidden"
                                                wire:target="status({{ $user->id_usuario_sistema }})">

                                                <input type="checkbox" id="{{ $user->id_usuario_sistema }}"
                                                    class="peer sr-only [&:checked_+_span_svg[data-checked-icon]]:block [&:checked_+_span_svg[data-unchecked-icon]]:hidden"
                                                    @if ($user->estatus) checked @endif
                                                    @disabled(true) />

                                                <span
                                                    class="absolute inset-y-0 start-0 z-10 m-1 inline-flex size-6 items-center justify-center rounded-full bg-white text-gray-400 transition-all peer-checked:start-6 peer-checked:text-green-600">
                                                    <svg data-unchecked-icon xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>

                                                    <svg data-checked-icon xmlns="http://www.w3.org/2000/svg"
                                                        class="hidden size-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </label>

                                            <label for="" wire:loading
                                                wire:target="status({{ $user->id_usuario_sistema }})">Cargando...</label>
                                        @else
                                            @if ($user->estatus)
                                                <h1>Activo</h1>
                                            @else
                                                <h1>inactivo</h1>
                                            @endif
                                        @endif
                                    @break

                                    @case(6)
                                        @if (Auth::user()->id_tipo_usuario == 6)
                                            <label for="{{ $user->id_usuario_sistema }}"
                                                class="relative inline-block h-8 w-14 cursor-pointer rounded-full bg-gray-300 transition [-webkit-tap-highlight-color:_transparent] has-[:checked]:bg-green-500"
                                                wire:click="status({{ $user->id_usuario_sistema }})"
                                                @if ($user->estatus) wire:confirm="Deseas desactivar a este usuario?" @else wire:confirm="Deseas activar a este usuario?" @endif
                                                wire:loading.class="hidden"
                                                wire:target="status({{ $user->id_usuario_sistema }})">


                                                <input type="checkbox" id="{{ $user->id_usuario_sistema }}"
                                                    class="peer sr-only [&:checked_+_span_svg[data-checked-icon]]:block [&:checked_+_span_svg[data-unchecked-icon]]:hidden"
                                                    @if ($user->estatus) checked @endif
                                                    @disabled(true) />

                                                <span
                                                    class="absolute inset-y-0 start-0 z-10 m-1 inline-flex size-6 items-center justify-center rounded-full bg-white text-gray-400 transition-all peer-checked:start-6 peer-checked:text-green-600">
                                                    <svg data-unchecked-icon xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>

                                                    <svg data-checked-icon xmlns="http://www.w3.org/2000/svg"
                                                        class="hidden size-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </label>

                                            <label for="" wire:loading
                                                wire:target="status({{ $user->id_usuario_sistema }})">Cargando...</label>
                                        @else
                                            @if ($user->estatus)
                                                <h1>Activo</h1>
                                            @else
                                                <h1>inactivo</h1>
                                            @endif
                                        @endif
                                    @break

                                    @default
                                        <label for="{{ $user->id_usuario_sistema }}"
                                            class="relative inline-block h-8 w-14 cursor-pointer rounded-full bg-gray-300 transition [-webkit-tap-highlight-color:_transparent] has-[:checked]:bg-green-500"
                                            wire:click="state({{ $user->id_usuario_sistema }})"
                                            @if ($user->estatus) wire:confirm="Deseas desactivar a este usuario?" @else wire:confirm="Deseas activar a este usuario?" @endif
                                            wire:loading.class="hidden" wire:target="state({{ $user->id_usuario_sistema }})">


                                            <input type="checkbox" id="{{ $user->id_usuario_sistema }}"
                                                class="peer sr-only [&:checked_+_span_svg[data-checked-icon]]:block [&:checked_+_span_svg[data-unchecked-icon]]:hidden"
                                                @if ($user->estatus) checked @endif
                                                @disabled(true) />

                                            <span
                                                class="absolute inset-y-0 start-0 z-10 m-1 inline-flex size-6 items-center justify-center rounded-full bg-white text-gray-400 transition-all peer-checked:start-6 peer-checked:text-green-600">
                                                <svg data-unchecked-icon xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                <svg data-checked-icon xmlns="http://www.w3.org/2000/svg"
                                                    class="hidden size-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </label>

                                        <label for="" wire:loading
                                            wire:target="state({{ $user->id_usuario_sistema }})">Cargando...</label>
                                @endswitch
                            </td>

                            <td class="px-6 py-4">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Visualizar</a>
                            </td>

                        </tr>
                    @endif

                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" wire:loading.class="hidden"
                            wire:target="searching, quantity, tipo_usuario, email_verification, status, resets">
                            <th scope="row" colspan="7"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                Usuarios no encontrados
                            </th>
                        </tr>
                    @endforelse

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hidden"
                        wire:loading.class.remove="hidden"
                        wire:target="searching, quantity, tipo_usuario, email_verification, status, resets">
                        <th scope="row" colspan="7"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            Cargando...
                        </th>
                    </tr>

                </tbody>

            </table>

        </div>

        <div class="mt-5">
            {{ $usuarios->links() }}
        </div>

        {{--  --}}
        <x-dialog-modal wire:model="open">

            <x-slot name="title">
                Crear nuevo usuario
                <div class="">
                    <div class="py-2">
                        <div class="border-t border-gray-200 dark:border-gray-700"></div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="content">
                <form action="">

                    <div class="">
                        <x-label-tooltip value="{{ __('Nombre de usuario') }}"
                            message-text="El nombre de usuario debe tener un mínimo de 3 caracteres y un máximo de 150 caracteres." />
                        <x-input name="nombre" id="nombre" placeholder="Nombre de usuario" class="w-full"
                            wire:model="nombre" />
                        @error('nombre')
                            <x-input-error for="nombre" class="mt-2" />
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label class="mb-1">Correo electrónico:</x-label>
                        <x-input name="email" id="email" placeholder="Correo" class="w-full"
                            wire:model="email" />
                        @error('email')
                            <x-input-error for="email" class="mt-2" />
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label-tooltip value="{{ __('Contraseña') }}"
                            message-text="La contraseña debe contener, mínimo 8 caracteres, combinación de números y letras, utilizar al menos una mayúscula y un símbolo." />
                        <x-input name="password" id="contraseña" placeholder="Contraseña" class="w-full"
                            type="password" wire:model="password" />

                        @error('password')
                            <x-input-error for="password" class="mt-2" />
                        @enderror

                    </div>

                    <div class="mt-4">
                        <x-label class="mb-1">Confirmar contraseña:</x-label>
                        <x-input name="password_confirmation" id="password_confirmation"
                            placeholder="Confirmar contraseña" class="w-full" type="password"
                            wire:model="password_confirmation" />
                    </div>

                    <div class="mt-4">
                        <x-label class="mb-1">Tipo de usuario:</x-label>
                        <x-select name="" id="" class="rounded-md block w-full" wire:model="type">
                            <option value="0" disabled>Seleccione</option>
                            @forelse ($tipos as $tipo)
                                @if ($tipo->descripcion == 'Usuario')
                                    <option value="{{ $tipo->id_tipo_usuario }}"
                                        wire:key="{{ $tipo->id_tipo_usuario }}">
                                        Clientes</option>
                                @else
                                    @switch($tipo->id_tipo_usuario)
                                        @case(1)
                                            @if (Auth::user()->id_tipo_usuario == 6)
                                                <option value="{{ $tipo->id_tipo_usuario }}"
                                                    wire:key="{{ $tipo->id_tipo_usuario }}">
                                                    {{ $tipo->descripcion }}</option>
                                            @else
                                            @endif
                                        @break

                                        @case(6)
                                            @if (Auth::user()->id_tipo_usuario == 6)
                                                <option value="{{ $tipo->id_tipo_usuario }}"
                                                    wire:key="{{ $tipo->id_tipo_usuario }}">
                                                    {{ $tipo->descripcion }}</option>
                                            @else
                                            @endif
                                        @break

                                        @default
                                            <option value="{{ $tipo->id_tipo_usuario }}"
                                                wire:key="{{ $tipo->id_tipo_usuario }}">
                                                {{ $tipo->descripcion }}</option>
                                    @endswitch
                                @endif
                                @empty
                                    <option value="">Sin resultados</option>
                                @endforelse
                            </x-select>
                            @error('type')
                                <x-input-error for="type" class="mt-2" />
                            @enderror
                        </div>

                    </form>
                </x-slot>

                <x-slot name="footer">
                    <div class="w-full flex justify-between px-20">
                        <x-button wire:click="save" wire:loading.attr="disabled" wire:loading.class="cursor-wait"
                            wire:target="save">Guardar</x-button>
                        <x-danger-button wire:click="close_modal" wire:loading.attr="disabled"
                            wire:target="close_modal">Cancelar</x-danger-button>

                    </div>
                </x-slot>

            </x-dialog-modal>

            <div class="bg-gray-500 dark:bg-gray-900 opacity-75 fixed z-[10000] left-0 top-0 h-screen w-full flex items-center justify-center hidden"
                wire:loading.class.remove="hidden" wire:target="modal">

                <div class="preloader_box">
                    <img src="{{ asset('images/G_Logo.png') }}" alt="" class="preloader_img">
                    <div class="lds-dual-ring"></div>
                </div>

            </div>

        </div>
