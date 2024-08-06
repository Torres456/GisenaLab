<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laboratorios extends Model
{
    protected $table = 'laboratorios';
    protected $primaryKey = 'id_laboratorio';
    protected $fillable = [
        'id_laboratorio',
        'descripcion_laboratorio',
    ];

    public function datos_muestras(){
        return $this->hasMany(datos_muestra_especificos::class, 'id_laboratorio', 'id_laboratorio');
    }
    
    use HasFactory;
}
