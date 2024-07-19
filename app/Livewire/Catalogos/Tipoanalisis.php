<?php

namespace App\Livewire\Catalogos;

use App\Models\catalogo_tipo_analisis;
use App\Models\catalogo_tipo_muestra;
use App\Models\metodo;
use App\Models\unidad_metodo;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;


#[Lazy()]
class Tipoanalisis extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtors
    public $search = '';
    public $view_dates = 10;

    //&================================================================= Datos de selects
    public  $tipo_muestras;
    public function mount()
    {
        $this->tipo_muestras = catalogo_tipo_muestra::all();
    }

    //&================================================================= Nuevo Registro

    public $new = false;
    public $newRegister = [
        'nombre' => '',
        'clave' => '',
        'muestra' => '',
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.nombre' => 'required|max:100',
            'newRegister.clave' => 'required|numeric',
            'newRegister.muestra' => 'required',
        ], [
            'newRegister.nombre.required' => __('El nombre es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'newRegister.clave.required' => __('La clave es requerida'),
            'newRegister.clave.numeric' => __('La clave debe ser numérica'),
            'newRegister.muestra.required' => __('La muestra es requerida'),
        ]);
        //store
        catalogo_tipo_analisis::create([
            'nomb_tipo_analisis' => $this->newRegister['nombre'],
            'clave' => $this->newRegister['clave'],
            'id_tipo_muestra' => $this->newRegister['muestra'],
        ]);
        $this->new = false;
        $this->reset('newRegister');
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
        'clave' => '',
        'muestra' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = catalogo_tipo_analisis::find($id);
        $this->editRegister = [
            'nombre' => $register->nomb_tipo_analisis,
            'clave' => $register->clave,
            'muestra' => $register->id_tipo_muestra,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:100',
            'editRegister.clave' => 'required|numeric',
            'editRegister.muestra' => 'required',
        ], [
            'editRegister.nombre.required' => __('El nombre es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'editRegister.clave.required' => __('La clave es requerida'),
            'editRegister.clave.numeric' => __('La clave debe ser numérica'),
            'editRegister.muestra.required' => __('La muestra es requerida'),
        ]);
        //store
        $categoria = catalogo_tipo_analisis::find($this->editId);
        $categoria->update([
            'nomb_tipo_analisis' => $this->editRegister['nombre'],
            'clave' => $this->editRegister['clave'],
            'id_tipo_muestra' => $this->editRegister['muestra'],
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
        $tipo_analisis = catalogo_tipo_analisis::where('nomb_tipo_analisis', 'LIKE', '%' . $this->search . '%')->paginate($this->view_dates);
        return view('livewire.catalogos.tipoanalisis', compact('tipo_analisis'));
    }
}
