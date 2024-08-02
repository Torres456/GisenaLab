<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class colonia extends Model
{
    use HasFactory;
    protected $table = 'colonia';
    protected $primaryKey = 'id_colonia';

    protected $fillable = [
        'nombre',
        'clave_colonia',
        'id_municipio'
    ];


    public function municipio(): BelongsTo
    {
        return $this->belongsTo(municipio::class, 'id_municipio');
    }

    public function sucursales(): HasMany
    {
        return $this->hasMany(sucursales_gisena::class, 'id_colonia');
    }


}
