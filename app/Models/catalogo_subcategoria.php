<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogo_subcategoria extends Model
{
    protected $table = 'catalogo_subcategoria';
    protected $fillable = [
        'id_subcategoria',
        'nom_subcategoria',
        'id_categoria'
    ];
    protected $primaryKey = 'id_subcategoria';

    public function categoria(){
        return $this->belongsTo(catalogo_categoria::class, 'id_categoria', 'id_categoria');
    }
    public function tipo_muestras(){
        return $this->hasMany(catalogo_tipo_muestra::class, 'id_subcategoria', 'subcategoria_id_subcategoria');
    }

    public function muestras(){
        return $this->hasMany(muestra_orden_servicio::class, 'id_categoria', 'id_categoria');
    }



    use HasFactory;
}
