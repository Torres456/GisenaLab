<?php

namespace App\Livewire\Administrador\Catalogos\Direcciones;

use App\Models\estados_zona;
use App\Models\representacion as ModelsRepresentacion;
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

    //&================================================================= Estado
    public $estados = false;
    public $estadoId='';
    public $estadoszonas=[];

    public function estado_register($id)
    {
        //mostar los estados de zona 
        $this->estados = true;
        $this->estadoId = $id;
        $this->estadoszonas = estados_zona::where('id_zona_representacion', $id)->get();

    }

    public function estado_cancel(){
        $this->estados = false;
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
            $query->where('nombre_zona', 'LIKE', '%' . $this->search . '%')->orWhere('id_zona_representacion', 'LIKE', '%' . $this->search . '%');
        })->count();
        $zonas = ModelsRepresentacion::where(function ($query) {
            $query->where('nombre_zona', 'LIKE', '%' . $this->search . '%')->orWhere('id_zona_representacion', 'LIKE', '%' . $this->search . '%');
        })->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.direcciones.representacion', compact('count','zonas'));
    }
}
