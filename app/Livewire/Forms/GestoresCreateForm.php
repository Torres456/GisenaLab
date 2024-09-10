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

    #[Rule(['required', 'max:100', new Les])]
    public $nombre;

    #[Rule(['required', 'max:100', new Les])]
    public $paterno;

    #[Rule(['required', 'max:100', new Les])]
    public $materno;

    #[Rule(['required', 'numeric', new telefono])]
    public $telefono;

    #[Rule(['required'])]
    public $sexo;

    #[Rule(['required', 'email', 'unique:usuario_sistema,correo'])]
    public $correo;

    #[Rule(['required', 'min:8', 'confirmed', new Password(8)])]
    public $contraseña;

    #[Rule(['required'])]
    public $contraseña_confirmation;

    #[Rule(['required'])]
    public $zona;

    #[Rule(['required', 'max:100'])]
    public $calle;

    #[Rule(['max:20'])]
    public $exterior;

    #[Rule(['max:20'])]
    public $interior;

    #[Rule(['required', 'numeric', 'digits:5'])]
    public $cp;

    #[Rule(['max:250'])]
    public $entre;

    #[Rule(['max:250'])]
    public $referencia;

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

    public function save(){

        DB::beginTransaction();
        try {
            $usuario = User::create([
                'nombre' => $this->nombre,
                'ap_paterno' => $this->paterno,
                'ap_materno' => $this->materno,
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

    public function cancel(){
        $this->new = false;
        $this->reset();
    }
}
