<div class="max-h-80 overflow-y-auto p-5 custom-scroll">
    <ul class=" grid grid-cols-1 gap-3">
        @foreach ($cards as $card)
            <li class="dark:text-white flex items-center">
                <a href="{{ route($card['route']) }}" :active="request()->routeIs($card['route'])" wire:navigate.hover>
                    {{ $card['title'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>


