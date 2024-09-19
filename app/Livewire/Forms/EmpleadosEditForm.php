<?php

namespace App\Livewire\Forms;

use App\Models\empleado;
use App\Models\User;
use App\Rules\Fisica;
use App\Rules\Les;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EmpleadosEditForm extends Form
{

    public $edit = false;
    public $editId;
    

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

    public function edit($id)
    {
        $this->edit = true;
        $this->editId = $id;

        $datos = empleado::find($id);
        $this->nombre = $datos->nombre;
        $this->a_paterno = $datos->ap_paterno;
        $this->a_materno = $datos->ap_materno;
        $this->correo = $datos->usuario_sistema->correo;
        $this->empleado = $datos->no_empleado;
        $this->telefono = $datos->telefono;
        $this->curp = $datos->curp;
        $this->rfc = $datos->rfc;
        $this->sexo = $datos->sexo;
        $this->tipo = $datos->id_tipo_empleado;
        $this->calle = $datos->calle;
        $this->exterior = $datos->no_exterior;
        $this->interior = $datos->no_interior;
        $this->cp = $datos->cp;
        $this->estado = $datos->id_estado;
        $this->municipio = $datos->id_municipio;
        $this->colonia = $datos->id_colonia;
    }

    public function update()
    {
        $search_emple = empleado::find($this->editId);
        

        $this->validate([
            'nombre' => ['required','max:50', new Les],
            'a_paterno' => ['required','max:50', new Les],
            'a_materno' => ['required','max:50', new Les],
            'correo' => ['required', 'email','max:255', 'unique:usuario_sistema,correo,' . $search_emple->id_usuario_sistema . ',id_usuario_sistema'],
            'empleado' => ['required', 'numeric', 'unique:empleado,no_empleado,'. $this->editId . ',id_empleado'],
            'telefono' => ['required', 'numeric'],
            'curp' => ['required','min:18', 'unique:empleado,curp,' . $this->editId . ',id_empleado'],
            'rfc' => ['required','min:12','max:13', 'unique:empleado,rfc,' . $this->editId . ',id_empleado'],
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
        
        $empleado = empleado::updateOrCreate([
            'id_empleado' => $this->editId,
        ], [
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
            'id_estado' => $this->estado,
            'id_municipio' => $this->municipio,
            'id_colonia' => $this->colonia,
        ]);

        $usuario = User::updateOrCreate([
            'id_usuario_sistema' => $search_emple->id_usuario_sistema,
        ], [
            'nombre' => $this->nombre,
            'correo' => $this->correo,
        ]);

        $this->edit = false;
        $this->reset('editRegister');
        DB::commit();
    }


    public function edit_cancel()
    {
        $this->edit = false;
    }
}
