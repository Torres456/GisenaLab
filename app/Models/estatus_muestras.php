<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estatus_muestras extends Model
{
    protected $table = 'status_muestra';
    protected $primaryKey = 'id_status_muestra';
    protected $fillable = [
        'id_status_muestra',
        'nombre_status',
        'descripcion',
    ];
    use HasFactory;
}
