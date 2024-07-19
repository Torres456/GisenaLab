<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'razon_social',
        'rfc',
        'regimen_fiscal',
        'uso_cfdi',
        'tipo',
        'correo',
        'telefono',
        'correo_alternativo',
        'telefono_alternativo',
        'id_contacto',
        'id_gestor',
        'idusuario_sistema'
    ];


    public function contacto(): HasOne
    {
        return $this->hasOne(contacto::class, 'id_contacto');
    }

    public function gestor(): HasOne
    {
        return $this->hasOne(gestor::class, 'id_gestor');
    }

    public function sistema(): HasOne
    {
        return $this->hasOne(gestor::class, 'idusuario_sistema');
    }


    public function direccion(): HasMany
    {
        return $this->hasMany(cliente_direccion::class, 'id_cliente');
    }
    


}
