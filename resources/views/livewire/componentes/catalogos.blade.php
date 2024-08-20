<div class="max-h-80 overflow-y-auto p-5 custom-scroll">
    <ul class=" grid grid-cols-1 gap-3">
        @foreach ($cards as $card)
            <li class="dark:text-white flex items-center">
                <x-nav-panel href="{{ route($card->route) }}" :active="request()->routeIs('{{$card->route}}')"
                    wire:navigate.hover>{{$card->title}}</x-nav-panel>
            </li>
        @endforeach
    </ul>
</div>


