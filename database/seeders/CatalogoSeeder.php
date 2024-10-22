<?php

namespace Database\Seeders;

use App\Models\rutas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Tipo 1
        //content 1 - Catalogos de muestras

        $rutas = new rutas();
        $rutas->title = "Unidades de Medida";
        $rutas->description = "Agregar y editar unidades de medida";
        $rutas->route = "admin.catalogos.unidad_medida";
        $rutas->estado = 1;
        $rutas->tipo = 1;
        $rutas->content = 1;
        $rutas->save();

        $rutas2 = new rutas();
        $rutas2->title = "Unidad de Métodos";
        $rutas2->description = "Agregar y editar unidad de métodos";
        $rutas2->route = "admin.catalogos.unidad_metodo";
        $rutas2->estado = 1;
        $rutas2->tipo = 1;
        $rutas2->content = 1;
        $rutas2->save();

        $rutas3 = new rutas();
        $rutas3->title = "Métodos";
        $rutas3->description = "Agregar y editar métodos";
        $rutas3->route = "admin.catalogos.metodos";
        $rutas3->estado = 0;
        $rutas3->tipo = 1;
        $rutas3->content = 1;
        $rutas3->save();

        $rutas4 = new rutas();
        $rutas4->title = "Categorías";
        $rutas4->description = "Agregar y editar categorías";
        $rutas4->route = "admin.catalogos.categorias";
        $rutas4->estado = 1;
        $rutas4->tipo = 1;
        $rutas4->content = 1;
        $rutas4->save();

        $rutas5 = new rutas();
        $rutas5->title = "Subcategoría";
        $rutas5->description = "Agregar y editar subcategoría";
        $rutas5->route = "admin.catalogos.subcategorias";
        $rutas5->estado = 1;
        $rutas5->tipo = 1;
        $rutas5->content = 1;
        $rutas5->save();

        $rutas6 = new rutas();
        $rutas6->title = "Tipo de Muestras";
        $rutas6->description = "Agregar y editar tipo de muestras";
        $rutas6->route = "admin.catalogos.tipo_muestras";
        $rutas6->estado = 1;
        $rutas6->tipo = 1;
        $rutas6->content = 1;
        $rutas6->save();

        $rutas7 = new rutas();
        $rutas7->title = "Descripción de Muestra";
        $rutas7->description = "Agregar y editar descripción de muestra";
        $rutas7->route = "admin.catalogos.descripcion_muetras";
        $rutas7->estado = 1;
        $rutas7->tipo = 1;
        $rutas7->content = 1;
        $rutas7->save();

        $rutas8 = new rutas();
        $rutas8->title = "Tipo de Análisis";
        $rutas8->description = "Agregar y editar Tipo de Análisis";
        $rutas8->route = "admin.catalogos.tipo_analisis";
        $rutas8->estado = 1;
        $rutas8->tipo = 1;
        $rutas8->content = 1;
        $rutas8->save();

        $rutas9 = new rutas();
        $rutas9->title = "Análisis Especificos";
        $rutas9->description = "Agregar y editar Análisis Especifico";
        $rutas9->route = "admin.catalogos.analisis_especifico";
        $rutas9->estado = 1;
        $rutas9->tipo = 1;
        $rutas9->content = 1;
        $rutas9->save();

        $rutas10 = new rutas();
        $rutas10->title = "Contenedores";
        $rutas10->description = "Agregar y editar contenedores";
        $rutas10->route = "admin.catalogos.contenedores";
        $rutas10->estado = 1;
        $rutas10->tipo = 1;
        $rutas10->content = 1;
        $rutas10->save();

        $rutas11 = new rutas();
        $rutas11->title = "Recipientes";
        $rutas11->description = "Agregar y editar Recipientes";
        $rutas11->route = "admin.catalogos.recipientes";
        $rutas11->estado = 1;
        $rutas11->tipo = 1;
        $rutas11->content = 1;
        $rutas11->save();

        $rutas12 = new rutas();
        $rutas12->title = "Estatus de Orden Servicio";
        $rutas12->description = "Agregar y editar estatus para la orden de servicio";
        $rutas12->route = "admin.catalogos.status_orden_servicio";
        $rutas12->estado = 1;
        $rutas12->tipo = 1;
        $rutas12->content = 1;
        $rutas12->save();

        $rutas13 = new rutas();
        $rutas13->title = "Estatus Muestra Orden Servicio";
        $rutas13->description = "Agregar y editar estatus muestra orden servicio";
        $rutas13->route = "admin.catalogos.status_muestra";
        $rutas13->estado = 1;
        $rutas13->tipo = 1;
        $rutas13->content = 1;
        $rutas13->save();

        $rutas14 = new rutas();
        $rutas14->title = "Laboratorios";
        $rutas14->description = "Agregar y editar Laboratorios";
        $rutas14->route = "admin.catalogos.laboratorios";
        $rutas14->estado = 1;
        $rutas14->tipo = 1;
        $rutas14->content = 1;
        $rutas14->save();

        $rutas15 = new rutas();
        $rutas15->title = "Datos Muestra Específicos";
        $rutas15->description = "Agregar y editar Datos Muestra Específicos";
        $rutas15->route = "admin.catalogos.datos_muestra";
        $rutas15->estado = 1;
        $rutas15->tipo = 1;
        $rutas15->content = 1;
        $rutas15->save();

        $rutas16 = new rutas();
        $rutas16->title = "Roles de Empleados";
        $rutas16->description = "Agregar y editar roles";
        $rutas16->route = "admin.catalogos.tipo_empleado";
        $rutas16->estado = 1;
        $rutas16->tipo = 1;
        $rutas16->content = 1;
        $rutas16->save();
    }
}
