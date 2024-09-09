<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\unidad_medida;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;

#[lazy]
class Unidadmedida extends Component
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

    public $newRegister = [
        'descripcion' => '',
        'abreviatura' => '',
    ];

    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.descripcion' => 'required|max:100|unique:unidad_medida,nombre_unidad',
            'newRegister.abreviatura' => 'required|max:10',
        ], [
            'newRegister.descripcion.required' => __('El nombre de la unidad de medida es requerida'),
            'newRegister.descripcion.max' => __('El nombre debe tener máximo 100 caracteres'),
            'newRegister.descripcion.unique' => __('Esta unidad de medida ya está registrada'),
            'newRegister.abreviatura.required' => __('La abreviatura es requerida'),
            'newRegister.abreviatura.max' => __('La abreviatura debe tener máximo 10 caracteres'),
        ]);

        unidad_medida::create([
            'nombre_unidad' => $this->newRegister['descripcion'],
            'abreviatura' => $this->newRegister['abreviatura'],
        ]);
        $this->new = false;
        $this->reset('newRegister');
        session()->flash('green', 'Agregada correctamente');
    }

    public function new_cancel()
    {
        $this->new = false;
        $this->reset('newRegister');
    }

    //&================================================================= Actualizacion Registros
    public $edit = false;
    public $editId;
    public $editRegister = [
        'descripcion' => '',
        'abreviatura' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = unidad_medida::find($id);
        $this->editRegister = [
            'descripcion' => $register->nombre_unidad,
            'abreviatura' => $register->abreviatura,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.descripcion' => 'required|max:100|unique:unidad_medida,nombre_unidad,'.$this->editId .',id_unidad_medida',
            'editRegister.abreviatura' => 'required|max:10',
        ], [
            'editRegister.descripcion.required' => __('El nombre de la unidad de medida es requerida'),
            'editRegister.descripcion.max' => __('El nombre debe tener máximo 100 caracteres'),
            'editRegister.descripcion.unique' => __('Esta unidad de medida ya está registrada'),
            'editRegister.abreviatura.required' => __('La abreviatura es requerida'),
            'editRegister.abreviatura.max' => __('La abreviatura debe tener máximo 10 caracteres'),
        ]);
        //store
        $categoria = unidad_medida::find($this->editId);
        $categoria->update([
            'nombre_unidad' => $this->editRegister['descripcion'],
            'abreviatura' => $this->editRegister['abreviatura'],
        ]);
        $this->edit = false;
        $this->reset('editRegister');
        session()->flash('blue', 'Editado correctamente');
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
        $statusregister = unidad_medida::find($id);
        $this->viewstatus = $statusregister->estatus;
    }

    public function status_update()
    {
        $date = unidad_medida::find($this->statusId);
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


    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $count=unidad_medida::where('nombre_unidad', 'LIKE', '%' . $this->search . '%')->count();
        $datos = unidad_medida::where('nombre_unidad', 'LIKE', '%' . $this->search . '%')->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.unidadmedida', compact('count', 'datos'));
    }
}
