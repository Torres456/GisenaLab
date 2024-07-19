<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contenedores extends Model
{
    protected $table = 'contenedores';
    protected $primaryKey = 'idcontenedor';
    protected $fillable = [
        'idcontenedor',
        'tipo_contenedor',
    ];
    
    use HasFactory;
}
