<x-paneles.personal>
    <x-slot:titulo>
        Principal
    </x-slot>
    <div class="font-semibold text-lg text-black dark:text-gray-200 leading-tight">
        <h2>¡Hola, {{ Auth::user()->nombre }}!</h2>
    </div>
</x-paneles.personal>
