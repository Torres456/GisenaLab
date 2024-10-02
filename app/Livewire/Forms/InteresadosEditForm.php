<?php

namespace App\Livewire\Forms;

use App\Models\contacto;
use App\Models\direccion;
use App\Models\interesado;
use App\Models\User;
use App\Rules\Les;
use App\Rules\telefono;
use Livewire\Attributes\Validate;
use Livewire\Form;

class InteresadosEditForm extends Form
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

    public $edit = false;
    public $editId;

    public function edit($id){
        $this->edit = true;
        $this->editId = $id;
        $register = interesado::find($id);
        $this->nombre = $register->nombre;
        $this->paterno = $register->ap_paterno;
        $this->materno = $register->ap_materno;
        $this->telefono = $register->telefono;
        $this->telefono_alter = $register->telefono_alternativo;
        $this->correo = $register->correo;
        $this->correo_alter = $register->correo_alternativo;
        $this->gestor = $register->id_gestor;
        $this->nombre_contac = $register->contacto->nombre;
        $this->materno_contac = $register->contacto->ap_materno;
        $this->paterno_contac = $register->contacto->ap_paterno;
        $this->correo_contact = $register->contacto->correo;
        $this->correo_alter_contact = $register->contacto->correo_alternativo;
        $this->telefono_contact = $register->contacto->telefono;
        $this->telefono_alter_contact = $register->contacto->telefono_alternativo;
        $this->calle = $register->direccion->calle;
        $this->exterior = $register->direccion->no_exterior;
        $this->interior = $register->direccion->no_interior;
        $this->cp = $register->direccion->cp;
        $this->entre = $register->direccion->entre_calles;
        $this->referencia = $register->direccion->referencia;
        $this->estado = $register->direccion->id_estado;
        $this->municipio = $register->direccion->id_municipio;
        $this->colonia = $register->direccion->id_colonia;
        $this->cliente = $register->id_cliente;
    }

    public function update(){
        //validations
        $this->validate([

            'nombre' => ['required', 'max:100', new Les],
            'paterno' => ['required', 'max:100', new Les],
            'materno' => ['required', 'max:100', new Les],
            'telefono' => ['required', 'numeric', new telefono],
            'telefono_alter' => ['required'],
            'correo' => ['required', 'email', 'unique:interesado,correo,' . $this->editId . ',id_interesado'],
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


        //store
        $interesado = interesado::updateOrCreate([
            'id_interesado' => $this->editId,
        ], [
            'nombre' => $this->nombre,
            'ap_paterno' => $this->paterno,
            'ap_materno' => $this->materno,
            'telefono' => $this->telefono,
            'telefono_alternativo' => $this->telefono_alter,
            'correo' => $this->correo,
            'correo_alternativo' => $this->correo_alter,
            'id_cliente' => $this->cliente,
        ]);

        //solo actualizar contacto
        $contacto = contacto::updateOrCreate([
            'id_contacto' => $interesado->contacto->id_contacto,
        ], [
            'nombre' => $this->nombre_contac,
            'ap_paterno' => $this->paterno_contac,
            'ap_materno' => $this->materno_contac,
            'telefono' => $this->telefono_contact,
            'telefono_alternativo' => $this->telefono_alter_contact,
            'correo' => $this->correo_contact,
            'correo_alternativo' => $this->correo_alter_contact,
        ]);


        $direccion = direccion::updateOrCreate([
            'id_direccion' => $interesado->direccion->id_direccion,
        ], [
            'calle' => $this->calle,
            'no_exterior' => $this->exterior,
            'no_interior' => $this->interior,
            'cp' => $this->cp,
            'entre_calles' => $this->entre,
            'referencia' => $this->referencia,
            'id_estado' => $this->estado,
            'id_municipio' => $this->municipio,
            'id_colonia' => $this->colonia,
        ]);

        $search_emple = interesado::find($this->editId);

        $usuario = User::updateOrCreate([
            'id_usuario_sistema' => $search_emple->id_usuario_sistema,
        ], [
            'nombre' => $this->nombre,
            'correo' => $this->correo,
        ]);

        $this->edit = false;
        $this->reset();
        session()->flash('blue', 'Editado correctamente');
    }

    public function cancel(){
        $this->edit = false;
        $this->reset();
    }
}
