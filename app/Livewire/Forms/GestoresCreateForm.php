<?php

namespace App\Livewire\Forms;

use App\Models\direccion;
use App\Models\gestor;
use App\Models\User;
use App\Rules\Les;
use App\Rules\Password;
use App\Rules\telefono;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GestoresCreateForm extends Form
{

    public $nombre;
    public $paterno;
    public $materno;
    public $telefono;
    public $sexo;
    public $correo;
    public $contraseña;
    public $contraseña_confirmation;
    public $zona;
    public $calle;
    public $exterior;
    public $interior;
    public $cp;
    public $entre;
    public $referencia;
    public $estado;
    public $municipio;
    public $colonia;

    public $new = false;

    public function create()
    {
        $this->new = true;
    }

    public function save()
    {
        $this->validate([
            'nombre' => ['required', 'max:100', new Les,],
            'paterno' => ['required', 'max:100', new Les],
            'materno' => ['required', 'max:100', new Les],
            'telefono' => ['required', 'numeric', new telefono],
            'sexo' => ['required'],
            'correo' => ['required', 'email', 'unique:usuario_sistema,correo'],
            'zona' => ['required'],
            'calle' => ['required', 'max:100'],
            'exterior' => ['max:20'],
            'interior' => ['max:20'],
            'cp' => ['required', 'numeric'],
            'entre' => ['max:250'],
            'referencia' => ['max:250'],
            'estado' => ['required'],
            'municipio' => ['required'],
            'colonia' => [' required'],
        ]);

        DB::beginTransaction();
        try {
            $usuario = User::create([
                'nombre' => $this->nombre,
                'correo' => $this->correo,
                'contraseña' => Hash::make($this->contraseña),
                'estatus' => 1,
                'id_tipo_usuario' => 3
            ]);
            $id = DB::table('usuario_sistema')->where('correo', $this->correo)->value('id_usuario_sistema');


            $direccion = direccion::create([
                'calle' => $this->calle,
                'no_exterior' => $this->exterior,
                'no_interior' => $this->interior,
                'entre_calles' => $this->entre,
                'referencia' => $this->referencia,
                'cp' => $this->cp,
                'id_estado' => $this->estado,
                'id_municipio' => $this->municipio,
                'id_colonia' => $this->colonia,
            ]);

            gestor::create([
                'nombre' => $this->nombre,
                'ap_paterno' => $this->paterno,
                'ap_materno' => $this->materno,
                'telefono' => $this->telefono,
                'sexo' => $this->sexo,
                'correo' => $this->correo,
                'id_direccion' => $direccion->id_direccion,
                'id_usuario_sistema' => $usuario->id_usuario_sistema,
                'id_zona_representacion' => $this->zona,
            ]);

            $this->new = false;
            $this->reset();
            session()->flash('green', 'Agregada correctamente');
            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollback();
            abort(500);
        }
    }

    public function cancel()
    {
        $this->new = false;
        $this->reset();
    }
}
