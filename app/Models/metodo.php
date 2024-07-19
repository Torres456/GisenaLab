<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodo extends Model
{
    protected $table ='metodo';
    protected $primaryKey = 'id_metodo';
    protected $fillable = ['id_metodo','descripcion'];

    public function tipo_analisis(){
        return $this->hasMany(catalogo_tipo_analisis::class, 'id_unidad_metodo', 'id_unidad_metodo');
    }
    use HasFactory;
}
