<?php

namespace App\Livewire\Administrador\Ordenes;

use App\Models\estatus_orden_servicio;
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
    public $view_dates = 0;
    public $shearch_state = '';
    public $search = '';
    public $date_one;
    public $date_two;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    //&================================================================= Nuevo Registro

    public function new_register(){
        //redirigir
        return redirect()->route('admin.ordenes.new_register');
    }

    //&================================================================= Datos
    public $estatus;
    public function mount()
    {
        $this->estatus = estatus_orden_servicio::where('estatus', '1')->get();
    }

    public function render()
    {
        $count = orden_servicio::count();
        $ordenes = orden_servicio::paginate($this->view_dates);
        return view('livewire.administrador.ordenes.ordenes', compact('count', 'ordenes'));
    }
}
