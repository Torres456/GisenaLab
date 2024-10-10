<div>
    <x-message />
    <div class="flex flex-col w-full dark:bg-slate-800 rounded p-5">
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
                </div>
                <x-button wire:click="new"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
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
            <x-slot name="titles">
                <x-th>Tipo de Muestra</x-th>
                <x-th>Descripción Muestra</x-th>
                <x-th>Cantidad enviada</x-th>
                <x-th>Unidad de medida</x-th>
                <x-th>Fecha muestreo</x-th>
                <x-th>Fecha envío</x-th>

                <x-th>Procedencia</x-th>
                <x-th>Editar</x-th>
                <x-th>Eliminar</x-th>
            </x-slot>
            <x-slot name="content">
                @if ($count != 0)
                    @foreach ($muestras as $muestra)
                        <x-tr>
                            <x-td wire:key='{{ $muestra->id_muestra_orden_servicio }}'>
                                {{ $muestra->tipo_muestra->nom_tipo_muestra }} </x-td>
                            <x-td> {{ $muestra->descripcion_muestra->nombre_descrip }} </x-td>
                            <x-td> {{ $muestra->cantidad_enviada }} </x-td>
                            <x-td> {{ $muestra->unidad_medida->nombre_unidad }} </x-td>
                            <x-td> {{ date('d-m-Y', strtotime($muestra->fecha_muestreo)) }} </x-td>
                            <x-td> {{ date('d-m-Y', strtotime($muestra->fecha_envio)) }} </x-td>
                            <x-td> <x-button  wire:click="procedencia_register({{$muestra->id_muestra_orden_servicio }})">
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
                            </x-td>
                            <x-td>
                                <x-button  wire:click="edit_register({{$muestra->id_muestra_orden_servicio }})" >
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
                            </x-td>
                            <x-td>
                                <x-danger-button  wire:click="delete_register({{$muestra->id_muestra_orden_servicio }})">
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
                            </x-td>

                        </x-tr>
                    @endforeach
                @else
                    <x-tr>
                        <x-td> Sin Muestras</x-td>
                    </x-tr>
                @endif
            </x-slot>
        </x-table>

        <div class="flex justify-between md:col-span-2 mt-5">
            <x-danger-button wire:click="cancel">Cancelar</x-danger-button>
            <x-button wire:click="next_orden">Siguiente</x-button>
        </div>
    </div>

    <x-dialog-modal wire:model="muestra">
        <x-slot name='title'>
            <h2 class="text-center">Ageragr Muestra</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="new_register" class="grid md:grid-cols-2 gap-3 w-full">

                <div class="flex flex-col">
                    <label for="newRegister.categoria">Categoria:<span class="text-red-600">*</span></label>
                    <x-select wire:model.live="newRegister.categoria" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->id_categoria }}">{{ $cat->descripcion }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newRegister.categoria" />
                </div>

                <div class="flex flex-col">
                    <label for="newRegister.categoria">Subcategoria:<span class="text-red-600">*</span></label>
                    <x-select wire:model.live="newRegister.subcategoria" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($subcategorias as $sub)
                            <option value="{{ $sub->id_subcategoria }}">{{ $sub->nom_subcategoria }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newRegister.subcategoria" />
                </div>

                <div class="flex flex-col">
                    <label for="categoria">Tipo muestra:<span class="text-red-600">*</span></label>
                    <x-select wire:model.live="newRegister.tipo_muestra" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($tipo_muestras as $tipo)
                            <option value="{{ $tipo->id_tipo_muestra }}">{{ $tipo->nom_tipo_muestra }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newRegister.tipo_muestra" />
                </div>

                <div class="flex flex-col">
                    <label for="newRegister.descripcion_muestra">Descripción Muestra:<span
                            class="text-red-600">*</span></label>
                    <x-select wire:model.live="newRegister.descripcion_muestra" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($descripcion_muestras as $descripcion)
                            <option value="{{ $descripcion->id_descrip_muestra }}">{{ $descripcion->nombre_descrip }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newRegister.descripcion_muestra" />
                </div>

                <div class="flex flex-col">
                    <label for="newRegister.tipo_analisis">Tipo de análisis:<span class="text-red-600">*</span></label>
                    <x-select wire:model.live="newRegister.tipo_analisis" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($tipo_analisis as $tipo)
                            <option value="{{ $tipo->id_tipo_analisis }}">{{ $tipo->nomb_tipo_analisis }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newRegister.tipo_analisis" />
                </div>

                <div class="flex flex-col">
                    <label for="newRegister.analisis_especifico">Análisis específico:<span
                            class="text-red-600">*</span></label>
                    <x-select wire:model.live="newRegister.analisis_especifico" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($analisis_especifico as $analisis)
                            <option value="{{ $analisis->id_analisis_especifico }}">{{ $analisis->nombre_comercial }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newRegister.analisis_especifico" />
                </div>

                <div class="flex flex-col">
                    <label for="newRegister.procedencia">Procedencia:<span class="text-red-600">*</span></label>
                    <x-select wire:model.live="newRegister.procedencia" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($procedencias as $procedencia)
                            <option value="{{ $procedencia->id_procedencia }}">
                                {{ $procedencia->sitio_muestreo . ' - ' . $procedencia->nombre_sitio_muestreo }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newRegister.procedencia" />
                </div>

                <div class="flex flex-col">
                    <label for="newRegister.lote">Lote:<span class="text-red-600">*</span></label>
                    <x-input wire:model.live="newRegister.lote" class="w-full" />
                    <x-input-error for="newRegister.lote" />
                </div>

                <div class="flex flex-col">
                    <label for="newRegister.cantidad">Cantidad enviada:<span class="text-red-600">*</span></label>
                    <x-input wire:model.live="newRegister.cantidad" class="w-full" />
                    <x-input-error for="newRegister.cantidad" />
                </div>

                <div class="flex flex-col">
                    <label for="newRegister.unidad_medida">Unidad de medida:<span
                            class="text-red-600">*</span></label>
                    <x-select wire:model.live="newRegister.unidad_medida" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($unidad_medidas as $unidad_medida)
                            <option value="{{ $unidad_medida->id_unidad_medida }}">
                                {{ $unidad_medida->nombre_unidad }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newRegister.unidad_medida" />
                </div>

                <div class="flex flex-col">
                    <label for="newRegister.muestreo">Fecha muestreo:<span class="text-red-600">*</span></label>
                    <x-input wire:model.live="newRegister.muestreo" class="w-full" type="date" />
                    <x-input-error for="newRegister.muestreo" />
                </div>

                <div class="flex flex-col">
                    <label for="newRegister.envio">Fecha envío:<span class="text-red-600">*</span></label>
                    <x-input wire:model.live="newRegister.envio" class="w-full" type="date" />
                    <x-input-error for="newRegister.envio" />
                </div>

                <div class="flex flex-col">
                    <label for="newRegister.productor">Productor o Responsable:<span
                            class="text-red-600">*</span></label>
                    <x-input wire:model.live="newRegister.productor" class="w-full" />
                    <x-input-error for="newRegister.productor" />
                </div>

                <div class="flex flex-col">
                    <label for="newRegister.tiempo">Tiempo de respuesta:<span class="text-red-600">*</span><span
                            class="text-slate-500">(Dias)</span></label>
                    <x-input wire:model.live="newRegister.tiempo" class="w-full" />
                    <x-input-error for="newRegister.tiempo" />
                </div>



                <div class="flex justify-between md:col-span-2">
                    <x-danger-button type="reset" wire:click="new_cancel">Cancelar</x-danger-button>
                    <x-button>Guardar</x-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="cancelar_orden">
        <x-slot name='title'>
            <h2 class="text-center">¿Desea cancelar esta orden de servicio?</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="flex justify-around md:col-span-2">
                <x-danger-button type="reset" wire:click="cancel_orden">Cancelar</x-danger-button>
                <x-button wire:click="continiu_orden">Continuar</x-button>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="procedencias_orden">
        <x-slot name='title'>
            <h2 class="text-center">Procedencia</h2>
        </x-slot>
        <x-slot name='content'>
            @livewire('componentes.muestras.procedencia', ['IdProce' => $IdProce])
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

</div>
