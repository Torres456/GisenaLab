<?php

namespace App\Livewire\Administrador\Ordenes;

use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

#[Lazy()]
class CreateMuestras extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= new register
    public $muestra= false;

    public function new_register(){
         $this->muestra = true;
    }

    public function new_cancel(){
         $this->muestra = false;
    }

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }
    //&================================================================= Render
    public function render()
    {
        return view('livewire.administrador.ordenes.create-muestras');
    }
}
