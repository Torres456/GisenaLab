<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datos_muestra_especificos extends Model
{
    protected $table = 'datos_muestra_especificos';
    protected $primaryKey = 'id_datos_muestra_especificos';
    protected $fillable = [
        'id_datos_muestra_especificos',
        'descripcion_dato',
        'id_laboratorio',
    ];

    public function laboratorios(){
        return $this->belongsTo(laboratorios::class, 'id_laboratorio','id_laboratorio');
    }

    public function muestra_especifico(){
        return $this->belongsToMany(muestra_orden_servicio::class);
    }


    use HasFactory;
}
