<?php

namespace App\Livewire\Administrador\Ordenes;

use App\Models\catalogo_analisis_especifico;
use App\Models\catalogo_categoria;
use App\Models\catalogo_subcategoria;
use App\Models\catalogo_tipo_analisis;
use App\Models\catalogo_tipo_muestra;
use App\Models\descripcion_muestra;
use App\Models\procedencias;
use App\Models\unidad_medida;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class CreateMuestras extends Component
{
    //&================================================================= Paginacion
    use WithPagination;


    //&================================================================= Datos

    public $categorias,$subcategorias,$tipo_muestras,$descripcion_muestras,$tipo_analisis;
    public $analisis_especifico,$procedencias,$unidad_medidas;

    public function mount()
    {
        $this->categorias = catalogo_categoria::where('estatus','1')->get();
        $this->subcategorias = catalogo_subcategoria::where('estatus','1')->get();
        $this->tipo_muestras = catalogo_tipo_muestra::where('estatus','1')->get();
        $this->descripcion_muestras = descripcion_muestra::where('estatus','1')->get();
        $this->tipo_analisis = catalogo_tipo_analisis::where('estatus','1')->get();
        $this->analisis_especifico = catalogo_analisis_especifico::where('estatus','1')->get();
        $this->procedencias = procedencias::where('estatus','1')->get();
        $this->unidad_medidas = unidad_medida::where('estatus','1')->get();
    }
    //&================================================================= new register
    public $muestra= false;

    public function new(){
         $this->muestra = true;
    }

    public function new_register(){
        $this->muestra = false;
    }

    public function new_cancel(){
         $this->muestra = false;
    }

    //&================================================================= CAncelar Orden

    public $cancelar_orden=false;

    public function cancel(){
         $this->cancelar_orden = true;
    }

    public function cancel_orden(){
        $this->reset();
        return redirect()->route('admin.ordenes.ordenes');
    }

    public function continiu_orden(){
        $this->cancelar_orden = false;
    }

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }
    //&================================================================= Render
    public function render()
    {
        return view('livewire.administrador.ordenes.create-muestras');
    }
}
