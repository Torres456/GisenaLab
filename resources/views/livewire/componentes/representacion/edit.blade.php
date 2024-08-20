<div>
    <form wire:submit="edit_form">
        <div>
            <x-label>Nombre:</x-label>
            <x-input wire:model="editRegister.nombre" type="text" class="block mt-1 w-full" onkeyup="mayuscula(this)" />
            <x-input-error for="editRegister.nombre" />
        </div>
        <x-input-error for="editRegister.selectedTagsEstado" />
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            
                        </th>
                        <th scope="col" class="px-6 py-3 text-center ">
                            Nombre Estado
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estados as $estado)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                wire:key="{{ $estado->id_estado }}">
                                <x-input type="checkbox" wire:model="editRegister.selectedTagsEstado"
                                    value="{{ $estado->id_estado }} " />
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $estado->nombre }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-5">
            {{ $estados->links() }}
        </div>
        <div class="flex justify-around">
            <x-button>Guardar</x-button>
            <x-danger-button wire:click="$parent.edit_cancel">Cancelar</x-danger-button>
        </div>
    </form>
</div>
