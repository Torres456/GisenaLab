<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class representacion extends Model
{
    protected $table ='zona_representacion';
    protected $primaryKey = 'idzona_representacion';
    protected $fillable = [
        'idzona_representacion',
        'nombre_zona',
    ];

    use HasFactory;
}
