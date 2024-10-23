<?php

namespace App\Livewire\Administrador\Flujos;

use App\Models\catalogo_categoria;
use App\Models\catalogo_subcategoria;
use App\Models\unidad_medida;
use App\Models\unidad_metodo;
use Livewire\Component;

class FlujoTipomuestra extends Component
{
    //&================================================================= Mostar Datos
    public $categorias, $subcategorias = [], $unidad_medidas,$unidad_metodos;
    public $list_sub = [];
    public $category_id, $category_name, $category_description;
    public $subcategory_id, $subcategory_name;
    public $nom_tipo_muestra,$caracteristicas,$cantidad_requerida,$unidad_medida,$unidad_metodo;

    public function mount()
    {
        $this->categorias = catalogo_categoria::where('estatus', 1)->get();
        $this->unidad_medidas = unidad_medida::where('estatus', 1)->get();
        $this->unidad_metodos = unidad_metodo::where('estatus', 1)->get();
    }

    public function updated($property, $value)
    {
        if ($property == 'category_id') {
            $this->subcategorias = catalogo_subcategoria::where('id_categoria', $value)->where('estatus', 1)->get();
        }
    }

    //&================================================================= Agreagr tipo Muestra
    public function addSubcategory()
    {
        $this->validate([
            'nom_tipo_muestra' =>'required|string|max:100',
            'caracteristicas' =>'required|string|max:100',
        ],[
            'nom_tipo_muestra.required' => 'El nombre es requerido',
            'nom_tipo_muestra.string' => 'El nombre debe ser una cadena',
            'nom_tipo_muestra.max' => 'El nombre debe tener máximo 255 caracteres',
            'caracteristicas.required' => 'Las características son requeridas',
            'caracteristicas.string' => 'Las características deben ser una cadena',
            'caracteristicas.max' => 'Las características deben tener máximo 255 caracteres',
        ]);


        $this->list_sub[] = [
            'nom_tipo_muestra' => htmlspecialchars($this->nom_tipo_muestra),
            'cantidad_requerida' => htmlspecialchars($this->cantidad_requerida),
            'unidad_medida' => htmlspecialchars($this->unidad_medida),
            'unidad_metodo' => htmlspecialchars($this->unidad_metodo),
            'caracteristicas' => htmlspecialchars($this->caracteristicas),
        ];

        // Reiniciar los valores de los inputs con reset
        $this->reset(['nom_tipo_muestra', 'caracteristicas', 'cantidad_requerida', 'unidad_medida', 'unidad_metodo']);
        

        

    }

    public function deteSubcategory($index)
    {
        unset($this->list_sub[$index]);
    }

    //&================================================================= Agregar Subcategorias

    public function submitForm()
    {
        dd($this->subcategory_name);
    }




    public function render()
    {
        return view('livewire.administrador.flujos.flujo-tipomuestra');
    }
}
