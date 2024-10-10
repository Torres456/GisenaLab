<?php

namespace App\Livewire\Forms;

use App\Models\orden_servicio;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OrdenesAdminCreateForm extends Form
{
        public $prioridad;
        public $factura;
        public $informacion;
        public $cliente;
        public $interesado;
        public $remision;
        public $documento;
        public $folio;
        public $netsuite;

        public $id;

        public function create(){
            $this->validate([
                'prioridad' => ['required'],
                'factura' => ['required'],
                'cliente' => ['required'],
                'interesado' => ['required'],
            ]);
    
            $this->id = orden_servicio::create([
                //fecha actual
                'fecha_orden' => now(),
                'prioridad' => $this->prioridad,
                'requiere_factura' => $this->factura,
                'inf_adicional' => $this->informacion,
                'id_cliente' => $this->cliente,
                'id_cotizacion' => '1',
                'id_interesado' => $this->interesado,
                'remision_muestra' => $this->remision,
                'tipo_documento' => $this->documento,
                'folio_documento' => $this->folio,
                'netsuite' => $this->netsuite,
                'id_status_orden_servicio' => '1',
                'estatus' => 1,
            ]);
            return redirect()->route('admin.ordenes.new_muestras', ['id' => $this->id]);
    
            /*DB::beginTransaction();
            try {
    
                
    
                return redirect()->route('admin.ordenes.new_muestras', ['id' => $this->id]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                abort(500);
            }*/
        }
}
