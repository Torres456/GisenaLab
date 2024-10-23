<?php

namespace App\Livewire\Administrador\Flujos;

use App\Models\catalogo_categoria;
use App\Models\catalogo_subcategoria;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use function Laravel\Prompts\error;

class FluejoSubcategorias extends Component
{
    public $name_category, $description_category, $name_subcategoria;
    public $categories;
    public $category;
    public $list_sub = [];
    public $mostrarcontenido = false;


    //reglas para neme_subcategoria
    protected $rules = [
        'name_category' => 'unique:catalogo_categoria,nombre_categoria',
        'name_subcategoria' => 'unique:catalogo_subcategoria,nom_subcategoria',
        'list_sub' => 'required'
    ];

    //mensajes perosnalisados de las reglas
    protected $messages = [
        'name_subcategoria.required' => 'El nombre de la subcategoría es requerido',
        'name_subcategoria.min' => 'El nombre de la subcategoría debe tener al menos 3 caracteres',
        'name_subcategoria.max' => 'El nombre de la subcategoría no puede superar los 100 caracteres',
        'name_subcategoria.unique' => 'Este nombre de subcategoría ya está registrado',
        'list_sub.required' => 'Debe agregar al menos una subcategoría',
        'name_category.required' => 'El nombre de la categoría es requerido',
        'name_category.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
        'name_category.max' => 'El nombre de la categoría no puede superar los 100 caracteres',
        'description_category.required' => 'La descripción de la categoría es requerida',
        'description_category.min' => 'La descripción de la categoría',
        'description_category.max' => 'La descripción de la categoría no puede superar los 100 caracteres',
    ];
    public function mount()
    {
        $this->categories = catalogo_categoria::all();
    }


    public function addSubcategory()
    {
        //agregar regra
        $this->validate([
            'name_subcategoria' => 'required|min:3|max:100|unique:catalogo_subcategoria,nom_subcategoria'
        ], [
            'name_subcategoria.required' => 'El nombre de la subcategoría es requerido',
            'name_subcategoria.min' => 'El nombre de la subcategoría debe tener al menos 3 caracteres',
            'name_subcategoria.max' => 'El nombre de la subcategoría no puede superar los 100 caracteres',
            'name_subcategoria.unique' => 'Este nombre de subcategoría ya está registrado',
        ]);

        array_push($this->list_sub, $this->name_subcategoria);
        $this->reset('name_subcategoria');

        //emitir evento js
        $this->dispatch('dataSend');
    }

    public function deteSubcategory($index)
    {
        unset($this->list_sub[$index]);
    }

    public function submitForm()
    {

        // Validar reglas
        $this->validate();

        try {
            if ($this->mostrarcontenido == false) {

                $categoryId = $this->category;

                foreach ($this->list_sub as $sub) {
                    catalogo_subcategoria::create([
                        'nom_subcategoria' => $sub,
                        'id_categoria' => $categoryId,
                    ]);
                }
                session()->flash('green', 'Subcategorías agregadas correctamente');
                $this->reset(['name_category', 'description_category', 'list_sub', 'name_subcategoria', 'category']);
            } else if ($this->mostrarcontenido == true) {
                //validaciones
                $this->validate([
                    'name_category' => 'required|min:3|max:100',
                    'description_category' => 'required|min:3|max:100',
                ], [
                    'name_category.required' => 'El nombre de la categoría es requerido o seleccione alguna categoria existente',
                    'name_category.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
                    'name_category.max' => 'El nombre de la categoría no puede superar los 100 caracteres',
                    'description_category.required' => 'La descripción de la categoría es requerida',
                    'description_category.min' => 'La descripción de la categoría debe tener al menos 3 caracteres',
                    'description_category.max' => 'La descripción de la categoría no puede superar los 100 caracteres',
                ]);

                //crear categoria y obtener id
                $categoryId = catalogo_categoria::create([
                    'nombre_categoria' => $this->name_category,
                    'descripcion' => $this->description_category,
                ]);

                foreach ($this->list_sub as $sub) {
                    catalogo_subcategoria::create([
                        'nom_subcategoria' => $sub,
                        'id_categoria' => $categoryId->id_categoria,
                    ]);
                }
                session()->flash('green', 'Subcategorías agregadas correctamente');
                $this->reset(['name_category', 'description_category', 'list_sub', 'name_subcategoria', 'category']);
            } else {
                //mensaje de que no se a agregado categoria
                session()->flash('red', 'No se ha seleccionado ninguna categoría o agregué una nueva');
            }
        } catch (\Exception $e) {
            DB::rollback();
            abort(500);
        }
    }

    public function render()
    {
        return view('livewire.administrador.flujos.fluejo-subcategorias');
    }
}
