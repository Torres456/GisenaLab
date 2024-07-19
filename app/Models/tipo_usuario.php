<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class tipo_usuario extends Model
{
    use HasFactory;
    protected $table = 'tipo_usuario';
    protected $primaryKey = 'idtipo_usuario';
    protected $fillable = ['descripcion'];

    //One to Many
    public function usuario(): HasMany
    {
        return $this->hasMany(User::class);
    }

}
