<?php

namespace App\Livewire\Componentes\Cliente;

use App\Models\cliente;
use App\Models\cliente_direccion;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Direcciones extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Datos
    #[Reactive]
    public $direcId;

    public function render()
    {
        $direcId=$this->direcId;
        $count= cliente_direccion::where('id_cliente',$direcId)->count();
        $direcciones = cliente_direccion::where('id_cliente',$direcId)->paginate(10);

        return view('livewire.componentes.cliente.direcciones',compact('direcciones','count'));
    }
}
