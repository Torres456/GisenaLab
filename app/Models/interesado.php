<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class interesado extends Model
{
    protected $table = 'interesado';
    protected $primaryKey = 'id_interesado';
    protected $fillable = [
        'nombre',
        'ap_paterno',
        'ap_materno',
        'telefono',
        'correo',
        'telefono_alternativo',
        'correo_alternativo',
        'id_contacto',
        'id_gestor',
        'id_direccion',
        'id_usuario_sistema',
        'id_cliente',
    ];

    public function contacto(): BelongsTo
    {
        return $this->BelongsTo(contacto::class, 'id_contacto');
    }
    
    //un interesado solo puede tener un gestor
    public function gestor() : BelongsTo
    {
        return $this->belongsTo(gestor::class, 'id_gestor','id_gestor');
    }

    public function direccion(): HasOne
    {
        return $this->hasOne(direccion::class, 'id_direccion');
    }

    public function sistema(): belongsTo
    {
        return $this->belongsTo(User::class,'id_usuario_sistema');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(cliente::class,'id_cliente');
    }

    use HasFactory;
}
