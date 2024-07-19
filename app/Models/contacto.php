<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class contacto extends Model
{
    use HasFactory;
    protected $table = 'contacto';
    protected $primaryKey = 'id_contacto';

    protected $fillable = [
        'nombre',
        'ap_paterno',
        'ap_materno',
        'telefono',
        'correo',
        'telefono_alternativo',
        'correo_alternativo'
    ];

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(cliente::class);
    }
    
}
