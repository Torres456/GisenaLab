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
    public $nombre;
    public $paterno;
    public $materno;
    public $telefono;
    public $telefono_alter;
    public $correo;
    public $correo_alter;
    public $contrasena;
    public $contrasena_confirmation;
    public $gestor;
    public $nombre_contac;
    public $materno_contac;
    public $paterno_contac;
    public $correo_contact;
    public $correo_alter_contact;
    public $telefono_contact;
    public $telefono_alter_contact;
    public $calle;
    public $exterior;
    public $interior;
    public $cp;
    public $entre;
    public $referencia;
    public $estado;
    public $municipio;
    public $colonia;
    public $cliente;


    public $new = false;

    public function create()
    {
        $this->new = true;
    }

    public function save()
    {
        $this->validate([

            'nombre' => ['required', 'max:100', new Les],
            'paterno' => ['required', 'max:100', new Les],
            'materno' => ['required', 'max:100', new Les],
            'telefono' => ['required', 'numeric', new telefono],
            'telefono_alter' => ['required'],
            'correo' => ['required', 'email', 'unique:interesado,correo'],
            'correo_alter' => ['required', 'email'],
            'gestor' => ['required'],
            'calle' => ['required', 'max:100'],
            'exterior' => ['max:20'],
            'interior' => ['max:20'],
            'cp' => ['required', 'numeric'],
            'entre' => ['max:250'],
            'referencia' => ['max:250'],
            'estado' => ['required'],
            'municipio' => ['required'],
            'colonia' => [' required'],
            'cliente' => ['required'],
        ]);


        DB::beginTransaction();
        try {
            $usuario = User::create([
                'nombre' => $this->nombre,
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
                'id_cliente' => $this->cliente,
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
