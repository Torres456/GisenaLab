<div>
    <x-message />
    <div class="flex w-full dark:bg-slate-800 rounded p-5">
        <form wire:submit="new_register" class="grid md:grid-cols-2 gap-3 w-full">
            <div class="flex flex-col">
                <label for="nombre">Prioridad:<span class="text-red-600">*</span></label>
                <x-select class="w-full">
                    <option value="0">Normal</option>
                    <option value="1">Urgente</option>
                </x-select>
            </div>

            <div class="flex flex-col">
                <label for="nombre">Requiere Factura:<span class="text-red-600">*</span></label>
                <x-select class="w-full">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </x-select>
            </div>

            <div class="flex flex-col md:col-span-2">
                <label for="nombre">Información adicional:</label>
                <x-textarea class="w-full">
                </x-textarea>
            </div>

            <div class="flex flex-col">
                <label for="nombre">Cliente:<span class="text-red-600">*</span></label>
                <x-select class="w-full">
                    <option value="">Seleccione una opción</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}">{{ $cliente->razon_social }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="flex flex-col">
                <label for="nombre">Interesado:<span class="text-red-600">*</span></label>
                <x-select class="w-full">
                    <option value="">Seleccione una opción</option>
                    @foreach ($interesados as $interesado)
                        <option value="{{ $interesado->id_interesado }}">{{ $interesado->nombre . ' ' . $interesado->ap_paterno . ' ' . $interesado->ap_materno }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="flex flex-col">
                <label for="nombre">Remisión de muestra:</label>
                <x-input class="w-full" />
            </div>

            <div class="flex flex-col">
                <label for="nombre">Tipo de documento:</label>
                <x-input class="w-full" />
            </div>
            <div class="flex flex-col md:col-span-2">
                <label for="nombre">NETSUITE:</label>
                <x-input class="w-full" />
            </div>


            <div class="flex justify-between md:col-span-2">
                <x-danger-button wire:click="cancel">Cancelar</x-danger-button>
                <x-button>Siguiente</x-button>
            </div>
        </form>
    </div>

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
