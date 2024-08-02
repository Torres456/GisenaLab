<?php

namespace App\Livewire\Direcciones;

use App\Models\estado;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Estados extends Component
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
            'newRegister.nombre' => 'required|max:100|unique:estado,nombre',
            'newRegister.descripcion' => 'required|numeric',
        ], [
            'newRegister.nombre.required' => __('El nombrede es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'newRegister.nombre.unique' => __('Este estado ya está registrado'),
            'newRegister.descripcion.required' => __('La descripcion es requerida'),
            'newRegister.descripcion.numeric' => __('Esta clave es invalida')

        ]);
        //store
        estado::create([
            'nombre' => $this->newRegister['nombre'],
            'clave_estado' => $this->newRegister['descripcion'],
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
        $register = estado::find($id);
        $this->editRegister = [
            'nombre' => $register->nombre,
            'descripcion' => $register->clave_estado,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:100|unique:estado,nombre,'.$this->editId .',id_estado',
            'editRegister.descripcion' => 'required|numeric',
        ], [
            'editRegister.nombre.required' => __('El nombrede es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'editRegister.nombre.unique' => __('Este estado ya está registrado'),
            'editRegister.descripcion.required' => __('La descripcion es requerida'),
            'editRegister.descripcion.numeric' => __('Esta clave es invalida')
        ]);
        //store
        $categoria = estado::find($this->editId);
        $categoria->update([
            'nombre' => $this->editRegister['nombre'],
            'clave_estado' => $this->editRegister['descripcion'],
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
        $count=estado::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')->orWhere('clave_estado', 'LIKE', '%' . $this->search . '%');
        })->count();
        $estados = estado::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')->orWhere('clave_estado', 'LIKE', '%' . $this->search . '%');
        })->paginate($this->view_dates);
        return view('livewire.direcciones.estados',compact('estados','count'));
    }
}
