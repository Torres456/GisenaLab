<?php

namespace App\Livewire\Administrador;

use App\Models\colonia;
use App\Models\contacto;
use App\Models\direccion;
use App\Models\estado;
use App\Models\gestor;
use App\Models\interesado;
use App\Models\municipio;
use App\Models\User;
use App\Rules\Les;
use App\Rules\Password;
use App\Rules\telefono;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Interesados extends Component
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
        'telefono_alter' => '',
        'correo' => '',
        'correo_alter' => '',
        'contrasena' => '',
        'contrasena_confirmation' => '',
        'gestor' => '',

        //Contacto
        'nombre_contac' => '',
        'materno_contac' => '',
        'paterno_contac' => '',
        'correo_contact' => '',
        'correo_alter_contact' => '',
        'telefono_contact' => '',
        'telefono_alter_contact' => '',

        //Direccion
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
            'newRegister.telefono_alter' => ['required'],
            'newRegister.correo' => ['required', 'email', 'unique:gestor,correo', 'unique:usuario_sistema,correo', 'unique:contacto,correo'],
            'newRegister.correo_alter' => ['required', 'email'],
            'newRegister.contrasena' => ['required', 'min:8', 'confirmed', Password::default()],
            'newRegister.contrasena_confirmation' => ['required'],
            'newRegister.gestor' => ['required'],
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
            'newRegister.telefono.max' => 'El teléfono debe ser numérico',
            'newRegister.telefono_alter.required' => 'El teléfono alternativo es requerido',
            'newRegister.correo.required' => 'El correo electrónico es requerido',
            'newRegister.correo.email' => 'El correo electrónico no es válido',
            'newRegister.correo.unique' => 'El correo electrónico ya está registrado',
            'newRegister.correo_alter.required' => 'El correo alternativo es requerido',
            'newRegister.correo_alter.email' => 'El correo electrónico no es válido',
            'newRegister.contrasena.required' => 'La contraseña es requerida',
            'newRegister.contrasena.min' => 'La contraseña debe tener al menos 8 caracteres',
            'newRegister.contrasena.confirmed' => 'Las contraseñas no coinciden',
            'newRegister.contrasena_confirmation.required' => 'Confirmar contraseña es requerida',
            'newRegister.gestor.required' => 'Seleccione un gestor',
            'newRegister.calle.required' => 'La calle es requerida',
            'newRegister.calle.max' => 'La calle es muy larga',
            'newRegister.exterior.max' => 'El número exterior es muy largo',
            'newRegister.interior.max' => 'El número interior es muy largo',
            'newRegister.cp.required' => 'El código postal es requerido',
            'newRegister.cp.numeric' => 'El código postal debe ser numérico',
            'newRegister.entre.required' => 'La dirección entre calles es requerida',
            'newRegister.entre.max' => 'La dirección entre calles es muy larga',
            'newRegister.referencia.required' => 'La referencia es requerida',
            'newRegister.referencia.max' => 'La referencia es muy larga',
            'newRegister.estado.required' => 'Seleccione un estado',
            'newRegister.municipio.required' => 'Seleccione un municipio',
            'newRegister.colonia.required' => 'Seleccione una colonia',
        ]);

        $usuario = User::create([
            'correo' => $this->newRegister['correo'],
            'contraseña' => Hash::make($this->newRegister['contrasena']),
            'estatus' => 1,
            'idtipo_usuario' => 4
        ]);
        $id = DB::table('usuario_sistema')->where('correo', $this->newRegister['correo'])->value('idusuario_sistema');
        
        $contacto = contacto::create([
            'nombre' => $this->newRegister['nombre_contac'],
            'ap_paterno' => $this->newRegister['materno_contac'],
            'ap_materno' => $this->newRegister['paterno_contac'],
            'correo' => $this->newRegister['correo_contact'],
            'correo_alternativo' => $this->newRegister['correo_alter_contact'],
            'telefono' => $this->newRegister['telefono_contact'],
            'telefono_alternativo' => $this->newRegister['telefono_alter_contact'],
        ]);

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

        interesado::create([
            'nombre' => $this->newRegister['nombre'],
            'a_paterno' => $this->newRegister['paterno'],
            'a_materno' => $this->newRegister['materno'],
            'telefono' => $this->newRegister['telefono'],
            'telefono_alternativo' => $this->newRegister['telefono_alter'],
            'correo' => $this->newRegister['correo'],
            'correo_alternativo' => $this->newRegister['correo_alter'],
            'direccion_id_direccion' => $direccion->id_direccion,
            //'idusuario_sistema' => $usuario->idusuario_sistema,
            'gestor_id_gestor' => $this->newRegister['gestor'],
            'contacto_idcontacto' => $contacto->id_contacto,
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
        'telefono_alter' => '',
        'correo' => '',
        'correo_alter' => '',
        'contrasena' => '',
        'contrasena_confirmation' => '',
        'gestor' => '',

        //Contacto
        'nombre_contac' => '',
        'materno_contac' => '',
        'paterno_contac' => '',
        'correo_contact' => '',
        'correo_alter_contact' => '',
        'telefono_contact' => '',
        'telefono_alter_contact' => '',

        //Direccion
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
        $register = interesado::find($id);
        $this->editRegister = [
            'nombre' => $register->nombre,
            'paterno' => $register->a_paterno,
            'materno' => $register->a_materno,
            'telefono' => $register->telefono,
            'telefono_alter' => $register->telefono_alternativo,
            'correo' => $register->correo,
            'correo_alter' => $register->correo_alternativo,
            'gestor' => $register->gestor_id_gestor,
            'contacto_idcontacto' => $register->contacto_idcontacto,
            'direccion_id_direccion' => $register->direccion_id_direccion,
            'nombre_contac' => $register->contacto->nombre,
            'materno_contac' => $register->contacto->ap_materno,
            'paterno_contac' => $register->contacto->ap_paterno,
            'correo_contact' => $register->contacto->correo,
            'correo_alter_contact' => $register->contacto->correo_alternativo,
            'telefono_contact' => $register->contacto->telefono,
            'telefono_alter_contact' => $register->contacto->telefono_alternativo,
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

            'editRegister.nombre' => ['required', 'max:100', new Les],
            'editRegister.paterno' => ['required', 'max:100', new Les],
            'editRegister.materno' => ['required', 'max:100', new Les],
            'editRegister.telefono' => ['required', 'numeric', new telefono],
            'editRegister.telefono_alter' => ['required'],
            'editRegister.correo' => ['required', 'email', 'unique:interesado,correo,' . $this->editId . ',id_interesado'],
            'editRegister.correo_alter' => ['required', 'email'],
            'editRegister.gestor' => ['required'],
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
            'editRegister.nombre.new Les' => 'El nombre es muy largo',
            'editRegister.paterno.required' => 'El apellido paterno es requerido',
            'editRegister.paterno.max' => 'El apellido paterno es muy largo',
            'editRegister.materno.required' => 'El apellido materno es requerido',
            'editRegister.materno.max' => 'El apellido materno es muy largo',
            'editRegister.telefono.required' => 'El teléfono es requerido',
            'editRegister.telefono.numeric' => 'El teléfono debe ser numérico',
            'editRegister.telefono.max' => 'El teléfono debe ser numérico',
            'editRegister.telefono_alter.required' => 'El teléfono alternativo es requerido',
            'editRegister.correo.required' => 'El correo electrónico es requerido',
            'editRegister.correo.email' => 'El correo electrónico no es válido',
            'editRegister.correo.unique' => 'El correo electrónico ya está registrado',
            'editRegister.correo_alter.required' => 'El correo alternativo es requerido',
            'editRegister.correo_alter.email' => 'El correo electrónico no es válido',
            'editRegister.gestor.required' => 'Seleccione un gestor',
            'editRegister.calle.required' => 'La calle es requerida',
            'editRegister.calle.max' => 'La calle es muy larga',
            'editRegister.exterior.max' => 'El número exterior es muy largo',
            'editRegister.interior.max' => 'El número interior es muy largo',
            'editRegister.cp.required' => 'El código postal es requerido',
            'editRegister.cp.numeric' => 'El código postal debe ser numérico',
            'editRegister.entre.required' => 'La dirección entre calles es requerida',
            'editRegister.entre.max' => 'La dirección entre calles es muy larga',
            'editRegister.referencia.required' => 'La referencia es requerida',
            'editRegister.referencia.max' => 'La referencia es muy larga',
            'editRegister.estado.required' => 'Seleccione un estado',
            'editRegister.municipio.required' => 'Seleccione un municipio',
            'editRegister.colonia.required' => 'Seleccione una colonia',
        ]);


        //store
        $interesado = interesado::updateOrCreate([
            'id_interesado' => $this->editId,
        ], [
            'nombre' => $this->editRegister['nombre'],
            'a_paterno' => $this->editRegister['paterno'],
            'a_materno' => $this->editRegister['materno'],
            'telefono' => $this->editRegister['telefono'],
            'telefono_alternativo' => $this->editRegister['telefono_alter'],
            'correo' => $this->editRegister['correo'],
            'correo_alternativo' => $this->editRegister['correo_alter'],
        ]);

        //solo actualizar contacto
        $contacto = contacto::updateOrCreate([
            'id_contacto' => $interesado->contacto->id_contacto,
        ], [
            'nombre' => $this->editRegister['nombre_contac'],
            'ap_paterno' => $this->editRegister['paterno_contac'],
            'ap_materno' => $this->editRegister['materno_contac'],
            'telefono' => $this->editRegister['telefono_contact'],
            'telefono_alternativo' => $this->editRegister['telefono_alter_contact'],
            'correo' => $this->editRegister['correo_contact'],
            'correo_alternativo' => $this->editRegister['correo_alter_contact'],
        ]);
        

        $direccion = direccion::updateOrCreate([
            'id_direccion' => $interesado->direccion->id_direccion,
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


    public $gestores;
    public $estados = [];
    public $municipios = [];
    public $colonias = [];


    public function mount()
    {
        $this->estados = estado::all();
        $this->gestores = gestor::all();
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
        $gestor = interesado::find($this->direcId);
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

    public function contac_register($id){
        $this->contac = true;
        $this->contactId = $id;
        $gestor = interesado::find($this->contactId);
        $this->contactRegister = [
            'nombre_contac' => $gestor->contacto->nombre,
            'materno_contac' => $gestor->contacto->ap_materno,
            'paterno_contac' => $gestor->contacto->ap_paterno,
            'correo_contact' => $gestor->contacto->correo,
            'correo_alter_contact' => $gestor->contacto->correo_alternativo,
            'telefono_contact' => $gestor->contacto->telefono,
            'telefono_alter_contact' => $gestor->contacto->telefono_alternativo,
        ];
    }

    public function contac_cancel(){
        $this->contac = false;
        $this->reset('contactRegister');
    }

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $count = interesado::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')->orWhere('correo', 'LIKE', '%' . $this->search . '%');
        })->count();
        $interesados = interesado::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')->orWhere('correo', 'LIKE', '%' . $this->search . '%');
        })->paginate($this->view_dates);
        return view('livewire.administrador.interesados', compact('count', 'interesados'));
    }
}
