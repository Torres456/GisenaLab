<?php

namespace App\Livewire\Rutas;

use App\Models\rutas;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $search;
    public $view_dates = 10;
    public $estade=1;

    //&================================================================= Nuevo Registro
    public $new = false;
    public $newRegister = [
        'nombre' => '',
        'descripcion' => '',
        'ruta' => '',
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.nombre' => 'required|max:200',
            'newRegister.descripcion' => 'required|max:250',
            'newRegister.ruta' => 'required|max:100',
        ], [
            'newRegister.nombre.required' => __('El nombre de la ruta es requerido'),
            'newRegister.nombre.max' => __('El nombre de la ruta debe tener máximo 200 caracteres'),
            'newRegister.descripcion.required' => __('La descripción de la ruta es requerida'),
            'newRegister.descripcion.max' => __('La descripción de la ruta debe tener máximo 250 caracteres'),
            'newRegister.ruta.required' => __('La ruta es requerida'),
            'newRegister.ruta.max' => __('La ruta debe tener máximo 100 caracteres'),
        ]);
        //store
        rutas::create([
            'title' => $this->newRegister['nombre'],
            'content' => $this->newRegister['descripcion'],
            'route' => $this->newRegister['ruta'],
        ]);
        $this->new = false;
        $this->reset('newRegister');
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
        'ruta' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = rutas::find($id);
        $this->editRegister = [
            'nombre' => $register->title,
            'descripcion' => $register->content,
            'ruta' => $register->route,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:200',
            'editRegister.descripcion' => 'required|max:250',
            'editRegister.ruta' => 'required|max:100',
        ], [
            'editRegister.nombre.required' => __('El nombre de la ruta es requerido'),
            'editRegister.nombre.max' => __('El nombre de la ruta debe tener máximo 200 caracteres'),
            'editRegister.descripcion.required' => __('La descripción de la ruta es requerida'),
            'editRegister.descripcion.max' => __('La descripción de la ruta debe tener máximo 250 caracteres'),
            'editRegister.ruta.required' => __('La ruta es requerida'),
            'editRegister.ruta.max' => __('La ruta debe tener máximo 100 caracteres'),
        ]);
        //store
        $categoria = rutas::find($this->editId);
        $categoria->update([
            'title' => $this->editRegister['nombre'],
            'content' => $this->editRegister['descripcion'],
            'route' => $this->editRegister['ruta'],
        ]);
        $this->edit = false;
        $this->reset('editRegister');
    }
    public function edit_cancel()
    {
        $this->edit = false;
        $this->reset('editRegister');
    }

    //&================================================================= Eliminar Registro

    public $deltes=false;
    public $deleteId;
    public $desacRegister=[
        'nombre' => '',
    ];

    public function delete_register($id){
        $this->deltes=true;
        $this->deleteId=$id;
        $register = rutas::find($id);
        $this->desacRegister=[
            'nombre' => $register->title,
        ];
    }

    public function delete_confirm(){
        $register = rutas::find($this->deleteId);
        $register->update([
            'estado' => 0,
        ]);
        $this->deltes=false;
        $this->reset('desacRegister');
    }

    public function delete_cancel(){
        $this->deltes=false;
        $this->reset('desacRegister');
    }

    //&================================================================= Activar Registro
    public $active=false;
    public $activeId;
    public $activeRegister=[
        'nombre' => '',
    ];

    public function active_register($id){
        $this->active=true;
        $this->activeId=$id;
        $register = rutas::find($id);
        $this->activeRegister=[
            'nombre' => $register->title,
        ];
    }

    public function active_confirm(){
        $register = rutas::find($this->activeId);
        $register->update([
            'estado' => 1,
        ]);
        $this->active=false;
        $this->reset('activeRegister');
    }

    public function active_cancel(){
        $this->active=false;
        $this->reset('activeRegister');
    }

    //&================================================================= Lazy
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render

    public function render()
    {
        $rutas=rutas::where('title','LIKE','%' . $this->search . '%')->where('estado',$this->estade)->paginate($this->view_dates);
        return view('livewire.rutas.index',compact('rutas'));
    }
}
