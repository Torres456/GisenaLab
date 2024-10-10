<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orden_servicio extends Model
{
    protected $table = 'orden_servicio';
    protected $primaryKey = 'id_orden_servicio';
    protected $fillable = [
        'id_orden_servicio',
        'fecha_orden',
        'prioridad',
        'requiere_factura',
        'inf_adicional',
        'id_cliente',
        'id_cotizacion',
        'id_interesado',
        'remision_muestra',
        'tipo_documento',
        'folio_documento',
        'netsuite',
        'id_status_orden_servicio',
    ];

    public function cliente(){
        return $this->belongsTo(cliente::class, 'id_cliente','id_cliente');
    }

    //interesado
    public function interesado(){
        return $this->belongsTo(interesado::class, 'id_interesado','id_interesado');
    }
    

    public function status_orden_servicio(){
        return $this->belongsTo(estatus_orden_servicio::class, 'idstatus_orden_servicio','idstatus_orden_servicio');
    }
    
    public function muestras(){
        return $this->hasMany(muestra_orden_servicio::class, 'id_categoria', 'id_categoria');
    }
    //relacion cotizacion uno a uno
    public function cotizacion(){
        return $this->belongsTo(cotizacion::class, 'id_cotizacion','id_cotizacion');
    }

    use HasFactory;
}
