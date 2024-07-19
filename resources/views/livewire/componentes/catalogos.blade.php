<div class="max-h-80 overflow-y-auto p-5">
    <x-input wire:model.live="search" type="text" placeholder="Buscar catalogo" class="w-full"/>
    <ul class=" grid grid-cols-1 gap-3">
        @foreach ($cards as $card)
            <li class="dark:text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="currentColor"
                    class="icon icon-tabler icons-tabler-filled icon-tabler-arrow-badge-right">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M7 6l-.112 .006a1 1 0 0 0 -.669 1.619l3.501 4.375l-3.5 4.375a1 1 0 0 0 .78 1.625h6a1 1 0 0 0 .78 -.375l4 -5a1 1 0 0 0 0 -1.25l-4 -5a1 1 0 0 0 -.78 -.375h-6z" />
                </svg><x-nav-link href="{{ route(strtolower($card['route'])) }}" :active="request()->routeIs($card['route'])" wire:navigate.hover>
                    {{ $card['title'] }}
                </x-nav-link>
            </li>
        @endforeach
    </ul>
</div>
