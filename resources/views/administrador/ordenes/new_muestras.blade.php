<x-paneles.personal>
    <x-slot:titulo>
        {{__('New Service Order')}}
    </x-slot>
    {{-- @livewire('administrador.ordenes.create-muestras',[
        $orderId='orderId'
    ])  --}}
    <livewire:administrador.ordenes.create-muestras :order-id="$orderId" />
    <script src="{{ asset('js/mayusculas.js') }}"></script>
</x-paneles.personal>
