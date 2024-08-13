<div class="max-h-80 overflow-y-auto p-5 custom-scroll">
    <ul class=" grid grid-cols-1 gap-3">
        <li class="dark:text-white flex items-center">
            <x-nav-panel href="{{ route('admin.gestores.index') }}" :active="request()->routeIs('admin.gestores.index')"
                wire:navigate.hover>Gestores</x-nav-panel>
        </li>
    </ul>
</div>
