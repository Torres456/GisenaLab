<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center max-md:flex-col max-md:gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Estatus Muestras') }}
                </h2>
                <P class="text-gray-600">Este estatus es para las muestras que tendrá una orden de servicio</P>
            </div>
            <x-menu-catalogos />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5">
                @livewire('catalogos.status-muestras')
            </div>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('js/mayusculas.js') }}"></script><script src="{{ asset('js/mayusculas.js') }}"></script>