<x-app-layout>
    <x-panel-menu>
        <x-slot name="content">
            @livewire('catalogos.analisis-especifico')
        </x-slot>
    </x-panel-menu>
</x-app-layout>


<script src="{{ asset('js/mayusculas.js') }}"></script>
<style>
     .custom-scroll {
     overflow-y: scroll;
     scrollbar-width: thin;
     scrollbar-color: #5fa631 #111827;
 }
</style>