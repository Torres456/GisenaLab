<?php

namespace App\Livewire\Administrador\Catalogos\Direcciones;

use App\Models\colonia;
use App\Models\estado;
use App\Models\municipio;
use App\Models\sucursales_gisena;
use App\Rules\Les;
use Livewire\Component;
use Livewire\WithPagination;

class Sucursales extends Component
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

    

    //&================================================================= Nuevo Registro
    public $new = false;
    public $newRegister = [
        'nombre' => '',
        'numero' => '',
        'estado' => '',
        'municipio' => '',
        'colonia' => '',
        'calle' => '',
        'exterior' => '',
        'interior' => '',
        'cp' => '',
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.nombre' => ['required','max:100','unique:municipio,nombre', new Les],
            'newRegister.numero' => 'required|numeric',
            'newRegister.estado' => 'required',
            'newRegister.municipio' => 'required',
            'newRegister.colonia' => 'required',
            'newRegister.calle' => 'required|max:250',
            'newRegister.exterior' => 'numeric',
            'newRegister.interior' => 'numeric',
            'newRegister.cp' => 'required|numeric',
        ], [
            'newRegister.nombre.required' => __('El nombre de es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'newRegister.nombre.unique' => __('Esta sucursal ya está registrada'),
            'newRegister.numero.required' => __('El número de sucursal es requerido'),
            'newRegister.numero.numeric' => __('El número de sucursales solo debe llevar números'),
            'newRegister.numero.unique' => __('Este número de sucursal ya está registrado'),
            'newRegister.estado.required' => __('El estado es requerido'),
            'newRegister.municipio.required' => __('El municipio es requerido'),
            'newRegister.colonia.required' => __('La colonia es requerida'),
            'newRegister.calle.required' => __('La calle es requerida'),
            'newRegister.calle.max' => __('La calle debe tener máximo 250 caracteres'),
            'newRegister.exterior.numeric' => __('Este número exterior es invalido'),
            'newRegister.interior.numeric' => __('Este número interior es invalido'),
            'newRegister.cp.required' => __('El código postal es requerido'),
            'newRegister.cp.numeric' => __('Este código postal es invalido'),
        ]);
        //store
        sucursales_gisena::create([
            'nombre' => $this->newRegister['nombre'],
            'numero_sucursal' => $this->newRegister['numero'],
            'id_estado' => $this->newRegister['estado'],
            'id_municipio' => $this->newRegister['municipio'],
            'id_colonia' => $this->newRegister['colonia'],
            'calle' => $this->newRegister['calle'],
            'no_exterior' => $this->newRegister['exterior'],
            'no_interior' => $this->newRegister['interior'],
            'cp' => $this->newRegister['cp'],
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
        'numero' => '',
        'estado' => '',
        'municipio' => '',
        'colonia' => '',
        'calle' => '',
        'exterior' => '',
        'interior' => '',
        'cp' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = sucursales_gisena::find($id);
        $this->editRegister = [
            'nombre' => $register->nombre,
            'numero' => $register->numero_sucursal,
            'estado' => $register->id_estado,
            'municipio' => $register->id_municipio,
            'colonia' => $register->id_colonia,
            'calle' => $register->calle,
            'exterior' => $register->no_exterior,
            'interior' => $register->no_interior,
            'cp' => $register->cp,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => 'required|max:100|unique:sucursales_gisena,nombre,' . $this->editId . ',id_sucursal_gisena',
            'editRegister.numero' => 'required|numeric',
            'editRegister.estado' => 'required',
            'editRegister.municipio' => 'required',
            'editRegister.colonia' => 'required',
            'editRegister.calle' => 'required|max:250',
            'editRegister.exterior' => 'numeric',
            'editRegister.interior' => 'numeric',
            'editRegister.cp' => 'required|numeric',
        ], [
            'editRegister.nombre.required' => __('El nombre de es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 100 caracteres'),
            'editRegister.nombre.unique' => __('Esta sucursal ya está registrada'),
            'editRegister.numero.required' => __('El número es requerido'),
            'editRegister.numero.numeric' => __('Este número es invalido'),
            'editRegister.numero.unique' => __('Este numero de sucursal ya está registrado'),
            'editRegister.estado.required' => __('El estado es requerido'),
            'editRegister.municipio.required' => __('El municipio es requerido'),
            'editRegister.colonia.required' => __('La colonia es requerida'),
            'editRegister.calle.required' => __('La calle es requerida'),
            'editRegister.calle.max' => __('La calle debe tener máximo 250 caracteres'),
            'editRegister.exterior.numeric' => __('Este número exterior es invalido'),
            'editRegister.interior.numeric' => __('Este número interior es invalido'),
            'editRegister.cp.required' => __('El código postal es requerido'),
            'editRegister.cp.numeric' => __('Este código postal es invalido'),
        ]);
        //store
        $categoria = sucursales_gisena::find($this->editId);
        $categoria->update([
            'nombre' => $this->editRegister['nombre'],
            'numero_sucursal' => $this->editRegister['numero'],
            'id_estado' => $this->editRegister['estado'],
            'id_municipio' => $this->editRegister['municipio'],
            'id_colonia' => $this->editRegister['colonia'],
            'calle' => $this->editRegister['calle'],
            'no_exterior' => $this->editRegister['exterior'],
            'no_interior' => $this->editRegister['interior'],
            'cp' => $this->editRegister['cp'],
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

    public $direcRegister=[
        'calle' => '',
        'numero' => '',
        'colonia' => '',
        'municipio' => '',
        'estado' => '',
        'calle' => '',
        'exterior' => '',
        'interior' => '',
        'cp' => ''
    ];

    public $nombre_sucursal='';
    public function direc_register($id)
    {
        $this->direct = true;
        $this->direcId = $id;
        $direccion = sucursales_gisena::find($this->direcId);
        $this->direcRegister = [
            'calle' => $direccion->calle,
            'numero' => $direccion->no_exterior,
            'colonia' => $direccion->colonia->nombre,
            'municipio' => $direccion->municipio->nombre,
            'estado' => $direccion->estado->nombre,
            'calle' => $direccion->calle,
            'exterior' => $direccion->no_exterior,
            'interior' => $direccion->no_interior,
            'cp' => $direccion->cp,
        ];
        $this->nombre_sucursal = $direccion->nombre;
    }

    public function direct_cancel(){
        $this->direct = false;
        $this->reset('direcRegister');
    }

    //&================================================================= Datos

    public $estados = [];
    public $municipios = [];
    public $colonias = [];


    public function mount()
    {
        $this->estados = estado::all();
    }

    public function updated($property, $value)
    {
        
        if ($property == 'newRegister.estado') {
            $this->newRegister['municipio'] = [];
            $this->newRegister['coloni'] = [];
            $estado= estado::find($value);
            $this->municipios = municipio::where('id_estado', $estado['clave_estado'])->orderBy('nombre', 'asc')->get();
        } elseif ($property == 'newRegister.municipio') {
            $this->colonias = [];
            $municipio= municipio::find($value);
            $this->colonias = colonia::where('id_municipio', $municipio['clave_municipio'])->orderBy('nombre', 'asc')->get();
            
        }

        if ($property == 'editRegister.estado') {
            $this->editRegister['municipio'] = [];
            $this->editRegister['coloni'] = [];
            $estado= estado::find($value);
            $this->municipios = municipio::where('id_estado', $estado['clave_estado'])->orderBy('nombre', 'asc')->get();
        } elseif ($property == 'editRegister.municipio') {
            $this->colonias = [];
            $municipio= municipio::find($value);
            $this->colonias = colonia::where('id_municipio', $municipio['clave_municipio'])->orderBy('nombre', 'asc')->get();
        }

    }


    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $count = sucursales_gisena::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')->orWhere('numero_sucursal', 'LIKE', '%' . $this->search . '%');
        })->count();
        $sucursales = sucursales_gisena::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')->orWhere('numero_sucursal', 'LIKE', '%' . $this->search . '%');
        })->paginate($this->view_dates);
        return view('livewire.administrador.catalogos.direcciones.sucursales', compact('count','sucursales'));
    }
}
