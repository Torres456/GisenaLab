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
                        Nombre Análisis Específicos
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Descripción
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Tipo de Análisis
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Clave Análisis
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Capacidad Instalada
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Editar
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Estatus
                    </th>
                </tr>
            </thead>
            @if ($count != 0)
                <tbody>
                    @foreach ($analisis_especificos as $analisis_especifico)
                        <x-tr>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ $analisis_especifico->id_analisis_especifico }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $analisis_especifico->nombre_comercial }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $analisis_especifico->descripcion }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $analisis_especifico->tipo_analisis->nomb_tipo_analisis }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $analisis_especifico->clave_analisis }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $analisis_especifico->capacidad_instalada }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button
                                    wire:click="edit_register({{ $analisis_especifico->id_analisis_especifico }})">
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
                                @if ($analisis_especifico->estatus == 1)
                                    <x-button
                                        wire:click="estatus_register({{ $analisis_especifico->id_analisis_especifico }})">
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
                                        wire:click="estatus_register({{ $analisis_especifico->id_analisis_especifico }})">
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
                        </x-tr>
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
        {{ $analisis_especificos->Links() }}
    </div>

    <x-dialog-modal wire:model="new">
        <x-slot name='title'>
            <h2 class="text-center">Nueva Análisis Especifico</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="new_form">
                <div>
                    <x-label>Nombre Comercial:</x-label>
                    <x-input wire:model="newRegister.nombre" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="newRegister.nombre" />
                </div>
                <div>
                    <x-label>Descripción:</x-label>
                    <x-textarea wire:model="newRegister.descripcion" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)"></x-textarea>
                    <x-input-error for="newRegister.descripcion" />
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div>
                        <x-label>Tipo Análisis:</x-label>
                        <x-select wire:model="newRegister.tipo" type="text" class="block mt-1 w-full">\
                            <option value="">Seleccione una opción</option>
                            @foreach ($Tipo_Analisis as $Tipo_Analisi)
                                <option value="{{ $Tipo_Analisi->id_tipo_analisis }}">
                                    {{ $Tipo_Analisi->nomb_tipo_analisis }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="newRegister.tipo" />
                    </div>
                    <div>
                        <x-label>Clave Análisis:</x-label>
                        <x-input wire:model="newRegister.clave" type="text" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.clave" />
                    </div>

                </div>

                <div>
                    <x-label>Acreditación o control de calidad:</x-label>
                    <x-input wire:model="newRegister.reconocimiento" type="text" class="block mt-1 w-full" />
                    <x-input-error for="newRegister.reconocimiento" />
                </div>
                <div>
                    <x-label>Nombre Técnico:</x-label>
                    <x-input wire:model="newRegister.tecnico" type="text" class="block mt-1 w-full" />
                    <x-input-error for="newRegister.tecnico" />
                </div>
                <div>
                    <x-label>Referencia Normativa:</x-label>
                    <x-input wire:model="newRegister.normativa" type="text" class="block mt-1 w-full" />
                    <x-input-error for="newRegister.normativa" />
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div>
                        <x-label>Aprobación:</x-label>
                        <x-input wire:model="newRegister.aprobacion" type="text" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.aprobacion" />
                    </div>
                    <div>
                        <x-label>Autorización:</x-label>
                        <x-input wire:model="newRegister.autorizacion" type="text" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.autorizacion" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div>
                        <x-label>Precio Normal: <span class=" text-slate-500">(Sin IVA)</span></x-label>
                        <x-input wire:model="newRegister.precio_ordinario" type="number"
                            class="block mt-1 w-full" />
                        <x-input-error for="newRegister.precio_ordinario" />
                    </div>
                    <div>
                        <x-label>Precio Urgente: <span class=" text-slate-500">(Sin IVA)</span></x-label>
                        <x-input wire:model="newRegister.precio_urgente" type="number" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.precio_urgente" />
                    </div>
                    <div>
                        <x-label>Tiempo Normal: <span class=" text-slate-500">(Días)</span></x-label>
                        <x-input wire:model="newRegister.tiempo_ordinario" type="number"
                            class="block mt-1 w-full" />
                        <x-input-error for="newRegister.tiempo_ordinario" />
                    </div>
                    <div>
                        <x-label>Tiempo Urgente: <span class=" text-slate-500">(Días)</span></x-label>
                        <x-input wire:model="newRegister.tiempo_urgente" type="number" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.tiempo_urgente" />
                    </div>
                </div>
                <div>
                    <x-label>Capacidad Instalada: </x-label>
                    <x-input wire:model="newRegister.capacidad" type="number" class="block mt-1 w-full" />
                    <x-input-error for="newRegister.capacidad" />
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
            <h2 class="text-center">Editar Análisis Especifico</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="edit_form">
                <div>
                    <x-label>Nombre Comercial:</x-label>
                    <x-input wire:model="editRegister.nombre" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="editRegister.nombre" />
                </div>
                <div>
                    <x-label>Descripción:</x-label>
                    <x-textarea wire:model="editRegister.descripcion" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)"></x-textarea>
                    <x-input-error for="editRegister.descripcion" />
                </div>
                <div>
                    <x-label>Tipo Análisis:</x-label>
                    <x-select wire:model="editRegister.tipo" type="text" class="block mt-1 w-full">\
                        <option value="">Seleccione una opción</option>
                        @foreach ($Tipo_Analisis as $Tipo_Analisi)
                            <option value="{{ $Tipo_Analisi->id_tipo_analisis }}">
                                {{ $Tipo_Analisi->nomb_tipo_analisis }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="editRegister.tipo" />
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div>
                        <x-label>Clave Análisis:</x-label>
                        <x-input wire:model="editRegister.clave" type="text" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.clave" />
                    </div>
                    <div>
                        <x-label>Acreditación o control de calidad:</x-label>
                        <x-input wire:model="editRegister.reconocimiento" type="text" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.reconocimiento" />
                    </div>
                </div>
                <div>
                    <x-label>Nombre Técnico:</x-label>
                    <x-input wire:model="editRegister.tecnico" type="text" class="block mt-1 w-full" />
                    <x-input-error for="editRegister.tecnico" />
                </div>
                <div>
                    <x-label>Referencia Normativa:</x-label>
                    <x-input wire:model="editRegister.normativa" type="text" class="block mt-1 w-full" />
                    <x-input-error for="editRegister.normativa" />
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div>
                        <x-label>Aprobación:</x-label>
                        <x-input wire:model="editRegister.aprobacion" type="text" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.aprobacion" />
                    </div>
                    <div>
                        <x-label>Autorización:</x-label>
                        <x-input wire:model="editRegister.autorizacion" type="text" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.autorizacion" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div>
                        <x-label>Precio Normal: <span class=" text-slate-500">(Sin IVA)</span></x-label>
                        <x-input wire:model="editRegister.precio_ordinario" type="number"
                            class="block mt-1 w-full" />
                        <x-input-error for="editRegister.precio_ordinario" />
                    </div>
                    <div>
                        <x-label>Precio Urgente: <span class=" text-slate-500">(Sin IVA)</span></x-label>
                        <x-input wire:model="editRegister.precio_urgente" type="number" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.precio_urgente" />
                    </div>
                    <div>
                        <x-label>Tiempo Normal: <span class=" text-slate-500">(Días)</span></x-label>
                        <x-input wire:model="editRegister.tiempo_ordinario" type="number"
                            class="block mt-1 w-full" />
                        <x-input-error for="editRegister.tiempo_ordinario" />
                    </div>
                    <div>
                        <x-label>Tiempo Urgente: <span class=" text-slate-500">(Días)</span></x-label>
                        <x-input wire:model="editRegister.tiempo_urgente" type="number" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.tiempo_urgente" />
                    </div>
                </div>
                <div>
                    <x-label>Capacidad Instalada: </x-label>
                    <x-input wire:model="editRegister.capacidad" type="number" class="block mt-1 w-full" />
                    <x-input-error for="editRegister.capacidad" />
                </div>
                <div class="mt-5 flex justify-around">
                    <x-button>Guardar</x-button>
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
