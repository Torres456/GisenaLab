<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recipientes extends Model
{
    protected $table ='recipientes';
    protected $primaryKey = 'id_recipiente';
    protected $fillable = [
        'id_recipiente',
        'tipo_recipiente',
    ];
    use HasFactory;
}
