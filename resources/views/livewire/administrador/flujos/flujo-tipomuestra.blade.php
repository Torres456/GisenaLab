<div>
    <x-message />

    <form wire:submit="submitForm" class="w-full  p-5 flex flex-col gap-5">
        <fieldset>
            <h2 class="mb-3">Paso 1: Categoría - Seleccionar o llenar datos de categoría</h2>
            <x-checkbox type="checkbox" wire:wire="mostrarcontenido" id="Changeselect" class="peer/cat w-5 h-5" /><label
                class="text-slate-500 ml-3 "> ¿No existe la Categoría? </label>


            <div class="peer-checked/cat:hidden flex flex-col bg-slate-300 dark:bg-slate-800 p-5 rounded-md mt-3"
                id="selectCategory" id="published">
                <x-select wire:model.live="category_id" id="categorySelect">
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categorias as $cat)
                        <option value="{{ $cat->id_categoria }}">{{ $cat->nombre_categoria }}</option>
                    @endforeach
                </x-select>
            </div>

            <div id="newCategory"
                class="peer-checked/cat:block hidden  bg-slate-300 dark:bg-slate-800 p-3 rounded-md mt-3">
                <div class="flex flex-row items-center gap-3 mt-3">
                    <x-input type="text" id="nameCategoy" wire:model="category_name" class="w-full"
                        placeholder="Nombre de Categoría" />
                    <x-input-error for="name_category" />
                </div>
                <div class="flex flex-row items-center gap-3 mt-3">
                    <x-input type="text" id="descriptionCategory" wire:model="category_description" class="w-full"
                        placeholder="Descripción de Categoría" />
                    <x-input-error for="description_category" />
                </div>
            </div>

            <div class="peer-checked/cat:hidden block  bg-slate-300 dark:bg-slate-800 p-3 rounded-md mt-5">
                <h2>Paso 2: Subcategoría - Seleccionar o llenar datos de subcategoría</h2>
                <x-checkbox type="checkbox" wire:wire="mostrarcontenido" id="subChange"
                    class="peer/sub w-5 h-5" /><label class="text-slate-500 ml-3"> ¿No existe la Categoría? </label>
                <div class="peer-checked/sub:hidden flex flex-col col-span-2 mt-3" id="selectCategory" id="published">

                    <x-select id="SubcategorySelect" wire:model="subcategory_id">
                        <option value="">Seleccione una subcategoría</option>
                        @foreach ($subcategorias as $sub)
                            <option value="{{ $sub->id_subcategoria }}">{{ $sub->nom_subcategoria }}</option>
                        @endforeach
                    </x-select>
                </div>

                <div id="newCategory"
                    class="peer-checked/sub:block hidden transition-all duration-3000 ease-in-out col-span-2">
                    <div class="flex flex-row items-center gap-3 mt-3">
                        <x-input type="text" id="subcategoryName1" wire:model="subcategory_name" class="w-full"
                            placeholder="Nombre de Subcategoria" />
                        <x-input-error for="subcategory_name" />
                    </div>
                </div>
            </div>

            <div class="peer-checked/cat:block hidden bg-slate-300 dark:bg-slate-800 p-3 rounded-md mt-5">
                <h2>Paso 2: Subcategoría - Llenar datos de subcategoría</h2>
                <div id="newCategory">
                    <div class="flex flex-row items-center gap-3 mt-3">
                        <x-input type="text" id="subcategoryName" wire:model="subcategory_name" class="w-full"
                            placeholder="Nombre de Subcategoria" />
                        <x-input-error for="subcategory_name" />
                    </div>
                </div>
            </div>
        </fieldset>


        <fieldset class="bg-slate-300 dark:bg-slate-800 p-5 rounded-md ">
            <h2>Paso 3: Tipo de Muestras - Agregar Tipo de Muestras</h2>

            <div class="grid gap-3 mb-3 mt-3">
                <div class="w-full">
                    <x-input type="text" placeholder="Nombre Tipo muestra" class="w-full"
                        wire:model="nom_tipo_muestra" />
                    <x-input-error for="nom_tipo_muestra" />
                </div>
                <div class="grid grid-cols-3 max-md:grid-cols-1 gap-3">
                    <div class="w-full">
                        <x-input type="text" placeholder="Cantidad Requerida" class="w-full"
                            wire:model="cantidad_requerida" />
                        <x-input-error for="cantidad_requerida" />
                    </div>
                    <div class="w-full">
                        <x-select wire:model="unidad_medida" class="w-full">
                            <option value="">Seleccione una unidad de medida</option>
                            @foreach ($unidad_medidas as $sub)
                                <option value="{{ $sub->id_unidad_medida }}">{{ $sub->nombre_unidad }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="unidad_medida" />
                    </div>
                    <div class="w-full">
                        <x-select wire:model="unidad_metodo" class="w-full">
                            <option value="">Seleccione una unidad de metodo</option>
                            @foreach ($unidad_metodos as $sub)
                                <option value="{{ $sub->id_unidad_metodo }}">{{ $sub->descripcion }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="unidad_metodo" />
                    </div>
                </div>
            </div>
            <div class="w-full">
                <x-textarea type="text" placeholder="Caracteristicas" class="w-full"
                    wire:model="caracteristicas"></x-textarea>
                <x-input-error for="caracteristicas" />
            </div>
            <div class="mb-3 flex justify-end ">
                <x-button type="button" wire:click="addSubcategory"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-circle-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                        <path d="M9 12h6" />
                        <path d="M12 9v6" />
                    </svg> <span class="ml-2">Agregar</span>
                </x-button>
            </div>

            <x-table>
                <x-slot name="titles">
                    <x-th>No.</x-th>
                    <x-th>Nombre</x-th>
                    <x-th>Cantidad Requerida</x-th>
                    <x-th>Unidad de Medida</x-th>
                    <x-th>Unidad de Método</x-th>
                    <x-th>Características</x-th>
                    <x-th>Eliminar</x-th>
                </x-slot>
                <x-slot name="content">
                    @foreach ($list_sub as $index => $subcat)
                        <x-tr>
                            <x-td wire:key="sub-{{ $index }}">{{ $index + 1 }}</x-td>
                            <x-td>{{ $subcat['nom_tipo_muestra'] }}</x-td>
                            <x-td>{{ $subcat['cantidad_requerida'] }}</x-td>
                            <x-td>
                                @foreach ($unidad_medidas as $medidas)
                                    @if ($medidas->id_unidad_medida == $subcat['unidad_medida'])
                                        {{ $medidas->nombre_unidad }}
                                    @endif
                                @endforeach
                            </x-td>
                            <x-td>
                                @foreach ($unidad_metodos as $metodo)
                                    @if ($metodo->id_unidad_metodo == $subcat['unidad_metodo'])
                                        {{ $metodo->descripcion }}
                                    @endif
                                @endforeach
                            </x-td>

                            <x-td>{{ $subcat['caracteristicas'] }}</x-td>
                            <x-td><x-danger-button type="button"
                                    wire:click="deteSubcategory({{ $index }})"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 6l-12 12" />
                                        <path d="M6 6l12 12" />
                                    </svg></x-danger-button></x-td>
                        </x-tr>
                    @endforeach
                </x-slot>
            </x-table>


            <x-input-error for="list_sub" />
        </fieldset>

        <div class="flex justify-between">
            <x-danger-button wire:click="cancelSub">Cancelar</x-danger-button>
            <x-button>Guardar</x-button>
        </div>
    </form>
</div>
