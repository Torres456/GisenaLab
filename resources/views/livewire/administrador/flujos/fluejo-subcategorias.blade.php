<div>
    <x-message />

    <form wire:submit="submitForm" class="w-full bg-slate-300 dark:bg-slate-800 p-5 rounded-md flex flex-col gap-5">
        <fieldset>
            <h2 class="mb-3">Paso 1: Categoría - Seleccionar o llenar datos de categoría</h2>
            <x-checkbox type="checkbox" wire:model="mostrarcontenido" id="Changeselect"  class="peer/docs w-5 h-5" /><label class="text-slate-500 ml-3"> ¿No existe la Categoría? </label>
            <div class="peer-checked/docs:hidden flex flex-col col-span-2 mt-3" id="selectCategory" id="published">
                
                <x-select name="Category" id="categorySelect" wire:model="category">
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id_categoria }}">{{ $cat->nombre_categoria }}</option>
                    @endforeach
                </x-select>
            </div>

            
            <div id="newCategory" class="peer-checked/docs:block hidden transition-all duration-3000 ease-in-out col-span-2">
                <div class="flex flex-row items-center gap-3 mt-3">
                    <x-input type="text" id="nameCategoy" wire:model="name_category" class="w-full"
                        placeholder="Nombre de Categoría" />
                    <x-input-error for="name_category" />
                </div>
                <div class="flex flex-row items-center gap-3 mt-3">
                    <x-input type="text" id="descriptionCategory" wire:model="description_category" class="w-full"
                        placeholder="Descripción de Categoría" />
                    <x-input-error for="description_category" />
                </div>
            </div>
            
        </fieldset>

        <fieldset>
            <h2>Paso 2: Subcategoría</h2>
            <div class="mb-3 flex justify-between items-center gap-3">
                <div class="w-full">
                    <x-input type="text" placeholder="Nombre Subcategoría" class="w-full"
                        wire:model="name_subcategoria" />
                    <x-input-error for="name_subcategoria" />
                </div>
                <x-button type="button" wire:click="addSubcategory"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-circle-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                        <path d="M9 12h6" />
                        <path d="M12 9v6" />
                    </svg></x-button>
            </div>

            <div id="subcategoriesContainer" class="grid gap-3 subcategory">
                <div class="subcategory w-full flex gap-3">
                    <ul class="list-inside list-disc space-y-2 w-full">
                        @foreach ($list_sub as $index => $subcat)
                            <li wire:key="sub-{{ $index }}"
                                class="flex justify-between items-center border-b-2 border-slate-500 p-3">
                                <p>
                                    <span class="text-slate-500 mr-2">{{ $index + 1 }} .-</span>
                                    {{ $subcat }}
                                </p>
                                <x-danger-button type="button" wire:click="deteSubcategory({{ $index }})"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 6l-12 12" />
                                        <path d="M6 6l12 12" />
                                    </svg></x-danger-button>
                            </li>
                        @endforeach
                    </ul>
                    <x-input-error for="list_sub" />
                </div>
            </div>
        </fieldset>

        <div class="flex justify-between">
            <x-danger-button wire:click="cancelSub">Cancelar</x-danger-button>
            <x-button>Guardar</x-button>
        </div>
    </form>
</div>
