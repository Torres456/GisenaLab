<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class municipio extends Model
{
    use HasFactory;

    protected $table = 'municipio';
    protected $primaryKey = 'id_municipio';

    protected $fillable = [
        'nombre',
        'clave_municipio',
        'id_estado'
    ];


    public function estado(): BelongsTo
    {
        return $this->belongsTo(estado::class, 'id_estado');
    }


    public function colonia(): HasMany
    {
        return $this->hasMany(colonia::class, 'id_municipio');
    }
}
