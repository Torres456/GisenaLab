<?php

namespace App\Livewire\Administrador\Ordenes;

use App\Livewire\Forms\OrdenesAdminCreateForm;
use App\Models\cliente;
use App\Models\interesado;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy()]
class Edit extends Component
{

    //&================================================================= new register
    public OrdenesAdminCreateForm $newRegister;

    public function new_register()
    {

        $this->resetValidation();
        $this->newRegister->create();
        
    }

    //&================================================================= CAncelar Orden

    public $cancelar_orden = false;

    public function cancel()
    {
        $this->cancelar_orden = true;
    }

    public function cancel_orden()
    {
        $this->reset();
        return redirect()->route('admin.ordenes.ordenes');
    }

    public function continiu_orden()
    {
        $this->cancelar_orden = false;
    }

    //&================================================================= Datos

    public $tipo_empleados;

    public $clientes = [];
    public $interesados = [];

    public function mount()
    {
        $this->clientes = cliente::where('estatus', 1)->get();
    }

    public function updated($property, $value)
    {
        if ($property == 'newRegister.cliente') {
            $this->interesados = interesado::where('id_cliente', $value)->get();
        }

        if ($property == 'editRegister.cliente') {
            $this->interesados = interesado::where('id_cliente', $value)->get();
        }
    }

    //&================================================================= Lazy Load

    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        return view('livewire.administrador.ordenes.edit');
    }
}
