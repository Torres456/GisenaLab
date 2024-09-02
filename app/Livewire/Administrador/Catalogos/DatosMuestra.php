<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\datos_muestra_especificos;
use App\Models\laboratorios;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class DatosMuestra extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $search = '';
    public $search_lab='';
    public $view_dates = 10;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //&================================================================= Mostar Datos
    public $laboratorios;
    public function mount()
    {
        $this->laboratorios = laboratorios::all();
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
            'newRegister.nombre' => 'required|max:200|unique:datos_muestra_especificos,descripcion_dato',
            'newRegister.laboratorio' => 'required',
        ], [
            'newRegister.nombre.required' => __('El nombre es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 200 caracteres'),
            'newRegister.nombre.unique' => __('Esta subcategoría ya está registrada'),
            'newRegister.laboratorio.required' => __('El laboratorio es requerido'),
            
        ]);
        //store
        datos_muestra_especificos::create([
            'descripcion_dato' => $this->newRegister['nombre'],
            'id_laboratorio' => $this->newRegister['laboratorio'],
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
        $register = datos_muestra_especificos::find($id);
        $this->editRegister = [
            'nombre' => $register->descripcion_dato,
            'laboratorio' => $register->id_laboratorio,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:200|unique:datos_muestra_especificos,descripcion_dato,' . $this->editId . ',id_datos_muestra_especificos',
            'editRegister.laboratorio' => 'required',
        ], [
            'editRegister.nombre.unique' => __('Esta subcategoría ya está registrada'),
            'editRegister.nombre.required' => __('El nombre es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 200 caracteres'),
            'editRegister.laboratorio.required' => __('El laboratorio es requerido'),
        ]);
        //store
        $categoria = datos_muestra_especificos::find($this->editId);
        $categoria->update([
            'descripcion_dato' => $this->editRegister['nombre'],
            'id_laboratorio' => $this->editRegister['laboratorio'],
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
        $search = $this->search;
        $search_lab = $this->search_lab;

        $count = datos_muestra_especificos::with('laboratorios')->whereHas('laboratorios', function ($query) use ($search) {
            $query->where('descripcion_laboratorio', 'LIKE', "%{$search}%");
        })->orWhere('descripcion_dato', 'LIKE', "%{$search}%")->where('id_laboratorio','LIKE',"%{$search_lab}%")->count();

        $datos_muestras = datos_muestra_especificos::with('laboratorios')->whereHas('laboratorios', function ($query) use ($search) {
            $query->where('descripcion_laboratorio', 'LIKE', "%{$search}%");
        })->orWhere('descripcion_dato', 'LIKE', "%{$search}%")->orWhere('id_laboratorio','LIKE',"%{$search_lab}%")->paginate($this->view_dates);

        return view('livewire.administrador.catalogos.datos-muestra',compact('count', 'datos_muestras'));
    }
}
