<?php

namespace App\Livewire\Catalogos;

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
            'editRegister.descripcion' => 'required|max:100|unique:unidad_metodo,descripcion',
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
    }
    public function edit_cancel()
    {
        $this->edit = false;
        $this->reset('editRegister');
    }



    //&================================================================= Lazy
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $datos = unidad_metodo::where('descripcion','LIKE','%' . $this->search . '%')->paginate($this->view_dates);
        return view('livewire.catalogos.unidadmetodos', compact('datos'));
    }
}
