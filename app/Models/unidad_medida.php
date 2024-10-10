<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unidad_medida extends Model
{
    
    protected $table = 'unidad_medida';
    protected $primaryKey = 'id_unidad_medida';
    protected $fillable = ['id_unidad_medida','nombre_unidad','abreviatura'];
    
    public function tipo_muestra(){
        return $this->hasMany(catalogo_tipo_muestra::class, 'id_unidad_medida','id_unidad_medida');
    }

    public function muestra_orden_servicio(){
        return $this->hasMany(muestra_orden_servicio::class, 'id_unidad_medida', 'id_unidad_medida');
    }

    use HasFactory;
}
