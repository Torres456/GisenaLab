<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogo_tipo_analisis extends Model
{
    protected $table = 'catalogo_tipo_analisis';
    protected $primaryKey = 'id_tipo_analisis';
    protected $fillable = [
        'id_tipo_analisis',
        'nomb_tipo_analisis',
        'clave',
        'id_tipo_muestra'
    ];

    public function tipo_muestra(){
        return $this->belongsTo(catalogo_tipo_muestra::class, 'id_tipo_muestra','id_tipo_muestra');
    }

    public function analisis_especifico(){
        return $this->hasMany(catalogo_analisis_especifico::class, 'id_tipo_analisis','id_tipo_analisis');
    }
    use HasFactory;
}
