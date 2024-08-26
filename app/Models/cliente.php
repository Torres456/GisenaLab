<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    //un cliente solo puede tener un gestor
    public function gestor(): BelongsTo
    {
        return $this->belongsTo(gestor::class, 'id_gestor');
    }

    public function sistema(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idusuario_sistema');
    }

    public function direcciones(): BelongsToMany
    {
        return $this->belongsToMany(direccion::class, 'cliente_direccion','id_cliente','id_direccion');
    }
    

}
