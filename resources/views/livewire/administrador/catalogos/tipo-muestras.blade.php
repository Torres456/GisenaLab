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
                <x-input wire:model.live="search" placeholder="(Nombre tipo de muestra)" class="w-full" />
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
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-center ">
                        Nombre Tipo Muestra
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Características
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Subcategoría
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Unidad Medida
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Editar
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Estatus
                    </th>
                </tr>
            </thead>
            @if ($count !== 0)
                <tbody>
                    @foreach ($tipo_muestras as $tipo_muestra)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ $tipo_muestra->id_tipo_muestra }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $tipo_muestra->nom_tipo_muestra }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $tipo_muestra->caracteristicas }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $tipo_muestra->subcategoria->nom_subcategoria }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $tipo_muestra->unidad_medidas->nombre_unidad }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="edit_register({{ $tipo_muestra->id_tipo_muestra }})">
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
                            <x-td>
                                @if ($tipo_muestra->estatus == 1)
                                    <x-button wire:click="estatus_register({{ $tipo_muestra->id_tipo_muestra }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-check">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M9 15l2 2l4 -4" />
                                        </svg>
                                    </x-button>
                                @else
                                    <x-danger-button
                                        wire:click="estatus_register({{ $tipo_muestra->id_tipo_muestra }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-x">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M10 12l4 4m0 -4l-4 4" />
                                        </svg>
                                    </x-danger-button>
                                @endif
                            </x-td>
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
        {{ $tipo_muestras->links() }}
    </div>

    <x-dialog-modal wire:model="new">
        <x-slot name='title'>
            <h2 class="text-center">Nuevo Tipo de Muestra</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="new_form">
                <div>
                    <x-label>Nombre Tipo de Muestra:</x-label>
                    <x-input wire:model="newRegister.nombre" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="newRegister.nombre" />
                </div>

                <div>
                    <x-label>Características:</x-label>
                    <x-textarea wire:model="newRegister.caracteristicas" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)"></x-textarea>
                    <x-input-error for="newRegister.caracteristicas" />
                </div>
                <div class=" grid grid-cols-2 gap-5 max-md:grid-cols-1">
                    <div>
                        <x-label>Cantidad Requrida:</x-label>
                        <x-input wire:model="newRegister.requerido" type="text" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.requerido" />
                    </div>
                    <div>
                        <x-label>Unidad Medida:</x-label>
                        <x-select wire:model="newRegister.unidad" type="text" class="block mt-1 w-full">\
                            <option value="">Seleccione una opción</option>
                            @foreach ($unidad_medidas as $unidad_medida)
                                <option value="{{ $unidad_medida->id_unidad_medida }}">
                                    {{ $unidad_medida->abreviatura . ' - ' . $unidad_medida->nombre_unidad }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error for="newRegister.unidad" />
                    </div>
                </div>
                <div class=" grid grid-cols-2 gap-5 max-md:grid-cols-1">
                    <div>
                        <x-label>Subcategoría:</x-label>
                        <x-select wire:model="newRegister.subcategoria" type="text" class="block mt-1 w-full">\
                            <option value="">Seleccione una opción</option>
                            @foreach ($subcategorias as $subcategoria)
                                <option value="{{ $subcategoria->id_subcategoria }}">
                                    {{ $subcategoria->nom_subcategoria }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error for="newRegister.subcategoria" />
                    </div>
                    <div>
                        <x-label>Unidad Metodo:</x-label>
                        <x-select wire:model="newRegister.metodo" type="text" class="block mt-1 w-full">\
                            <option value="">Seleccione una opción</option>
                            @foreach ($unidad_metodos as $unidad_metodo)
                                <option value="{{ $unidad_metodo->id_unidad_metodo }}">
                                    {{ $unidad_metodo->descripcion }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error for="newRegister.metodo" />
                    </div>
                </div>

                <div class="mt-5 flex justify-around">
                    <x-button>Agregar</x-button>
                    <x-danger-button wire:click="new_cancel">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>



    <x-dialog-modal wire:model="edit">
        <x-slot name='title'>
            <h2 class="text-center">Nuevo Tipo de Muestra</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="edit_form">
                <div>
                    <x-label>Nombre Tipo de Muestra:</x-label>
                    <x-input wire:model="editRegister.nombre" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="editRegister.nombre" />
                </div>

                <div>
                    <x-label>Características:</x-label>
                    <x-textarea wire:model="editRegister.caracteristicas" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)"></x-textarea>
                    <x-input-error for="editRegister.caracteristicas" />
                </div>
                <div class=" grid grid-cols-2 gap-5 max-md:grid-cols-1">
                    <div>
                        <x-label>Cantidad Requrida:</x-label>
                        <x-input wire:model="editRegister.requerido" type="text" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.requerido" />
                    </div>
                    <div>
                        <x-label>Unidad Medida:</x-label>
                        <x-select wire:model="editRegister.unidad" type="text" class="block mt-1 w-full">\
                            <option value="">Seleccione una opción</option>
                            @foreach ($unidad_medidas as $unidad_medida)
                                <option value="{{ $unidad_medida->id_unidad_medida }}">
                                    {{ $unidad_medida->nombre_unidad }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error for="editRegister.unidad" />
                    </div>
                </div>
                <div class=" grid grid-cols-2 gap-5 max-md:grid-cols-1">
                    <div>
                        <x-label>Subcategoría:</x-label>
                        <x-select wire:model="editRegister.subcategoria" type="text" class="block mt-1 w-full">\
                            <option value="">Seleccione una opción</option>
                            @foreach ($subcategorias as $subcategoria)
                                <option value="{{ $subcategoria->id_subcategoria }}">
                                    {{ $subcategoria->nom_subcategoria }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error for="editRegister.subcategoria" />
                    </div>

                    <div>
                        <x-label>Unidad Metodo:</x-label>
                        <x-select wire:model="editRegister.metodo" type="text" class="block mt-1 w-full">\
                            <option value="">Seleccione una opción</option>
                            @foreach ($unidad_metodos as $unidad_metodo)
                                <option value="{{ $unidad_metodo->id_unidad_metodo }}">
                                    {{ $unidad_metodo->descripcion }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error for="editRegister.metodo" />
                    </div>
                </div>

                <div class="mt-5 flex justify-around">
                    <x-button>Editar</x-button>
                    <x-danger-button wire:click="edit_cancel">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="status">
        <x-slot name='title'>
            <h2 class="text-center">¿Desea cambiar el estatus?</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="mt-5 flex justify-around">
                <x-button wire:click="status_update">Guardar</x-button>
                <x-danger-button wire:click="status_cancel">Cancelar</x-danger-button>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>
</div>
