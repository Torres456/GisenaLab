<?php

namespace App\Livewire\Administrador\Catalogos\Direcciones;

use App\Models\colonia;
use App\Models\municipio;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;


#[Lazy()]
class Colonias extends Component
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
    public $municipios;
    public function mount()
    {
        $this->municipios = municipio::all();
    }

    //&================================================================= Nuevo Registro
    public $new = false;
    public $newRegister = [
        'nombre' => '',
        'descripcion' => '',
        'municipio' => '',
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {


        //validations
        $this->validate([
            'newRegister.nombre' => 'required|max:100|unique:colonia,nombre',
            'newRegister.descripcion' => 'required|numeric',
            'newRegister.municipio' => 'required'
        ], [
            'newRegister.nombre.required' => __('El nombrede es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'newRegister.nombre.unique' => __('Este municipio ya está registrado'),
            'newRegister.descripcion.required' => __('La descripcion es requerida'),
            'newRegister.descripcion.numeric' => __('Esta clave es invalida'),
            'newRegister.municipio.required' => __('El municipio es requerido'),
        ]);

        $municipio_es=municipio::find($this->newRegister['municipio']);
        //store
        colonia::create([
            'nombre' => $this->newRegister['nombre'],
            'clave_colonia' => $this->newRegister['descripcion'],
            'id_municipio' => $this->newRegister['municipio'],
            'id_estado' => $municipio_es->id_estado,
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
        'municipio' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = colonia::find($id);
        $this->editRegister = [
            'nombre' => $register->nombre,
            'descripcion' => $register->clave_colonia,
            'municipio' => $register->id_municipio,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:100|unique:colonia,nombre,' . $this->editId . ',id_colonia',
            'editRegister.descripcion' => 'required|numeric',
            'editRegister.municipio' => 'required'
        ], [
            'editRegister.nombre.required' => __('El nombrede es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'editRegister.nombre.unique' => __('Este municipio ya está registrado'),
            'editRegister.descripcion.required' => __('La descripcion es requerida'),
            'editRegister.descripcion.numeric' => __('Esta clave es invalida'),
            'editRegister.municipio.required' => __('El municipio es requerido'),
        ]);
        //store
        $categoria = colonia::find($this->editId);
        $categoria->update([
            'nombre' => $this->editRegister['nombre'],
            'clave_colonia' => $this->editRegister['descripcion'],
            'id_municipio' => $this->editRegister['municipio'],
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
        $count = colonia::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')
                  ->orWhere('clave_colonia', 'LIKE', '%' . $this->search . '%');
        })
        ->when(isset($this->search_stade), function ($query) {
            $query->where('id_municipio', $this->search_stade);
        })
        ->count();

        $colonias = colonia::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')
                  ->orWhere('clave_colonia', 'LIKE', '%' . $this->search . '%');
        })
        ->when(isset($this->search_stade), function ($query) {
            $query->where('id_municipio', $this->search_stade);
        })
        ->paginate($this->view_dates);
        
        return view('livewire.administrador.catalogos.direcciones.colonias', compact('count','colonias'));
    }
}
