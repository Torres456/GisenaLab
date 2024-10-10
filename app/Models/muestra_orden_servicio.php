<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class muestra_orden_servicio extends Model
{
    protected $table ='muestra_orden_servicio';
    protected $primaryKey = 'id_muestra_orden_servicio';
    protected $fillable = [
        'id_muestra_orden_servicio',
        'id_orden_servicio',
        'id_categoria',
        'id_subcategoria',
        'id_tipo_muestra',
        'id_descrip_muestra',
        'id_tipo_analisis',
        'id_analisis_especifico',
        'cantidad_enviada',
        'no_lote',
        'productor_responsable',
        'fecha_muestreo',
        'otros_datos',
        'fecha_envio',
        'idioma_informe',
        'id_procedencia',
        'id_muestra_internacional',
        'tiempo_respuesta',
        'id_status_muestra',
        'id_unidad_medida',
        'id_procedencia_orden'
    ];

    public function categoria(){
        return $this->belongsTo(catalogo_categoria::class,'id_categoria','id_categoria');
    }
    public function subcategoria(){
        return $this->belongsTo(catalogo_subcategoria::class,'id_subcategoria','id_subcategoria');
    }
    public function tipo_muestra(){
        return $this->belongsTo(catalogo_tipo_muestra::class,'id_tipo_muestra','id_tipo_muestra');
    }

    public function tipo_analisis(){
        return $this->belongsTo(catalogo_tipo_analisis::class,'id_tipo_analisis','id_tipo_analisis');
    }

    public function analisis_especifico(){
        return $this->belongsTo(catalogo_analisis_especifico::class,'id_analisis_especifico','id_analisis_especifico');
    }

    public function muestra_internacional(){
        return $this->belongsTo(mustra_internacional::class,'idmuestra_internacional','idmuestra_internacional');
    }

    public function datos_muestra_especifico(){
        return $this->belongsToMany(datos_muestra_especificos::class);
    }

    public function descripcion_muestra(){
        return $this->belongsTo(descripcion_muestra::class,'id_descrip_muestra','id_descrip_muestra');
    }

    public function unidad_medida(){
        return $this->belongsTo(unidad_medida::class,'id_unidad_medida','id_unidad_medida');
    }

    //procedencia
    public function procedencia(){
        return $this->belongsTo(procedencias::class,'id_procedencia','id_procedencia');
    }

    //Estatus muestra
    public function status_muestra(){
        return $this->belongsTo(estatus_muestras::class,'id_status_muestra','id_status_muestra');
    }



    use HasFactory;
}
