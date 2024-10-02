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

                <x-th>Ver Muestra</x-th>
                <x-th>Procedencia</x-th>
                <x-th>Editar</x-th>
                <x-th>Estatus</x-th>
            </x-slot>
            <x-slot name="content">

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
                    <label for="newregister.categoria">Categoria:<span class="text-red-600">*</span></label>
                    <x-select wire:model.live="newregister.categoria" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->id_categoria }}">{{ $cat->descripcion }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newregister.categoria" />
                </div>

                <div class="flex flex-col">
                    <label for="newregister.categoria">Subcategoria:<span class="text-red-600">*</span></label>
                    <x-select wire:model.live="newregister.subcategoria" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($subcategorias as $sub)
                            <option value="{{ $sub->id_subcategoria }}">{{ $sub->descripcion }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newregister.subcategoria" />
                </div>

                <div class="flex flex-col">
                    <label for="categoria">Tipo muestra:<span class="text-red-600">*</span></label>
                    <x-select wire:model.live="newregister.tipo_muestra" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($tipo_muestras as $tipo)
                            <option value="{{ $tipo->id_tipo_analisis }}">{{ $tipo->descripcion }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newregister.tipo_muestra" />
                </div>

                <div class="flex flex-col">
                    <label for="newregister.descripcion_muestra">Descripción Muestra:<span
                            class="text-red-600">*</span></label>
                    <x-select wire:model.live="newregister.descripcion_muestra" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($descripcion_muestras as $descripcion)
                            <option value="{{ $descripcion->id_descrip_muestra }}">{{ $descripcion->descripcion }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newregister.descripcion_muestra" />
                </div>

                <div class="flex flex-col">
                    <label for="newregister.tipo_analisis">Tipo de análisis:<span class="text-red-600">*</span></label>
                    <x-select wire:model.live="newregister.tipo_analisis" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($tipo_analisis as $tipo)
                            <option value="{{ $tipo->id_tipo_analisis }}">{{ $tipo->descripcion }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newregister.tipo_analisis" />
                </div>

                <div class="flex flex-col">
                    <label for="newregister.analisis_especifico">Análisis específico:<span
                            class="text-red-600">*</span></label>
                    <x-select wire:model.live="newregister.analisis_especifico" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($analisis_especifico as $analisis)
                            <option value="{{ $analisis->id_analisis_especifico }}">{{ $analisis->descripcion }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newregister.analisis_especifico" />
                </div>

                <div class="flex flex-col">
                    <label for="newregister.procedencia">Procedencia:<span class="text-red-600">*</span></label>
                    <x-select wire:model.live="newregister.procedencia" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($procedencias as $procedencia)
                            <option value="{{ $procedencia->id_procedencia }}">{{ $procedencia->descripcion }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newregister.procedencia" />
                </div>

                <div class="flex flex-col">
                    <label for="newregister.lote">Lote:<span class="text-red-600">*</span></label>
                    <x-input wire:model.live="newregister.lote" class="w-full" />
                    <x-input-error for="newregister.lote" />
                </div>

                <div class="flex flex-col">
                    <label for="newregister.cantidad">Cantidad enviada:<span class="text-red-600">*</span></label>
                    <x-input wire:model.live="newregister.cantidad" class="w-full" />
                    <x-input-error for="newregister.cantidad" />
                </div>

                <div class="flex flex-col">
                    <label for="newregister.unidad_medida">Unidad de medida:<span
                            class="text-red-600">*</span></label>
                    <x-select wire:model.live="newregister.unidad_medida" class="w-full">
                        <option value="">Seleccione una opción</option>
                        @foreach ($unidad_medidas as $unidad_medida)
                            <option value="{{ $unidad_medida->id_unidad_medida }}">{{ $unidad_medida->descripcion }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newregister.unidad_medida" />
                </div>

                <div class="flex flex-col col-span-2">
                    <label for="newregister.muestreo">Fecha muestreo:<span class="text-red-600">*</span></label>
                    <x-input wire:model.live="newregister.muestreo" class="w-full" type="date" />
                    <x-input-error for="newregister.muestreo" />
                </div>

                <div class="flex flex-col col-span-2">
                    <label for="newregister.envio">Fecha envío:<span class="text-red-600">*</span></label>
                    <x-input wire:model.live="newregister.envio" class="w-full" type="date" />
                    <x-input-error for="newregister.envio" />
                </div>

                <div class="flex flex-col">
                    <label for="newregister.productor">Productor o Responsable:<span
                            class="text-red-600">*</span></label>
                    <x-input wire:model.live="newregister.productor" class="w-full" />
                    <x-input-error for="newregister.productor" />
                </div>

                <div class="flex flex-col col-span-2">
                    <label for="newregister.tiempo">Tiempo de respuesta:<span class="text-red-600">*</span><span
                            class="text-slate-500">(Dias)</span></label>
                    <x-input wire:model.live="newregister.tiempo" class="w-full" />
                    <x-input-error for="newregister.tiempo" />
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
</div>
