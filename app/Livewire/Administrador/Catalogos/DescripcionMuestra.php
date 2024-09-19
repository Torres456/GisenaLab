<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\catalogo_tipo_muestra;
use App\Models\descripcion_muestra;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class DescripcionMuestra extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $search = '';
    public $search_lab = '';
    public $view_dates = 10;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //&================================================================= Mostar Datos
    public $tipos;
    public function mount()
    {
        $this->tipos = catalogo_tipo_muestra::where('estatus','1')->get();
    }

    //&================================================================= Nuevo Registro

    public $new = false;
    public $newRegister = [
        'nombre' => '',
        'laboratorio' => '',
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.nombre' => 'required|max:100|unique:descrip_muestra,nombre_descrip',
            'newRegister.laboratorio' => 'required',
        ], [
            'newRegister.nombre.required' => __('La descripción es requerido'),
            'newRegister.nombre.max' => __('La descripción debe tener máximo 100 caracteres'),
            'newRegister.nombre.unique' => __('Esta descripcion ya está registrada'),
            'newRegister.laboratorio.required' => __('El tipo de muestra es requerido'),
        ]);
        //store
        descripcion_muestra::create([
            'nombre_descrip' => $this->newRegister['nombre'],
            'id_tipo_muestra' => $this->newRegister['laboratorio'],
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

    //&================================================================= Editar Registro
    public $edit = false;
    public $editId;
    public $editRegister = [
        'nombre' => '',
        'laboratorio' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = descripcion_muestra::find($id);
        $this->editRegister = [
            'nombre' => $register->nombre_descrip,
            'laboratorio' => $register->id_tipo_muestra,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:200|unique:descrip_muestra,nombre_descrip,' . $this->editId . ',id_descrip_muestra',
            'editRegister.laboratorio' => 'required',
        ], [
            'editRegister.nombre.required' => __('La descripción es requerido'),
            'editRegister.nombre.max' => __('La descripción debe tener máximo 100 caracteres'),
            'editRegister.nombre.unique' => __('Esta descripcion ya está registrada'),
            'editRegister.laboratorio.required' => __('El tipo de muestra es requerido'),
        ]);
        //store
        $categoria = descripcion_muestra::find($this->editId);
        $categoria->update([
            'nombre_descrip' => $this->editRegister['nombre'],
            'id_tipo_muestra' => $this->editRegister['laboratorio'],
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

    //&================================================================= Estatus

    public $estatus = false;
    public $viewstatus;
    public $statusId;
    public function estatus_register($id)
    {
        $this->estatus = true;
        $this->statusId = $id;
        $statusregister = descripcion_muestra::find($id);
        $this->viewstatus = $statusregister->estatus;
    }

    public function status_update()
    {
        $date = descripcion_muestra::find($this->statusId);
        $date->estatus = ($this->viewstatus == 1) ? 0 : 1;
        $date->save();
        $this->estatus = false;
        $this->reset('viewstatus');
        session()->flash('blue', 'Estatus actualizado correctamente');
    }

    public function status_cancel()
    {
        $this->estatus = false;
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
        $search_lab = $this->search_lab;

        $count = descripcion_muestra::where('nombre_descrip', 'LIKE', '%' . $search . '%')->Where('id_tipo_muestra', 'LIKE', '%' . $search_lab . '%')->count();

        $datos_muestras = descripcion_muestra::where('nombre_descrip', 'LIKE', '%' . $search . '%')->Where('id_tipo_muestra', 'LIKE', '%' . $search_lab . '%')->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.descripcion-muestra',compact('count', 'datos_muestras'));
    }
}
