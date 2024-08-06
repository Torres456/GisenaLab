<?php

namespace App\Livewire\Direcciones;

use App\Models\representacion as ModelsRepresentacion;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Representacion extends Component
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
            'newRegister.nombre' => 'required|max:45|unique:zona_representacion,nombre_zona',
        ], [
            'newRegister.nombre.required' => __('El nombrede es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 45 caracteres'),
            'newRegister.nombre.unique' => __('Esta zona ya está registrada'),

        ]);
        //store
        ModelsRepresentacion::create([
            'nombre_zona' => $this->newRegister['nombre'],
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
        $register = ModelsRepresentacion::find($id);
        $this->editRegister = [
            'nombre' => $register->nombre_zona,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:45|unique:zona_representacion,nombre_zona,' . $this->editId . ',idzona_representacion',
        ], [
            'editRegister.nombre.required' => __('El nombrede es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 45 caracteres'),
            'editRegister.nombre.unique' => __('Esta zona ya está registrada'), 
        ]);
        //store
        $categoria = ModelsRepresentacion::find($this->editId);
        $categoria->update([
            'nombre_zona' => $this->editRegister['nombre'],
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

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $count = ModelsRepresentacion::where(function ($query) {
            $query->where('nombre_zona', 'LIKE', '%' . $this->search . '%')->orWhere('idzona_representacion', 'LIKE', '%' . $this->search . '%');
        })->count();
        $zonas = ModelsRepresentacion::where(function ($query) {
            $query->where('nombre_zona', 'LIKE', '%' . $this->search . '%')->orWhere('idzona_representacion', 'LIKE', '%' . $this->search . '%');
        })->paginate($this->view_dates);
        return view('livewire.direcciones.representacion',compact('count', 'zonas'));
    }
}
