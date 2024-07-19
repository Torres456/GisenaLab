<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class direccion extends Model
{
    use HasFactory;
    protected $table = 'direccion';
    protected $primaryKey = 'id_direccion';

    protected $fillable = [
        'calle',
        'no_exterior',
        'no_interior',
        'entre_calles',
        'referencia',
        'cp',
        'id_estado',
        'id_municipio',
        'id_colonia'
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

    public function gestor(): HasOne
    {
        return $this->hasOne(gestor::class);
    }

    public function cliente_direccion(): HasMany
    {
        return $this->hasMany(cliente_direccion::class,'id_direccion');
    }
}
