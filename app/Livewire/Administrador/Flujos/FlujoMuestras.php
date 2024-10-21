<?php

namespace App\Livewire\Administrador\Flujos;

use App\Models\catalogo_categoria;
use App\Models\catalogo_subcategoria;
use App\Models\catalogo_tipo_muestra;
use App\Models\descripcion_muestra;
use App\Models\unidad_medida;
use App\Models\unidad_metodo;
use Livewire\Component;
use Livewire\WithPagination;

class FlujoMuestras extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    public $newRegister= [
        'categoriaid',
        'categorianame',
        'categoridescription',
        'subcategoriaid',
        'tipomuestraid'
    ];

    public $categorias,$subcategorias=[],$unidad_metodo=[],$unidad_medida=[],$tipo_muestra=[],$descrip_muestra=[];	


    public function mount(){
        $this->categorias= catalogo_categoria::all();
        $this->unidad_metodo = unidad_metodo::all();
        $this->unidad_medida = unidad_medida::all();
        $this->subcategorias = catalogo_subcategoria::all();
        $this->tipo_muestra = catalogo_tipo_muestra::all();
        $this->descrip_muestra = descripcion_muestra::all();
    }

    //  public function updated($property, $value){
    //      if ($property == 'newRegister.categoriaid'){
    //          $this->subcategorias = catalogo_subcategoria::where('id_categoria', $value)->orderBy('nom_subcategoria', 'asc')->get();
    //      }
    //      if ($property == 'newRegister.subcategoriaid'){
    //          $this->tipo_muestra = catalogo_tipo_muestra::where('id_subcategoria', $value)->orderBy('nom_tipo_muestra', 'asc')->get();
    //      }
    //      if ($property == 'newRegister.tipomuestraid'){
    //          $this->descrip_muestra = descripcion_muestra::where('id_tipo_muestra', $value)->orderBy('nombre_descrip', 'asc')->get();
    //      }
    //  }


     //&================================================================ Register

     public function FormRegister(){

     }
    
    public function render()
    {
        return view('livewire.administrador.flujos.flujo-muestras');
    }
}
