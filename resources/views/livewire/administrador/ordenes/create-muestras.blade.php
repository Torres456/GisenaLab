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
    </div>

    <x-dialog-modal wire:model="muestra">
        <x-slot name='title'>
            <h2 class="text-center">Ageragr Muestra</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="new_register" class="grid md:grid-cols-2 gap-3 w-full">
                <div class="flex justify-between md:col-span-2">
                    <x-danger-button type="reset" wire:click="new_cancel">Cancelar</x-danger-button>
                    <x-button>Siguiente</x-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>
</div>
