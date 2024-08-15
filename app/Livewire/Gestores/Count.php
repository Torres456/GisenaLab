<?php

namespace App\Livewire\Gestores;

use App\Models\gestor;
use Livewire\Component;

class Count extends Component
{
    public $view_dates;
    public function render()
    {
        $this->view_dates = request()->query('view_dates', 7);  // Definir 7 dias por defecto
        $nuevos=gestor::where('created_at', '>=', now()->subDays($this->view_dates))->count();
        return view('livewire.gestores.count',compact('nuevos'));
    }
}
