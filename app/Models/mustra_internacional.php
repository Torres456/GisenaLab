<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mustra_internacional extends Model
{
    protected $table = 'muestra_internacional';
    protected $primaryKey = 'idmuestra_internacional';
    protected $fillable = [
        'idmuestra_internacional',
        'fecha_recepcion',
        'sucursal',
        'prioridad',
        'oficina_inspeccion',
        'numero_pedimiento',
        'numero_remision',
        'numero_sinalab',
        'nombre_importador',
        'requisitos',
        'origen_procedencia',
        'ci',
        'fraccion',
        'otros_datos',
        'id_direccion',
    ];

    public function direccion(){
        return $this->belongsTo(direccion::class, 'id_direccion');
    }

    public function muestras(){
        return $this->hasMany(mustra_orden_servicio::class, 'idmuestra_internacional', 'idmuestra_internacional');
    }
    
    use HasFactory;
}
