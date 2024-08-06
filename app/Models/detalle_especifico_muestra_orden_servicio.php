<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_especifico_muestra_orden_servicio extends Model
{
    protected $table = 'detalle_especifico_muestra';
    protected $primaryKey = 'id_detalle_especifico_muestra_orden_servicios';
    protected $fillable = [
        'id_detalle_especifico_muestra_orden_servicios',
        'id_muestra_orden_servicio',
        'id_datos_muestra_especifico',
    ];

    public function muestra_orden_servicio(){
        return $this->belongsTo(muestra_orden_servicio::class, 'id_muestra_orden_servicio','id_muestra_orden_servicio');
    }

    public function datos_muestra_especifico(){
        return $this->belongsTo(datos_muestra_especificos::class, 'id_datos_muestra_especifico','id_datos_muestra_especifico');
    }
    use HasFactory;
}
