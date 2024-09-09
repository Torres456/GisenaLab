<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\unidad_metodo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;

#[lazy]
class Unidadmetodos extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $search;
    public $view_dates=10;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //&================================================================= Nuevo Registro
    public $new = false;
    public $newRegister = [
        'descripcion' => '',
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.descripcion' => 'required|max:100|unique:unidad_metodo,descripcion',
        ], [
            'newRegister.descripcion.required' => __('El nombre de la unidad de metodo es requerida'),
            'newRegister.descripcion.max' => __('El nombre debe tener máximo 100 caracteres'),
            'newRegister.descripcion.unique' => __('Esta unidad de metodo ya está registrada'),
        ]);
        //store
        unidad_metodo::create([
            'descripcion' => $this->newRegister['descripcion'],
        ]);
        $this->new = false;
        $this->reset('newRegister');
        session()->flash('green','Agregada correctamente');
    }

    public function new_cancel()
    {
        $this->new = false;
        $this->reset('newRegister');
    }

    //&================================================================= Editar Registro
    public $edit = false;
    public $editId;
    public $editRegister = [
        'descripcion' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = unidad_metodo::find($id);
        $this->editRegister = [
            'descripcion' => $register->descripcion,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.descripcion' => 'required|max:100|unique:unidad_metodo,descripcion,'.$this->editId .',id_unidad_metodo',
        ], [
            'editRegister.descripcion.required' => __('El nombre de la unidad de metodo es requerida'),
            'editRegister.descripcion.max' => __('El nombre debe tener máximo 100 caracteres'),
            'editRegister.descripcion.unique' => __('Esta unidad de metodo ya está registrada'),
        ]);
        //store
        $categoria = unidad_metodo::find($this->editId);
        $categoria->update([
            'descripcion' => $this->editRegister['descripcion'],
        ]);
        $this->edit = false;
        $this->reset('editRegister');
        session()->flash('blue','Editado correctamente');

    }
    public function edit_cancel()
    {
        $this->edit = false;
        $this->reset('editRegister');
    }

    //&================================================================= Estatus

    public $status = false;
    public $viewstatus;
    public $statusId;
    public function estatus_register($id)
    {
        $this->status = true;
        $this->statusId = $id;
        $statusregister = unidad_metodo::find($id);
        $this->viewstatus = $statusregister->estatus;
    }

    public function status_update()
    {
        $date = unidad_metodo::find($this->statusId);
        $date->estatus = ($this->viewstatus == 1) ? 0 : 1;
        $date->save();
        $this->status = false;
        $this->reset('viewstatus');
        session()->flash('blue', 'Estatus actualizado correctamente');
    }

    public function status_cancel()
    {
        $this->status = false;
        $this->reset('viewstatus');
    }


    //&================================================================= Lazy
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $count= unidad_metodo::where('descripcion','LIKE','%' . $this->search . '%')->count();
        $datos = unidad_metodo::where('descripcion','LIKE','%' . $this->search . '%')->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.unidadmetodos',compact('count','datos'));
    }
}
