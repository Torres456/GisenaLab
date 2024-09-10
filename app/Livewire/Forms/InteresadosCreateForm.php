<?php

namespace App\Livewire\Forms;

use App\Models\contacto;
use App\Models\direccion;
use App\Models\interesado;
use App\Models\User;
use App\Rules\Les;
use App\Rules\Password;
use App\Rules\telefono;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Livewire\Attributes\Rule;
use Livewire\Form;

class InteresadosCreateForm extends Form
{

    public $new = false;

    #[Rule(['required', 'max:100', new Les])]
    public $nombre;

    #[Rule(['required', 'max:100', new Les])]
    public $paterno;

    #[Rule(['required', 'max:100', new Les])]
    public $materno;

    #[Rule(['required', 'numeric', new telefono])]
    public $telefono;

    #[Rule(['required', 'numeric', new telefono])]
    public $telefono_alter;

    #[Rule(['required', 'email', 'unique:usuario_sistema,correo'])]
    public $correo;

    #[Rule(['required', 'email'])]
    public $correo_alter;

    #[Rule(['required', 'min:8', 'confirmed', new RulesPassword(8)])]
    public $contrasena;

    #[Rule(['required'])]
    public $contrasena_confirmation;

    #[Rule(['required'])]
    public $gestor;

    #[Rule(['required', 'max:100', new Les])]
    public $nombre_contac;

    #[Rule(['required', 'max:100', new Les])]
    public $materno_contac;

    #[Rule(['required', 'max:100', new Les])]
    public $paterno_contac;

    #[Rule(['required', 'email'])]
    public $correo_contact;

    #[Rule(['required', 'email'])]
    public $correo_alter_contact;

    #[Rule(['required', 'numeric', new telefono])]
    public $telefono_contact;

    #[Rule(['required', 'numeric', new telefono])]
    public $telefono_alter_contact;


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

    public function create(){
        $this->new = true;
    }

    public function save()
    {
        DB::beginTransaction();
        try {
            $usuario = User::create([
                'nombre' => $this->nombre,
                'ap_paterno' => $this->paterno,
                'ap_materno' => $this->materno,
                'correo' => $this->correo,
                'contraseña' => Hash::make($this->contrasena),
                'estatus' => 1,
                'id_tipo_usuario' => 4
            ]);
            $id = DB::table('usuario_sistema')->where('correo', $this->correo)->value('id_usuario_sistema');

            $contacto = contacto::create([
                'nombre' => $this->nombre_contac,
                'ap_paterno' => $this->materno_contac,
                'ap_materno' => $this->paterno_contac,
                'correo' => $this->correo_contact,
                'correo_alternativo' => $this->correo_alter_contact,
                'telefono' => $this->telefono_contact,
                'telefono_alternativo' => $this->telefono_alter_contact,
            ]);

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

            interesado::create([
                'nombre' => $this->nombre,
                'ap_paterno' => $this->paterno,
                'ap_materno' => $this->materno,
                'telefono' => $this->telefono,
                'telefono_alternativo' => $this->telefono_alter,
                'correo' => $this->correo,
                'correo_alternativo' => $this->correo_alter,
                'id_direccion' => $direccion->id_direccion,
                'id_usuario_sistema' => $usuario->id_usuario_sistema,
                'id_gestor' => $this->gestor,
                'id_contacto' => $contacto->id_contacto,
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
