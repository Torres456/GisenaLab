<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function sistema(): belongsTo
    {
        return $this->belongsTo(User::class,'idusuario_sistema');
    }

    public function zona(): BelongsTo
    {
        return $this->BelongsTo(zona_representacion::class,'idzona_representacion');
    }

    //un gestor puede tener barios interesados
    public function interesados(): HasMany
    {
        return $this->hasMany(interesado::class ,'id_gestor','gestor_id_gestor');
    }
  
    public function comments(): HasMany
    {
        return $this->hasMany(cliente::class);
    }

    //un gestor puede tener varios clientes
    public function clientes(): HasMany
    {
        return $this->hasMany(cliente::class,'id_gestor');
    }
}
