<?php

namespace App\Livewire\Forms;

use App\Models\direccion;
use App\Models\gestor;
use App\Rules\Les;
use App\Rules\telefono;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GestoresEditForm extends Form
{
    public $nombre;
    public $paterno;
    public $materno;
    public $telefono;
    public $sexo;
    public $correo;
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

    public $edit = false;
    public $editId;

    public function edit($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = gestor::find($id);
        $this->nombre = $register->nombre;
        $this->paterno = $register->ap_paterno;
        $this->materno = $register->ap_materno;
        $this->telefono = $register->telefono;
        $this->sexo = $register->sexo;
        $this->correo = $register->correo;
        $this->zona = $register->id_zona_representacion;
        $this->calle = $register->direccion->calle;
        $this->exterior = $register->direccion->no_exterior;
        $this->interior = $register->direccion->no_interior;
        $this->cp = $register->direccion->cp;
        $this->entre = $register->direccion->entre_calles;
        $this->referencia = $register->direccion->referencia;
        $this->estado = $register->direccion->id_estado;
        $this->municipio = $register->direccion->id_municipio;
        $this->colonia = $register->direccion->id_colonia;
    }

    public function update(){

        //validations
        $this->validate([
            'nombre' => ['required', 'max:100', new Les,],
            'paterno' => ['required', 'max:100', new Les],
            'materno' => ['required', 'max:100', new Les],
            'telefono' => ['required', 'numeric', new telefono],
            'sexo' => ['required'],
            'correo' => ['required', 'email', 'unique:gestor,correo,' . $this->editId . ',id_gestor'],
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
        ], [
            'nombre.required' => 'El nombre es requerido ',
            'nombre.max' => 'El nombre es muy largo',
            'paterno.required' => 'El apellido paterno es requerido',
            'paterno.max' => 'El apellido paterno es muy largo',
            'materno.required' => 'El apellido materno es requerido',
            'materno.max' => 'El apellido materno es muy largo ',
            'telefono.required' => 'El teléfono es requerido ',
            'telefono.numeric' => 'El teléfono debe ser numérico ',
            'sexo.required' => 'El sexo es requerido',
            'correo.required' => 'El correo es requerido',
            'correo.email' => 'El correo no es válido',
            'correo.unique' => 'El correo ya existe',
            'contrasena.required' => 'La contraseña es requerida',
            'contrasena.min' => 'La contraseña debe tener al menos 8 caracteres',
            'contrasena.confirmed' => 'Las contraseñas no coinciden',
            'conficontrasena.required' => 'Confirmar contraseña es requerida',
            'zona.required' => 'La zona es requerida',
            'calle.required' => 'La calle es requerida',
            'calle.max' => 'El nombre de la calle es muy larga',
            'exterior.max' => 'El número exterior es muy largo',
            'interior.max' => 'El número interior es muy largo',
            'cp.required' => 'El código postal es requerido',
            'cp.numeric' => 'El código postal debe ser numérico',
            'entre.max' => 'La dirección entre calles es muy larga',
            'referencia.max' => 'La referencia es muy larga',
            'estado.required' => 'El estado es requerido',
            'municipio.required' => 'El municipio es requerido',
            'colonia.required' => 'La colonia es requerida',
        ]);
        //store
        $gestor = gestor::updateOrCreate([
            'id_gestor' => $this->editId,
        ], [
            'nombre' => $this->nombre,
            'ap_paterno' => $this->paterno,
            'ap_materno' => $this->materno,
            'telefono' => $this->telefono,
            'sexo' => $this->sexo,
            'correo' => $this->correo,
            'id_zona_representacion' => $this->zona,
        ]);

        $direccion = direccion::updateOrCreate([
            'id_direccion' => $gestor->direccion->id_direccion,
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

        $this->edit = false;
        $this->reset('editRegister');
        session()->flash('blue', 'Editado correctamente');
    }

    public function cancel(){
        $this->edit = false;
        $this->reset('editRegister');
    }
}
