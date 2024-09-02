<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\catalogo_categoria;
use App\Models\catalogo_subcategoria;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Subcategorias extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $search = '';
    public $view_dates=10;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //&================================================================= Mostar Datos
    public $categorias;
    public function mount()
    {
        $this->categorias = catalogo_categoria::all();
    }

    //&================================================================= Nuevo Registro

    public $new = false;
    public $newRegister = [
        'nombre' => '',
        'categoria' => '',
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.nombre' => 'required|max:50|unique:catalogo_subcategoria,nom_subcategoria',
            'newRegister.categoria' => 'required',
        ], [
            'newRegister.nombre.required' => __('El nombre es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 50 caracteres'),
            'newRegister.categoria.required' => __('La categoria es requerida'),
            'newRegister.nombre.unique' => __('Esta subcategoría ya está registrada'),
        ]);
        //store
        catalogo_subcategoria::create([
            'nom_subcategoria' => $this->newRegister['nombre'],
            'id_categoria' => $this->newRegister['categoria'],
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
        'categoria' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = catalogo_subcategoria::find($id);
        $this->editRegister = [
            'nombre' => $register->nom_subcategoria,
            'categoria' => $register->id_categoria,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:50|unique:catalogo_subcategoria,nom_subcategoria,' . $this->editId . ',id_subcategoria',
            'editRegister.categoria' => 'required',
        ], [
            'editRegister.nombre.unique' => __('Esta subcategoría ya está registrada'),
            'editRegister.nombre.required' => __('El nombre es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 50 caracteres'),
            'editRegister.categoria.required' => __('La categoria es requerida'),
        ]);
        //store
        $categoria = catalogo_subcategoria::find($this->editId);
        $categoria->update([
            'nom_subcategoria' => $this->editRegister['nombre'],
            'id_categoria' => $this->editRegister['categoria'],
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
        $search = $this->search;
        $count=catalogo_subcategoria::with('categoria')->whereHas('categoria', function ($query) use ($search) {
            $query->where('nombre_categoria', 'LIKE', "%{$search}%");
        })->orWhere('nom_subcategoria', 'LIKE', "%{$search}%")->count();
        $subcategorias = catalogo_subcategoria::with('categoria')->whereHas('categoria', function ($query) use ($search) {
            $query->where('nombre_categoria', 'LIKE', "%{$search}%");
        })->orWhere('nom_subcategoria', 'LIKE', "%{$search}%")->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.subcategorias', compact('count','subcategorias'));
    }
}
