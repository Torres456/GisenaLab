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
            </div>
            <div class="flex flex-col w-full">
                <label for="">Buscar:</label>
                <x-input wire:model.live="search" placeholder="(Nombre o correo del gestor)" class="w-full" />
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
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-center ">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 text-center ">
                        Teléfono
                    </th>
                    <th scope="col" class="px-6 py-3 text-center ">
                        Correo
                    </th>
                    <th scope="col" class="px-6 py-3 text-center ">
                        Zona de representación
                    </th>
                    <th scope="col" class="px-6 py-3 text-center ">
                        Dirección
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Editar
                    </th>
                </tr>
            </thead>
            @if ($count != 0)
                <tbody>
                    @foreach ($gestores as $gestor)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ $gestor->id_gestor }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $gestor->nombre . ' ' . $gestor->a_paterno . ' ' . $gestor->a_materno }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $gestor->telefono }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $gestor->correo }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $gestor->zona->nombre_zona }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click='direc_register({{ $gestor->id_gestor }})'>
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
                                <x-button wire:click="edit_register({{ $gestor->id_gestor }})">
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
        {{ $gestores->links() }}
    </div>

    <x-dialog-modal wire:model="new">
        <x-slot name='title'>
            <h2 class="text-center">Nuevo Gestor</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="new_form">
                <div>
                    <x-label>Nombre(s):</x-label>
                    <x-input wire:model="newRegister.nombre" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="newRegister.nombre" />
                </div>
                <div class="w-full grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div>
                        <x-label>A. Paterno:</x-label>
                        <x-input wire:model="newRegister.paterno" type="text" class="block mt-1 w-full"
                            onkeyup="mayuscula(this)" />
                        <x-input-error for="newRegister.paterno" />
                    </div>
                    <div>
                        <x-label>A. Materno:</x-label>
                        <x-input wire:model="newRegister.materno" type="text" class="block mt-1 w-full"
                            onkeyup="mayuscula(this)" />
                        <x-input-error for="newRegister.materno" />
                    </div>
                </div>
                <div class="w-full grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div>
                        <x-label>Telefono:</x-label>
                        <x-input wire:model="newRegister.telefono" type="text" class="block mt-1 w-full"
                            onkeyup="mayuscula(this)" />
                        <x-input-error for="newRegister.telefono" />
                    </div>
                    <div>
                        <x-label>Sexo:</x-label>
                        <x-select wire:model="newRegister.sexo" type="text" class="block mt-1 w-full">
                            <option value="">Seleccione un sexo</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </x-select>
                        <x-input-error for="newRegister.sexo" />
                    </div>
                </div>
                <div>
                    <x-label>Correo:</x-label>
                    <x-input wire:model="newRegister.correo" type="text" class="block mt-1 w-full" />
                    <x-input-error for="newRegister.correo" />
                </div>
                <div class="w-full grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div>
                        <x-label>Contraseña: <span class="text-slate-500">(Temporal)</span>:</x-label>
                        <x-input wire:model="newRegister.contrasena" type="password" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.contrasena" />
                    </div>
                    <div>
                        <x-label>Confirmar Contraseña: <span class="text-slate-500">(Temporal)</span>:</x-label>
                        <x-input wire:model="newRegister.contrasena_confirmation" type="password" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.contrasena_confirmation" />
                    </div>
                </div>
                <div>
                    <x-label>Zona Representacion:</x-label>
                    <x-select wire:model.live="newRegister.zona" type="text" class="block mt-1 w-full">
                        <option value="">Seleccione una zona</option>
                        @foreach ($zonas as $zona)
                            <option value="{{ $zona->idzona_representacion }}">{{ $zona->nombre_zona }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newRegister.zona" />
                </div>

                <div class="border-b-2 border-slate-700 my-3">
                    <p class="text-black dark:text-slate-500">Dirección</p>
                </div>

                <div>
                    <x-label>Calle:</x-label>
                    <x-input wire:model="newRegister.calle" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="newRegister.calle" />
                </div>
                <div class="w-full grid grid-cols-3 max-md:grid-cols-1 gap-3">
                    <div>
                        <x-label>No. Exterior:</x-label>
                        <x-input wire:model="newRegister.exterior" type="text" class="block mt-1 w-full"
                            onkeyup="mayuscula(this)" />
                        <x-input-error for="newRegister.exterior" />
                    </div>
                    <div>
                        <x-label>No. Interior:</x-label>
                        <x-input wire:model="newRegister.interior" type="text" class="block mt-1 w-full"
                            onkeyup="mayuscula(this)" />
                        <x-input-error for="newRegister.interior" />
                    </div>
                    <div>
                        <x-label>CP:</x-label>
                        <x-input wire:model="newRegister.cp" type="text" class="block mt-1 w-full"
                            onkeyup="mayuscula(this)" />
                        <x-input-error for="newRegister.cp" />
                    </div>
                </div>
                <div>
                    <x-label>Entre cales:</x-label>
                    <x-input wire:model="newRegister.entre" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="newRegister.entre" />
                </div>
                <div>
                    <x-label>Referencia:</x-label>
                    <x-input wire:model="newRegister.referencia" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="newRegister.referencia" />
                </div>
                <div class="w-full grid grid-cols-3 max-md:grid-cols-1 gap-3">
                    <div>
                        <x-label>Estado:</x-label>
                        <x-select wire:model.live="newRegister.estado" type="text" class="block mt-1 w-full">
                            <option value="">Seleccione un estado</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->estado->id_estado }}">{{ $estado->estado->nombre }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="newRegister.estado" />
                    </div>
                    <div>
                        <x-label>Municipio:</x-label>
                        <x-select wire:model.live="newRegister.municipio" type="text" class="block mt-1 w-full">
                            <option value="">Seleccione un municipio</option>
                            @foreach ($municipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}">{{ $municipio->nombre }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="newRegister.municipio" />
                    </div>
                    <div>
                        <x-label>Colinia:</x-label>
                        <x-select wire:model="newRegister.colonia" type="text" class="block mt-1 w-full">
                            <option value="">Seleccione una colonia</option>
                            @foreach ($colonias as $colonia)
                                <option value="{{ $colonia->id_colonia }}">{{ $colonia->nombre }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="newRegister.colonia" />
                    </div>
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
            <h2 class="text-center">Editar Gestor</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="edit_form">
                <div>
                    <x-label>Nombre(s):</x-label>
                    <x-input wire:model="editRegister.nombre" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="editRegister.nombre" />
                </div>
                <div class="w-full grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div>
                        <x-label>A. Paterno:</x-label>
                        <x-input wire:model="editRegister.paterno" type="text" class="block mt-1 w-full"
                            onkeyup="mayuscula(this)" />
                        <x-input-error for="editRegister.paterno" />
                    </div>
                    <div>
                        <x-label>A. Materno:</x-label>
                        <x-input wire:model="editRegister.materno" type="text" class="block mt-1 w-full"
                            onkeyup="mayuscula(this)" />
                        <x-input-error for="editRegister.materno" />
                    </div>
                </div>
                <div class="w-full grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div>
                        <x-label>Telefono:</x-label>
                        <x-input wire:model="editRegister.telefono" type="text" class="block mt-1 w-full"
                            onkeyup="mayuscula(this)" />
                        <x-input-error for="editRegister.telefono" />
                    </div>
                    <div>
                        <x-label>Sexo:</x-label>
                        <x-select wire:model="editRegister.sexo" type="text" class="block mt-1 w-full">
                            <option value="">Seleccione un sexo</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </x-select>
                        <x-input-error for="editRegister.sexo" />
                    </div>
                </div>
                <div>
                    <x-label>Correo:</x-label>
                    <x-input wire:model="editRegister.correo" type="text" class="block mt-1 w-full" />
                    <x-input-error for="editRegister.correo" />
                </div>
                <div>
                    <x-label>Zona Representacion:</x-label>
                    <x-select wire:model.live="editRegister.zona" type="text" class="block mt-1 w-full">
                        <option value="">Seleccione una zona</option>
                        @foreach ($zonas as $zona)
                            <option value="{{ $zona->idzona_representacion }}">{{ $zona->nombre_zona }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="editRegister.zona" />
                </div>

                <div class="border-b-2 border-slate-700 my-3">
                    <p class="text-black dark:text-slate-500">Dirección</p>
                </div>

                <div>
                    <x-label>Calle:</x-label>
                    <x-input wire:model="editRegister.calle" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="editRegister.calle" />
                </div>
                <div class="w-full grid grid-cols-3 max-md:grid-cols-1 gap-3">
                    <div>
                        <x-label>No. Exterior:</x-label>
                        <x-input wire:model="editRegister.exterior" type="text" class="block mt-1 w-full"
                            onkeyup="mayuscula(this)" />
                        <x-input-error for="editRegister.exterior" />
                    </div>
                    <div>
                        <x-label>No. Interior:</x-label>
                        <x-input wire:model="editRegister.interior" type="text" class="block mt-1 w-full"
                            onkeyup="mayuscula(this)" />
                        <x-input-error for="editRegister.interior" />
                    </div>
                    <div>
                        <x-label>CP:</x-label>
                        <x-input wire:model="editRegister.cp" type="text" class="block mt-1 w-full"
                            onkeyup="mayuscula(this)" />
                        <x-input-error for="editRegister.cp" />
                    </div>
                </div>
                <div>
                    <x-label>Entre cales:</x-label>
                    <x-input wire:model="editRegister.entre" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="editRegister.entre" />
                </div>
                <div>
                    <x-label>Referencia:</x-label>
                    <x-input wire:model="editRegister.referencia" type="text" class="block mt-1 w-full"
                        onkeyup="mayuscula(this)" />
                    <x-input-error for="editRegister.referencia" />
                </div>
                <div class="w-full grid grid-cols-3 max-md:grid-cols-1 gap-3">
                    <div>
                        <x-label>Estado:</x-label>
                        <x-select wire:model.live="editRegister.estado" type="text" class="block mt-1 w-full">
                            <option value="">Seleccione un estado</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->estado->id_estado }}">{{ $estado->estado->nombre }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="editRegister.estado" />
                    </div>
                    <div>
                        <x-label>Municipio:</x-label>
                        <x-select wire:model.live="editRegister.municipio" type="text" class="block mt-1 w-full">
                            <option value="">Seleccione un municipio</option>
                            @foreach ($municipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}">{{ $municipio->nombre }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="editRegister.municipio" />
                    </div>
                    <div>
                        <x-label>Colinia:</x-label>
                        <x-select wire:model="editRegister.colonia" type="text" class="block mt-1 w-full">
                            <option value="">Seleccione una colonia</option>
                            @foreach ($colonias as $colonia)
                                <option value="{{ $colonia->id_colonia }}">{{ $colonia->nombre }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="editRegister.colonia" />
                    </div>
                </div>
                <div class="mt-5 flex justify-around">
                    <x-button>Guardar</x-button>
                    <x-danger-button wire:click="edit_cancel">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="direct">
        <x-slot name='title'>
            <h2 class="text-center">Dirección</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-3">
                <div>
                    <x-label>Calle:</x-label>
                    <x-input wire:model="direcRegister.calle" class="block mt-1 w-full" disabled />
                    <x-input-error for="direcRegister.calle" />
                </div>
                <div>
                    <x-label>No.Exterior:</x-label>
                    <x-input wire:model="direcRegister.exterior" class="block mt-1 w-full" disabled />
                    <x-input-error for="direcRegister.exterior" />
                </div>
            </div>

            <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-2">
                <div>
                    <x-label>No. Interior:</x-label>
                    <x-input wire:model="direcRegister.interior" class="block mt-1 w-full" disabled />
                    <x-input-error for="direcRegister.interior" />
                </div>
                <div>
                    <x-label>CP:</x-label>
                    <x-input wire:model="direcRegister.cp" type="text" class="block mt-1 w-full" disabled />
                    <x-input-error for="direcRegister.cp" />
                </div>
            </div>
            <div>
                <x-label>Entre Calles:</x-label>
                <x-input wire:model="direcRegister.entre" type="text" class="block mt-1 w-full" disabled />
                <x-input-error for="direcRegister.entre" />
            </div>
            <div>
                <x-label>Referencia:</x-label>
                <x-input wire:model="direcRegister.referencia" type="text" class="block mt-1 w-full" disabled />
                <x-input-error for="direcRegister.referencia" />
            </div>
            <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-2">
                <div>
                    <x-label>Estado:</x-label>
                    <x-input wire:model="direcRegister.estado" type="text" class="block mt-1 w-full" disabled />
                    <x-input-error for="direcRegister.estado" />
                </div>
                <div>
                    <x-label>Municipio:</x-label>
                    <x-input wire:model="direcRegister.municipio" type="text" class="block mt-1 w-full"
                        disabled />
                    <x-input-error for="direcRegister.municipio" />
                </div>
            </div>
            <div>
                <x-label>Colonia:</x-label>
                <x-input wire:model="direcRegister.colonia" type="text" class="block mt-1 w-full" disabled />
                <x-input-error for="direcRegister.colonia" />
            </div>
        </x-slot>
        <x-slot name='footer'>
            <div class="">
                <x-danger-button wire:click="direct_cancel">Cerrar</x-danger-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
