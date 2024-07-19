<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class zona_representacion extends Model
{
    use HasFactory;

    protected $table = 'zona_representacion';
    protected $primaryKey = 'idzona_representacion';

    protected $fillable = [
        
        'nombre_zona'
    ];
    
   
    public function estado(): BelongsToMany
    {
        return $this->belongsToMany(estado::class);
    }

    
    public function user(): HasOne
    {
        return $this->hasOne(gestor::class);
    }
}
