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
        'nombre_interesado',
        'a_paterno',
        'a_materno',
        'telefono',
        'correo',
        'telefono_alternativo',
        'correo_alternativo',
        'contacto_idcontacto',
        'gestor_id_gestor',
        'direccion_id_direccion',
    ];

    public function contacto(): HasOne
    {
        return $this->hasOne(contacto::class, 'idcontacto');
    }
    
    //un interesado puede tener uno a muchos
    public function gestor(): BelongsTo
    {
        return $this->belongsTo(gestor::class, 'id_gestor');
    }

    public function direccion(): HasOne
    {
        return $this->hasOne(direccion::class, 'id_direccion');
    }

    use HasFactory;
}
