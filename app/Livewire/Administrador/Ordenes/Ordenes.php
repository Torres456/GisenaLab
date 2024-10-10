<?php

namespace App\Livewire\Administrador\Ordenes;

use App\Models\estatus_orden_servicio;
use App\Models\muestra_orden_servicio;
use App\Models\orden_servicio;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Ordenes extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $view_dates = 10;
    public $shearch_state;
    public $search = '';
    public $date_one = "";
    public $date_two = "";

    public function updatingSearch()
    {
        $this->resetPage();
    }
    //&====================================================================Validacion
    protected $rules = [
        'date_one' => 'date|before_or_equal:date_two',
        'date_two' => 'date|after_or_equal:date_one',
    ];

    //&================================================================= Nuevo Registro

    public function new_register()
    {
        //redirigir
        return redirect()->route('admin.ordenes.new_register');
    }

    //&================================================================= editar Registro

    public function edit_register($id)
    {
        //redirigir
        return redirect()->route('admin.ordenes.edit_register', ['id' => $id]);
    }

    //&================================================================= Muestras

    public $muestras_orden = false;
    public $IdOrden;

    public function muestras_register($id)
    {
        $this->muestras_orden = true;
        $this->IdOrden = $id;
    }

    public function cancel_muestras()
    {
        $this->muestras_orden = false;
    }

    //&================================================================= Datos
    public $status, $muestras;

    public function mount()
    {
        $this->status = estatus_orden_servicio::where('estatus', '1')->get();

        //$this->date_one = now()->format('Y-m-d');
        //$this->date_two = now()->format('Y-m-d');
        $this->validate();
    }

    public function reiniciar_fechas(){
        $this->date_one = "";
        $this->date_two = "";
    }

    public function reiniciar_filtros(){
        $this->shearch_state = "";
        $this->search = "";
        $this->date_one = "";
        $this->date_two = "";

        $this->resetPage();
    }

    public function updated($property, $value)
    {
        if ($property == 'date_one') {
            $this->resetPage();
            $this->date_two = "";
        }
    }

    //&================================================================= Estatus

    public $estatus_orden = false;
    public $viewstatus;
    public $statusId;
    public function estatus_register($id)
    {
        $this->estatus_orden = true;
        $this->statusId = $id;
        $statusregister = orden_servicio::find($id);
        $this->viewstatus = $statusregister->estatus;
    }

    public function status_update()
    {
        $date = orden_servicio::find($this->statusId);
        $date->estatus = ($this->viewstatus == 1) ? 0 : 1;
        $date->save();
        $this->estatus_orden = false;
        $this->reset('viewstatus');
        session()->flash('blue', 'Estatus actualizado correctamente');
    }

    public function status_cancel()
    {
        $this->estatus_orden = false;
        $this->reset('viewstatus');
    }

    //&================================================================= Estados

    public $estado_orden = false;
    public $estado = "";
    public $IdEstado;
    public function estado_register($id)
    {
        $this->estado_orden = true;
        $this->IdEstado = $id;
        $estado_orden = orden_servicio::find($id);
        $this->estado = $estado_orden->id_status_orden_servicio;
    }

    public function update_estado()
    {
        $orden = orden_servicio::find($this->IdEstado);
        $orden->id_status_orden_servicio = $this->estado;
        $orden->save();
        $this->estado_orden = false;
        $this->reset('estado');
        session()->flash('blue', 'Estado actualizado correctamente');
    }

    public function estado_cancel()
    {
        $this->estado_orden = false;
        $this->reset('estado');
    }

    //&================================================================= Render

    public function render()
    {
        $count =  orden_servicio::where('id_orden_servicio', 'LIKE', '%' . $this->search . '%')
        ->where('id_status_orden_servicio', 'LIKE', "%" . $this->shearch_state . '%')
        ->when($this->date_one, function ($query) {
            $query->when($this->date_two, function ($query) {
                $query->whereBetween('fecha_orden', [$this->date_one, $this->date_two]);
            }, function ($query) {
                $query->whereDate('fecha_orden', $this->date_one);
            });
        })
            ->count();

        $ordenes = orden_servicio::where('id_orden_servicio', 'LIKE', '%' . $this->search . '%')
            ->where('id_status_orden_servicio', 'LIKE', "%" . $this->shearch_state . '%')
            ->when($this->date_one, function ($query) {
                $query->when($this->date_two, function ($query) {
                    $query->whereBetween('fecha_orden', [$this->date_one, $this->date_two]);
                }, function ($query) {
                    $query->whereDate('fecha_orden', $this->date_one);
                });
            })
            ->paginate($this->view_dates);

        return view('livewire.administrador.ordenes.ordenes', compact('count', 'ordenes'));
    }
}
