<?php

namespace App\Livewire\Administrador;

use App\Models\cliente;
use Livewire\Component;

class Clientes extends Component
{
    public $view_dates = 10; 

    public $new =false;
     public function new_register(){
        
        $this->new = true;
     }

    public function render()
    {
        $count=cliente::count();
        $clientes=cliente::paginate($this->view_dates);
        return view('livewire.administrador.clientes',compact('count','clientes'));
    }
}