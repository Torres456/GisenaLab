<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogo_categoria extends Model
{
    protected $table = 'catalogo_categoria';
    protected $fillable = [
        'id_categoria',
        'nombre_categoria',
        'descripcion'
    ];
    protected $primaryKey = 'id_categoria';

    public function subcategorias(){
        return $this->hasMany(Catalogo_subcategoria::class, 'id_categoria', 'id_categoria');
    }

    public function muestras(){
        return $this->hasMany(mustra_orden_servicio::class, 'id_categoria', 'id_categoria');
    }


    use HasFactory;
}
