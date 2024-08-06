<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogo_tipo_muestra extends Model
{
    protected $table = 'catalogo_tipo_muestra';
    protected $primaryKey = 'id_tipo_muestra';
    protected $fillable = [
        'id_tipo_muestra',
        'nom_tipo_muestra',
        'caracteristicas',
        'cantidad_requerida',
        'subcategoria_id_subcategoria',
        'unidad_medida_id_unidad_medida',
        'unidad_metodo_id_unidad_metodo'
    ];
    
    public function subcategoria(){
        return $this->belongsTo(catalogo_subcategoria::class, 'subcategoria_id_subcategoria' , 'id_subcategoria');
    }

    public function unidad_medidas(){
        return $this->belongsTo(unidad_medida::class, 'unidad_medida_id_unidad_medida' , 'id_unidad_medida');
    }

    public function unidad_metodo(){
        return $this->belongsTo(unidad_metodo::class, 'unidad_medida_id_unidad_medida' , 'id_unidad_medida');
    }

    public function tipo_analisis(){
        return $this->hasMany(catalogo_tipo_analisis::class, 'id_unidad_metodo', 'id_unidad_metodo');
    }

    public function muestras(){
        return $this->hasMany(mustra_orden_servicio::class, 'id_tipo_muestra', 'id_tipo_muestra');
    }

    use HasFactory;
}
