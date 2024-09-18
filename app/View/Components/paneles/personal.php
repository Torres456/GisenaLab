<?php

namespace App\View\Components\paneles;

use App\Models\rutas;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;



class personal extends Component
{

    public $rutas;

    public $titulo;

    public function __construct()
    {

        switch (Auth::user()->id_tipo_usuario) {

            case 1:
                $this->rutas = rutas::where('estado', 1)->where('tipo', 1)->orderBy('title', 'asc')->get();
                break;

            case 3:
                $this->rutas = rutas::where('estado', 1)->where('tipo', 3)->orderBy('title', 'asc')->get();
                break;

            case 5:
                $this->rutas = rutas::where('estado', 1)->where('tipo', 5)->orderBy('title', 'asc')->get();
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.paneles.personal');
    }
}
