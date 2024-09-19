<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\catalogo_subcategoria;
use App\Models\catalogo_tipo_muestra;
use App\Models\unidad_medida;
use App\Models\unidad_metodo;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class TipoMuestras extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $search = '';
    public $view_dates = 10;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //&================================================================= Datos de select
    public $subcategorias, $unidad_medidas, $unidad_metodos;
    public function mount()
    {
        $this->subcategorias = catalogo_subcategoria::where('estatus','1')->get();
        $this->unidad_medidas = unidad_medida::where('estatus','1')->get();
        $this->unidad_metodos = unidad_metodo::where('estatus','1')->get();
    }

    //&================================================================= Nuevo Registro

    public $new = false;
    public $newRegister = [
        'nombre' => '',
        'requerido' => '',
        'caracteristicas' => '',
        'unidad' => '',
        'subcategoria' => '',
        'metodo' => '',

    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.nombre' => ['required', 'max:100', Rule::unique('catalogo_tipo_muestra','nom_tipo_muestra')->where('id_subcategoria', $this->newRegister['subcategoria'])],
            'newRegister.requerido' => ['required', 'numeric',],
            'newRegister.caracteristicas' => ['required', 'max:100'],
            'newRegister.subcategoria' => ['required'],
            'newRegister.unidad' => ['required'],
            'newRegister.metodo' => ['required'],
        ], [
            'newRegister.nombre.required' => 'El nombre es requerido',
            'newRegister.nombre.max' => 'El nombre debe tener máximo 100 caracteres',
            'newRegister.requerido.required' => 'El campo requerido es requerido',
            'newRegister.requerido.decimal' => 'El campo requerido debe ser un número ',
            'newRegister.caracteristicas.required' => 'Las características son requeridas',
            'newRegister.caracteristicas.max' => 'Las características no pueden superar los 100 caracteres',
            'newRegister.subcategoria.required' => 'La subcategoría es requerida',
            'newRegister.unidad.required' => 'La unidad es requerida',
            'newRegister.metodo.required' => 'El metodo es requerido',
            'newRegister.nombre.unique' => 'Este tipo de muestra ya está registrada',
        ]);
        //store
        catalogo_tipo_muestra::create([
            'nom_tipo_muestra' => $this->newRegister['nombre'],
            'caracteristicas' => $this->newRegister['caracteristicas'],
            'cantidad_requerida' => $this->newRegister['requerido'],
            'id_subcategoria' => $this->newRegister['subcategoria'],
            'id_unidad_medida' => $this->newRegister['unidad'],
            'id_unidad_metodo' => $this->newRegister['metodo'],
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
        'nombre' => '',
        'requerido' => '',
        'caracteristicas' => '',
        'unidad' => '',
        'subcategoria' => '',
        'metodo' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = catalogo_tipo_muestra::find($id);
        $this->editRegister = [
            'nombre' => $register->nom_tipo_muestra,
            'requerido' => $register->cantidad_requerida,
            'caracteristicas' => $register->caracteristicas,
            'unidad' => $register->id_unidad_medida,
            'subcategoria' => $register->id_subcategoria,
            'metodo' => $register->id_unidad_metodo,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => ['required', 'max:100'],
            'editRegister.requerido' => ['required', 'numeric',],
            'editRegister.caracteristicas' => ['required', 'max:100'],
            'editRegister.subcategoria' => ['required'],
            'editRegister.unidad' => ['required'],
            'editRegister.metodo' => ['required'],
        ], [
            'editRegister.nombre.required' => 'El nombre es requerido',
            'editRegister.nombre.max' => 'El nombre debe tener máximo 100 caracteres',
            'editRegister.requerido.required' => 'El campo requerido es requerido',
            'editRegister.requerido.decimal' => 'El campo requerido debe ser un número ',
            'editRegister.caracteristicas.required' => 'Las características son requeridas',
            'editRegister.caracteristicas.max' => 'Las características no pueden superar los 100 caracteres',
            'editRegister.subcategoria.required' => 'La subcategoría es requerida',
            'editRegister.unidad.required' => 'La unidad es requerida',
            'editRegister.metodo.required' => 'El metodo es requerido',
        ]);
        //store
        $categoria = catalogo_tipo_muestra::find($this->editId);
        $categoria->update([
            'nom_tipo_muestra' => $this->editRegister['nombre'],
            'caracteristicas' => $this->editRegister['caracteristicas'],
            'cantidad_requerida' => $this->editRegister['requerido'],
            'id_subcategoria' => $this->editRegister['subcategoria'],
            'id_unidad_medida' => $this->editRegister['unidad'],
            'id_unidad_metodo' => $this->editRegister['metodo'],
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
        $statusregister = catalogo_tipo_muestra::find($id);
        $this->viewstatus = $statusregister->estatus;
    }

    public function status_update()
    {
        $date = catalogo_tipo_muestra::find($this->statusId);
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
        $search = $this->search;
        $count = catalogo_tipo_muestra::with('subcategoria')->whereHas('subcategoria', function ($query) use ($search) {
            $query->where('nom_subcategoria', 'LIKE', "%{$search}%");
        })->orWhere('nom_tipo_muestra', 'LIKE', "%{$search}%")->count();
        $tipo_muestras = catalogo_tipo_muestra::with('subcategoria')->whereHas('subcategoria', function ($query) use ($search) {
            $query->where('nom_subcategoria', 'LIKE', "%{$search}%");
        })->orWhere('nom_tipo_muestra', 'LIKE', "%{$search}%")->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.tipo-muestras',compact('count', 'tipo_muestras'));
    }
}
