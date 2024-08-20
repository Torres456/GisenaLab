<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class estados_zona extends Model
{
    protected $table = 'estados_zona';
    protected $primaryKey = 'idestados_zona';
    protected $fillable = [
        'idestados_zona',
        'id_estado',
        'idzona_representacion',
    ];

    public function estado(){
        return $this->belongsTo(estado::class,'id_estado');
    }

    use HasFactory;
}
