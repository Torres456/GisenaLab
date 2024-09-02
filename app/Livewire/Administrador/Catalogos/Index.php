<?php

namespace App\Livewire\Administrador\Catalogos;

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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    //&================================================================= Lazy
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render

    public function render()
    { 
        $count=rutas::where('title','LIKE','%' . $this->search . '%')->count();
        $cards = rutas::where('title','LIKE','%' . $this->search . '%')
              ->where('estado',1)
              ->where('tipo',1)
              ->orderBy('title', 'asc') // Ordenamos por el campo 'title' en orden ascendente
              ->paginate(9);
        return view('livewire.administrador.catalogos.index',compact('count','cards'));
    }
}
