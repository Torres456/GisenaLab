<div class="felex flex-col">
    <div>
        <x-message />
        <div class="flex gap-3 items-center dark:text-white mb-5 max-md:flex-col">
            <div class="flex flex-row w-full gap-2">
                <div class="flex flex-col">
                    <label for="">Mostrar:</label>
                    <x-select wire:model.live="view_dates">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </x-select>
                </div>
                <div class="flex flex-col w-full">
                    <label for="">Buscar:</label>
                    <x-input wire:model.live="search" placeholder="(Nombre o correo del cliente)" class="w-full" />
                </div>
            </div>
            {{-- <x-button wire:click="new_register"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-plus">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                <path d="M12 11l0 6" />
                <path d="M9 14l6 0" />
            </svg> Nuevo</x-button>  --}}
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        Id Cliente
                    </th>
                    <th scope="col" class="px-6 py-3 text-center ">
                        Razón social
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        RFC Cliente
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Régimen fiscal
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Correos
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Teléfonos
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Gestor
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Direcciónes
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Contacto
                    </th>

                </tr>
            </thead>
            @if ($count != 0)
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center" wire:key='{{$cliente->id_cliente}}'>
                                {{ $cliente->id_cliente }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $cliente->razon_social }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $cliente->rfc }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $cliente->regimen_fiscal }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $cliente->correo }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $cliente->telefono }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($cliente->id_gestor)
                                    <x-button wire:click="gestor_register({{ $cliente->id_cliente }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                            <path
                                                d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                        </svg><p class="ml-2">{{$cliente->gestor->nombre . ' ' . $cliente->gestor->ap_paterno . ' ' . $cliente->gestor->ap_materno}}</p>
                                    </x-button>
                                @else
                                    <x-button wire:click="gestor_register({{ $cliente->id_cliente }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M16 19h6" />
                                            <path d="M19 16v6" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                        </svg><p class="ml-2">Asignar</p>
                                    </x-button>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="direc_register({{ $cliente->id_cliente }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-buildings">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 21v-15c0 -1 1 -2 2 -2h5c1 0 2 1 2 2v15" />
                                        <path d="M16 8h2c1 0 2 1 2 2v11" />
                                        <path d="M3 21h18" />
                                        <path d="M10 12v0" />
                                        <path d="M10 16v0" />
                                        <path d="M10 8v0" />
                                        <path d="M7 12v0" />
                                        <path d="M7 16v0" />
                                        <path d="M7 8v0" />
                                        <path d="M17 12v0" />
                                        <path d="M17 16v0" />
                                    </svg>
                                </x-button>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="contac_register({{ $cliente->id_cliente }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-address-book">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                                        <path d="M10 16h6" />
                                        <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M4 8h3" />
                                        <path d="M4 12h3" />
                                        <path d="M4 16h3" />
                                    </svg>
                                </x-button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            @else
                <tbody>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 ">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            No se encontraron resultados
                        </th>
                    </tr>
                </tbody>
            @endif
        </table>
    </div>
    <div class="p-5">
        {{ $clientes->links() }}
    </div>

    <x-dialog-modal wire:model="direct">
        <x-slot name='title'>
            <h2 class="text-center">Dirección</h2>
        </x-slot>
        <x-slot name='content'>
            @livewire('componentes.cliente.direcciones',[
                'direcId'=> $direcId,
            ])
        </x-slot>
        <x-slot name='footer'>
            <div class="">
                <x-danger-button wire:click="direct_cancel">Cerrar</x-danger-button>
            </div>
        </x-slot>
    </x-dialog-modal>


    <x-dialog-modal wire:model="contac">
        <x-slot name='title'>
            <h2 class="text-center">Contacto</h2>
        </x-slot>
        <x-slot name='content'>
            <div>
                <x-label>Nombre(s):</x-label>
                <x-input wire:model="contactRegister.nombre_contac" class="block mt-1 w-full" disabled />
                <x-input-error for="contactRegister.nombre_contac" />
            </div>
            <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-3">
                <div>
                    <x-label>A. Materno:</x-label>
                    <x-input wire:model="contactRegister.materno_contac" class="block mt-1 w-full" disabled />
                    <x-input-error for="contactRegister.materno_contac" />
                </div>
                <div>
                    <x-label>A Paterno:</x-label>
                    <x-input wire:model="contactRegister.paterno_contac" class="block mt-1 w-full" disabled />
                    <x-input-error for="contactRegister.paterno_contac" />
                </div>
            </div>

            <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-2">
                <div>
                    <x-label>Correo:</x-label>
                    <x-input wire:model="contactRegister.correo_contact" class="block mt-1 w-full" disabled />
                    <x-input-error for="contactRegister.correo_contact" />
                </div>
                <div>
                    <x-label>Correo alternativo:</x-label>
                    <x-input wire:model="contactRegister.correo_alter_contact" type="text"
                        class="block mt-1 w-full" disabled />
                    <x-input-error for="contactRegister.correo_alter_contact" />
                </div>
            </div>
            <div>
                <x-label>Teléfono:</x-label>
                <x-input wire:model="contactRegister.telefono_contact" type="text" class="block mt-1 w-full"
                    disabled />
                <x-input-error for="contactRegister.telefono_contact" />
            </div>
            <div>
                <x-label>Teléfono alternativo:</x-label>
                <x-input wire:model="contactRegister.telefono_alter_contact" type="text" class="block mt-1 w-full"
                    disabled />
                <x-input-error for="contactRegister.telefono_alter_contact" />
            </div>
        </x-slot>
        <x-slot name='footer'>
            <div class="">
                <x-danger-button wire:click="direct_cancel">Cerrar</x-danger-button>
            </div>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="gestor">
        <x-slot name='title'>
            <h2 class="text-center">Contacto</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit='edit_Gestor'>
                <div>
                    <x-label>Gestor:</x-label>
                    <x-select wire:model="gestorRegister.gestor" class="block mt-1 w-full" >
                        <option value="">Seleccione un gestor</option>
                        @foreach($gestores as $gestor)
                            <option value="{{ $gestor->id_gestor }}">{{ $gestor->nombre . ' ' . $gestor->ap_paterno . ' ' . $gestor->ap_materno }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="gestorRegister.gestor" />
                </div>
                <div class="w-full flex justify-between mt-5">
                    <x-button>Guardar</x-button>
                    <x-danger-button wire:click="direct_cancel">Cerrar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>
</div>
