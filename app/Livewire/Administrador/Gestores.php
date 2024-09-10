<?php

namespace App\Livewire\Administrador;

use App\Livewire\Forms\GestoresCreateForm;
use App\Livewire\Forms\GestoresEditForm;
use App\Models\colonia;
use App\Models\direccion;
use App\Models\estado;
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
    
    public GestoresCreateForm $newRegister;

    public function new_register()
    {
        $this->resetValidation();
        $this->newRegister->create();
    }

    public function new_form()
    {
        $this->newRegister->save();
    }

    public function new_cancel()
    {
        $this->newRegister->cancel();
    }


    //&=================================================================Editar Registro
    
    public GestoresEditForm $editRegister;
    public function edit_register($id)
    {
        $this->resetValidation();
        $this->editRegister->edit($id);
    }
    public function edit_form()
    {
        $this->editRegister->update();
    }
    public function edit_cancel()
    {
        $this->editRegister->cancel();
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

     //&================================================================= Estatus

     public $estatus = false;
     public $viewstatus;
     public $statusId;
     public function estatus_register($id)
     {
         $this->estatus = true;
         $interesado = gestor::find($id);
         $this->statusId = $interesado->id_usuario_sistema;
         $statusregister = User::find($interesado->id_usuario_sistema);
         $this->viewstatus = $statusregister->estatus;
     }
 
     public function status_update()
     {
         $date = User::find($this->statusId);
         $date->estatus = ($this->viewstatus == 1) ? 0 : 1;
         $date->save();
         $this->estatus = false;
         $this->reset('viewstatus');
         session()->flash('blue', 'Estatus actualizado correctamente');
     }
 
     public function status_cancel()
     {
         $this->estatus = false;
         $this->reset('viewstatus');
     }

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $count = gestor::where(DB::raw('concat(nombre, " ", ap_paterno, " ", ap_materno)'), 'like', "%$this->search%")
        ->orWhere('correo', 'like', "%$this->search%")->count();

        $gestores = gestor::where(DB::raw('concat(nombre, " ", ap_paterno, " ", ap_materno)'), 'like', "%$this->search%")
        ->orWhere('correo', 'like', "%$this->search%")->paginate($this->view_dates);
        return view('livewire.administrador.gestores', compact('gestores', 'count'));
    }
}
