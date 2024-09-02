<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogo_analisis_especifico extends Model
{
    protected $table = 'catalogo_analisis_especifico';
    protected $primaryKey = 'id_analisis_especifico';
    protected $fillable = [
        'id_analisis_especifico',
        'nombre_comercial',
        'descripcion',
        'id_tipo_analisis',
        'clave_analisis',
        'acreditacion',
        'nombre_tecnico',
        'referencia_normativa',
        'aprobacion',
        'autorizacion',
        'precio_ordinario',
        'precio_urgente',
        'tiempo_respuesta_ordinario',
        'tiempo_respuesta_urgente',
        'capacidad_instalada',
    ];

    public function tipo_analisis(){
        return $this->belongsTo(catalogo_tipo_analisis::class, 'id_tipo_analisis','id_tipo_analisis');
    }

    public function muestras(){
        return $this->hasMany(muestra_orden_servicio::class, 'id_categoria', 'id_categoria');
    }


    use HasFactory;
}
