<x-app-layout>
    <x-panel-menu>
        <x-slot name="content">
            <div class="grid grid-cols-3 max-lg:grid-cols-2 max-md:grid-cols-1 gap-5">
                <x-cards>
                    <x-slot name="title">Clientes</x-slot>
                    <x-slot name="content">
                        <div class="flex flex-col divide-y divide-slate-700">
                            <div class="w-full flex justify-between py-2">
                                <p>Clientes Nuevos</p>
                                <p class="text-white">6</p>
                            </div>
                            <div class="w-full flex justify-between py-2">
                                <p>Clientes sin gestor</p>
                                <p class="text-white">5</p>
                            </div>
                        </div>
                    </x-slot>
                    <x-slot name="footer"><x-button-enter wire:navigate.hover>Entrar</x-button-enter></x-slot>
                </x-cards>
            </div>
        </x-slot>
    </x-panel-menu>
</x-app-layout>


