<div>
    <x-message />
    <div class="flex gap-3 items-center dark:text-white mb-5 flex-col max-md:flex-col-reverse">

        <div class="flex flex-row w-full gap-2 max-md:flex-col md:items-end md:justify-between">
            <div class="flex flex-col md:w-full ">
                <label for="">Mostrar:</label>
                <x-select wire:model.live="view_dates">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </x-select>
            </div>
            <div class="flex flex-col md:w-full">
                <label for="">Estatus:</label>
                <x-select wire:model.live="shearch_state">
                    <option value="">Todos</option>
                    @foreach ($status as $statu)
                        <option value="{{ $statu->id_status_orden_servicio }}">{{ $statu->nombre }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="flex flex-col w-full">
                <label for="">De:</label>
                <x-input type="date" wire:model.live="date_one" class="w-full" />
                <x-input-error for="date_one" />
            </div>
            <div class="flex flex-col w-full">
                <label for="">Al:</label>
                <x-input type="date" wire:model.live="date_two" class="w-full" />
                <x-input-error for="date_two" />
            </div>
            <div class="flex max-md:justify-around md:items-end md:gap-2">
                <x-button wire:click="reiniciar_fechas">Borar Fechas</x-button>
                <x-button wire:click="reiniciar_filtros">Borar Filtros</x-button>
            </div>

        </div>
        <div class="flex max-md:flex-col w-full md:items-end gap-2 max-md:justify-center">
            <div class="flex flex-col w-full">
                <label for="">Buscar:</label>
                <x-input wire:model.live.500="search" placeholder="(No. Orden de servicio)" class="w-full" />
            </div>
            <x-button wire:click="new_register"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-file-plus">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                <path d="M12 11l0 6" />
                <path d="M9 14l6 0" />
            </svg> Nuevo</x-button>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        No. Orden
                    </th>
                    <th scope="col" class="px-6 py-3 text-center ">
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Prioridad
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Factura
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Clientre
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Interesado
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Estatus
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Muestras
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Editar Orden
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Estatus Orden
                    </th>
                </tr>
            </thead>
            @if ($count != 0)
                <tbody>
                    @foreach ($ordenes as $orden)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ $orden->id_orden_servicio }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ date('d-m-Y', strtotime($orden->fecha_orden)) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @switch($orden->prioridad)
                                    @case(0)
                                        Normal
                                    @break

                                    @case(1)
                                        Urgente
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td class="px-6 py-4 text-center">
                                @switch($orden->requiere_factura)
                                    @case(0)
                                        No
                                    @break

                                    @case(1)
                                        Si
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($orden->id_cliente)
                                    {{ $orden->cliente->razon_social }}
                                @else
                                    {{ $orden->interesado->nombre }}
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $orden->interesado->nombre . ' ' . $orden->interesado->ap_materno . ' ' . $orden->interesado->ap_paterno }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @foreach ($status as $estatus)
                                    @switch($orden->id_status_orden_servicio)
                                        @case($estatus->id_status_orden_servicio)
                                            <x-button
                                                wire:click="estado_register({{ $orden->id_orden_servicio }})">{{ $estatus->nombre }}</x-button>
                                        @break

                                        @default
                                    @endswitch
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="muestras_register({{ $orden->id_orden_servicio }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-brand-databricks">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M3 17l9 5l9 -5v-3l-9 5l-9 -5v-3l9 5l9 -5v-3l-9 5l-9 -5l9 -5l5.418 3.01" />
                                    </svg>
                                </x-button>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="edit_register({{ $orden->id_orden_servicio }})">
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
                                @switch($orden->estatus)
                                    @case(0)
                                        <x-danger-button wire:click="estatus_register({{ $orden->id_orden_servicio }})">
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
                                    @break

                                    @case(1)
                                        <x-button wire:click="estatus_register({{ $orden->id_orden_servicio }})">
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
                                    @break

                                    @default
                                @endswitch
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
        {{ $ordenes->links() }}
    </div>


    <x-dialog-modal wire:model="muestras_orden">
        <x-slot name='title'>
            <h2 class="text-center">Muestras</h2>
        </x-slot>
        <x-slot name='content'>
            <p class="text-center text-sm">No. Orden {{ $IdOrden }}</p>
            @livewire('componentes.ordenes.muestras', ['IdOrden' => $IdOrden])
        </x-slot>
        <x-slot name='footer'>
            <x-danger-button type="reset" wire:click="cancel_muestras">Cancelar</x-danger-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="estatus_orden">
        <x-slot name='title'>
            <h2 class="text-center">Estatus de Orden </h2>
        </x-slot>
        <x-slot name='content'>
            @if ($viewstatus == 1)
                <p class="text-center">¿Desea cancelar esta orden?</p>
            @else
                <p class="text-center">¿Desea reactivar esta orden?</p>
            @endif
            <div class="flex justify-around">
                <x-button wire:click="status_update">Guardar</x-button>
                <x-danger-button type="reset" wire:click="status_cancel">Cancelar</x-danger-button>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="estado_orden">
        <x-slot name='title'>
            <h2 class="text-center">Estado de Orden </h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="update_estado">
                <div class="flex flex-col">
                    <label for="">Esatdo de orden:</label>
                    <x-select wire:model.live="estado">
                        @foreach ($status as $statu)
                            <option value="{{ $statu->id_status_orden_servicio }}">{{ $statu->nombre }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="flex justify-around mt-3">
                    <x-button>Guardar</x-button>
                    <x-danger-button type="reset" wire:click="estado_cancel">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'>
        </x-slot>
    </x-dialog-modal>
</div>
