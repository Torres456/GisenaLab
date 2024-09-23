<?php

namespace App\Livewire\Administrador\Ordenes;

use App\Models\cliente;
use App\Models\interesado;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy()]
class Create extends Component
{

    //&================================================================= new register
    public $clientes,$interesados;
    public function mount(){
        $this->clientes= cliente::where('estatus',1)->get();
        $this->interesados= interesado::where('estatus',1)->get();
    }

    public $id=1;
    public function new_register(){
        // Redirigir y mandar valor de id
        return redirect()->route('admin.ordenes.new_muestras', ['id' => $this->id]);
    }

    public function new_cancel()
    {
        // Redirigir al index
        return redirect()->route('admin.ordenes.ordenes');
    }

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }
    //&================================================================= Render
    public function render()
    {
        return view('livewire.administrador.ordenes.create');
    }
}
