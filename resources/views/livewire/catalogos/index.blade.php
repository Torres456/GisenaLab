<div>
    <div class="p-5">
        <x-input wire:model.live="search" type="text" placeholder="Buscar catalogo" class="w-full"/>
    </div>

    <div class="card-container">
        <div class="grid grid-cols-3 max-lg:grid-cols-2 max-md:grid-cols-1 gap-5">
            @foreach ($cards as $card)
                <x-cards>
                    <x-slot name="title">{{ $card['title'] }}</x-slot>
                    <x-slot name="content">{{ $card['content'] }}</x-slot>
                    <x-slot name="footer"><x-button-enter
                            href="{{ route(strtolower($card['route'])) }}" wire:navigate.hover>Entrar</x-button-enter></x-slot>
                </x-cards>
            @endforeach
        </div>
        <div class="p-5">
            {{$cards->links()}}
        </div>
    </div>
</div>
