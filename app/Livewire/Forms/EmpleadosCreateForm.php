<?php

namespace App\Livewire\Forms;

use App\Models\empleado;
use App\Models\User;
use App\Rules\Fisica;
use App\Rules\Les;
use App\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EmpleadosCreateForm extends Form
{
    public $nombre;
    public $a_paterno;
    public $a_materno;
    public $correo;
    public $contraseña;
    public $contraseña_confirmation;
    public $empleado;
    public $telefono;
    public $curp;
    public $rfc;
    public $sexo;
    public $tipo;
    public $calle;
    public $exterior;
    public $interior;
    public $cp;
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
            'nombre' => ['required','max:50', new Les],
            'a_paterno' => ['required','max:50', new Les],
            'a_materno' => ['required','max:50', new Les],
            'correo' => ['required', 'email','max:255', 'unique:usuario_sistema,correo'],
            'empleado' => ['required', 'numeric', 'unique:empleado,no_empleado'],
            'telefono' => ['required', 'numeric'],
            'curp' => ['required','min:18', 'unique:empleado,curp'],
            'rfc' => ['required','min:12','max:13', 'unique:empleado,rfc'],
            'sexo' => ['required'],
            'tipo' => ['required'],
            'calle' => ['required','max:100'],
            'exterior' => ['required','max:20'],
            'interior' => ['nullable','max:20'],
            'cp' => ['required','numeric', 'digits:5'],
            'estado' => ['required'],
            'municipio' => ['required'],
            'colonia' => ['required'],
        ]);

        DB::beginTransaction();
        try {

            $usuario = User::create([
                'nombre' => $this->nombre,
                'correo' => $this->correo,
                'contraseña' => Hash::make($this->contraseña),
                'estatus' => 1,
                'id_tipo_usuario' => 5
            ]);
            $id = DB::table('usuario_sistema')->where('correo', $this->correo)->value('id_usuario_sistema');

            empleado::create([
                'nombre' => $this->nombre,
                'ap_paterno' => $this->a_paterno,
                'ap_materno' => $this->a_materno,
                'no_empleado' => $this->empleado,
                'telefono' => $this->telefono,
                'curp' => $this->curp,
                'rfc' => $this->rfc,
                'sexo' => $this->sexo,
                'calle' => $this->calle,
                'no_exterior' => $this->exterior,
                'no_interior' => $this->interior,
                'cp' => $this->cp,
                'id_tipo_empleado' => $this->tipo,
                'id_usuario_sistema' => $usuario->id_usuario_sistema,
                'id_estado' => $this->estado,
                'id_municipio' => $this->municipio,
                'id_colonia' => $this->colonia,
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
        $this->reset('newRegister');
    }
}
