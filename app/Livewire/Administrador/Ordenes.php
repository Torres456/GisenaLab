<?php

namespace App\Livewire\Administrador;

use App\Models\estatus_orden_servicio;
use App\Models\orden_servicio;
use Livewire\Component;
use Livewire\WithPagination;

class Ordenes extends Component
{

    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $view_dates=0;
    public $shearch_state='';
    public $search='';
    public $date_one;
    public $date_two;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    //&================================================================= Datos
    public $estatus;
    public function mount()
    {
        $this->estatus = estatus_orden_servicio::all();
    }

    public function render()
    {
        $count=orden_servicio::count();
        $ordenes=orden_servicio::paginate($this->view_dates);
        return view('livewire.administrador.ordenes',compact('count','ordenes'));
    }
}
