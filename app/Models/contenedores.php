<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contenedores extends Model
{
    protected $table = 'contenedores';
    protected $primaryKey = 'id_contenedor';
    protected $fillable = [
        'id_contenedor',
        'tipo_contenedor',
    ];
    
    use HasFactory;
}
