<?php

namespace App\Livewire\Administrador;

use App\Models\colonia;
use App\Models\direccion;
use App\Models\estado;
use App\Models\estados_zona;
use App\Models\gestor;
use App\Models\municipio;
use App\Models\User;
use App\Models\zona_representacion;
use Livewire\Component;
use Livewire\WithPagination;
use App\Rules\Les;
use App\Rules\telefono;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Lazy;
use App\Rules\Password;

#[Lazy()]
class Gestores extends Component
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




    //&================================================================= Nuevo Registro
    public $new = false;
    public $newRegister = [
        'nombre' => '',
        'paterno' => '',
        'materno' => '',
        'telefono' => '',
        'sexo' => '',
        'correo' => '',
        'contrasena' => '',
        'contrasena_confirmation' => '',
        'zona' => '',
        'calle' => '',
        'exterior' => '',
        'interior' => '',
        'cp' => '',
        'entre' => '',
        'referencia' => '',
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
        //validations
        $this->validate([
            'newRegister.nombre' => ['required', 'max:100', new Les],
            'newRegister.paterno' => ['required', 'max:100', new Les],
            'newRegister.materno' => ['required', 'max:100', new Les],
            'newRegister.telefono' => ['required', 'numeric', new telefono],
            'newRegister.sexo' => ['required'],
            'newRegister.correo' => ['required', 'email', 'unique:gestor,correo', 'unique:usuario_sistema,correo', 'unique:contacro,correo'],
            'newRegister.contrasena' => ['required', 'min:8', 'confirmed', Password::default()],
            'newRegister.contrasena_confirmation' => ['required'],
            'newRegister.zona' => ['required'],
            'newRegister.calle' => ['required', 'max:100'],
            'newRegister.exterior' => ['max:20'],
            'newRegister.interior' => ['max:20'],
            'newRegister.cp' => ['required', 'numeric'],
            'newRegister.entre' => ['required', 'max:250'],
            'newRegister.referencia' => ['required', 'max:250'],
            'newRegister.estado' => ['required'],
            'newRegister.municipio' => ['required'],
            'newRegister.colonia' => [' required'],
        ], [
            'newRegister.nombre.required' => 'El nombre es requerido',
            'newRegister.nombre.max' => 'El nombre es muy largo',
            'newRegister.nombre.new Les' => 'El nombre es muy largo',
            'newRegister.paterno.required' => 'El apellido paterno es requerido',
            'newRegister.paterno.max' => 'El apellido paterno es muy largo',
            'newRegister.materno.required' => 'El apellido materno es requerido',
            'newRegister.materno.max' => 'El apellido materno es muy largo',
            'newRegister.telefono.required' => 'El teléfono es requerido',
            'newRegister.telefono.numeric' => 'El teléfono debe ser numérico',
            'newRegister.sexo.required' => 'El sexo es requerido',
            'newRegister.correo.required' => 'El correo es requerido',
            'newRegister.correo.email' => 'El correo no es válido',
            'newRegister.correo.unique' => 'El correo ya a sido registrado',
            'newRegister.contrasena.required' => 'La contraseña es requerida',
            'newRegister.contrasena.min' => 'La contraseña debe tener al menos 8 caracteres',
            'newRegister.contrasena.confirmed' => 'Las contraseñas no coinciden',
            'newRegister.contrasena_confirmation.required' => 'Confirmar contraseña es requerida',
            'newRegister.zona.required' => 'La zona es requerida',
            'newRegister.calle.required' => 'La calle es requerida',
            'newRegister.calle.max' => 'El nombre de la calle es muy larga',
            'newRegister.exterior.max' => 'El número exterior es muy largo',
            'newRegister.interior.max' => 'El número interior es muy largo',
            'newRegister.cp.required' => 'El código postal es requerido',
            'newRegister.cp.numeric' => 'El código postal debe ser numérico',
            'newRegister.entre.required' => 'La dirección entre calles es requerida',
            'newRegister.entre.max' => 'La dirección entre calles es muy larga',
            'newRegister.referencia.required' => 'La referencia es requerida',
            'newRegister.referencia.max' => 'La referencia es muy larga',
            'newRegister.estado.required' => 'El estado es requerido',
            'newRegister.municipio.required' => 'El municipio es requerido',
            'newRegister.colonia.required' => 'La colonia es requerida',
        ]);

        $usuario = User::create([
            'correo' => $this->newRegister['correo'],
            'contraseña' => Hash::make($this->newRegister['contrasena']),
            'estatus' => 1,
            'idtipo_usuario' => 3
        ]);
        $id = DB::table('usuario_sistema')->where('correo', $this->newRegister['correo'])->value('idusuario_sistema');


        $direccion = direccion::create([
            'calle' => $this->newRegister['calle'],
            'no_exterior' => $this->newRegister['exterior'],
            'no_interior' => $this->newRegister['interior'],
            'entre_calles' => $this->newRegister['entre'],
            'referencia' => $this->newRegister['referencia'],
            'cp' => $this->newRegister['cp'],
            'id_estado' => $this->newRegister['estado'],
            'id_municipio' => $this->newRegister['municipio'],
            'id_colonia' => $this->newRegister['colonia'],
        ]);

        gestor::create([
            'nombre' => $this->newRegister['nombre'],
            'ap_paterno' => $this->newRegister['paterno'],
            'ap_materno' => $this->newRegister['materno'],
            'telefono' => $this->newRegister['telefono'],
            'sexo' => $this->newRegister['sexo'],
            'correo' => $this->newRegister['correo'],
            'id_direccion' => $direccion->id_direccion,
            'idusuario_sistema' => $usuario->idusuario_sistema,
            'idzona_representacion' => $this->newRegister['zona'],
        ]);

        $this->new = false;
        $this->reset('newRegister');
        session()->flash('green', 'Agregada correctamente');
    }

    public function new_cancel()
    {
        $this->new = false;
        $this->reset('newRegister');
    }


    //&=================================================================Editar Registro
    public $edit = false;
    public $editId;
    public $editRegister = [
        'nombre' => '',
        'paterno' => '',
        'materno' => '',
        'telefono' => '',
        'sexo' => '',
        'correo' => '',
        'zona' => '',
        'calle' => '',
        'exterior' => '',
        'interior' => '',
        'cp' => '',
        'entre' => '',
        'referencia' => '',
        'estado' => '',
        'municipio' => '',
        'colonia' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = gestor::find($id);
        $this->editRegister = [
            'nombre' => $register->nombre,
            'paterno' => $register->ap_paterno,
            'materno' => $register->ap_materno,
            'telefono' => $register->telefono,
            'sexo' => $register->sexo,
            'correo' => $register->correo,
            'zona' => $register->idzona_representacion,
            'calle' => $register->direccion->calle,
            'exterior' => $register->direccion->no_exterior,
            'interior' => $register->direccion->no_interior,
            'cp' => $register->direccion->cp,
            'entre' => $register->direccion->entre_calles,
            'referencia' => $register->direccion->referencia,
            'estado' => $register->direccion->id_estado,
            'municipio' => $register->direccion->id_municipio,
            'colonia' => $register->direccion->id_colonia,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => ['required', 'max:100'],
            'editRegister.paterno' => ['required', 'max:100'],
            'editRegister.materno' => ['required', 'max:100'],
            'editRegister.telefono' => ['required', 'numeric', new telefono],
            'editRegister.sexo' => ['required'],
            'editRegister.correo' => ['required', 'email', 'unique:gestor,correo,' . $this->editId . ',id_gestor'],
            'editRegister.zona' => ['required'],
            'editRegister.calle' => ['required', 'max:100'],
            'editRegister.exterior' => ['max:20'],
            'editRegister.interior' => ['max:20'],
            'editRegister.cp' => ['required', 'numeric'],
            'editRegister.entre' => ['required', 'max:250'],
            'editRegister.referencia' => ['required', 'max:250'],
            'editRegister.estado' => ['required'],
            'editRegister.municipio' => ['required'],
            'editRegister.colonia' => [' required'],
        ], [
            'editRegister.nombre.required' => 'El nombre es requerido',
            'editRegister.nombre.max' => 'El nombre es muy largo',
            'editRegister.paterno.required' => 'El apellido paterno es requerido',
            'editRegister.paterno.max' => 'El apellido paterno es muy largo',
            'editRegister.materno.required' => 'El apellido materno es requerido',
            'editRegister.materno.max' => 'El apellido materno es muy largo',
            'editRegister.telefono.required' => 'El teléfono es requerido',
            'editRegister.telefono.numeric' => 'El teléfono debe ser numérico',
            'editRegister.sexo.required' => 'El sexo es requerido',
            'editRegister.correo.required' => 'El correo es requerido',
            'editRegister.correo.email' => 'El correo no es válido',
            'editRegister.correo.unique' => 'El correo ya existe',
            'editRegister.contrasena.required' => 'La contraseña es requerida',
            'editRegister.contrasena.min' => 'La contraseña debe tener al menos 8 caracteres',
            'editRegister.contrasena.confirmed' => 'Las contraseñas no coinciden',
            'editRegister.conficontrasena.required' => 'Confirmar contraseña es requerida',
            'editRegister.zona.required' => 'La zona es requerida',
            'editRegister.calle.required' => 'La calle es requerida',
            'editRegister.calle.max' => 'El nombre de la calle es muy larga',
            'editRegister.exterior.max' => 'El número exterior es muy largo',
            'editRegister.interior.max' => 'El número interior es muy largo',
            'editRegister.cp.required' => 'El código postal es requerido',
            'editRegister.cp.numeric' => 'El código postal debe ser numérico',
            'editRegister.entre.required' => 'La dirección entre calles es requerida',
            'editRegister.entre.max' => 'La dirección entre calles es muy larga',
            'editRegister.referencia.required' => 'La referencia es requerida',
            'editRegister.referencia.max' => 'La referencia es muy larga',
            'editRegister.estado.required' => 'El estado es requerido',
            'editRegister.municipio.required' => 'El municipio es requerido',
            'editRegister.colonia.required' => 'La colonia es requerida',
        ]);
        //store
        $gestor = gestor::updateOrCreate([
            'id_gestor' => $this->editId,
        ], [
            'nombre' => $this->editRegister['nombre'],
            'ap_paterno' => $this->editRegister['paterno'],
            'ap_materno' => $this->editRegister['materno'],
            'telefono' => $this->editRegister['telefono'],
            'sexo' => $this->editRegister['sexo'],
            'correo' => $this->editRegister['correo'],
            'idzona_representacion' => $this->editRegister['zona'],
        ]);

        $direccion = direccion::updateOrCreate([
            'id_direccion' => $gestor->direccion->id_direccion,
        ], [
            'calle' => $this->editRegister['calle'],
            'no_exterior' => $this->editRegister['exterior'],
            'no_interior' => $this->editRegister['interior'],
            'cp' => $this->editRegister['cp'],
            'entre_calles' => $this->editRegister['entre'],
            'referencia' => $this->editRegister['referencia'],
            'id_estado' => $this->editRegister['estado'],
            'id_municipio' => $this->editRegister['municipio'],
            'id_colonia' => $this->editRegister['colonia'],
        ]);

        $this->edit = false;
        $this->reset('editRegister');
        session()->flash('blue', 'Editado correctamente');
    }
    public function edit_cancel()
    {
        $this->edit = false;
        $this->reset('editRegister');
    }
    //&================================================================= Datos


    public $zonas;
    public $estados = [];
    public $municipios = [];
    public $colonias = [];


    public function mount()
    {
        $this->zonas = zona_representacion::all();
        $this->estados = estado::all();
    }

    public function updated($property, $value)
    {
        if ($property == 'newRegister.estado') {
            $this->municipios = [];
            $this->colonias = [];
            $this->municipios = municipio::where('id_estado', $this->newRegister['estado'])->get();
        } elseif ($property == 'newRegister.municipio') {
            $this->colonias = '';
            $this->colonias = colonia::where('id_municipio', $this->newRegister['municipio'])->get();
        }

        if ($property == 'editRegister.estado') {
            $this->municipios = '';
            $this->municipios = municipio::where('id_estado', $this->editRegister['estado'])->get();
        } elseif ($property == 'editRegister.municipio') {
            $this->colonias = '';
            $this->colonias = colonia::where('id_municipio', $this->editRegister['municipio'])->get();
        }
    }

    //&================================================================= Direccion

    public $direct = false;
    public $direcId;

    public $direcRegister = [
        'calle' => '',
        'exterior' => '',
        'interior' => '',
        'cp' => '',
        'entre' => '',
        'referencia' => '',
        'estado' => '',
        'municipio' => '',
        'colonia' => '',
    ];

    public $nombre_sucursal = '';
    public function direc_register($id)
    {
        $this->direct = true;
        $this->direcId = $id;
        $gestor = gestor::find($this->direcId);
        $this->direcRegister = [
            'calle' => $gestor->direccion->calle,
            'exterior' => $gestor->direccion->no_exterior,
            'interior' => $gestor->direccion->no_interior,
            'cp' => $gestor->direccion->cp,
            'entre' => $gestor->direccion->entre_calles,
            'referencia' => $gestor->direccion->referencia,
            'estado' => $gestor->direccion->estado->nombre,
            'municipio' => $gestor->direccion->municipio->nombre,
            'colonia' => $gestor->direccion->colonia->nombre,
        ];
    }

    public function direct_cancel()
    {
        $this->direct = false;
        $this->reset('direcRegister');
    }

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $count = gestor::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')->orWhere('correo', 'LIKE', '%' . $this->search . '%');
        })->count();
        $gestores = gestor::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')->orWhere('correo', 'LIKE', '%' . $this->search . '%');
        })->paginate($this->view_dates);
        return view('livewire.administrador.gestores', compact('gestores', 'count'));
    }
}
