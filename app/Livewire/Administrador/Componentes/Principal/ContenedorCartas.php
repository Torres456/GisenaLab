<?php

namespace App\Livewire\Administrador\Componentes\Principal;

use App\Models\cliente;
use App\Models\empleado;
use App\Models\gestor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ContenedorCartas extends Component
{

    public $usuarios;

    public $clientes;

    public $clientes_gestor;

    public $gestores;

    public $empleados;


    public function mount()
    {
        $this->usuarios = User::count();

        $this->clientes = cliente::count();

        $this->clientes_gestor = DB::table('cliente_direccion')->join('cliente', 'cliente_direccion.id_cliente', '=', 'cliente.id_cliente')->where('cliente.id_gestor', NULL)->count();

        $this->gestores = gestor::count();

        $this->empleados = empleado::count();
    }


    public function refresh()
    {

        $this->usuarios = User::count();

        $this->clientes = cliente::count();

        $this->clientes_gestor = DB::table('cliente_direccion')->join('cliente', 'cliente_direccion.id_cliente', '=', 'cliente.id_cliente')->where('cliente.id_gestor', NULL)->count();

        $this->gestores = gestor::count();

        $this->empleados = empleado::count();
    }



    public function render()
    {
        return view('livewire.administrador.componentes.principal.contenedor-cartas');
    }
}
