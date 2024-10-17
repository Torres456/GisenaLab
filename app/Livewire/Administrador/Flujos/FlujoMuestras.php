<?php

namespace App\Livewire\Administrador\Flujos;

use App\Models\catalogo_categoria;
use App\Models\catalogo_subcategoria;
use App\Models\catalogo_tipo_muestra;
use App\Models\unidad_medida;
use App\Models\unidad_metodo;
use Livewire\Component;

class FlujoMuestras extends Component
{

    public $newRegister= [
        'categoriaid',
        'categorianame',
        'categoridescription',
        'subcategoriaid'
    ];

    public $categorias,$subcategorias=[],$unidad_metodo=[],$unidad_medida=[],$tipo_muestra=[];	


    public function mount(){
        $this->categorias= catalogo_categoria::all();
        $this->unidad_metodo = unidad_metodo::all();
        $this->unidad_medida = unidad_medida::all();
    }

    public function updated($property, $value){
        if ($property == 'newRegister.categoriaid'){
            $this->subcategorias = catalogo_subcategoria::where('id_categoria', $value)->orderBy('nom_subcategoria', 'asc')->get();
        }
        if ($property == 'newRegister.subcategoriaid'){
            $this->tipo_muestra = catalogo_tipo_muestra::where('id_subcategoria', $value)->orderBy('nom_tipo_muestra', 'asc')->get();
        }
    }
    
    public function render()
    {
        return view('livewire.administrador.flujos.flujo-muestras');
    }
}
