<?php

namespace App\Livewire\Administrador;

use App\Models\cliente;
use App\Models\colonia;
use App\Models\estado;
use App\Models\gestor;
use App\Models\municipio;
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
