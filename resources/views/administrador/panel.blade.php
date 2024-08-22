<x-app-layout>
    <x-panel-menu>
        <x-slot name="content">
            <div class="grid grid-cols-3 max-lg:grid-cols-2 max-md:grid-cols-1 gap-5">
                <x-cards>
                    <x-slot name="title">Clientes</x-slot>
                    <x-slot name="content">
                        <div class="flex flex-col divide-y divide-slate-700">
                            @livewire('componentes.cliente.gestorsclient')
                        </div>
                    </x-slot>
                    <x-slot name="footer"><x-button-enter href="{{route('admin.administrador.clientes')}}" >Entrar</x-button-enter></x-slot>
                </x-cards>
                <x-cards>
                    <x-slot name="title">Gestores</x-slot>
                    <x-slot name="content">
                        @livewire('componentes.gestorescount')
                    </x-slot>
                    <x-slot name="footer"><x-button-enter href="{{route('admin.administrador.gestores')}}" >Entrar</x-button-enter></x-slot>
                </x-cards>
                <x-cards>
                    <x-slot name="title">Interesados</x-slot>
                    <x-slot name="content">
                    </x-slot>
                    <x-slot name="footer"><x-button-enter href="{{route('admin.administrador.interesados')}}" >Entrar</x-button-enter></x-slot>
                </x-cards>
            </div>
        </x-slot>
    </x-panel-menu>
</x-app-layout>


