<?php

namespace App\Livewire\Administrador;

use App\Models\cliente;
use App\Models\colonia;
use App\Models\contacto;
use App\Models\estado;
use App\Models\gestor;
use App\Models\municipio;
use App\Models\User;
use App\Rules\Fisica;
use App\Rules\Les;
use App\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
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
    public $select = false;

    public function fisica_moral()
    {
        $this->select = true;
    }

    public function select_cancel()
    {
        $this->select = false;
    }

    public $new = false;
    public $new_moral = false;
    public $newRegister = [
        //datos cliente
        'nombre' => '',
        'rfc' => '',
        'correo' => '',
        'contrasena' => '',
        'contrasena_confirmation' => '',
        'nombre_contac'=> '',
        'paterno_contac'=>'',
        'materno_contac'=>'',
        'correo_contact'=>'',
        'correo_alter_contact'=>'',
        'telefono_contact'=>'',
        'telefono_alter_contact'=>'',
    ];

    public function select_fisica()
    {
        $this->new = true;
        $this->select = false;
    }

    public function select_moral()
    {
        $this->new_moral = true;
        $this->select = false;
    }

    public function new_form()
    {
        $this->validate([
            'newRegister.nombre' => ['required', 'string', 'max:50', new Les, 'unique:usuario_sistema,nombre'],
            'newRegister.rfc' => ['required', 'string', 'min:13', 'max:13', new Fisica, 'unique:cliente,rfc'],
            'newRegister.correo' => ['required', 'email', 'max:255', 'unique:usuario_sistema,correo'],
            'newRegister.contrasena' => ['required', 'string', 'min:8', 'confirmed', Password::default()],
            'newRegister.contrasena_confirmation' => ['required'],
           
            'newRegister.nombre_contac' => ['required', 'string', 'max:50', new Les],
            'newRegister.paterno_contac' => ['required', 'string', 'max:50', new Les],
            'newRegister.materno_contac' => ['required', 'string', 'max:50', new Les],
            'newRegister.correo_contact' => ['required', 'email', 'max:255', 'unique:usuario_sistema,correo'],
            'newRegister.correo_alter_contact' => ['required', 'email', 'max:255', 'unique:usuario_sistema,correo'],
            'newRegister.telefono_contact' => ['required', 'string', 'max:50'],
            'newRegister.telefono_alter_contact' => ['required', 'string', 'max:50' ],
            
        ], [
            'newRegister.nombre.unique'=> 'El nombre deve ser unico',
            'newRegister.nombre.required' => 'El nombre es obligatorio',
            'newRegister.nombre.string' => 'El nombre debe ser un texto',
            'newRegister.nombre.max' => 'El nombre no puede tener más de 50 caracteres',
            'newRegister.nombre.les' => 'El nombre no puede contener caracteres especiales o números',

            'newRegister.rfc.required' => 'El RFC es obligatorio',
            'newRegister.rfc.string' => 'El RFC debe ser un texto',
            'newRegister.rfc.min' => 'El RFC debe tener al menos 13 caracteres',
            'newRegister.rfc.max' => 'El RFC no puede tener más de 13 caracteres',
            'newRegister.rfc.fisica' => 'El RFC no es válido',
            'newRegister.rfc.unique' => 'El RFC ya ha sido registrado',

            'newRegister.correo.required' => 'El correo electrónico es obligatorio',
            'newRegister.correo.email' => 'El correo electrónico debe ser válido',
            'newRegister.correo.max' => 'El correo electrónico no puede tener más de 255 caracteres',
            'newRegister.correo.unique' => 'El correo electrónico ya ha sido registrado',
            'newRegister.contrasena.required' => 'La contraseña es obligatoria',
            'newRegister.contrasena.string' => 'La contraseña debe ser un texto',
            'newRegister.contrasena.min' => 'La contraseña debe tener al menos 8 caracteres',
            'newRegister.contrasena.confirmed' => 'Las contraseñas no coinciden',
            'newRegister.contrasena_confirmation.required' => 'Confirmar el correo es requerido'
        ]);

        /*DB::beginTransaction();

        try {


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            abort(500);
        }*/
        $usuario_sistema = User::create([
            'nombre' => $this->newRegister['nombre'],
            
            'correo' => $this->newRegister['correo'],
            'contraseña' => Hash::make($this->newRegister['contrasena']),

            'estatus' => 1,
            'id_tipo_usuario' => 2
        ]);

        $id = DB::table('usuario_sistema')->where('correo', $this->newRegister['correo'])->value('id_usuario_sistema');

        $contacto = contacto::create([
            'nombre' => $this->newRegister['nombre_contac'],
            'ap_paterno' => $this->newRegister['paterno_contac'],
            'ap_materno' => $this->newRegister['materno_contac'],
            'correo' => $this->newRegister['correo_contact'],
            'correo_alternativo' => $this->newRegister['correo_alter_contact'],
            'telefono'=> $this->newRegister['telefono_contact'],
            'telefono_alternativo'=> $this->newRegister['telefono_alter_contact'],
        
        ]);
  
        $id2 = DB::table('contacto')->where('correo', $this->newRegister['correo'])->value('id_contacto');

        $cliente = cliente::create([
            'rfc' => strtoupper($this->newRegister['rfc']),
            'tipo' => 1,
            'correo' => $this->newRegister['correo'],
            'id_usuario_sistema' => $id,
            'id_contacto' => $contacto->id_contacto
        ]);

        $this->reset('newRegister');
        $this->new = false;
        session()->flash('green', 'Agregada correctamente');
    }

    public $newRegisterM = [
        //datos cliente
        'nombre' => '',
        'rfc' => '',
        'correo' => '',
        'contrasena' => '',
        'contrasena_confirmation' => '',
    ];

    public function new_form_moral()
    {
        $this->validate([
            'newRegisterM.nombre' => ['required', 'string', 'max:50'],
            'newRegisterM.rfc' => ['required', 'string', 'min:12', 'max:12', new Fisica, 'unique:cliente,rfc'],
            'newRegisterM.correo' => ['required', 'email', 'max:255', 'unique:usuario_sistema,correo'],
            'newRegisterM.contrasena' => ['required', 'string', 'min:8', 'confirmed', Password::default()],
            'newRegisterM.contrasena_confirmation' => ['required'],
        ], [
            'newRegisterM.nombre.required' => 'El nombre es obligatorio',
            'newRegisterM.nombre.string' => 'El nombre debe ser un texto',
            'newRegisterM.nombre.max' => 'El nombre no puede tener más de 50 caracteres',
            'newRegisterM.nombre.les' => 'El nombre no puede contener caracteres especiales o números',

            'newRegisterM.paterno.required' => 'El apellido paterno es obligatorio',
            'newRegisterM.paterno.string' => 'El apellido paterno debe ser un texto',
            'newRegisterM.paterno.max' => 'El apellido paterno no puede tener más de 50 caracteres',
            'newRegisterM.paterno.les' => 'El apellido paterno no puede contener caracteres especiales o números',

            'newRegisterM.materno.required' => 'El apellido materno es obligatorio',
            'newRegisterM.materno.string' => 'El apellido materno debe ser un texto',
            'newRegisterM.materno.max' => 'El apellido materno no puede tener más de 50 caracteres',
            'newRegisterM.materno.les' => 'El apellido materno no puede contener caracteres especiales o números',

            'newRegisterM.rfc.required' => 'El RFC es obligatorio',
            'newRegisterM.rfc.string' => 'El RFC debe ser un texto',
            'newRegisterM.rfc.min' => 'El RFC debe tener al menos 12 caracteres',
            'newRegisterM.rfc.max' => 'El RFC no puede tener más de 12 caracteres',
            'newRegisterM.rfc.fisica' => 'El RFC no es válido',
            'newRegisterM.rfc.unique' => 'El RFC ya ha sido registrado',

            'newRegisterM.correo.required' => 'El correo electrónico es obligatorio',
            'newRegisterM.correo.email' => 'El correo electrónico debe ser válido',
            'newRegisterM.correo.max' => 'El correo electrónico no puede tener más de 255 caracteres',
            'newRegisterM.correo.unique' => 'El correo electrónico ya ha sido registrado',
            'newRegisterM.contrasena.required' => 'La contraseña es obligatoria',
            'newRegisterM.contrasena.string' => 'La contraseña debe ser un texto',
            'newRegisterM.contrasena.min' => 'La contraseña debe tener al menos 8 caracteres',
            'newRegisterM.contrasena.confirmed' => 'Las contraseñas no coinciden',
            'newRegisterM.contrasena_confirmation.required' => 'Confirmar el correo es requerido'
        ]);

        DB::beginTransaction();
        try {

            $usuario_sistema = User::create([
                'nombre' => $this->newRegisterM['nombre'],
                'ap_paterno' => '',
                'ap_materno' => '',
                'correo' => $this->newRegisterM['correo'],
                'contraseña' => Hash::make($this->newRegisterM['contrasena']),
                'estatus' => 1,
                'id_tipo_usuario' => 2
            ]);

            $id = DB::table('usuario_sistema')->where('correo', $this->newRegisterM['correo'])->value('id_usuario_sistema');
 
            $contacto = contacto::create([
                'nombre_contac'=> $this->newRegisterM['nombre_contac'],
                'materno_contac'=> $this->newRegisterM['materno_contac'],
                'paterno_contac'=> $this->newRegisterM['paterno_contac'],
                'correo_contact' => $this->newRegisterM['correo_contact'],
                'correo_alter_contact' => $this->newRegisterM['correo_alter_contactr'],
                'telefono_contact'=> $this->newRegisterM['telefono_contact'],
                'telefono_alter_contact'=> $this->newRegisterM['telefono_alter_contact'],

            ]);

            $cliente = cliente::create([

                'rfc' => strtoupper($this->newRegisterM['rfc']),
                'razon_social' => $this->newRegisterM['nombre'],
                'tipo' => 2,
                'correo' => $this->newRegisterM['correo'],
                'id_usuario_sistema' => $id,
                'id_contacto' => $contacto-> id_contacto,
            ]);

            $this->reset('newRegisterM');
            $this->new_moral = false;
            session()->flash('green', 'Agregada correctamente');


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            abort(500);
        }
    }

    public function new_moral_cancel(){
        $this->new_moral = false;
        $this->reset('newRegisterM');
    }
    public function new_cancel(){
        $this->new = false;
        $this->reset('newRegister');
    }

    //&================================================================= Datos


    public $gestores;
    public $estados = [];
    public $municipios = [];
    public $colonias = [];



    public function mount()
    {
        $this->estados = estado::all();
        $this->gestores = gestor::where('estatus','1')->get();
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
    }

    public function direct_cancel()
    {
        $this->direct = false;
        $this->reset('direcRegister');
    }

    //&================================================================= Contacto

    public $contac = false;
    public $contactId;

    public $contactRegister = [
        'nombre_contac' => '',
        'materno_contac' => '',
        'paterno_contac' => '',
        'correo_contact' => '',
        'correo_alter_contact' => '',
        'telefono_contact' => '',
        'telefono_alter_contact' => '',
    ];

    public function views($id)
    {
        $this->contac = true;
        $this->contactId = $id;
        $cliente = cliente::find($this->contactId);
        if ($cliente->id_contacto) {
            $this->contactRegister = [
                'nombre_contac' => $cliente->contacto->nombre,
                'materno_contac' => $cliente->contacto->ap_materno,
                'paterno_contac' => $cliente->contacto->ap_paterno,
                'correo_contact' => $cliente->contacto->correo,
                'correo_alter_contact' => $cliente->contacto->correo_alternativo,
                'telefono_contact' => $cliente->contacto->telefono,
                'telefono_alter_contact' => $cliente->contacto->telefono_alternativo,
            ];
        } else {
            $this->contactRegister = [
                'nombre_contac' => 'Sin Contacto',
                'materno_contac' => '',
                'paterno_contac' => '',
                'correo_contact' => '',
                'correo_alter_contact' => '',
                'telefono_contact' => '',
                'telefono_alter_contact' => '',
            ];
        }
    }
    public function contact_cancel()
    {
        $this->contac = false;
        $this->reset('contactRegister');
    }

    //&================================================================= Gestor view or edit
    public $gestor = false;
    public $gestorId;
    public $gestorRegister = [
        'gestor' => '',
    ];

    public function gestor_register($id)
    {
        $this->gestor = true;
        $this->gestorId = $id;
        $gestorEdit = cliente::find($this->gestorId);
        $this->gestorRegister = [
            'gestor' => $gestorEdit->id_gestor,
        ];
    }

    public function edit_Gestor()
    {

        $this->validate([
            'gestorRegister.gestor' => 'required',
        ], [
            'gestorRegister.gestor.required' => 'Seleccione un gestor',
        ]);
        $clientes = cliente::updateOrCreate([
            'id_cliente' => $this->gestorId,
        ], [
            'id_gestor' => $this->gestorRegister['gestor'],
        ]);

        $this->gestor = false;
        $this->reset('gestorRegister');
    }

    public function gestor_cancel()
    {
        $this->gestor = false;
        $this->reset('gestorRegister');
    }

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $search = $this->search;
        $count =  cliente::with('sistema')->whereHas('sistema', function ($query) use ($search) {
            $query->where('nombre', 'LIKE', "%{$search}%")->orWhere('correo', 'LIKE', "%{$search}%");
        })->orWhere('razon_social', 'LIKE', "%{$search}%")->count();

        $clientes = cliente::with('sistema')->whereHas('sistema', function ($query) use ($search) {
            $query->where('nombre', 'LIKE', "%{$search}%")->orWhere('correo', 'LIKE', "%{$search}%");
        })->orWhere('razon_social', 'LIKE', "%{$search}%")->paginate($this->view_dates);
        return view('livewire.administrador.clientes', compact('count', 'clientes'));
    }
}
