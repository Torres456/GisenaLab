<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class descripcion_muestra extends Model
{
    protected $table = 'descrip_muestra';
    protected $primaryKey = 'id_descrip_muestra';
    protected $fillable = [
        'id_descrip_muestra',
        'nombre_descrip',
        'id_tipo_muestra',
        'estatus',
    ];

    public function tipo_muestra()
    {
        return $this->belongsTo(catalogo_tipo_muestra::class, 'id_tipo_muestra', 'id_tipo_muestra');
    }

    //muestra orden servicio
    public function muestra_orden_servicio(){
        return $this->hasMany(muestra_orden_servicio::class, 'id_descripcion_muestra', 'id_descripcion_muestra');
    }
    
    use HasFactory;
}
