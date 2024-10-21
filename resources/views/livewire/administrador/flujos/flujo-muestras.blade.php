<div>
    <!-- multistep form -->
    <form id="msform" wire:submit="FormRegister" class="w-full bg-slate-300 dark:bg-slate-800 p-5">
        <!-- progressbar -->
        <ul class="flex gap-3">
            <li id="title1" class="text-sky-500 ">Categorias</li>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-chevrons-right">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 7l5 5l-5 5" />
                <path d="M13 7l5 5l-5 5" />
            </svg>
            <li id="title2" class="">Subcategorias</li>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-chevrons-right">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 7l5 5l-5 5" />
                <path d="M13 7l5 5l-5 5" />
            </svg>
            <li id="title3" class="">Unidad de Metodo</li>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-chevrons-right">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 7l5 5l-5 5" />
                <path d="M13 7l5 5l-5 5" />
            </svg>
            <li id="title4" class="">Unidad de Medida</li>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-chevrons-right">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 7l5 5l-5 5" />
                <path d="M13 7l5 5l-5 5" />
            </svg>
            <li id="title5" class="">Tipo de Muestra</li>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-chevrons-right">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 7l5 5l-5 5" />
                <path d="M13 7l5 5l-5 5" />
            </svg>
            <li id="title6" class="">Descripcion de Muestra</li>
        </ul>
        <!-- ========================================================================Categoria -->
        <fieldset id="form1" class="flex flex-col w-full">
            <h2 class="text-2xl mt-3 mb-3">Categorias</h2>
            <div class="grid gap-3">
                <x-select id="categoriaId" wire:model.live="newRegister.categoriaid">
                    <option value="">Seleccione una opción</option>
                    @foreach ($categorias as $cat)
                        <option value="{{ $cat->id_categoria }}">{{ $cat->nombre_categoria }}</option>
                    @endforeach
                </x-select>
                <div class="flex flex-col w-full">
                    <x-label-tooltip value="{{ __('Nombre Categoria: ') }}"
                        message-text="Este campo es en caso de que no exista la categoria requerida" />
                    <x-input type="text" id="categoriaName" wire:model="newRegister.categorianame"
                        placeholder="Nombre" />
                </div>
                <div class="flex flex-col w-full">
                    <x-label-tooltip value="{{ __('Descripción: ') }}"
                        message-text="Este campo es en caso de que no exista la subcategoria requerida" />
                    <x-input type="text" id="categoriaDescription" wire:model="newRegister.categoridescription"
                        placeholder="Descripcion..." />
                </div>
            </div>
            <div class="flex justify-between mt-3">
                <x-danger-button>Cancelar</x-danger-button>
                <x-button-next type="button" id="butonNext1">Next</x-button-next>
            </div>
        </fieldset>
        <!-- ========================================================================Subcategoria -->
        <fieldset id="form2" class="hidden flex-col w-full">
            <h2 class="text-2xl mt-3 mb-3">Subcategorias</h2>
            <div class="grid gap-3">
                <x-select id="subcategoriaId" wire:model="newRegister.subcategoriaid">
                    <option value="">Seleccione una opción</option>
                    @foreach ($subcategorias as $sub)
                        <option value="{{ $sub->id_subcategoria }}">{{ $sub->nom_subcategoria }}</option>
                    @endforeach
                </x-select>
                <div class="flex flex-col w-full">
                    <x-label-tooltip value="{{ __('Nombre Subcategoria: ') }}"
                        message-text="Este campo es en caso de que no exista la categoria requerida" />
                    <x-input type="text" id="subcategoriaName" wire:model="newRegister.subcategorianame"
                        placeholder="Nombre" />
                </div>
            </div>
            <div class="flex justify-between mt-3">
                <x-danger-button id="butonPrevius1">previus</x-danger-button>
                <x-button-next type="button" id="butonNext2"  >Next</x-button-next>
            </div>
        </fieldset>
        <!-- ========================================================================Unidad de Metodo -->
        <fieldset id="form3" class="hidden flex-col w-full">
            <h2 class="text-2xl mt-3 mb-3">Unidad de Metodo</h2>
            <div class="grid gap-3">
                <x-select id="unidadmetodoId" wire:model="unidad_metodoid">
                    <option value="">Seleccione una opción</option>
                    @foreach ($unidad_metodo as $metodo)
                        <option value="{{ $metodo->id_unidad_metodo }}">{{ $metodo->descripcion }}</option>
                    @endforeach
                </x-select>
                <div class="flex flex-col w-full">
                    <x-label-tooltip value="{{ __('Nombre Unidad Metodo: ') }}"
                        message-text="Este campo es en caso de que no exista la unidad de metdo requerida" />
                    <x-input type="text" id="unidadmetodoName" wire:model="newRegister.unidadmetodoname"
                        placeholder="Nombre" />
                </div>
            </div>
            <div class="flex justify-between mt-3">
                <x-danger-button id="butonPrevius2">previus</x-danger-button>
                <x-button-next type="button" id="butonNext3">Next</x-button-next>
            </div>
        </fieldset>
        <!-- ========================================================================Unidad de Medida -->
        <fieldset id="form4" class="hidden flex-col w-full">
            <h2 class="text-2xl mt-3 mb-3">Unidad de Medida</h2>
            <div class="grid gap-3">
                <x-select id="unidadmedidaId" wire:model="unidad_medidaid">
                    <option value="">Seleccione una opción</option>
                    @foreach ($unidad_medida as $medida)
                        <option value="{{ $medida->id_unidad_medida }}">{{ $medida->nombre_unidad }}</option>
                    @endforeach
                </x-select>
                <div class="flex flex-col w-full">
                    <x-label-tooltip value="{{ __('Nombre Unidad Metodo: ') }}"
                        message-text="Este campo es en caso de que no exista la unidad de metdo requerida" />
                    <x-input type="text" id="unidadmedidaName" wire:model="newRegister.unidadmetodoname"
                        placeholder="Nombre" />
                </div>
            </div>
            <div class="flex justify-between mt-3">
                <x-danger-button id="butonPrevius3">previus</x-danger-button>
                <x-button-next type="button" id="butonNext4">Next</x-button-next>
            </div>
        </fieldset>

        <!-- ========================================================================Tipo de muestra -->
        <fieldset id="form5" class="hidden flex-col w-full">
            <h2 class="text-2xl mt-3 mb-3">Tipo de muestra</h2>
            <div class="grid gap-3">
                <x-select id="tipomuestraId" wire:model="newRegister.tipomuestraid">
                    <option value="">Seleccione una opción</option>
                    @foreach ($tipo_muestra as $nuestra)
                        <option value="{{ $nuestra->id_tipo_muestra }}">{{ $nuestra->nom_tipo_muestra }}</option>
                    @endforeach
                </x-select>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col w-full">
                        <x-label-tooltip value="{{ __('Nombre Tipo Muestra: ') }}"
                            message-text="Este campo es en caso de que no exista la unidad de metdo requerida" />
                        <x-input type="text" id="tipomuestraName" wire:model="newRegister.tipomuestraname"/>
                    </div>
                    <div class="flex flex-col w-full">
                        <x-label-tooltip value="{{ __('Caracteristicas: ') }}"
                            message-text="Este campo es en caso de que no exista la unidad de metdo requerida" />
                        <x-input type="text" id="unidadmetodoCarac" wire:model="newRegister.unidadmetodocarac" />
                    </div>

                    <div class="flex flex-col w-full col-span-2">
                        <x-label-tooltip value="{{ __('Cantidad Requerida: ') }}"
                            message-text="Este campo es en caso de que no exista la unidad de metdo requerida" />
                        <x-input type="text" id="unidadmetodoCanti" wire:model="newRegister.unidadmetodocanti" />
                    </div>

                </div>
            </div>
            <div class="flex justify-between mt-3">
                <x-danger-button id="butonPrevius4">previus</x-danger-button>
                <x-button-next type="button" id="butonNext5">Next</x-button-next>
            </div>
        </fieldset>

        <!-- ========================================================================Descripcion de muestra -->
        <fieldset id="form6" class="hidden flex-col w-full">
            <h2 class="text-2xl mt-3 mb-3">Descripcion de muestra</h2>
            <div class="grid gap-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col w-full col-span-2">
                        <x-label-tooltip value="{{ __('Descripcion de Muestra: ') }}"
                            message-text="Este campo es en caso de que no exista la descripcion de muetra requerida" />
                        <x-input type="text" id="descripcionMuetra" wire:model="newRegister.descripcionmuetra" />
                    </div>
                </div>
            </div>
            <div class="flex justify-between mt-3">
                <x-danger-button id="butonPrevius5">previus</x-danger-button>
                <x-button  id="butonNext6">Guardar</x-button>
            </div>
        </fieldset>
    </form>
</div>
