<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\laboratorios as ModelsLaboratorios;
use Livewire\Component;
use Livewire\WithPagination;

class Laboratorios extends Component
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
           'newRegister.descripcion' => 'required|max:100|unique:laboratorios,descripcion_laboratorio',
       ], [
           'newRegister.descripcion.required' => __('El nombre del laboratorio es requerido'),
           'newRegister.descripcion.max' => __('El nombre debe tener máximo 100 caracteres'),
           'newRegister.descripcion.unique' => __('Este laboratorio ya está registrado'),
       ]);
       //store
       ModelsLaboratorios::create([
           'descripcion_laboratorio' => $this->newRegister['descripcion'],
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
       $register = ModelsLaboratorios::find($id);
       $this->editRegister = [
           'descripcion' => $register->descripcion_laboratorio,
       ];
   }
   public function edit_form()
   {
       //validations
       $this->validate([
           'editRegister.descripcion' => 'required|max:100|unique:laboratorios,descripcion_laboratorio,'.$this->editId .',id_laboratorio',
       ], [
           'editRegister.descripcion.required' => __('El nombre del laboratorio es requerida'),
           'editRegister.descripcion.max' => __('El nombre debe tener máximo 100 caracteres'),
           'editRegister.descripcion.unique' => __('Este laboratorio ya está registrado'),
       ]);
       //store
       $categoria = ModelsLaboratorios::find($this->editId);
       $categoria->update([
           'descripcion_laboratorio' => $this->editRegister['descripcion'],
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
       $statusregister = ModelsLaboratorios::find($id);
       $this->viewstatus = $statusregister->estatus;
   }

   public function status_update()
   {
       $date = ModelsLaboratorios::find($this->statusId);
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



   //&================================================================= Lazy
   public function placeholder()
   {
       return view('livewire.placeholders.skeleton');
   }

   //&================================================================= Render
   public function render()
   {
       $count= ModelsLaboratorios::where('descripcion_laboratorio','LIKE','%' . $this->search . '%')->count();
       $datos = ModelsLaboratorios::where('descripcion_laboratorio','LIKE','%' . $this->search . '%')->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.laboratorios',compact('count','datos'));
    }
}
