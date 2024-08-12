<div>
    <form wire:submit="update">
        @csrf
        <div>
            <x-label for="correo" value="{{ __('Correo') }}" />
            <x-input id="correo" class="block mt-1 w-full" type="text" wire:model="correo" required autofocus
                autocomplete="correo" />

            <div>
                <x-input-error for="correo" class="mt-2" />
            </div>
        </div>
        <div class="flex items-center justify-end mt-4">
            <div wire:loading>
                Enviando correo...
            </div>
            <x-button class="ms-4" wire:loading.class="cursor-progress">
                {{ __('Enviar') }}
            </x-button>
        </div>
    </form>
    <div class="p-5 text-center">
        <a class="inline-flex items-center gap-2 rounded border border-blue-800 bg-blue-800 px-8 py-3 text-white hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
            href="{{ route('cliente.panel') }}">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" transform="rotate(180)">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
            <span class="text-sm font-medium">Regresar.</span>
        </a>
    </div>
</div>
