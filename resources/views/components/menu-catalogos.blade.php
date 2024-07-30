<div class="flex gap-4 justify-center items-center">
    <x-dropdown-catalogos>
        <x-slot name="trigger">
            <div class="flex dark:text-white justify-center items-center gap-2 cursor-pointer">
                <p>Catálogos</p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-down">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M18 13l-6 6" />
                    <path d="M6 13l6 6" />
                </svg>
            </div>
        </x-slot>
        <x-slot name="content">
            @livewire('componentes.catalogos')
        </x-slot>
    </x-dropdown-catalogos>
    <x-button-return href="{{ route('catalogos.index') }}" wire:navigate.hover>Regresar</x-button-return>
</div>