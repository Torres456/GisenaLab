<div>
    <form action="">
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
        <div>
            <x-label>Entre Calles:</x-label>
            <x-input wire:model="direcRegister.entre" type="text" class="block mt-1 w-full" disabled />
            <x-input-error for="direcRegister.entre" />
        </div>
        <div>
            <x-label>Referencia:</x-label>
            <x-input wire:model="direcRegister.referencia" type="text" class="block mt-1 w-full" disabled />
            <x-input-error for="direcRegister.referencia" />
        </div>
        <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-2">
            <div>
                <x-label>Estado:</x-label>
                <x-input wire:model="direcRegister.estado" type="text" class="block mt-1 w-full" disabled />
                <x-input-error for="direcRegister.estado" />
            </div>
            <div>
                <x-label>Municipio:</x-label>
                <x-input wire:model="direcRegister.municipio" type="text" class="block mt-1 w-full" disabled />
                <x-input-error for="direcRegister.municipio" />
            </div>
        </div>
        <div>
            <x-label>Colonia:</x-label>
            <x-input wire:model="direcRegister.colonia" type="text" class="block mt-1 w-full" disabled />
            <x-input-error for="direcRegister.colonia" />
        </div>
    </form>
</div>
