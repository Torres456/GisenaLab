<?php

namespace App\Livewire\Administrador\Flujos;

use App\Livewire\Administrador\Catalogos\Categorias;
use App\Livewire\Administrador\Catalogos\Subcategorias;
use App\Models\catalogo_categoria;
use App\Models\catalogo_subcategoria;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

use function Laravel\Prompts\error;

class FluejoSubcategorias extends Component
{
    public $name_category,$description_category,$name_subcategoria;
    public $categories;
    public $list_sub=[];

   //reglas para neme_subcategoria
    protected $rules=[
        'name_category'=>'unique:catalogo_categoria,nombre_categoria',
        'name_subcategoria'=>'unique:catalogo_subcategoria,nom_subcategoria',
        'list_sub'=>'required'
    ]; 

    //mensajes perosnalisados de las reglas
    protected $messages=[
        'name_subcategoria.required'=>'El nombre de la subcategoría es requerido',
        'name_subcategoria.min'=>'El nombre de la subcategoría debe tener al menos 3 caracteres',
        'name_subcategoria.max'=>'El nombre de la subcategoría no puede superar los 100 caracteres',
        'name_subcategoria.unique'=>'Este nombre de subcategoría ya está registrado',
        'list_sub.required'=>'Debe agregar al menos una subcategoría',
        'name_category.required'=>'El nombre de la categoría es requerido',
        'name_category.min'=>'El nombre de la categoría debe tener al menos 3 caracteres',
        'name_category.max'=>'El nombre de la categoría no puede superar los 100 caracteres',
        'description_category.required'=>'La descripción de la categoría es requerida',
        'description_category.min'=>'La descripción de la categoría',
        'description_category.max'=>'La descripción de la categoría no puede superar los 100 caracteres',
    ];
    public function mount()
    {
        $this->categories = catalogo_categoria::all();
    }


    public function addSubcategory(){
        //agregar regra
        $this->validate([
            'name_subcategoria'=>'required|min:3|max:100|unique:catalogo_subcategoria,nom_subcategoria'
        ],[
            'name_subcategoria.required'=>'El nombre de la subcategoría es requerido',
            'name_subcategoria.min'=>'El nombre de la subcategoría debe tener al menos 3 caracteres',
            'name_subcategoria.max'=>'El nombre de la subcategoría no puede superar los 100 caracteres',
            'name_subcategoria.unique'=>'Este nombre de subcategoría ya está registrado',
        ]);

        array_push($this->list_sub,$this->name_subcategoria);
        $this->reset('name_subcategoria');

        //emitir evento js
        $this->dispatch('dataSend');
        
    }

    public function deteSubcategory($index){
        unset($this->list_sub[$index]);
    }


    public $category;

    public function submitForm(){

        // Validar reglas
        $this->validate();

        try{
            if ($this->category){
                $categoryId=$this->category;
    
                foreach($this->list_sub as $sub){
                    catalogo_subcategoria::create([
                        'nom_subcategoria' => $sub,
                        'id_categoria' => $categoryId,
                    ]); 
                }
    
            }else{
                //validaciones
                $this->validate([
                    'name_category'=>'required|min:3|max:100',
                    'description_category'=>'required|min:3|max:100',
                ],[
                    'name_category.required'=>'El nombre de la categoría es requerido o seleccione alguna categoria existente',
                    'name_category.min'=>'El nombre de la categoría debe tener al menos 3 caracteres',
                    'name_category.max'=>'El nombre de la categoría no puede superar los 100 caracteres',
                    'description_category.required'=>'La descripción de la categoría es requerida',
                    'description_category.min'=>'La descripción de la categoría debe tener al menos 3 caracteres',
                    'description_category.max'=>'La descripción de la categoría no puede superar los 100 caracteres',
                ]);
    
                //crear categoria y obtener id
                $categoryId=catalogo_categoria::create([
                    'nombre_categoria' => $this->name_category,
                    'descripcion' => $this->description_category,
                ]);
    
                foreach($this->list_sub as $sub){
                    catalogo_subcategoria::create([
                        'nom_subcategoria' => $sub,
                        'id_categoria' => $categoryId->id_categoria,
                    ]); 
                }
            }
            
        }catch(\Exception $e){
            //rollback
            DB::rollBack();
            abort(500);
        }
        

        //crear subcategorias
        
        $this->reset(['name_category','description_category','list_sub','name_subcategoria','category']);
        session()->flash('green','Subcategorías agregadas correctamente');
    }
    
    public function render()
    {
        return view('livewire.administrador.flujos.fluejo-subcategorias');
    }
}
