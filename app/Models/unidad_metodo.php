<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unidad_metodo extends Model
{
    protected $table = 'unidad_metodo';
    protected $primaryKey = 'id_unidad_metodo';
    protected $fillable = [
        'id_unidad_metodo',
        'descripcion',
    ];

    //relacion con catalogo_tipo_analsiis
    public function tipo_muestra(){
        return $this->hasMany(catalogo_tipo_muestra::class, 'id_unidad_metodo', 'id_unidad_metodo');
    }
    use HasFactory;
}
