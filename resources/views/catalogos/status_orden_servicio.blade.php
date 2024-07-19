<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center max-md:flex-col max-md:gap-3">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Estatus Orden Servicio') }}
            </h2>
            <x-menu-catalogos />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5">
                @livewire('catalogos.status_ordenes')
            </div>
        </div>
    </div>
</x-app-layout>
