<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rutas extends Model
{

    protected $table = 'rutas';
    protected $fillable = [
        'id',
        'title',
        'content',
        'route',
        'estado'
    ];

    use HasFactory;
}
