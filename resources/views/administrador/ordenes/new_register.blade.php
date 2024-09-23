<x-paneles.personal>
    <x-slot:titulo>
        {{__('New Service Order')}}
    </x-slot>
    @livewire('administrador.ordenes.create') 
    <script src="{{ asset('js/mayusculas.js') }}"></script>
</x-paneles.personal>
