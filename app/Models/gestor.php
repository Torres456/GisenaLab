<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class gestor extends Model
{
    use HasFactory;

    protected $table = 'gestor';
    protected $primaryKey = 'id_gestor';

    protected $fillable = [
        'nombre',
        'ap_paterno',
        'ap_materno',
        'telefono',
        'correo',
        'sexo',
        'id_direccion',
        'idusuario_sistema',
        'idzona_representacion'
    ];


    public function direccion(): HasOne
    {
        return $this->hasOne(direccion::class,'id_direccion');
    }

    public function sistema(): HasOne
    {
        return $this->hasOne(User::class,'idusuario_sistema');
    }

    public function zona(): HasOne
    {
        return $this->hasOne(zona_representacion::class,'idzona_representacion');
    }

  
    public function comments(): HasMany
    {
        return $this->hasMany(cliente::class);
    }
}
