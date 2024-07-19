<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class cliente_direccion extends Model
{
    use HasFactory;
    protected $table = 'cliente_direccion';
    protected $primaryKey = 'id_cliente_direccion';

    protected $fillable = [
        'id_cliente',
        'id_direccion'
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(cliente::class,'id_cliente');
    }

    public function direccion(): BelongsTo
    {
        return $this->belongsTo(direccion::class,'id_direccion');
    }

}
