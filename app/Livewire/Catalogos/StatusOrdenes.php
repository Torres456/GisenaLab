<?php

namespace App\Livewire\Catalogos;

use App\Models\estatus_orden_servicio;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class StatusOrdenes extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $search;
    public $view_dates = 10;

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
            'newRegister.nombre' => 'required|max:45|unique:status_orden_servicio,nombre',
            'newRegister.descripcion' => 'required|max:250',
        ], [
            'newRegister.nombre.required' => __('El nombre  es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 45 caracteres'),
            'newRegister.nombre.unique' => __('Este recipiente ya está registrado'),
            'newRegister.descripcion.required' => __('La descripcion es requerida'),
            'newRegister.descripcion.max' => __('La descripcion debe tener máximo 250 caracteres'),

        ]);
        //store
        estatus_orden_servicio::create([
            'nombre' => $this->newRegister['nombre'],
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
        $register = estatus_orden_servicio::find($id);
        $this->editRegister = [
            'nombre' => $register->nombre,
            'descripcion' => $register->descripcion,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:45',
            'editRegister.descripcion' => 'required|max:250',
        ], [
            'editRegister.nombre.required' => __('El nombre  es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 45 caracteres'),
            'editRegister.descripcion.required' => __('La descripcion es requerida'),
            'editRegister.descripcion.max' => __('La descripcion debe tener máximo 250 caracteres'),
        ]);
        //store
        $categoria = estatus_orden_servicio::find($this->editId);
        $categoria->update([
            'nombre' => $this->editRegister['nombre'],
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

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $status=estatus_orden_servicio::where('nombre','LIKE','%' . $this->search . '%')->paginate($this->view_dates);
        return view('livewire.catalogos.status-ordenes',compact('status'));
    }
}
