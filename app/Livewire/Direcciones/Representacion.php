<?php

namespace App\Livewire\Direcciones;

use App\Models\estado;
use App\Models\representacion as ModelsRepresentacion;
use App\Models\zona_representacion;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Representacion extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $search;
    public $view_dates = 10;
    public function updatingSearch()
    {
        $this->resetPage();

    }

    //&================================================================= Nuevo Registro
    public $new = false;
    
    public function new_register()
    {
        $this->new = true;
    }

    #[On('newRegister')]
    public function register_new(){
        session()->flash('green', 'Agregada correctamente');
    }

    #[On('cancelRegister')]
    public function new_cancel()
    {
        $this->new = false;
    }


    //&=================================================================Editar Registro
    public $edit = false;
    public $editId='';
    
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
    }

    
    public function edit_cancel(){
        $this->edit = false;
    }

    #[On('editRegister')]
    public function register_edit(){
        $this->edit = false;
        session()->flash('blue', 'Editado correctamente');
    }

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    
    public function render()
    {
        $count = ModelsRepresentacion::where(function ($query) {
            $query->where('nombre_zona', 'LIKE', '%' . $this->search . '%')->orWhere('idzona_representacion', 'LIKE', '%' . $this->search . '%');
        })->count();
        $zonas = ModelsRepresentacion::where(function ($query) {
            $query->where('nombre_zona', 'LIKE', '%' . $this->search . '%')->orWhere('idzona_representacion', 'LIKE', '%' . $this->search . '%');
        })->paginate($this->view_dates);

        return view('livewire.direcciones.representacion', compact('count', 'zonas'));
    }
    
}
