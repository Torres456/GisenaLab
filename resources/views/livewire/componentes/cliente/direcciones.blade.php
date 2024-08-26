<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        Calle
                    </th>
                    <th scope="col" class="px-6 py-3 text-center ">
                        No. Exterior
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        No. Interior
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        CP
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Municipio
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Colonia
                    </th>
                    {{-- <th scope="col" class="px-6 py-3 text-center">
                        Editar
                    </th> --}}
                </tr>
            </thead>
             @if ($count != 0)
                <tbody>
                    @foreach ($direcciones as $direccion)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ $direccion->direccion->calle }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $direccion->direccion->no_exterior }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $direccion->direccion->no_interior }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $direccion->direccion->cp }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $direccion->direccion->estado->nombre }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $direccion->direccion->municipio->nombre }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $direccion->direccion->colonia->nombre }}
                            </td>
                            {{-- <td class="px-6 py-4 text-center">
                                <x-button wire:click="edit_register({{ $direccion->id_cliente }})">
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
                            </td> --}}
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
        {{ $direcciones->links() }}
    </div>
</div>
