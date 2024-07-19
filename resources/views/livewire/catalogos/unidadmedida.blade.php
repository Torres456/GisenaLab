<div>
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
                <x-input wire:model.live="search" placeholder="(Nombre análisis)" class="w-full" />
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
            </svg> Nuevo
        </x-button>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Nombre unidad medida
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Abreviatura
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Editar
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{ $dato->id_unidad_medida }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ $dato->nombre_unidad }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $dato->abreviatura }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <x-button wire:click="edit_register({{ $dato->id_unidad_medida }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg>
                            </x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-5">
        {{ $datos->links() }}
    </div>

    <x-dialog-modal wire:model="new">
        <x-slot name='title'>
            <h2 class="text-center">Nueva Unidad de medida</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="new_form">
                <div>
                    <x-label>Nombre Unidad:</x-label>
                    <x-input wire:model="newRegister.descripcion" type="text" class="block mt-1 w-full" />
                    <x-input-error for="newRegister.descripcion" />
                </div>
                <div>
                    <x-label>Abreviatura de Unidad:</x-label>
                    <x-input wire:model="newRegister.abreviatura" type="text" class="block mt-1 w-full" />
                    <x-input-error for="newRegister.abreviatura" />
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
            <h2 class="text-center">Editar Unidad de medida</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="edit_form">
                <div>
                    <x-label>Nombre Unidad:</x-label>
                    <x-input wire:model="editRegister.descripcion" type="text" class="block mt-1 w-full" />
                    <x-input-error for="editRegister.descripcion" />
                </div>
                <div>
                    <x-label>Abreviatura de Unidad:</x-label>
                    <x-input wire:model="editRegister.abreviatura" type="text" class="block mt-1 w-full" />
                    <x-input-error for="editRegister.abreviatura" />
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
