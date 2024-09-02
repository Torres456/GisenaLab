<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class empleado extends Model
{

    protected $table = 'empleado';
    protected $primaryKey = 'id_empleado';
    protected $fillable = [
        'id_empleado',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'no_empleado',
        'telefono',
        'curp',
        'rfc',
        'sexo',
        'calle',
        'no_exterior',
        'no_interior',
        'cp',
        'id_tipo_empleado',
        'id_usuario_sistema',
        'id_estado',
        'id_municipio',
        'id_colonia',
    ];

    public function tipo_empleado(): BelongsTo
    {
        return $this->belongsTo(tipo_empleado::class, 'id_tipo_empleado');
    }

    public function usuario_sistema(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario_sistema');
    }
    public function estado(): BelongsTo
    {
        return $this->belongsTo(estado::class, 'id_estado');
    }
    public function municipio(): BelongsTo
    {
        return $this->belongsTo(municipio::class, 'id_municipio');
    }
    public function colonia(): BelongsTo
    {
        return $this->belongsTo(colonia::class, 'id_colonia');
    }

    use HasFactory;
}
