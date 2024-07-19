<?php

namespace App\Livewire\Catalogos;

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
    }

    public function new_cancel()
    {
        $this->new = false;
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
            'editRegister.nombre' => 'required|max:50',
            'editRegister.categoria' => 'required',
        ], [
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
    }
    public function edit_cancel()
    {
        $this->edit = false;
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
        $subcategorias = catalogo_subcategoria::with('categoria')->whereHas('categoria', function ($query) use ($search) {
            $query->where('nombre_categoria', 'LIKE', "%{$search}%");
        })->orWhere('nom_subcategoria', 'LIKE', "%{$search}%")->paginate($this->view_dates);
        return view('livewire.catalogos.subcategorias', compact('subcategorias'));
    }
}
