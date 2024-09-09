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


    #[Rule(['required', 'max:50', new Les])]
    public $nombre;

    #[Rule(['required', 'max:50', new Les])]
    public $a_paterno;

    #[Rule(['required', 'max:50', new Les])]
    public $a_materno;

    #[Rule(['required', 'email', 'max:255', 'unique:usuario_sistema,correo'])]
    public $correo;

    #[Rule(['required', 'min:8', 'confirmed'])]
    public $contraseña;

    #[Rule(['required'])]
    public $contraseña_confirmation;

    #[Rule(['required', 'numeric', 'unique:empleado,curp'])]
    public $empleado;

    #[Rule(['required', 'numeric'])]
    public $telefono;

    #[Rule(['required', 'min:18'])]
    public $curp;

    #[Rule(['required', 'min:12', 'max:13', new Fisica])]
    public $rfc;

    #[Rule(['required'])]
    public $sexo;

    #[Rule(['required'])]
    public $tipo;

    #[Rule(['required', 'max:100'])]
    public $calle;

    #[Rule(['required', 'max:20'])]
    public $exterior;

    #[Rule(['nullable', 'max:20'])]
    public $interior;

    #[Rule(['required', 'numeric', 'digits:5'])]
    public $cp;

    #[Rule(['required'])]
    public $estado;

    #[Rule(['required'])]
    public $municipio;

    #[Rule(['required'])]
    public $colonia;

    public $new = false;

    public function create(){
        $this->new = true;
    }

    public function save()
    {
        DB::beginTransaction();
        try {
            $usuario = User::create([
                'nombre' => $this->nombre,
                'ap_paterno' => $this->a_paterno,
                'ap_materno' => $this->a_materno,
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

    public function cancel(){
        $this->new = false;
        $this->reset('newRegister');
    }
}
