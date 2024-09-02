<?php

namespace App\Livewire\Componentes\Representacion;

use App\Models\estado;
use App\Models\zona_representacion;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Edit extends Component
{
    use WithPagination;

    public $editRegister = [
        'nombre' => '',
        'selectedTagsEstado' => [],
    ];


    #[Reactive]
    public $editId = '1';

    #[Reactive]
    public $edit;

    //mostrar datos de edicion
    public function hydrate()
    {
        if ($this->editId) {
            $zona = zona_representacion::find($this->editId);
            $this->editRegister = [
                'nombre' => $zona->nombre_zona,
                'selectedTagsEstado' => $zona->estados->pluck('id_estado')->toArray(),
            ];
        }else{
            $this->editRegister = [
                'nombre' => '',
                'selectedTagsEstado' => [],
            ];
        }
    }

    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:45|unique:zona_representacion,nombre_zona,' . $this->editId . ',id_zona_representacion',
            'editRegister.selectedTagsEstado' => 'array'
        ], [
            'editRegister.nombre.required' => __('El nombrede es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 45 caracteres'),
            'editRegister.nombre.unique' => __('Esta zona ya está registrada'),
        ]);
        //store
        $categoria = zona_representacion::find($this->editId);
        $categoria->update([
            'nombre_zona' => $this->editRegister['nombre'],
        ]);
        
        $categoria->estados()->sync($this->editRegister['selectedTagsEstado']);

        
        $this->reset('editRegister');
        
        $this->dispatch('editRegister');
    }

    public function render()
    {
        $estados = estado::paginate(10);
        return view('livewire.componentes.representacion.edit', compact('estados'));
    }
}
