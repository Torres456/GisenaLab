<?php

namespace App\Livewire\Direcciones;

use App\Models\estado;
use App\Models\municipio;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class Municipios extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $search;
    public $view_dates = 10;
    public $search_stade;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //&================================================================= Datos
    public $estados;
    public function mount(){
        $this->estados = estado::all();
    }

    //&================================================================= Nuevo Registro
    public $new = false;
    public $newRegister = [
        'nombre' => '',
        'descripcion' => '',
        'estado' => '',
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.nombre' => 'required|max:100|unique:municipio,nombre',
            'newRegister.descripcion' => 'required|numeric',
            'newRegister.estado' => 'required'
        ], [
            'newRegister.nombre.required' => __('El nombrede es requerido'),
            'newRegister.nombre.unique' => __('Este municipio ya está registrado'),
            'newRegister.descripcion.required' => __('La descripcion es requerida'),
            'newRegister.descripcion.max' => __('la descripcion debe tener máximo 100 caracteres'),
            'newRegister.descripcion.numeric' => __('Esta clave es invalida'),
            'newRegister.estado.required' => __('El estado es requerido'),
            

        ]);
        //store
        municipio::create([
            'nombre' => $this->newRegister['nombre'],
            'clave_municipio' => $this->newRegister['descripcion'],
            'id_estado' => $this->newRegister['estado'],
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
        'descripcion' => '',
        'estado' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = municipio::find($id);
        $this->editRegister = [
            'nombre' => $register->nombre,
            'descripcion' => $register->clave_municipio,
            'estado' => $register->id_estado,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:100|unique:municipio,nombre,' . $this->editId . ',id_municipio',
            'editRegister.descripcion' => 'required|numeric',
            'editRegister.estado' => 'required'
        ], [
            'editRegister.nombre.required' => __('El nombrede es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'editRegister.nombre.unique' => __('Este municipio ya está registrado'),
            'editRegister.descripcion.required' => __('La descripcion es requerida'),
            'editRegister.descripcion.numeric' => __('Esta clave es invalida'),
            'editRegister.estado.required' => __('El estado es requerido'),
        ]);
        //store
        $categoria = municipio::find($this->editId);
        $categoria->update([
            'nombre' => $this->editRegister['nombre'],
            'clave_municipio' => $this->editRegister['descripcion'],
            'id_estado' => $this->editRegister['estado'],
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
        $count = municipio::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')->orWhere('clave_municipio', 'LIKE', '%' . $this->search . '%');
        })->where('id_estado','LIKE','%' . $this->search_stade . '%')->count();
        $municipios = municipio::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')->orWhere('clave_municipio', 'LIKE', '%' . $this->search . '%');
        })->where('id_estado','LIKE','%' . $this->search_stade . '%')->paginate($this->view_dates);
        return view('livewire.direcciones.municipios',compact('municipios','count'));
    }
}
