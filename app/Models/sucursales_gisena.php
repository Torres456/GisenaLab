<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class sucursales_gisena extends Model
{
    protected $table ='sucursales_gisena';
    protected $primaryKey = 'idsucursal_gisena';
    protected $fillable = [
        'idsucursal_gisena',
        'numero_sucursal',
        'nombre',
        'id_estado',
        'id_municipio',
        'id_colonia',
        'calle',
        'num_exterior',
        'num_interior',
        'cp',
    ];

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
