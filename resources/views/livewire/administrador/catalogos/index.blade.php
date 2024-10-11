<div>
    <div class="py-5">
        <x-input wire:model.live="search" type="text" placeholder="Buscar catalogo" class="w-full" />
    </div>
    <div class="grid grid-cols-3 max-lg:grid-cols-2 max-md:grid-cols-1 gap-5 mb-4">
        <x-cards>
            <x-slot name="title">Flujo de Muestras</x-slot>
            <x-slot name="content">Permite agregar de manera ordenada los diferentes regisdtros de muestras</x-slot>
            <x-slot name="footer"><x-button-enter href="">Entrar</x-button-enter></x-slot>
        </x-cards>
    </div>
    <div class="card-container">
        @if ($count == 0)
            <h2 class="text-center text-2xl dark:text-white">No se encontraron resultados</h2>
        @else
            <div class="grid grid-cols-3 max-lg:grid-cols-2 max-md:grid-cols-1 gap-5">
                @foreach ($cards as $card)
                    <x-cards>
                        <x-slot name="title">{{ $card['title'] }}</x-slot>
                        <x-slot name="content">{{ $card['description'] }}</x-slot>
                        <x-slot name="footer"><x-button-enter href="{{ route(strtolower($card['route'])) }}"
                                wire:navigate.hover>Entrar</x-button-enter></x-slot>
                    </x-cards>
                @endforeach
            </div>
            <div class="p-5">
                {{ $cards->links() }}
            </div>
        @endif
    </div>
</div>
