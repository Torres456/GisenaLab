<?php

namespace App\Livewire\Administrador;

use App\Models\cliente;
use App\Models\colonia;
use App\Models\estado;
use App\Models\gestor;
use App\Models\municipio;
use App\Rules\Password;
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

    public $new=false;
    public $newRegister = [
        //datos cliente
        'razon'=>'',
        'rfc'=>'',
        'regimento'=>'',
        'correo'=>'',
        'contrasena'=>'',
        'contrasena_confirmation'=>'',
        'telefono'=>'',
        'correo_alter'=>'',
        'telefono_alter'=>'',
        'gestor'=>'',


        //datos contacto
        'nombre_contacto'=>'',
        'a_paterno'=>'',
        'a_amaterno'=>'', 
        'correo_contact'=>'',
        'correo_contact_alter'=>'',
        'telefono_contact'=>'',
        'telefono_contact_alter'=>'', 
    ];
    
    public function new_register(){
        $this->new = true;
    }

    public function new_form(){
        $this->validate([
            'newRegister.razon' => ['required','string','max:255'],
            'newRegister.rfc' => ['required','string','max:13','unique:cliente,correo','unique:gestor,correo', 'unique:usuario_sistema,correo'],
            'newRegister.regimento' => ['required','string','max:255'],
            'newRegister.correo' => ['required','email','max:255','unique:usuario_sistema'],
            'newRegister.contrasena' => ['required','string','min:8','confirmed',Password::default()],
            'newRegister.telefono' => ['required','string','max:15'],
            'newRegister.correo_alter' => ['nullable','email','max:255'],
            'newRegister.telefono_alter' => ['nullable','string','max:15'],
            'newRegister.gestor' => ['required','integer'],

            'newRegister.nombre_contacto' => ['required','string','max:255'],
            'newRegister.a_paterno' => ['required','string','max:255'],
            'newRegister.a_materno' => ['required','string','max:255'],
            'newRegister.correo' => ['required','email','max:255'],
            'newRegister.correo_alter' => ['nullable','email','max:255'],
            'newRegister.telefono' => ['required','numeric'],
            'newRegister.telefono_alter' => ['nullable','numeric'],
        ],[
            'newRegister.razon.required' => 'La razón social es requerida ',
            'newRegister.razon.string' => 'La razón social debe ser una cadena',
            'newRegister.razon.max' => 'La razón social es muy larga',

            'newRegister.rfc.required' => 'El RFC es requerido',
            'newRegister.rfc.string' => 'El RFC debe ser una cadena',
            'newRegister.rfc.max' => 'El RFC es muy largo',
            'newRegister.rfc.unique' => 'El RFC ya está registrado',

            'newRegister.regimento.required' => 'El regimento es requerido',
            'newRegister.regimento.string' => 'El regimento debe ser una cadena',
            'newRegister.regimento.max' => 'El regimento es muy largo',

            'newRegister.correo.required' => 'El correo electrónico es requerido',
            'newRegister.correo.email' => 'El correo electrónico no es válido',
            'newRegister.correo.max' => 'El correo electrónico es muy largo',
            'newRegister.correo.unique' => 'El correo electrónico ya está registrado',

            'newRegister.contrasena.required' => 'La contraseña es requerida',
            'newRegister.contrasena.min' => 'La contraseña debe tener al menos 8 caracteres',
            'newRegister.contrasena.confirmed' => 'Las contraseñas no coinciden',
            'newRegister.contrasena_confirmation.required' => 'Confirmar contraseña es requerida',
            
            'newRegister.telefono.required' => 'El teléfono es requerido',
            'newRegister.telefono.string' => 'El teléfono debe ser una cadena',
            'newRegister.telefono.max' => 'El teléfono es muy largo',

            'newRegister.correo_alter.email' => 'El correo electrónico alternativo no es válido',
            'newRegister.telefono_alter.string' => 'El teléfono alternativo debe ser una cadena',
            'newRegister.telefono_alter.max' => 'El teléfono alternativo es muy largo',

            'newRegister.gestor.required' => 'El gestor es requerido',
            'newRegister.gestor.integer' => 'El gestor debe ser un número entero',

            'newRegister.nombre_contacto.required' => 'El nombre del contacto es requerido',
            'newRegister.nombre_contacto.string' => 'El nombre del contacto debe ser una cadena',
            'newRegister.nombre_contacto.max' => 'El nombre del contacto es muy largo',

            'newRegister.a_paterno.required' => 'El apellido paterno es requerido',
            'newRegister.a_paterno.string' => 'El apellido paterno debe ser una cadena',
            'newRegister.a_paterno.max' => 'El apellido paterno es muy largo',

            'newRegister.a_materno.required' => 'El apellido materno es requerido',
            'newRegister.a_materno.string' => 'El apellido materno debe ser una cadena',
            'newRegister.a_materno.max' => 'El apellido materno es muy largo',

            'newRegister.correo_contact.required' => 'El correo electrónico del contacto es requerido',
            'newRegister.correo_contact.email' => 'El correo electrónico del contacto no es válido',
            'newRegister.correo_contact.max' => 'El correo electrónico del contacto es muy largo',

            'newRegister.telefono_contact.required' => 'El telefono es requerido',
            'newRegister.telefono_contact.string' => 'El teléfono del contacto debe ser una cadena',
            'newRegister.telefono_contact.max' => 'El teléfono del contacto es muy largo',

            'newRegister.correo_contact_alter.email' => 'El correo electrónico alternativo del contacto no es válido',
            'newRegister.correo_contact_alter.require' => 'El corre alternativo es requerido',
            'newRegister.correo_contact_alter.max' => 'El correo electrónico alternativo del contacto es muy largo',

            'newRegister.telefono_contact_alter.string' => 'El teléfono alternativo del contacto debe ser una cadena',
            'newRegister.telefono_contact_alter.max' => 'El teléfono alternativo del contacto es muy largo',

        ]);
        
        $this->reset('newRegister');
        $this->new = false;
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
        $cliente = cliente::find($this->contactId);
        if($cliente->id_contacto){
            $this->contactRegister = [
                'nombre_contac' => $cliente->contacto->nombre,
                'materno_contac' => $cliente->contacto->ap_materno,
                'paterno_contac' => $cliente->contacto->ap_paterno,
                'correo_contact' => $cliente->contacto->correo,
                'correo_alter_contact' => $cliente->contacto->correo_alternativo,
                'telefono_contact' => $cliente->contacto->telefono,
                'telefono_alter_contact' => $cliente->contacto->telefono_alternativo,
            ];
        }else{
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
    public $gestor=false;
    public $gestorId;
    public $gestorRegister=[
        'gestor'=>'',
    ];

    public function gestor_register($id){
        $this->gestor=true;
        $this->gestorId = $id;
        $gestorEdit=cliente::find($this->gestorId);
        $this->gestorRegister=[
            'gestor'=>$gestorEdit->id_gestor,
        ];
    }

    public function edit_Gestor(){

        $this->validate([
            'gestorRegister.gestor' => 'required',
        ],[
            'gestorRegister.gestor.required' => 'Seleccione un gestor',
        ]);
        $clientes = cliente::updateOrCreate([
            'id_cliente' => $this->gestorId,
        ], [
            'id_gestor' => $this->gestorRegister['gestor'],
        ]);

        $this->gestor=false;
        $this->reset('gestorRegister');
    }

    public function gestor_cancel(){
        $this->gestor=false;
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
        $count = cliente::where(function ($query) {
            $query->where('razon_social', 'LIKE', '%' . $this->search . '%')->orWhere('correo', 'LIKE', '%' . $this->search . '%')->orWhere('telefono', 'LIKE', '%' . $this->search . '%');
        })->count();
        $clientes = cliente::where(function ($query) {
            $query->where('razon_social', 'LIKE', '%' . $this->search . '%')->orWhere('correo', 'LIKE', '%' . $this->search . '%')->orWhere('telefono', 'LIKE', '%' . $this->search . '%');
        })->paginate($this->view_dates);
        return view('livewire.administrador.clientes', compact('count', 'clientes'));
    }
}
