<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\catalogo_categoria;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;

#[lazy]
class Categorias extends Component
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
            'newRegister.nombre' => 'required|max:100|unique:catalogo_categoria,nombre_categoria',
            'newRegister.descripcion' => 'required|max:250',
        ], [
            'newRegister.nombre.required' => __('El nombrede es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'newRegister.nombre.unique' => __('Esta categoria ya está registrada'),
            'newRegister.descripcion.required' => __('La descripcion es requerida'),
            'newRegister.descripcion.max' => __('la descripcion debe tener máximo 100 caracteres'),

        ]);
        //store
        catalogo_categoria::create([
            'nombre_categoria' => $this->newRegister['nombre'],
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
        $register = catalogo_categoria::find($id);
        $this->editRegister = [
            'nombre' => $register->nombre_categoria,
            'descripcion' => $register->descripcion,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:100|unique:catalogo_categoria,nombre_categoria,'.$this->editId .',id_categoria',
            'editRegister.descripcion' => 'required|max:100',
        ], [
            'editRegister.nombre.required' => __('El nombrede es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'editRegister.nombre.unique' => __('Esta categoria ya está registrada'),
            'editRegister.descripcion.required' => __('La descripcion es requerida'),
            'editRegister.descripcion.max' => __('la descripcion debe tener máximo 100 caracteres'),
        ]);
        //store
        $categoria = catalogo_categoria::find($this->editId);
        $categoria->update([
            'nombre_categoria' => $this->editRegister['nombre'],
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
        $statusregister = catalogo_categoria::find($id);
        $this->viewstatus = $statusregister->estatus;
    }

    public function status_update()
    {
        $date = catalogo_categoria::find($this->statusId);
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
        $count=catalogo_categoria::where(function ($query) {
            $query->where('nombre_categoria', 'LIKE', '%' . $this->search . '%')->orWhere('id_categoria', 'LIKE', '%' . $this->search . '%');
        })->count();
        $categorias = catalogo_categoria::where(function ($query) {
            $query->where('nombre_categoria', 'LIKE', '%' . $this->search . '%')->orWhere('id_categoria', 'LIKE', '%' . $this->search . '%');
        })->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.categorias',compact('count','categorias'));
    }
}
