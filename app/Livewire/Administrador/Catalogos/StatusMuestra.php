<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\estatus_muestras;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]

class StatusMuestra extends Component
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
        'nombre' => '',
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
            'newRegister.nombre' => 'required|max:45|unique:status_muestra,nombre_status',
            'newRegister.descripcion' => 'required|max:45',
        ], [
            'newRegister.nombre.required' => __('El nombre  es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 45 caracteres'),
            'newRegister.nombre.unique' => __('Este recipiente ya está registrado'),
            'newRegister.descripcion.required' => __('La descripcion es requerida'),
            'newRegister.descripcion.max' => __('La descripcion debe tener máximo 45 caracteres'),

        ]);
        //store
        estatus_muestras::create([
            'nombre_status' => $this->newRegister['nombre'],
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

    //&=================================================================Editar Registro
    public $edit = false;
    public $editId;
    public $editRegister = [
        'nombre' => '',
        'descripcion' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = estatus_muestras::find($id);
        $this->editRegister = [
            'nombre' => $register->nombre_status,
            'descripcion' => $register->descripcion,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:45|unique:status_muestra,nombre_status,' . $this->editId . ',idstatus_muestra',
            'editRegister.descripcion' => 'required|max:45',
        ], [
            'editRegister.nombre.required' => __('El nombre  es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 45 caracteres'),
            'editRegister.nombre.unique' => __('Este recipiente ya está registrado'),
            'editRegister.descripcion.required' => __('La descripcion es requerida'),
            'editRegister.descripcion.max' => __('La descripcion debe tener máximo 45 caracteres'),
        ]);
        //store
        $categoria = estatus_muestras::find($this->editId);
        $categoria->update([
            'nombre_status' => $this->editRegister['nombre'],
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

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $count= estatus_muestras::where('nombre_status', 'LIKE', '%' . $this->search . '%')->count();
        $status = estatus_muestras::where('nombre_status', 'LIKE', '%' . $this->search . '%')->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.status-muestra',compact('count', 'status'));
    }
}
