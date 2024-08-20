<?php

namespace App\Livewire\Componentes\Representacion;

use App\Models\estado;
use App\Models\zona_representacion;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Create extends Component
{

    use WithPagination;
    
    #[Modelable]
    public $new;

    public $newRegister = [
        'nombre' => '',
        'selectedTagsEstado' => [],
    ];

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.nombre' => 'required|max:45|unique:zona_representacion,nombre_zona',
            'newRegister.selectedTagsEstado' => 'array'
        ], [
            'newRegister.nombre.required' => __('El nombrede es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 45 caracteres'),
            'newRegister.nombre.unique' => __('Esta zona ya está registrada'),

        ]);
        //store
        $zona = zona_representacion::create([
            'nombre_zona' => $this->newRegister['nombre'],
        ]);

        $zona->estados()->sync($this->newRegister['selectedTagsEstado']);

        $this->new = false;
        $this->reset('newRegister');
        
        $this->dispatch('newRegister');
    }

    
    public function new_cancel()
    {
        $this->reset('newRegister');
        $this->dispatch('cancelRegister');
    }
    
    public function render()
    {
        $estados = estado::paginate(10);
        return view('livewire.componentes.representacion.create',compact('estados'));
    }
}
