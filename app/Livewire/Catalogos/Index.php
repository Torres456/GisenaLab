<?php

namespace App\Livewire\Catalogos;

use App\Models\rutas;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Index extends Component
{

    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtos
    public $search = '';

    //&================================================================= Lazy
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render

    public function render()
    {
        $cards=rutas::where('title','LIKE','%' . $this->search . '%')->where('estado',1)->paginate(9);
        return view('livewire.catalogos.index', compact('cards'));
    }
}
