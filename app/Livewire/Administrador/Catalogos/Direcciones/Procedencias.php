<?php

namespace App\Livewire\Administrador\Catalogos\Direcciones;

use App\Models\colonia;
use App\Models\estado;
use App\Models\municipio;
use App\Models\procedencias as ModelsProcedencias;
use Livewire\Component;
use Livewire\WithPagination;

class Procedencias extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $search;
    public $view_dates = 10;
    public $search_stade;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //&================================================================= Datos
    public $estados, $municipios, $colonias;
    public function mount()
    {
        $this->estados = estado::all();
        $this->municipios = municipio::all();
        $this->colonias = colonia::all();
    }

    //&================================================================= Nuevo Registro
    public $new = false;
    public $newRegister = [
        'sitio' => '',
        'nombre' => '',
        'estado' => '',
        'municipio' => '',
        'colonia' => '',
        'calle' => '',
        'exterior' => '',
        'interior' => '',
        'cp' => '',
        'gps' => '',
        'sader' => '',
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.sitio' => 'required|max:250',
            'newRegister.nombre' => 'required|max:250',
            'newRegister.estado' => 'required',
            'newRegister.municipio' => 'required',
            'newRegister.colonia' => 'required',
            'newRegister.calle' => 'required|max:250',
            'newRegister.exterior' => 'numeric',
            'newRegister.interior' => 'numeric',
            'newRegister.cp' => 'required|numeric',
            'newRegister.gps' => 'required|max:250',
            'newRegister.sader' => 'required|max:20',
        ], [
            'newRegister.sitio.required' => __('El sitio de procedencia es requerido'),
            'newRegister.sitio.max' => __('El sitio de procedencia debe tener máximo 250 caracteres'),
            'newRegister.sitio.unique' => __('Este sitio de procedencia ya está registrado'),
            'newRegister.nombre.required' => __('El nombre de la sucursal es requerido'),
            'newRegister.nombre.max' => __('El nombre de la sucursal debe tener máximo 250 caracteres'),
            'newRegister.estado.required' => __('El estado es requerido'),
            'newRegister.municipio.required' => __('El municipio es requerido'),
            'newRegister.colonia.required' => __('La colonia es requerida'),
            'newRegister.calle.required' => __('La calle es requerida'),
            'newRegister.calle.max' => __('La calle debe tener máximo 250 caracteres'),
            'newRegister.exterior.numeric' => __('Este número exterior es invalido'),
            'newRegister.interior.numeric' => __('Este número interior es invalido'),
            'newRegister.cp.required' => __('El código postal es requerido'),
            'newRegister.cp.numeric' => __('Este código postal es invalido'),
            'newRegister.gps.required' => __('La ubicación GPS es requerida'),
            'newRegister.gps.max' => __('La ubicación GPS debe tener máximo 250 caracteres'),
            'newRegister.sader.required' => __('El número de SADER es requerido'),
            'newRegister.sader.max' => __('El número de SADER debe tener máximo 20 caracteres'),
        ]);
        //store
        ModelsProcedencias::create([
            'sitio_muestreo' => $this->newRegister['sitio'],
            'nombre_sitio_muestreo' => $this->newRegister['nombre'],
            'id_estado' => $this->newRegister['estado'],
            'id_municipio' => $this->newRegister['municipio'],
            'id_colonia' => $this->newRegister['colonia'],
            'calle' => $this->newRegister['calle'],
            'no_exterior' => $this->newRegister['exterior'],
            'no_interior' => $this->newRegister['interior'],
            'cp' => $this->newRegister['cp'],
            'gps' => $this->newRegister['gps'],
            'registro_sader' => $this->newRegister['sader'],
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
        'sitio' => '',
        'nombre' => '',
        'estado' => '',
        'municipio' => '',
        'colonia' => '',
        'calle' => '',
        'exterior' => '',
        'interior' => '',
        'cp' => '',
        'gps' => '',
        'sader' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = ModelsProcedencias::find($id);
        $this->editRegister = [
            'sitio' => $register->sitio_muestreo,
            'nombre' => $register->nombre_sitio_muestreo,
            'estado' => $register->id_estado,
            'municipio' => $register->id_municipio,
            'colonia' => $register->id_colonia,
            'calle' => $register->calle,
            'exterior' => $register->no_exterior,
            'interior' => $register->no_interior,
            'cp' => $register->cp,
            'gps' => $register->gps,
            'sader' => $register->registro_sader,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.sitio' => 'required|max:250',
            'editRegister.nombre' => 'required|max:250',
            'editRegister.estado' => 'required',
            'editRegister.municipio' => 'required',
            'editRegister.colonia' => 'required',
            'editRegister.calle' => 'required|max:250',
            'editRegister.exterior' => 'numeric',
            'editRegister.interior' => 'numeric',
            'editRegister.cp' => 'required|numeric',
            'editRegister.gps' => 'required|max:250',
            'editRegister.sader' => 'required|max:20',
        ], [
            'editRegister.sitio.required' => __('El sitio de procedencia es requerido'),
            'editRegister.sitio.max' => __('El sitio de procedencia debe tener máximo 250 caracteres'),
            'editRegister.sitio.unique' => __('Este sitio de procedencia ya está registrado'),
            'editRegister.nombre.required' => __('El nombre de la sucursal es requerido'),
            'editRegister.nombre.max' => __('El nombre de la sucursal debe tener máximo 250 caracteres'),
            'editRegister.estado.required' => __('El estado es requerido'),
            'editRegister.municipio.required' => __('El municipio es requerido'),
            'editRegister.colonia.required' => __('La colonia es requerida'),
            'editRegister.calle.required' => __('La calle es requerida'),
            'editRegister.calle.max' => __('La calle debe tener máximo 250 caracteres'),
            'editRegister.exterior.numeric' => __('Este número exterior es invalido'),
            'editRegister.interior.numeric' => __('Este número interior es invalido'),
            'editRegister.cp.required' => __('El código postal es requerido'),
            'editRegister.cp.numeric' => __('Este código postal es invalido'),
            'editRegister.gps.required' => __('La ubicación GPS es requerida'),
            'editRegister.gps.max' => __('La ubicación GPS debe tener máximo 250 caracteres'),
            'editRegister.sader.required' => __('El número de SADER es requerido'),
            'editRegister.sader.max' => __('El número de SADER debe tener máximo 20 caracteres'),
        ]);
        //store
        $categoria = ModelsProcedencias::find($this->editId);
        $categoria->update([
            'sitio_muestreo' => $this->editRegister['sitio'],
            'nombre_sitio_muestreo' => $this->editRegister['nombre'],
            'id_estado' => $this->editRegister['estado'],
            'id_municipio' => $this->editRegister['municipio'],
            'id_colonia' => $this->editRegister['colonia'],
            'calle' => $this->editRegister['calle'],
            'no_exterior' => $this->editRegister['exterior'],
            'no_interior' => $this->editRegister['interior'],
            'cp' => $this->editRegister['cp'],
            'gps' => $this->editRegister['gps'],
            'registro_sader' => $this->editRegister['sader'],
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

    //&================================================================= Direccion

    public $direct = false;
    public $direcId;

    public $direcRegister = [
        'sitio' => '',
        'nombre' => '',
        'estado' => '',
        'municipio' => '',
        'colonia' => '',
        'calle' => '',
        'exterior' => '',
        'interior' => '',
        'cp' => '',
        'gps' => '',
        'sader' => '',
    ];

    public $nombre_sucursal = '';
    public function direc_register($id)
    {
        $this->direct = true;
        $this->direcId = $id;
        $direccion = ModelsProcedencias::find($this->direcId);
        $this->direcRegister = [
            'sitio' => $direccion->sitio_muestreo,
            'nombre' => $direccion->nombre_sitio_muestreo,
            'estado' => $direccion->estado->nombre,
            'municipio' => $direccion->municipio->nombre,
            'colonia' => $direccion->colonia->nombre,
            'calle' => $direccion->calle,
            'exterior' => $direccion->no_exterior,
            'interior' => $direccion->no_interior,
            'cp' => $direccion->cp,
            'gps' => $direccion->gps,
            'sader' => $direccion->registro_sader,
        ];
        $this->nombre_sucursal = $direccion->nombre;
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
        $count = ModelsProcedencias::where(function ($query) {
            $query->where('sitio_muestreo', 'LIKE', '%' . $this->search . '%')->orWhere('nombre_sitio_muestreo', 'LIKE', '%' . $this->search . '%');
        })->count();
        $procedencias = ModelsProcedencias::where(function ($query) {
            $query->where('sitio_muestreo', 'LIKE', '%' . $this->search . '%')->orWhere('nombre_sitio_muestreo', 'LIKE', '%' . $this->search . '%');
        })->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.direcciones.procedencias', compact('count','procedencias'));
    }
}
