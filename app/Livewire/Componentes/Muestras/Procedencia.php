<?php

namespace App\Livewire\Componentes\Muestras;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class Procedencia extends Component
{
    #[Reactive]
    public $IdProce;

    
    public function render()
    {
        return view('livewire.componentes.muestras.procedencia');
    }
}
