<div>
    <x-table>
        <x-slot name="titles">
            <x-th>Tipo Muestra</x-th>
            <x-th>Descripción Muestra</x-th>
            <x-th>Cantidad Enviada</x-th>
            <x-th>Ver Muestra</x-th>
            <x-th>Estatus</x-th>
        </x-slot>
        <x-slot name="content">
            @if ($count != 0)
                @foreach ($muestras as $muestra)
                    <x-tr>
                        <x-td wire:key='{{ $muestra->id_muestra_orden_servicio }}'>
                            {{ $muestra->tipo_muestra->nom_tipo_muestra }} </x-td>
                        <x-td> {{ $muestra->descripcion_muestra->nombre_descrip }} </x-td>
                        <x-td> {{ $muestra->cantidad_enviada }} </x-td>
                        <x-td>
                            <x-button wire:click="view_muestra({{ $muestra->id_muestra_orden_servicio }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path
                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>
                            </x-button>
                        </x-td>
                        <x-td>
                            @switch($muestra->estatus)
                                @case(0)
                                    <x-danger-button wire:click="estatus_muestra({{ $muestra->id_muestra_orden_servicio }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-x">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M10 12l4 4m0 -4l-4 4" />
                                        </svg>
                                    </x-danger-button>
                                @break

                                @case(1)
                                    <x-button wire:click="estatus_muestra({{ $muestra->id_muestra_orden_servicio }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-check">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M9 15l2 2l4 -4" />
                                        </svg>
                                    </x-button>
                                @break

                                @default
                            @endswitch
                        </x-td>
                    </x-tr>
                @endforeach
            @else
                <x-tr>
                    <x-td>Sin muestras registradas</x-td>
                </x-tr>
            @endif
        </x-slot>
    </x-table>

    <x-dialog-modal wire:model="muestra">
        <x-slot name='title'>
            <h2 class="text-center">Muestra</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="grid md:grid-cols-2 gap-3">
                <div class="flex flex-col">
                    <label for="">Categoria:</label>
                    <x-input type="text" wire:model="muestRegister.categoria" disabled />
                </div>
                <div class="flex flex-col">
                    <label for="">Subcategoria:</label>
                    <x-input type="text" wire:model="muestRegister.subcategoria" disabled />
                </div>
                <div class="flex flex-col">
                    <label for="">Tipo Muestra:</label>
                    <x-input type="text" wire:model="muestRegister.muestra" disabled />
                </div>
                <div class="flex flex-col">
                    <label for="">Descripcion Muestra:</label>
                    <x-input type="text" wire:model="muestRegister.descripcion" disabled />
                </div>
                <div class="flex flex-col">
                    <label for="">Tipo Analisis:</label>
                    <x-input type="text" wire:model="muestRegister.analisis" disabled />
                </div>
                <div class="flex flex-col">
                    <label for="">Analisis Especifico:</label>
                    <x-input type="text" wire:model="muestRegister.especifico" disabled />
                </div>
                <div class="flex flex-col">
                    <label for="">Procedencia:</label>
                    <x-input type="text" wire:model="muestRegister.procedencia" disabled />
                </div>
                <div class="flex flex-col">
                    <label for="">Cantidad Enviada:</label>
                    <x-input type="text" wire:model="muestRegister.cantidad" disabled />
                </div>
                <div class="flex flex-col">
                    <label for="">Unidad de Medida:</label>
                    <x-input type="text" wire:model="muestRegister.medida" disabled />
                </div>
                <div class="flex flex-col">
                    <label for="">No. Lote:</label>
                    <x-input type="text" wire:model="muestRegister.lote" disabled />
                </div>
                
                <div class="flex flex-col">
                    <label for="">Fecha Muestreo:</label>
                    <x-input type="text" wire:model="muestRegister.muestreo" disabled />
                </div>
                <div class="flex flex-col">
                    <label for="">Fecha Envio:</label>
                    <x-input type="text" wire:model="muestRegister.envio" disabled />
                </div>
                <div class="flex flex-col md:col-span-2">
                    <label for="">Productor o responsable:</label>
                    <x-input type="text" wire:model="muestRegister.productor" disabled />
                </div>
                <div class="flex flex-col md:col-span-2">
                    <label for="">Otros Datos:</label>
                    <x-textarea type="text" wire:model="muestRegister.otros" disabled ></x-textarea>
                </div>
                <div class="flex flex-col">
                    <label for="">Tiempo de Respuesta:</label>
                    <x-input type="text" wire:model="muestRegister.respuesta" disabled />
                </div>
                <div class="flex flex-col">
                    <label for="">Estatus de Muestra:</label>
                    <x-input type="text" wire:model="muestRegister.estatus" disabled />
                </div>

            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-danger-button wire:click="view_muestra_cancel">Cerrar</x-danger-button>
        </x-slot>
    </x-dialog-modal>


    <x-dialog-modal wire:model="estatus">
        <x-slot name='title'>
            <h2 class="text-center">Estatus de Orden </h2>
        </x-slot>
        <x-slot name='content'>
            @if ($viewstatus == 1)
                <p class="text-center">¿Desea cancelar esta muestra?</p>
            @else
                <p class="text-center">¿Desea reactivar esta muestra?</p>
            @endif
            <div class="flex justify-around">
                <x-button wire:click="status_update">Guardar</x-button>
                <x-danger-button type="reset" wire:click="status_cancel">Cancelar</x-danger-button>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>
</div>
