<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estatus_muestras extends Model
{
    protected $table = 'status_muestra';
    protected $primaryKey = 'idstatus_muestra';
    protected $fillable = [
        'idstatus_muestra',
        'nombre_status',
        'descripcion',
    ];
    use HasFactory;
}
