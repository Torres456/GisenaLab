<x-paneles.personal>
    <x-slot:titulo>
        Flujo de Subcategorias
    </x-slot:titulo>
    @livewire('administrador.flujos.fluejo-subcategorias')


    <script src="{{ asset('js/mayusculas.js') }}"></script>
    <script src="{{ asset('js/steps.js') }}"></script>
    <style>
        .step {
            display: none;
        }
    </style>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('dataSend', () => {
                const modal = document.getElementById('modal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                alert('hola');
            });
        })
    </script>

</x-paneles.personal>
