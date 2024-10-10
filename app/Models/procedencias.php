<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class procedencias extends Model
{
    protected $table = 'procedencia';
    protected $primaryKey = 'id_procedencia';
    protected $fillable = [
        'sitio_muestreo',
        'nombre_sitio_muestreo',
        'id_estado',
        'id_municipio',
        'id_colonia',
        'calle',
        'num_exterior',
        'num_interior',
        'cp',
        'gps',
        'registro_sader',
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
