<?php

namespace App\Livewire\Administrador;

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
    public $new = false;
    public $newRegister = [
        'nombre' => '',
        'a_paterno' => '',
        'a_materno' => '',
        'correo' => '',
        'contrasena' => '',
        'contrasena_confirmation' => '',
        'empleado' => '',
        'telefono' => '',
        'curp' => '',
        'rfc' => '',
        'sexo' => '',
        'tipo' => '',
        'calle' => '',
        'exterior' => '',
        'interior' => '',
        'cp' => '',
        'estado' => '',
        'municipio' => '',
        'colonia' => '',
    ];

    public function new_register()
    {

        $this->new = true;
    }

    public function new_form()
    {
        $this->validate([
            'newRegister.nombre' => ['required', 'max:50'],
            'newRegister.a_paterno' => ['required', 'max:50'],
            'newRegister.a_materno' => ['required', 'max:50'],
            'newRegister.correo' => ['required', 'email', 'max:255', 'unique:usuario_sistema,correo'],
            'newRegister.contrasena' => ['required', 'min:8', 'confirmed'],
            'newRegister.contrasena_confirmation' => ['required'],
            'newRegister.empleado' => ['required', 'numeric', 'unique:empleado,curp'],
            'newRegister.telefono' => ['required', 'numeric'],
            'newRegister.curp' => ['required', 'min:18'],
            'newRegister.rfc' => ['required', 'min:12', 'max:13', new Fisica],
            'newRegister.sexo' => ['required'],
            'newRegister.tipo' => ['required'],

            'newRegister.calle' => ['required', 'max:100'],
            'newRegister.exterior' => ['required', 'max:10'],
            'newRegister.interior' => ['nullable', 'max:10'],
            'newRegister.cp' => ['required', 'numeric', 'digits:5'],
            'newRegister.entre' => ['nullable', 'max:100'],
            'newRegister.referencia' => ['nullable', 'max:100'],
            'newRegister.estado' => ['required'],
            'newRegister.municipio' => ['required'],
            'newRegister.colonia' => ['required'],
        ], [
            'newRegister.nombre.required' => 'El nombre es requerido.',
            'newRegister.nombre.max' => 'El nombre no puede tener más de 50 caracteres.',
            'newRegister.a_paterno.required' => 'El apellido paterno es requerido.',
            'newRegister.a_paterno.max' => 'El apellido paterno no puede tener más de 50 caracteres.',
            'newRegister.a_materno.required' => 'El apellido materno es requerido.',
            'newRegister.a_materno.max' => 'El apellido materno no puede tener más de 50 caracteres.',
            'newRegister.correo.required' => 'El correo electrónico es requerido.',
            'newRegister.correo.email' => 'El correo electrónico es requerido',
            'newRegister.correo.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            'newRegister.correo.unique' => 'El correo electrónico ya está registrado.',
            'newRegister.contrasena.required' => 'La contraseña es requerida.',
            'newRegister.contrasena.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'newRegister.contrasena.confirmed' => 'Las contraseñas no coincide',
            'newRegister.contrasena_confirmation.required' => 'Confirmar contraseña es requerida.',
            'newRegister.empleado.required' => 'El número de empleado es requerido.',
            'newRegister.empleado.numeric' => 'El número de empleado debe ser numérico.',
            'newRegister.telefono.required' => 'El teléfono es requerido.',
            'newRegister.telefono.numeric' => 'El telefono deve ser numérico.',
            'newRegister.curp.requiere' => 'El CURP es requerido',
            'newRegister.curp.min' => 'El CURP deve tener 18 caracteres.',
            'newRegister.curp.max' => 'El CURP no puede tener más de 18 caracteres.',
            'newRegister.curp.unique' => 'El curp ya esta registrado',
            'newRegister.rfc.min' => 'El RFC debe tener 12 caracteres.',
            'newRegister.rfc.max' => 'El RFC no puede tener más de 13 caracteres.',
            'newRegister.rfc.fisica' => 'El RFC no es válido.',
            'newRegister.sexo.required' => 'El sexo es requerido.',
            'newRegister.tipo.required' => 'El tipo de empleado es requerido.',
            'newRegister.estado.required' => 'El estado es requerido.',
            'newRegister.municipio.required' => 'El municipio es requerido.',
            'newRegister.colonia.required' => 'La colonia es requerida.',
            'newRegister.calle.required' => 'La calle es requerida.',
            'newRegister.calle.max' => 'La calle no puede tener más de 100 caracteres.',
            'newRegister.exterior.required' => 'El número exterior es requerido.',
            'newRegister.exterior.numeric' => 'El número exterior debe ser numérico.',
            'newRegister.interior.numeric' => 'El número interior debe ser numero',
            'newRegister.cp.required' => 'El código postal es requerido.',
            'newRegister.cp.numeric' => 'El código postal debe ser numérico.',
            'newRegister.cp.digits' => 'El código postal debe tener 5 dígitos.',
            'newRegister.entre.max' => 'El campo entre calles no puede tener más de 100 caracteres.',
            'newRegister.referencia.max' => 'El campo referencia  no puede tener más de 100 caracteres.',
            'newRegister.estado.required' => 'El estado es requerido.',
            'newRegister.municipio.required' => 'El municipio es requerido.',
            'newRegister.colonia.required' => 'La colonia es requerida.',
        ]);

        DB::beginTransaction();
        try {
            $usuario = User::create([
                'nombre' => $this->newRegister['nombre'],
                'ap_paterno' => $this->newRegister['a_paterno'],
                'ap_materno' => $this->newRegister['a_materno'],
                'correo' => $this->newRegister['correo'],
                'contraseña' => Hash::make($this->newRegister['contrasena']),
                'estatus' => 1,
                'id_tipo_usuario' => 5
            ]);
            $id = DB::table('usuario_sistema')->where('correo', $this->newRegister['correo'])->value('id_usuario_sistema');

            empleado::create([
                'nombre' => $this->newRegister['nombre'],
                'ap_paterno' => $this->newRegister['a_paterno'],
                'ap_materno' => $this->newRegister['a_materno'],
                'no_empleado' => $this->newRegister['empleado'],
                'telefono' => $this->newRegister['telefono'],
                'curp' => $this->newRegister['curp'],
                'rfc' => $this->newRegister['rfc'],
                'sexo' => $this->newRegister['sexo'],
                'calle' => $this->newRegister['calle'],
                'no_exterior' => $this->newRegister['exterior'],
                'no_interior' => $this->newRegister['interior'],
                'cp' => $this->newRegister['cp'],
                'id_tipo_empleado' => $this->newRegister['tipo'],
                'id_usuario_sistema' => $usuario->id_usuario_sistema,
                'id_estado' => $this->newRegister['estado'],
                'id_municipio' => $this->newRegister['municipio'],
                'id_colonia' => $this->newRegister['colonia'],
            ]);
            $this->new = false;
            $this->reset('newRegister');
            session()->flash('green', 'Agregada correctamente');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            abort(500);
        }
    }

    public function new_cancel()
    {
        $this->new = false;
        $this->reset('newRegister');
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
    public $edit = false;
    public $editId;
    public $editRegister = [
        'nombre' => '',
        'a_paterno' => '',
        'a_materno' => '',
        'correo' => '',
        'contrasena' => '',
        'contrasena_confirmation' => '',
        'empleado' => '',
        'telefono' => '',
        'curp' => '',
        'rfc' => '',
        'sexo' => '',
        'tipo' => '',
        'calle' => '',
        'exterior' => '',
        'interior' => '',
        'cp' => '',
        'estado' => '',
        'municipio' => '',
        'colonia' => '',
    ];

    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $datos = empleado::find($id);
        $this->editRegister = [
            'nombre' => $datos->nombre,
            'a_paterno' => $datos->ap_paterno,
            'a_materno' => $datos->ap_materno,
            'correo' => $datos->usuario_sistema->correo,
            'empleado' => $datos->no_empleado,
            'telefono' => $datos->telefono,
            'curp' => $datos->curp,
            'rfc' => $datos->rfc,
            'sexo' => $datos->sexo,
            'tipo' => $datos->id_tipo_empleado,
            'calle' => $datos->calle,
            'exterior' => $datos->no_exterior,
            'interior' => $datos->no_interior,
            'cp' => $datos->cp,
            'estado' => $datos->id_estado,
            'municipio' => $datos->id_municipio,
            'colonia' => $datos->id_colonia,
        ];
    }

    public function edit_form()
    {
        $search_emple = empleado::find($this->editId);

        $this->validate([
            'editRegister.nombre' => ['required', 'max:50'],
            'editRegister.a_paterno' => ['required', 'max:50'],
            'editRegister.a_materno' => ['required', 'max:50'],
            'editRegister.correo' => ['required', 'email', 'max:255', Rule::unique('usuario_sistema', 'correo')->ignore($search_emple->id_usuario_sistema, 'id_usuario_sistema')],
            'editRegister.empleado' => ['required', 'numeric', Rule::unique('empleado', 'curp')->ignore($this->editId, 'id_empleado')],
            'editRegister.telefono' => ['required', 'numeric'],
            'editRegister.curp' => ['required', 'min:18'],
            'editRegister.rfc' => ['required', 'min:12', 'max:13', new Fisica, Rule::unique('empleado', 'rfc')->ignore($this->editId, 'id_empleado')],
            'editRegister.sexo' => ['required'],
            'editRegister.tipo' => ['required'],

            'editRegister.calle' => ['required', 'max:100'],
            'editRegister.exterior' => ['required', 'max:10'],
            'editRegister.interior' => ['nullable', 'max:10'],
            'editRegister.cp' => ['required', 'numeric', 'digits:5'],
            'editRegister.entre' => ['nullable', 'max:100'],
            'editRegister.referencia' => ['nullable', 'max:100'],
            'editRegister.estado' => ['required'],
            'editRegister.municipio' => ['required'],
            'editRegister.colonia' => ['required'],
        ], [
            'editRegister.nombre.required' => 'El nombre es requerido.',
            'editRegister.nombre.max' => 'El nombre no puede tener más de 50 caracteres.',
            'editRegister.a_paterno.required' => 'El apellido paterno es requerido.',
            'editRegister.a_paterno.max' => 'El apellido paterno no puede tener más de 50 caracteres.',
            'editRegister.a_materno.required' => 'El apellido materno es requerido.',
            'editRegister.a_materno.max' => 'El apellido materno no puede tener más de 50 caracteres.',
            'editRegister.correo.required' => 'El correo electrónico es requerido.',
            'editRegister.correo.email' => 'El correo electrónico es requerido',
            'editRegister.correo.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            'editRegister.correo.unique' => 'El correo electrónico ya está registrado.',
            'editRegister.empleado.required' => 'El número de empleado es requerido.',
            'editRegister.empleado.numeric' => 'El número de empleado debe ser numérico.',
            'editRegister.telefono.required' => 'El teléfono es requerido.',
            'editRegister.telefono.numeric' => 'El telefono deve ser numérico.',
            'editRegister.curp.requiere' => 'El CURP es requerido',
            'editRegister.curp.min' => 'El CURP deve tener 18 caracteres.',
            'editRegister.curp.max' => 'El CURP no puede tener más de 18 caracteres.',
            'editRegister.curp.unique' => 'El curp ya esta registrado',
            'editRegister.rfc.min' => 'El RFC debe tener 12 caracteres.',
            'editRegister.rfc.max' => 'El RFC no puede tener más de 13 caracteres.',
            'editRegister.rfc.fisica' => 'El RFC no es válido.',
            'editRegister.sexo.required' => 'El sexo es requerido.',
            'editRegister.tipo.required' => 'El tipo de empleado es requerido.',
            'editRegister.estado.required' => 'El estado es requerido.',
            'editRegister.municipio.required' => 'El municipio es requerido.',
            'editRegister.colonia.required' => 'La colonia es requerida.',
            'editRegister.calle.required' => 'La calle es requerida.',
            'editRegister.calle.max' => 'La calle no puede tener más de 100 caracteres.',
            'editRegister.exterior.required' => 'El número exterior es requerido.',
            'editRegister.exterior.numeric' => 'El número exterior debe ser numérico.',
            'editRegister.interior.numeric' => 'El número interior debe ser numero',
            'editRegister.cp.required' => 'El código postal es requerido.',
            'editRegister.cp.numeric' => 'El código postal debe ser numérico.',
            'editRegister.cp.digits' => 'El código postal debe tener 5 dígitos.',
            'editRegister.entre.max' => 'El campo entre calles no puede tener más de 100 caracteres.',
            'editRegister.referencia.max' => 'El campo referencia  no puede tener más de 100 caracteres.',
            'editRegister.estado.required' => 'El estado es requerido.',
            'editRegister.municipio.required' => 'El municipio es requerido.',
            'editRegister.colonia.required' => 'La colonia es requerida.',
        ]);

        $empleado = empleado::updateOrCreate([
            'id_empleado' => $this->editId,
        ], [
            'nombre' => $this->editRegister['nombre'],
            'ap_paterno' => $this->editRegister['a_paterno'],
            'ap_materno' => $this->editRegister['a_materno'],
            'no_empleado' => $this->editRegister['empleado'],
            'telefono' => $this->editRegister['telefono'],
            'curp' => $this->editRegister['curp'],
            'rfc' => $this->editRegister['rfc'],
            'sexo' => $this->editRegister['sexo'],
            'calle' => $this->editRegister['calle'],
            'no_exterior' => $this->editRegister['exterior'],
            'no_interior' => $this->editRegister['interior'],
            'cp' => $this->editRegister['cp'],
            'id_tipo_empleado' => $this->editRegister['tipo'],
            'id_estado' => $this->editRegister['estado'],
            'id_municipio' => $this->editRegister['municipio'],
            'id_colonia' => $this->editRegister['colonia'],
        ]);

        $usuario = User::updateOrCreate([
            'id_usuario_sistema' => $search_emple->id_usuario_sistema,
        ], [
            'correo' => $this->editRegister['correo'],
        ]);

        $this->edit = false;
        $this->reset('editRegister');
        session()->flash('blue', 'Editada correctamente');
    }

    public function edit_cancel()
    {
        $this->edit = false;
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
            $estado= estado::find($value);
            $this->municipios = municipio::where('id_estado', $estado['clave_estado'])->orderBy('nombre', 'asc')->get();
        } elseif ($property == 'newRegister.municipio') {
            $this->colonias = [];
            $municipio= municipio::find($value);
            $this->colonias = colonia::where('id_municipio', $municipio['clave_municipio'])->orderBy('nombre', 'asc')->get();
            
        }

        if ($property == 'editRegister.estado') {
            $this->municipios = [];
            $this->colonias = [];
            $estado= estado::find($value);
            $this->municipios = municipio::where('id_estado', $estado['clave_estado'])->orderBy('nombre', 'asc')->get();
        } elseif ($property == 'editRegister.municipio') {
            $this->colonias = [];
            $municipio= municipio::find($value);
            $this->colonias = colonia::where('id_municipio', $municipio['clave_municipio'])->orderBy('nombre', 'asc')->get();
        }

    }


    public function render()
    {
        $count = empleado::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')->orWhere('no_empleado', 'LIKE', '%' . $this->search . '%');
        })->count();
        $empleados = empleado::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')->orWhere('no_empleado', 'LIKE', '%' . $this->search . '%');
        })->paginate($this->view_dates);
        return view('livewire.administrador.empleados', compact('count', 'empleados'));
    }
}
