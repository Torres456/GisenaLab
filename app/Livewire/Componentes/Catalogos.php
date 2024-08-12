<?php

namespace App\Livewire\Componentes;

use App\Models\rutas;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy()]
class Catalogos extends Component
{
    public $search = '';
    

    //&================================================================= Lazy
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    
    //&================================================================= Render
    public function render()
    {
        $cards=rutas::all();
        $cards = rutas::where('estado',1)
              ->where('tipo',1)
              ->orderBy('title', 'asc') // Ordenamos por el campo 'title' en orden ascendente
              ->get();

        return view('livewire.componentes.catalogos', compact('cards'));
    }
}
