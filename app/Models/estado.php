<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class estado extends Model
{
    use HasFactory;
    protected $table = 'estado';
    protected $primaryKey = 'id_estado';

    protected $fillable = [
        'nombre',
        'clave_estado'
    ];

    //One to Many
    public function municipio(): HasMany
    {
        return $this->hasMany(municipio::class,'id_estado');
    }

    //Relacion con sucursales
    public function sucursales(): HasMany
    {
        return $this->hasMany(sucursales_gisena::class, 'id_estado');
    }
    public function procedencias(): HasMany
    {
        return $this->hasMany(procedencias::class, 'id_estado');
    }
    
    // //Zona representacion
    public function zonas(): BelongsToMany
    {
         return $this->belongsToMany(zona_representacion::class,'estados_zona', 'idzona_representacion','id_estado');
     }

    // //direccion estado
    // public function direccion_estado(): HasMany
    // {
    //     return $this->hasMany(direccion::class);
    // }

    // //direccion municipio
    // public function direccion_municipio(): HasMany
    // {
    //     return $this->hasMany(municipio::class);
    // }

    //  //direccion colona
    //  public function direccion_colonia(): HasMany
    //  {
    //      return $this->hasMany(colonia::class);
    //  }
     
}
