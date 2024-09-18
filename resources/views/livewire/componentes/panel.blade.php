<div class="max-h-80 overflow-y-auto p-5 custom-scroll">
    <ul class=" grid grid-cols-1 gap-3">
        <li class="dark:text-white flex items-center">
            <x-nav-panel href="{{ route('admin.registros.gestores') }}" :active="request()->routeIs('admin.registros.gestores')">Gestores</x-nav-panel>
        </li>
        <li class="dark:text-white flex items-center">
            <x-nav-panel href="{{ route('admin.administrador.interesados') }}" :active="request()->routeIs('admin.administrador.interesados')">Interesados</x-nav-panel>
        </li>
        <li class="dark:text-white flex items-center">
            <x-nav-panel href="{{ route('admin.registros.clientes') }}" :active="request()->routeIs('admin.registros.clientes')">Clientes</x-nav-panel>
        </li>
        <li class="dark:text-white flex items-center">
            <x-nav-panel href="{{ route('admin.registros.empleados') }}" :active="request()->routeIs('admin.registros.empleados')">Empleados</x-nav-panel>
        </li>
    </ul>
</div>
