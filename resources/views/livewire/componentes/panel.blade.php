<div class="max-h-80 overflow-y-auto p-5 custom-scroll">
    <ul class=" grid grid-cols-1 gap-3">
        <li class="dark:text-white flex items-center">
            <x-nav-panel href="{{ route('admin.administrador.gestores') }}" :active="request()->routeIs('admin.administrador.gestores')"
                wire:navigate.hover>Gestores</x-nav-panel>
        </li>
        <li class="dark:text-white flex items-center">
            <x-nav-panel href="{{ route('admin.administrador.interesados') }}" :active="request()->routeIs('admin.administrador.interesados')"
                wire:navigate.hover>Interesados</x-nav-panel>
        </li>
        <li class="dark:text-white flex items-center">
            <x-nav-panel href="{{ route('admin.administrador.clientes') }}" :active="request()->routeIs('admin.administrador.clientes')"
                wire:navigate.hover>Clientes</x-nav-panel>
        </li>
    </ul>
</div>
