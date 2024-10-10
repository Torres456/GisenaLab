<?php

namespace App\Livewire\Administrador\Ordenes;

use App\Livewire\Administrador\Catalogos\Categorias;
use App\Models\catalogo_analisis_especifico;
use App\Models\catalogo_categoria;
use App\Models\catalogo_subcategoria;
use App\Models\catalogo_tipo_analisis;
use App\Models\catalogo_tipo_muestra;
use App\Models\descripcion_muestra;
use App\Models\muestra_orden_servicio;
use App\Models\procedencias;
use App\Models\unidad_medida;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class CreateMuestras extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    #[Reactive]
    public $orderId;

    //&================================================================= Cretae 
    public $newRegister = [
        'categoria',
        'subcategoria',
        'tipo_muestra',
        'descripcion_muestra',
        'tipo_analisis',
        'analisis_especifico',
        'procedencia',
        'lote',
        'cantidad',
        'unidad_medida',
        'muestreo',
        'envio',
        'productor',
        'tiempo'
    ];

    public $muestra = false;

    public function new()
    {
        $this->muestra = true;
    }

    public function new_register()
    {
        $this->validate([
            'newRegister.categoria' => ['required'],
            'newRegister.subcategoria' => ['required'],
            'newRegister.tipo_muestra' => ['required'],
            'newRegister.descripcion_muestra' => ['required'],
            'newRegister.tipo_analisis' => ['required'],
            'newRegister.analisis_especifico' => ['required'],
            'newRegister.procedencia' => ['required'],
            'newRegister.lote' => ['required'],
            'newRegister.cantidad' => ['required', 'numeric'],
            'newRegister.unidad_medida' => ['required'],
            'newRegister.muestreo' => ['required'],
            'newRegister.envio' => ['required'],
            'newRegister.productor' => ['required'],
            'newRegister.tiempo' => ['required'],
            'newRegister.unidad_medida' => ['required'],
            'newRegister.muestreo' => ['required'],
            'newRegister.envio' => ['required'],
            'newRegister.productor' => ['required'],
            'newRegister.tiempo' => ['required'],
        ],[
            'newRegister.categoria.required' => 'La categoria es requerida',
            'newRegister.subcategoria.required' => 'La sub categoria es requerida',
            'newRegister.tipo_muestra.required' => 'El tipo de muestra es requerido',
            'newRegister.descripcion_muestra.required' => 'La descripcion de muestra es requerida',
            'newRegister.tipo_analisis.required' => 'El tipo de analisis es requerido',
            'newRegister.analisis_especifico.required' => 'El analisis especifico es requerido',
            'newRegister.procedencia.required' => 'La procedencia es requerida',
            'newRegister.lote.required' => 'El lote es requerido',
            'newRegister.cantidad.required' => 'La cantidad es requerida',
            'newRegister.unidad_medida.required' => 'La unidad de medida es requerida',
            'newRegister.muestreo.required' => 'El muestreo es requerido',
            'newRegister.envio' => 'El envio es requerido',
            'newRegister.productor.required' => 'El productor es requerido',
            'newRegister.tiempo.required' => 'El tiempo es requerido',
        ]);

        muestra_orden_servicio::create([
            'id_orden_servicio' => $this->orderId,
            'id_categoria' => $this->newRegister['categoria'],
            'id_subcategoria' => $this->newRegister['subcategoria'],
            'id_tipo_muestra' => $this->newRegister['tipo_muestra'],
            'id_descrip_muestra' => $this->newRegister['descripcion_muestra'],
            'id_tipo_analisis' => $this->newRegister['tipo_analisis'],
            'id_analisis_especifico' => $this->newRegister['analisis_especifico'],
            'id_procedencia' => $this->newRegister['procedencia'],
            'lote' => $this->newRegister['lote'],
            'cantidad_enviada' => $this->newRegister['cantidad'],
            'id_unidad_medida' => $this->newRegister['unidad_medida'],
            'no_lote' => $this->newRegister['lote'],
            'fecha_muestreo' => $this->newRegister['muestreo'],
            'fecha_envio' => $this->newRegister['envio'],
            'idioma_informe' => "es",
            'id_procedencia_orden'=>'1',
            'productor_responsable' => $this->newRegister['productor'],
            'tiempo_respuesta' => $this->newRegister['tiempo'],
            'id_status_muestra'=>'1'
        ]);

        $this->new_cancel();
    }

    public function new_cancel()
    {
        $this->muestra = false;
        $this->reset('newRegister');
    }

    //&================================================================= Procedencias

    public $procedencias_orden=false;
    public $IdProce;

    public function procedencia_register($id){

        $this->procedencias_orden=true;
        $this->IdProce=$id;
    }

    public function procedencia_cancel(){
        $this->procedencias_orden=false;
    }
    //&================================================================= Datos

    public $categorias, $subcategorias = [], $tipo_muestras = [], $descripcion_muestras = [], $tipo_analisis = [];
    public $analisis_especifico = [], $procedencias = [], $unidad_medidas = [] ;

    public function mount()
    {
        $this->categorias = catalogo_categoria::where('estatus', '1')->get();
        $this->procedencias = procedencias::where('estatus','1')->get();
    }

    public function updated($property, $value)
    {
        if ($property == 'newRegister.categoria') {
            $this->subcategorias = [];
            $this->tipo_muestras = [];
            $this->descripcion_muestras = [];
            $this->tipo_analisis = [];
            $this->analisis_especifico = [];


            $this->subcategorias = catalogo_subcategoria::where('id_categoria', $value)->orderBy('nom_subcategoria', 'asc')->get();
        } else if ($property == 'newRegister.subcategoria') {
            $this->tipo_muestras = [];
            $this->descripcion_muestras = [];
            $this->tipo_analisis = [];
            $this->analisis_especifico = [];


            $this->tipo_muestras = catalogo_tipo_muestra::where('id_subcategoria', $value)->orderBy('nom_tipo_muestra', 'asc')->get();
        }else if ($property == 'newRegister.tipo_muestra') {
            $this->descripcion_muestras = [];
            $this->tipo_analisis = [];
            $this->analisis_especifico = [];
            $this->unidad_medidas = [];


            $unidad= catalogo_tipo_muestra::find($value); 
            $this->descripcion_muestras = descripcion_muestra::where('id_tipo_muestra', $value)->orderBy('nombre_descrip', 'asc')->get();
            $this->tipo_analisis = catalogo_tipo_analisis::where('id_tipo_muestra', $value)->orderBy('nomb_tipo_analisis', 'asc')->get();
            $this->unidad_medidas = unidad_medida::where('id_unidad_medida',$unidad->id_unidad_medida)->get();
        }
        else if ($property == 'newRegister.tipo_analisis') {
            $this->analisis_especifico = [];


            $this->analisis_especifico = catalogo_analisis_especifico::where('id_tipo_analisis', $value)->orderBy('nombre_comercial', 'asc')->get();
        }
    }
    

    //&================================================================= CAncelar Orden

    public $cancelar_orden = false;

    public function cancel()
    {
        $this->cancelar_orden = true;
    }

    public function cancel_orden()
    {
        $this->reset();
        return redirect()->route('admin.ordenes.ordenes');
    }

    public function continiu_orden()
    {
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
        $count = muestra_orden_servicio::where('id_orden_servicio', $this->orderId)->count();
        $muestras = muestra_orden_servicio::where('id_orden_servicio', $this->orderId)->paginate(10);
        return view('livewire.administrador.ordenes.create-muestras', compact('count', 'muestras'));
    }
}
