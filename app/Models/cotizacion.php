<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cotizacion extends Model
{
    protected $table = 'cotizacion';
    protected $primaryKey = 'id_cotizacion';
    protected $fillable = [
        'id_cotizacion',
        'descripcion',
    ];

    //relacion con orden servicio uno a uno
    public function orden_servicio(){
        return $this->hasOne(orden_servicio::class, 'id_cotizacion', 'id_cotizacion');
    }


    use HasFactory;
}
