<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\tipo_empleado;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class TipoEmpleado extends Component
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
        'nombre' => '',
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.nombre' => 'required|max:70|unique:tipo_empleado,descripcion_puesto',
        ], [
            'newRegister.nombre.required' => __('El nombrede es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 70 caracteres'),
            'newRegister.nombre.unique' => __('Esta categoria ya está registrada'),

        ]);
        //store
        tipo_empleado::create([
            'descripcion_puesto' => $this->newRegister['nombre'],
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

    //&=================================================================Editar Registro
    public $edit = false;
    public $editId;
    public $editRegister = [
        'nombre' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = tipo_empleado::find($id);
        $this->editRegister = [
            'nombre' => $register->descripcion_puesto,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:70|unique:tipo_empleado,descripcion_puesto,'.$this->editId .',id_tipo_empleado',
        ], [
            'editRegister.nombre.required' => __('El nombrede es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 70 caracteres'),
            'editRegister.nombre.unique' => __('Esta categoria ya está registrada'),
        ]);
        //store
        $categoria = tipo_empleado::find($this->editId);
        $categoria->update([
            'descripcion_puesto' => $this->editRegister['nombre'],
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

    public $estatus = false;
    public $viewstatus;
    public $statusId;
    public function estatus_register($id)
    {
        $this->estatus = true;
        $this->statusId = $id;
        $statusregister = tipo_empleado::find($id);
        $this->viewstatus = $statusregister->estatus;
    }

    public function status_update()
    {
        $date = tipo_empleado::find($this->statusId);
        $date->estatus = ($this->viewstatus == 1) ? 0 : 1;
        $date->save();
        $this->estatus = false;
        $this->reset('viewstatus');
        session()->flash('blue', 'Estatus actualizado correctamente');
    }

    public function status_cancel()
    {
        $this->estatus = false;
        $this->reset('viewstatus');
    }

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $count=tipo_empleado::where(function ($query) {
            $query->where('descripcion_puesto', 'LIKE', '%' . $this->search . '%')->orWhere('id_tipo_empleado', 'LIKE', '%' . $this->search . '%');
        })->count();
        $roles = tipo_empleado::where(function ($query) {
            $query->where('descripcion_puesto', 'LIKE', '%' . $this->search . '%')->orWhere('id_tipo_empleado', 'LIKE', '%' . $this->search . '%');
        })->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.tipo-empleado',compact('count','roles'));
    }
}
