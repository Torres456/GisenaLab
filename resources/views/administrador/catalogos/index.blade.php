<x-app-layout>
    <x-panel-menu>
        <x-slot name="content">
            @livewire('administrador.catalogos.index')
        </x-slot>
    </x-panel-menu>
</x-app-layout>

<style>
    .custom-scroll {
    overflow-y: scroll;
    scrollbar-width: thin;
    scrollbar-color: #5fa631 #111827;
}
</style>
