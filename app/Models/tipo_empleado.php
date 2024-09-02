<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_empleado extends Model
{
    protected $table = 'tipo_empleado';
    protected $primaryKey = 'id_tipo_empleado';
    protected $fillable = [
        'id_tipo_empleado',
        'descripcion',
    ];


    // Relaciones
    public function empleados()
    {
        return $this->hasMany(empleado::class, 'id_tipo_empleado', 'id_tipo_empleado');
    }

    use HasFactory;
}
