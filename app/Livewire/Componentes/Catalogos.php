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
        $cards=rutas::where('title','LIKE','%' . $this->search . '%')->where('estado',1)->paginate(15);
        return view('livewire.componentes.catalogos', compact('cards'));
    }
}
