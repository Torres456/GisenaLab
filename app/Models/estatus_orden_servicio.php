<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estatus_orden_servicio extends Model
{
    protected $table = 'status_orden_servicio';
    protected $primaryKey = 'id_status_orden_servicio';
    protected $fillable = [
        'id_status_orden_servicio',
        'nombre',
        'descripcion',
    ];
    use HasFactory;
}
