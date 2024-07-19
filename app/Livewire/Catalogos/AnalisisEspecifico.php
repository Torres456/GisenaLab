<?php

namespace App\Livewire\Catalogos;

use App\Models\catalogo_analisis_especifico;
use App\Models\catalogo_tipo_analisis;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class AnalisisEspecifico extends Component
{
    //&================================================================= Paginacion
    use WithPagination;

    //&================================================================= Filtros
    public $search = '';
    public $view_dates = 10;

    //&================================================================= Datos de delects
    public $Tipo_Analisis;
    public function mount()
    {
        $this->Tipo_Analisis = catalogo_tipo_analisis::all();
    }

    //&================================================================= Nuevo Registro

    public $new = false;
    public $newRegister = [
        'nombre' => '',
        'descripcion' => '',
        'tipo' => '',
        'clave' => '',
        'reconocimiento' => '',
        'tecnico' => '',
        'normativa' => '',
        'aprobacion' => '',
        'autorizacion' => '',
        'precio_ordinario' => '',
        'precio_urgente' => '',
        'tiempo_ordinario' => '',
        'tiempo_urgente' => '',
        'capacidad' => '',
    ];
    public function new_register()
    {
        $this->new = true;
    }

    public function new_form()
    {
        //validations
        $this->validate([
            'newRegister.nombre' => ['required', 'max:50'],
            'newRegister.descripcion' => ['required', 'max:250'],
            'newRegister.tipo' => ['required'],
            'newRegister.clave' => ['required', 'max:45'],
            'newRegister.reconocimiento' => ['required', 'max:45'],
            'newRegister.tecnico' => ['required', 'max:45'],
            'newRegister.normativa' => ['required', 'max:45'],
            'newRegister.aprobacion' => ['max:45'],
            'newRegister.autorizacion' => ['max:45'],
            'newRegister.precio_ordinario' => ['required', 'numeric'],
            'newRegister.precio_urgente' => ['required', 'numeric'],
            'newRegister.tiempo_ordinario' => ['required', 'numeric'],
            'newRegister.tiempo_urgente' => ['required', 'numeric'],
            'newRegister.capacidad' => ['required'],
        ], [
            'newRegister.nombre.required' => __('El nombre es requerido'),
            'newRegister.nombre.max' => __('El nombre debe tener máximo 50 caracteres'),
            'newRegister.descripcion.required' => __('La descripcion es requerida'),
            'newRegister.descripcion.max' => __('La descripcion debe tener máximo 250 caracteres'),
            'newRegister.tipo.required' => __('El tipo es requerido'),
            'newRegister.clave.required' => __('La clave es requerida'),
            'newRegister.clave.max' => __('La clave debe tener máximo 45 caracteres'),
            'newRegister.reconocimiento.required' => __('El reconocimiento es requerido'),
            'newRegister.reconocimiento.max' => __('El reconocimiento debe tener máximo 45 caracteres'),
            'newRegister.tecnico.required' => __('El descripcion debe tener máx implements'),
            'newRegister.tecnico.max' => __('El nombre tecnico debe tener máximo 45 caracteres'),
            'newRegister.normativa.required' => __('La normativa es requerida'),
            'newRegister.normativa.max' => __('La referencia normativa debe tener máximo 45 caracteres'),
            'newRegister.aprobacion.max' => __('La aprobacion debe tener máximo 45 caracteres'),
            'newRegister.autorizacion.max' => __('La autorización debe tener máximo 45 caracteres'),
            'newRegister.precio_ordinario.required' => __('El precio ordinario es requerido'),
            'newRegister.precio_ordinario.numeric' => __('El precio ordinario debe ser un número'),
            'newRegister.precio_urgente.required' => __('El precio urgente es requerido'),
            'newRegister.precio_urgente.numeric' => __('El precio urgente debe ser un número'),
            'newRegister.tiempo_ordinario.required' => __('El tiempo ordinario es requerido'),
            'newRegister.tiempo_ordinario.numeric' => __('El tiempo ordinario debe ser un número'),
            'newRegister.tiempo_urgente.required' => __('El tiempo urgente es requerido'),
            'newRegister.capacidad.required' => __('La capacidad es requerida'),
        ]);
        //store
        catalogo_analisis_especifico::create([
            'nombre_comercial_analisis_especifico' => $this->newRegister['nombre'],
            'descripcion' => $this->newRegister['descripcion'],
            'id_tipo_analisis' => $this->newRegister['tipo'],
            'clave_analisis' => $this->newRegister['clave'],
            'acreditacion' => $this->newRegister['reconocimiento'],
            'nombre_tecnico' => $this->newRegister['tecnico'],
            'referencia_normativa' => $this->newRegister['normativa'],
            'aprobacion' => $this->newRegister['aprobacion'],
            'autorizacion' => $this->newRegister['autorizacion'],
            'precio_ordinario' => $this->newRegister['precio_ordinario'],
            'precio_urgente' => $this->newRegister['precio_urgente'],
            'tiempo_respuesta_ordinario' => $this->newRegister['tiempo_ordinario'],
            'tiempo_respuesta_urgente' => $this->newRegister['tiempo_urgente'],
            'capacidad_instalada' => $this->newRegister['capacidad'],

        ]);
        $this->new = false;
        $this->reset('newRegister');
    }

    public function new_cancel()
    {
        $this->new = false;
        $this->reset('newRegister');
    }

    //&================================================================= Editar Registro
    public $edit = false;
    public $editId;
    public $editRegister = [
        'nombre' => '',
        'descripcion' => '',
        'tipo' => '',
        'clave' => '',
        'reconocimiento' => '',
        'tecnico' => '',
        'normativa' => '',
        'aprobacion' => '',
        'autorizacion' => '',
        'precio_ordinario' => '',
        'precio_urgente' => '',
        'tiempo_ordinario' => '',
        'tiempo_urgente' => '',
        'capacidad' => '',
    ];
    public function edit_register($id)
    {
        $this->edit = true;
        $this->editId = $id;
        $register = catalogo_analisis_especifico::find($id);
        $this->editRegister = [
            'nombre' => $register->nombre_comercial_analisis_especifico,
            'descripcion' => $register->descripcion,
            'tipo' => $register->id_tipo_analisis,
            'clave' => $register->clave_analisis,
            'reconocimiento' => $register->acreditacion,
            'tecnico' => $register->nombre_tecnico,
            'normativa' => $register->referencia_normativa,
            'aprobacion' => $register->aprobacion,
            'autorizacion' => $register->autorizacion,
            'precio_ordinario' => $register->precio_ordinario,
            'precio_urgente' => $register->precio_urgente,
            'tiempo_ordinario' => $register->tiempo_respuesta_ordinario,
            'tiempo_urgente' => $register->tiempo_respuesta_urgente,
            'capacidad' => $register->capacidad_instalada,
        ];
    }
    public function edit_form()
    {
        //validations
        $this->validate([
            'editRegister.nombre' => ['required', 'max:50'],
            'editRegister.descripcion' => ['required', 'max:250'],
            'editRegister.tipo' => ['required'],
            'editRegister.clave' => ['required', 'max:45'],
            'editRegister.reconocimiento' => ['required', 'max:45'],
            'editRegister.tecnico' => ['required', 'max:45'],
            'editRegister.normativa' => ['required', 'max:45'],
            'editRegister.aprobacion' => ['max:45'],
            'editRegister.autorizacion' => ['max:45'],
            'editRegister.precio_ordinario' => ['required', 'numeric'],
            'editRegister.precio_urgente' => ['required', 'numeric'],
            'editRegister.tiempo_ordinario' => ['required', 'numeric'],
            'editRegister.tiempo_urgente' => ['required', 'numeric'],
            'editRegister.capacidad' => ['required'],
        ], [
            'editRegister.nombre.required' => __('El nombre es requerido'),
            'editRegister.nombre.max' => __('El nombre debe tener máximo 50 caracteres'),
            'editRegister.descripcion.required' => __('La descripcion es requerida'),
            'editRegister.descripcion.max' => __('La descripcion debe tener máximo 250 caracteres'),
            'editRegister.tipo.required' => __('El tipo es requerido'),
            'editRegister.clave.required' => __('La clave es requerida'),
            'editRegister.clave.max' => __('La clave debe tener máximo 45 caracteres'),
            'editRegister.reconocimiento.required' => __('El reconocimiento es requerido'),
            'editRegister.reconocimiento.max' => __('El reconocimiento debe tener máximo 45 caracteres'),
            'editRegister.tecnico.required' => __('El descripcion debe tener máx implements'),
            'editRegister.tecnico.max' => __('El nombre tecnico debe tener máximo 45 caracteres'),
            'editRegister.normativa.required' => __('La normativa es requerida'),
            'editRegister.normativa.max' => __('La referencia normativa debe tener máximo 45 caracteres'),
            'editRegister.aprobacion.max' => __('La aprobacion debe tener máximo 45 caracteres'),
            'editRegister.autorizacion.max' => __('La autorización debe tener máximo 45 caracteres'),
            'editRegister.precio_ordinario.required' => __('El precio ordinario es requerido'),
            'editRegister.precio_ordinario.numeric' => __('El precio ordinario debe ser un número'),
            'editRegister.precio_urgente.required' => __('El precio urgente es requerido'),
            'editRegister.precio_urgente.numeric' => __('El precio urgente debe ser un número'),
            'editRegister.tiempo_ordinario.required' => __('El tiempo ordinario es requerido'),
            'editRegister.tiempo_ordinario.numeric' => __('El tiempo ordinario debe ser un número'),
            'editRegister.tiempo_urgente.required' => __('El tiempo urgente es requerido'),
            'editRegister.capacidad.required' => __('La capacidad es requerida'),
        ]);
        //store
        $categoria = catalogo_analisis_especifico::find($this->editId);
        $categoria->update([
            'nombre_comercial_analisis_especifico' => $this->editRegister['nombre'],
            'descripcion' => $this->editRegister['descripcion'],
            'id_tipo_analisis' => $this->editRegister['tipo'],
            'clave_analisis' => $this->editRegister['clave'],
            'acreditacion' => $this->editRegister['reconocimiento'],
            'nombre_tecnico' => $this->editRegister['tecnico'],
            'referencia_normativa' => $this->editRegister['normativa'],
            'aprobacion' => $this->editRegister['aprobacion'],
            'autorizacion' => $this->editRegister['autorizacion'],
            'precio_ordinario' => $this->editRegister['precio_ordinario'],
            'precio_urgente' => $this->editRegister['precio_urgente'],
            'tiempo_respuesta_ordinario' => $this->editRegister['tiempo_ordinario'],
            'tiempo_respuesta_urgente' => $this->editRegister['tiempo_urgente'],  
            'capacidad_instalada' => $this->editRegister['capacidad'], 
            
        ]);
        $this->edit = false;
        $this->reset('editRegister');
    }
    public function edit_cancel()
    {
        $this->edit = false;
        $this->reset('editRegister');
    }

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================= Render
    public function render()
    {
        $analisis_especificos = catalogo_analisis_especifico::where('nombre_comercial_analisis_especifico', 'LIKE', '%' . $this->search . '%')->paginate($this->view_dates);
        return view('livewire.catalogos.analisis-especifico', compact('analisis_especificos'));
    }
}
