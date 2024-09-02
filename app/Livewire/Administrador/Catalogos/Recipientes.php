<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\recipientes as ModelsRecipientes;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Recipientes extends Component
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
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.nombre' => 'required|max:45|unique:recipientes,tipo_recipiente',
        ], [
            'newRegister.nombre.required' => __('El nombre  es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 45 caracteres'),
            'newRegister.nombre.unique' => __('Este recipiente ya está registrado'),

        ]);
        //store
        ModelsRecipientes::create([
            'tipo_recipiente' => $this->newRegister['nombre'],
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
        $register = ModelsRecipientes::find($id);
        $this->editRegister = [
            'nombre' => $register->tipo_recipiente,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:100|unique:recipientes,tipo_recipiente,'.$this->editId .',id_recipiente',
        ], [
            'editRegister.nombre.required' => __('El nombre  es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 45 caracteres'),
            'editRegister.nombre.unique' => __('Este recipiente ya está registrado'),

        ]);
        //store
        $categoria = ModelsRecipientes::find($this->editId);
        $categoria->update([
            'tipo_recipiente' => $this->editRegister['nombre'],
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
        $count=ModelsRecipientes::where('tipo_recipiente','LIKE','%' . $this->search . '%')->count();
        $recipientes=ModelsRecipientes::where('tipo_recipiente','LIKE','%' . $this->search . '%')->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.recipientes',compact('count','recipientes'));
    }
}
