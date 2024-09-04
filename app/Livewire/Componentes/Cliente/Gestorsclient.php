<?php

namespace App\Livewire\Componentes\Cliente;

use App\Models\cliente;
use Livewire\Component;

class Gestorsclient extends Component
{
    public $view_dates;
    public function render()
    {
        //contar clientes nuevos
        $this->view_dates = request()->query('view_dates', 7);  // Definir 7 dias por defecto
        $nuevos=cliente::where('created_at', '>=', now()->subDays($this->view_dates))->count();
        $gestor=cliente::doesntHave('gestor')->count();
        return view('livewire.componentes.cliente.gestorsclient', compact('gestor','nuevos'));
    }
}
