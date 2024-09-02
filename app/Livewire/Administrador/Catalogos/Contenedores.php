<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\contenedores as ModelsContenedores;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;


#[Lazy()]
class Contenedores extends Component
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
        'tipo_contenedor' => '',
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.tipo_contenedor' => 'required|max:45|unique:contenedores,tipo_contenedor',
        ], [
            'newRegister.tipo_contenedor.required' => __('El nombre del contenedor es requerido'),
            'newRegister.tipo_contenedor.max' => __('El nombre contenedor debe tener máximo 45 caracteres'),
            'newRegister.tipo_contenedor.unique' => __('Este contenedor ya está registrado'),

        ]);
        //store
        ModelsContenedores::create([
            'tipo_contenedor' => $this->newRegister['tipo_contenedor'],
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
        'tipo_contenedor' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = ModelsContenedores::find($id);
        $this->editRegister = [
            'tipo_contenedor' => $register->tipo_contenedor,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.tipo_contenedor' => 'required|max:100|unique:contenedores,tipo_contenedor,'.$this->editId .',idcontenedor',
        ], [
            'editRegister.tipo_contenedor.required' => __('El nombre del contenedor es requerido'),
            'editRegister.tipo_contenedor.max' => __('El nombre contenedor debe tener máximo 45 caracteres'),
            'editRegister.tipo_contenedor.unique' => __('Este contenedor ya está registrado'),
        ]);
        //store
        $categoria = ModelsContenedores::find($this->editId);
        $categoria->update([
            'tipo_contenedor' => $this->editRegister['tipo_contenedor'],
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
        $count=ModelsContenedores::where('tipo_contenedor', 'LIKE', '%' . $this->search . '%')->count();
        $contenedores = ModelsContenedores::where('tipo_contenedor', 'LIKE', '%' . $this->search . '%')->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.contenedores', compact('count', 'contenedores'));
    }
}
