<div>
    <x-message />
    <div class="flex gap-3 items-center dark:text-white mb-5 max-md:flex-col">
        <div class="flex flex-row w-full gap-2">
            <div class="flex flex-row gap-2">
                <div class="flex flex-col">
                    <label for="">Mostrar:</label>
                    <x-select wire:model.live="view_dates">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </x-select>
                </div>
                <div class="flex flex-col">
                    <label for="">Estatus:</label>
                    <x-select wire:model.live="shearch_state">
                        <option value="">Todos</option>
                        @foreach ($estatus as $estatu)
                            <option value="{{$estatu->idstatus_orden_servicio }}">{{ $estatu->nombre }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="flex flex-col w-full">
                <label for="">Buscar:</label>
                <x-input wire:model.live="search" placeholder="(No. Orden de servicio)" class="w-full" />
            </div>
            <div class="flex flex-row gap-2">
                <div class="flex flex-col">
                    <label for="">De:</label>
                    <x-input type="date" wire:model.live="date_one" />
                </div>
                <div class="flex flex-col">
                    <label for="">Al:</label>
                    <x-input type="date" wire:model.live="date_two" />
                </div>
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
                        Ver Orden
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
                                {{ $orden->numero_orden_servicio }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $orden->Fecha_orden }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $orden->prioridad }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $orden->requiere_factura }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $orden->id_cliente }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $orden->id_interesado }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $orden->idstatus_orden_servicio }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="edit_register({{ $orden->numero_orden_servicio }})">
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
                                <x-button wire:click="edit_register({{ $orden->numero_orden_servicio }})">
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
        {{ $ordenes->links() }}
    </div>
</div>
