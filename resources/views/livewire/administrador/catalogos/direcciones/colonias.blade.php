<div>
    <x-message />
    <div class="flex gap-3 items-center dark:text-white mb-5 max-md:flex-col">
        <div class="flex flex-row w-full gap-2 max-md:flex-col">
            <div class="flex gap-2">
                <div class="flex flex-col ">
                    <label for="">Mostrar:</label>
                    <x-select wire:model.live="view_dates">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </x-select>
                </div>
                <div class="flex flex-col max-md:w-full">
                    <label for="">Municipio:</label>
                    <x-select wire:model.live="search_stade" class="max-md:w-full">
                        <option value="">Todos</option>
                        @foreach ($municipios as $municipio)
                            <option value="{{ $municipio->id_municipio }}">{{ $municipio->nombre }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="flex flex-col w-full">
                <label for="">Buscar:</label>
                <x-input wire:model.live="search" placeholder="(Nombre o clave de la colonia)" class="w-full" />
            </div>
        </div>
        <x-button wire:click="new_register"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-plus">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                <path d="M12 11l0 6" />
                <path d="M9 14l6 0" />
            </svg> Nuevo</x-button>
    </div>
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        Clave
                    </th>
                    <th scope="col" class="px-6 py-3 text-center ">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 text-center ">
                        Municipio
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Editar
                    </th>
                </tr>
            </thead>
            @if ($count != 0)
                <tbody>
                    @foreach ($colonias as $colonia)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ $colonia->clave_colonia }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $colonia->nombre }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $colonia->municipio->nombre }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="edit_register({{ $colonia->id_colonia }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path
                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
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
        {{ $colonias->links() }}
    </div>

    <x-dialog-modal wire:model="new">
        <x-slot name='title'>
            <h2 class="text-center">Nueva Colonia</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="new_form">
                <div>
                    <x-label>Nombre colonia:</x-label>
                    <x-input wire:model="newRegister.nombre" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="newRegister.nombre" />
                </div>
                <div>
                    <x-label>Clave colonia:</x-label>
                    <x-input wire:model="newRegister.descripcion" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="newRegister.descripcion" />
                </div>
                <div>
                    <x-label>Municipio:</x-label>
                    <x-select wire:model="newRegister.municipio" class="w-full">
                        <option value="">Seleccione un municipio</option>
                        @foreach ($municipios as $municipio)
                            <option value="{{ $municipio->id_municipio }}">{{ $municipio->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newRegister.municipio" />
                </div>
                <div class="mt-5 flex justify-around">
                    <x-button>Guardar</x-button>
                    <x-danger-button wire:click="new_cancel">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>



    <x-dialog-modal wire:model="edit">
        <x-slot name='title'>
            <h2 class="text-center">Editar Colonia</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="edit_form">
                <div>
                    <x-label>Nombre colonia:</x-label>
                    <x-input wire:model="editRegister.nombre" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="editRegister.nombre" />
                </div>
                <div>
                    <x-label>Clave colonia:</x-label>
                    <x-input wire:model="editRegister.descripcion" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="editRegister.descripcion" />
                </div>
                <div>
                    <x-label>Municipio:</x-label>
                    <x-select wire:model="editRegister.municipio" class="w-full">
                        <option value="">Seleccione un municipio</option>
                        @foreach ($municipios as $municipio)
                            <option value="{{ $municipio->id_municipio }}">{{ $municipio->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="editRegister.municipio" />
                </div>
                <div class="mt-5 flex justify-around">
                    <x-button>Guardar</x-button>
                    <x-danger-button wire:click="edit_cancel">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>
</div>
