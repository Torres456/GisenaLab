<div>
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
                    <x-input wire:model.live="search" placeholder="(Nombre o No. empleado del empleado)"
                        class="w-full" />
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
    </div>
    <x-table>
        <x-slot name='titles'>
            <x-th>No. Empleado</x-th>
            <x-th>Nombre</x-th>
            <x-th>Teléfono</x-th>
            <x-th>curp</x-th>
            <x-th>Tipo Empleado</x-th>
            <x-th>Dirección</x-th>
            <x-th>Recuperar contraseña</x-th>
            <x-th>Editar</x-th>
            <x-th>Acceso</x-th>
        </x-slot>
        <x-slot name='content'>
            @foreach ($empleados as $empleado)
                <x-tr>
                    <x-td wire:key='{{ $empleado->id_empleado }}'>{{ $empleado->no_empleado }}</x-td>
                    <x-td>{{ $empleado->nombre . ' ' . $empleado->ap_paterno . ' ' . $empleado->ap_materno }}</x-td>
                    <x-td>{{ $empleado->telefono }}</x-td>
                    <x-td>{{ $empleado->curp }}</x-td>
                    <x-td>{{ $empleado->tipo_empleado->descripcion_puesto }}</x-td>
                    <x-td><x-button wire:click='direc_register({{ $empleado->id_empleado }})'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
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
                        </x-button></x-td>
                    <x-td><x-button wire:click="password_register({{ $empleado->id_empleado }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-password-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 17v4" />
                                <path d="M10 20l4 -2" />
                                <path d="M10 18l4 2" />
                                <path d="M5 17v4" />
                                <path d="M3 20l4 -2" />
                                <path d="M3 18l4 2" />
                                <path d="M19 17v4" />
                                <path d="M17 20l4 -2" />
                                <path d="M17 18l4 2" />
                                <path d="M9 6a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                <path d="M7 14a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2" />
                            </svg>
                        </x-button></x-td>
                    <x-td><x-button wire:click="edit_register({{ $empleado->id_empleado }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                <path d="M16 5l3 3" />
                            </svg>
                        </x-button></x-td>
                    @if ($empleado->usuario_sistema->estatus == 1)
                        <x-td><x-danger-button wire:click="edit_register({{ $empleado->id_empleado }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-down">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4c.342 0 .674 .043 .99 .124" />
                                    <path d="M19 16v6" />
                                    <path d="M22 19l-3 3l-3 -3" />
                                </svg>
                            </x-danger-button></x-td>
                    @else
                        <x-td><x-button wire:click="edit_register({{ $empleado->id_empleado }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-up">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                    <path d="M19 22v-6" />
                                    <path d="M22 19l-3 -3l-3 3" />
                                </svg>
                            </x-button></x-td>
                    @endif
                </x-tr>
            @endforeach
        </x-slot>
    </x-table>

    <x-dialog-modal wire:model="new">
        <x-slot name='title'>
            <h2 class="text-center">Nuevo Empleado</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="new_form">
                <div>
                    <x-label>Nombre(s):</x-label>
                    <x-input wire:model="newRegister.nombre" class="block mt-1 w-full" />
                    <x-input-error for="newRegister.nombre" />
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-3">
                    <div>
                        <x-label>A Paterno:</x-label>
                        <x-input wire:model="newRegister.a_paterno" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.a_paterno" />
                    </div>
                    <div>
                        <x-label>A. Materno:</x-label>
                        <x-input wire:model="newRegister.a_materno" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.a_materno" />
                    </div>
                </div>
                <div>
                    <x-label>Correo:</x-label>
                    <x-input wire:model="newRegister.correo" class="block mt-1 w-full" />
                    <x-input-error for="newRegister.correo" />
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-3">
                    <div>
                        <x-label>Contraseña:</x-label>
                        <x-input wire:model="newRegister.contrasena" type="password" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.contrasena" />
                    </div>
                    <div>
                        <x-label>Confirmar Contraseña:</x-label>
                        <x-input wire:model="newRegister.contrasena_confirmation" type="password"
                            class="block mt-1 w-full" />
                        <x-input-error for="newRegister.contrasena_confirmation" />
                    </div>
                </div>

                <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-3">
                    <div>
                        <x-label>Numero Empleado:</x-label>
                        <x-input wire:model="newRegister.empleado" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.empleado" />
                    </div>
                    <div>
                        <x-label>Teléfono:</x-label>
                        <x-input wire:model="newRegister.telefono" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.telefono" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-3">
                    <div>
                        <x-label>CURP:</x-label>
                        <x-input wire:model="newRegister.curp" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.curp" />
                    </div>
                    <div>
                        <x-label>RFC:</x-label>
                        <x-input wire:model="newRegister.rfc" class="block mt-1 w-full" />
                        <x-input-error for="newRegister.rfc" />
                    </div>
                </div>

                <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-3">
                    <div>
                        <x-label>Sexo:</x-label>
                        <x-select wire:model="newRegister.sexo" class="block mt-1 w-full">
                            <option value="">Seleccione una opción</option>
                            <option value="0">Hombre</option>
                            <option value="1">Mujer</option>
                        </x-select>
                        <x-input-error for="newRegister.sexo" />
                    </div>
                    <div>
                        <x-label>Tipo Empleado:</x-label>
                        <x-select wire:model="newRegister.tipo" class="block mt-1 w-full">
                            <option value="">Seleccione una opción</option>
                            @foreach ($tipo_empleados as $tipo_empleado)
                                <option value="{{ $tipo_empleado->id_tipo_empleado }}">
                                    {{ $tipo_empleado->descripcion_puesto }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="newRegister.tipo" />
                    </div>
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
                <div class="w-full grid grid-cols-3 max-md:grid-cols-1 gap-3">
                    <div>
                        <x-label>Estado:</x-label>
                        <x-select wire:model.live="newRegister.estado" type="text" class="block mt-1 w-full">
                            <option value="">Seleccione un estado</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->id_estado }}">{{ $estado->nombre }}</option>
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
                        <x-label>Colonia:</x-label>
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

    <x-dialog-modal wire:model="edit">
        <x-slot name='title'>
            <h2 class="text-center">Editar Empleado </h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="edit_form">
                <div>
                    <x-label>Nombre(s):</x-label>
                    <x-input wire:model="editRegister.nombre" class="block mt-1 w-full" />
                    <x-input-error for="editRegister.nombre" />
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-3">
                    <div>
                        <x-label>A Paterno:</x-label>
                        <x-input wire:model="editRegister.a_paterno" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.a_paterno" />
                    </div>
                    <div>
                        <x-label>A. Materno:</x-label>
                        <x-input wire:model="editRegister.a_materno" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.a_materno" />
                    </div>
                </div>
                <div>
                    <x-label>Correo:</x-label>
                    <x-input wire:model="editRegister.correo" class="block mt-1 w-full" />
                    <x-input-error for="editRegister.correo" />
                </div>

                <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-3">
                    <div>
                        <x-label>Numero Empleado:</x-label>
                        <x-input wire:model="editRegister.empleado" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.empleado" />
                    </div>
                    <div>
                        <x-label>Teléfono:</x-label>
                        <x-input wire:model="editRegister.telefono" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.telefono" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-3">
                    <div>
                        <x-label>CURP:</x-label>
                        <x-input wire:model="editRegister.curp" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.curp" />
                    </div>
                    <div>
                        <x-label>RFC:</x-label>
                        <x-input wire:model="editRegister.rfc" class="block mt-1 w-full" />
                        <x-input-error for="editRegister.rfc" />
                    </div>
                </div>

                <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-3">
                    <div>
                        <x-label>Sexo:</x-label>
                        <x-select wire:model="editRegister.sexo" class="block mt-1 w-full">
                            <option value="">Seleccione una opción</option>
                            <option value="0">Hombre</option>
                            <option value="1">Mujer</option>
                        </x-select>
                        <x-input-error for="editRegister.sexo" />
                    </div>
                    <div>
                        <x-label>Tipo Empleado:</x-label>
                        <x-select wire:model="editRegister.tipo" class="block mt-1 w-full">
                            <option value="">Seleccione una opción</option>
                            @foreach ($tipo_empleados as $tipo_empleado)
                                <option value="{{ $tipo_empleado->id_tipo_empleado }}">
                                    {{ $tipo_empleado->descripcion_puesto }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="editRegister.tipo" />
                    </div>
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
                <div class="w-full grid grid-cols-3 max-md:grid-cols-1 gap-3">
                    <div>
                        <x-label>Estado:</x-label>
                        <x-select wire:model.live="editRegister.estado" type="text" class="block mt-1 w-full">
                            <option value="">Seleccione un estado</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->id_estado }}">{{ $estado->nombre }}</option>
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
                        <x-label>Colonia:</x-label>
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

    <x-dialog-modal wire:model="password">
        <x-slot name='title'>
            <h2 class="text-center">Recuperar Contraseña</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="passwor_form">
                <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-2">
                    <div>
                        <x-label>Contraseña:</x-label>
                        <x-input wire:model="passRegister.contrasena" type="password" class="block mt-1 w-full" />
                        <x-input-error for="passwordRegister.contrasena" />
                    </div>
                    <div>
                        <x-label>Confirmar Contraseña:</x-label>
                        <x-input wire:model="passRegister.contrasena_confirmation" type="password"
                            class="block mt-1 w-full" />
                        <x-input-error for="passwordRegister.contrasena_confirmation" />
                    </div>
                </div>
                <div class="">
                    <x-button>Guardar</x-button>
                    <x-danger-button wire:click="password_cancel">Cerrar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'>

        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="password">
        <x-slot name='title'>
            <h2 class="text-center">Acceso</h2>
            <p>¿Desea quitar el acceso a este usuario?</p>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="passwor_form">
                <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-2">
                    <div>
                        <x-label>Contraseña:</x-label>
                        <x-input wire:model="passRegister.contrasena" type="password" class="block mt-1 w-full" />
                        <x-input-error for="passwordRegister.contrasena" />
                    </div>
                    <div>
                        <x-label>Confirmar Contraseña:</x-label>
                        <x-input wire:model="passRegister.contrasena_confirmation" type="password"
                            class="block mt-1 w-full" />
                        <x-input-error for="passwordRegister.contrasena_confirmation" />
                    </div>
                </div>
                <div class="">
                    <x-button>Guardar</x-button>
                    <x-danger-button wire:click="password_cancel">Cerrar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'>

        </x-slot>
    </x-dialog-modal>

</div>
