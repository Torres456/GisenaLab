<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\metodo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;

#[lazy]
class Metodos extends Component
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

    //&================================================================= Nuevo Registros

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
            'newRegister.descripcion' => 'required|max:100|unique:metodo,descripcion',
        ], [
            'newRegister.descripcion.required' => __('El nombre de método es requerido'),
            'newRegister.descripcion.max' => __('El nombre debe tener máximo 100 caracteres'),
            'newRegister.descripcion.unique' => __('Este método ya está registrado'),
        ]);
        //store
        metodo::create([
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
        $register = metodo::find($id);
        $this->editRegister = [
            'descripcion' => $register->descripcion,
        ];
    }

    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.descripcion' => 'required|max:100|unique:metodo,descripcion,' . $this->editId . ',id_metodo',
        ], [
            'editRegister.descripcion.required' => __('El nombre de método es requerido'),
            'editRegister.descripcion.max' => __('El nombre debe tener máximo 100 caracteres'),
            'editRegister.descripcion.unique' => __('Este método ya está registrado'),
        ]);
        //store
        $categoria = metodo::find($this->editId);
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


    //&================================================================= Lazy
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $count= metodo::where('descripcion','LIKE','%' . $this->search . '%')->count();
        $datos = metodo::where('descripcion','LIKE','%' . $this->search . '%')->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.metodos',compact('count','datos'));
    }
}
