<?php

namespace App\Livewire\Componentes\Ordenes;

use App\Models\muestra_orden_servicio;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Muestras extends Component
{
    #[Reactive]
    public $IdOrden;


    //&================================================================= view muestra
    public $muestRegister=[
        'categoria',
        'subcategoria',
        'muestra',
        'descripcion',
        'analisis',
        'especifico',
        'procedencia',
        'cantidad',
        'medida',
        'lote',
        'productor',
        'muestreo',
        'envio',
        'otros',
        'respuesta',
        'estatus',
    ];

    
    public $muestra=false;
    public $viewstatus;

    public function view_muestra($id){
        $this->muestra=true;
        $muestras=muestra_orden_servicio::find($id);
        $this->muestRegister=[
        'categoria'=> $muestras->categoria->nombre_categoria,
        'subcategoria' => $muestras->subcategoria->nom_subcategoria,
        'muestra' => $muestras->tipo_muestra->nom_tipo_muestra,
        'descripcion' => $muestras->descripcion_muestra->nombre_descrip,
        'analisis' => $muestras->tipo_analisis->nomb_tipo_analisis,
        'especifico' => $muestras->analisis_especifico->nombre_comercial,
        'procedencia' => $muestras->procedencia->sitio_muestreo,
        'cantidad' => $muestras->cantidad_enviada,
        'medida' => $muestras->unidad_medida->nombre_unidad,
        'lote' => $muestras->no_lote,
        'productor' => $muestras->productor_responsable,
        'muestreo' => date('d-m-Y', strtotime($muestras->fecha_muestreo)),
        'envio' => date('d-m-Y', strtotime($muestras->fecha_envio)),
        'otros' => $muestras->otros_datos,
        'respuesta' => $muestras->tiempo_respuesta,
        'estatus' => $muestras->status_muestra->nombre_status,
        ];
        $this->viewstatus=$muestras->estatus;

    }

    public function view_muestra_cancel(){
        $this->muestra=false;
        $this->reset('muestra');
    }


    //&================================================================= Estatus

    public $estatus=false;
    public $estatusId="";
    public function estatus_muestra($id){
        $this->estatus=true;
        $this->estatusId=$id;
    }

    public function status_update(){
        $muestra=muestra_orden_servicio::find($this->estatusId);
        $muestra->estatus = ($muestra->estatus == 1)? 0 : 1;
        $muestra->save();
        $this->viewstatus=$muestra->estatus;
        $this->estatus=false;
    }

    public function status_cancel(){
        $this->estatus=false;
    }

    //&================================================================= render

    public function render()
    {
        $count = muestra_orden_servicio::where('id_orden_servicio',$this->IdOrden)->count();
        $muestras = muestra_orden_servicio::where('id_orden_servicio',$this->IdOrden)->get();
        return view('livewire.componentes.ordenes.muestras',compact('count','muestras'));
    }
}
