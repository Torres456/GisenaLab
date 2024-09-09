<?php

namespace App\Livewire\Administrador;

use App\Livewire\Forms\EmpleadosCreateForm;
use App\Livewire\Forms\EmpleadosEditForm;
use App\Models\colonia;
use App\Models\empleado;
use App\Models\estado;
use App\Models\municipio;
use App\Models\tipo_empleado;
use App\Models\User;
use App\Rules\Fisica;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Empleados extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $search;
    public $view_dates = 10;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //&================================================================= Nuevo


    public EmpleadosCreateForm $newRegister;

    public function new_register()
    {
        $this->resetValidation();
        $this->newRegister->create();
    }

    public function new_form()
    {
        $this->newRegister->save();
    }

    public function new_cancel()
    {
        $this->newRegister->cancel();
    }

    //&================================================================= Direccion
    public $direct = false;
    public $direcRegister = [
        'calle' => '',
        'exterior' => '',
        'interior' => '',
        'cp' => '',
        'estado' => '',
        'municipio' => '',
        'colonia' => '',
    ];

    public function direc_register($id)
    {
        $this->direct = true;
        $datos = empleado::find($id);
        $this->direcRegister = [
            'calle' => $datos->calle,
            'exterior' => $datos->no_exterior,
            'interior' => $datos->no_interior,
            'cp' => $datos->cp,
            'estado' => $datos->estado->nombre,
            'municipio' => $datos->municipio->nombre,
            'colonia' => $datos->colonia->nombre,
        ];
    }

    public function direct_cancel()
    {
        $this->direct = false;
    }

    //&================================================================= Editar
    public EmpleadosEditForm $editRegister;

    public function edit_register($id)
    {
        $this->resetValidation();

        $this->editRegister->edit($id);
    }
    public function edit_form()
    {
        $this->editRegister->update();
        session()->flash('blue', 'Editada correctamente');
    }

    public function edit_cancel()
    {
        $this->editRegister->edit_cancel();
    }

    //&================================================================= Recuperar contrasena
    public $passwordnew = false;
    public $passwordId;
    public $passRegister = [
        'contrasena' => '',
        'contrasena_confirmation' => '',
    ];
    public function password_register($id)
    {
        $this->passwordnew = true;
        $this->passwordId = $id;
    }

    public function passwor_form()
    {
        $this->validate([
            'passRegister.contrasena' => ['required', 'min:8', 'max:20', 'confirmed'],
            'passRegister.contrasena_confirmation' => ['required', 'min:8', 'max:20'],
        ], [
            'passRegister.contrasena.required' => 'La contraseña es requerida.',
            'passRegister.contrasena.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'passRegister.contrasena.max' => 'La contraseña no puede tener más de 20 caracteres.',
            'passRegister.contrasena.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = User::find($this->passwordId);
        $user->contraseña = Hash::make($this->passRegister['contrasena']);
        $user->save();

        $this->passwordnew = false;
        session()->flash('blue', 'Contraseña cambiada correctamente');
        $this->reset('passRegister');
    }

    public function password_cancel()
    {
        $this->passwordnew = false;
        $this->reset('passRegister');
    }

    //&================================================================= down up acces
    public $acces = false;
    public $viewacces;
    public $accesId;
    public function down_register($id)
    {
        $this->acces = true;
        $this->accesId = $id;
        $accesuser = empleado::find($id);
        $this->viewacces = $accesuser->usuario_sistema->estatus;
    }

    public function down_acces()
    {
        $usuario = empleado::find($this->accesId);
        $user = User::find($usuario->id_usuario_sistema);
        $user->estatus = ($this->viewacces == 1) ? 0 : 1;
        $user->save();
        $this->acces = false;
        $this->reset('viewacces');
        session()->flash('blue', 'Cambiado correctamente');
    }

    public function acces_cancel()
    {
        $this->acces = false;
        $this->reset('viewacces');
    }
    //&================================================================= Datos


    public $tipo_empleados;
    public $estados = [];
    public $municipios = [];
    public $colonias = [];


    public function mount()
    {
        $this->estados = estado::all();
        $this->tipo_empleados = tipo_empleado::all();
    }

    public function updated($property, $value)
    {
        if ($property == 'newRegister.estado') {
            $this->municipios = [];
            $this->colonias = [];
            $estado = estado::find($value);
            $this->municipios = municipio::where('id_estado', $estado['clave_estado'])->orderBy('nombre', 'asc')->get();
        } elseif ($property == 'newRegister.municipio') {
            $this->colonias = [];
            $municipio = municipio::find($value);
            $this->colonias = colonia::where('id_municipio', $municipio['clave_municipio'])->orderBy('nombre', 'asc')->get();
        }

        if ($property == 'editRegister.estado') {
            $this->municipios = [];
            $this->colonias = [];
            $estado = estado::find($value);
            $this->municipios = municipio::where('id_estado', $estado['clave_estado'])->orderBy('nombre', 'asc')->get();
        } elseif ($property == 'editRegister.municipio') {
            $this->colonias = [];
            $municipio = municipio::find($value);
            $this->colonias = colonia::where('id_municipio', $municipio['clave_municipio'])->orderBy('nombre', 'asc')->get();
        }
    }


    public function render()
    {
        $count = Empleado::where(DB::raw('concat(nombre, " ", ap_paterno, " ", ap_materno)'), 'like', "%$this->search%")
        ->orWhere('no_empleado', 'like', "%$this->search%")->count();
            
        $empleados = Empleado::where(DB::raw('concat(nombre, " ", ap_paterno, " ", ap_materno)'), 'like', "%$this->search%")
            ->orWhere('no_empleado', 'like', "%$this->search%")->paginate();
            
        return view('livewire.administrador.empleados', compact('count', 'empleados'));
    }
}
