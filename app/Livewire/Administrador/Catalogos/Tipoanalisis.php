<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\catalogo_tipo_analisis;
use App\Models\catalogo_tipo_muestra;
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
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //&================================================================= Datos de selects
    public  $tipo_muestras;
    public function mount()
    {
        $this->tipo_muestras = catalogo_tipo_muestra::where('estatus','1')->get();
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
            'newRegister.clave' => 'required|max:45',
            'newRegister.muestra' => 'required',
        ], [
            'newRegister.nombre.required' => __('El nombre es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'newRegister.clave.required' => __('La clave es requerida'),
            'newRegister.clave.max' => __('La clave debe tener máximo 45 caracteres'),
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
            'editRegister.clave' => 'required|max:45',
            'editRegister.muestra' => 'required',
        ], [
            'editRegister.nombre.required' => __('El nombre es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'editRegister.clave.required' => __('La clave es requerida'),
            'editRegister.clave.max' => __('La clave debe tener máximo 45 caracteres'),
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
        $statusregister = catalogo_tipo_analisis::find($id);
        $this->viewstatus = $statusregister->estatus;
    }

    public function status_update()
    {
        $date = catalogo_tipo_analisis::find($this->statusId);
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
        $count = catalogo_tipo_analisis::where('nomb_tipo_analisis', 'LIKE', '%' . $this->search . '%')->count();
        $tipo_analisis = catalogo_tipo_analisis::where('nomb_tipo_analisis', 'LIKE', '%' . $this->search . '%')->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.tipoanalisis', compact('count', 'tipo_analisis'));
    }
}
