<?php

namespace Database\Seeders;

use App\Models\rutas;
use App\Models\tipo_usuario;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Ramsey\Uuid\v1;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        

        $TipoUser1= new tipo_usuario();
        $TipoUser1->idtipo_usuario=1;
        $TipoUser1->descripcion="Administrador";
        $TipoUser1->save();

        $TipoUser2= new tipo_usuario();
        $TipoUser2->idtipo_usuario=2;
        $TipoUser2->descripcion="Usuario";
        $TipoUser2->save();

        $TipoUser3= new tipo_usuario();
        $TipoUser3->idtipo_usuario=3;
        $TipoUser3->descripcion="Gestores";
        $TipoUser3->save();

        $user= new User();
        $user->correo="lued1006@gmail.com";
        $user->contraseña="Hmcnjsa1*";
        $user->estatus="1";
        $user->idtipo_usuario=1;
        $user->email_verified_at='05/08/2024';
        $user->save();

        $rutas= new rutas();
        $rutas->title="Unidades de Medida";
        $rutas->content="Agregar y editar Unidades de Medida";
        $rutas->route="admin.catalogos.unidad_medida";
        $rutas->estado=1;
        $rutas->tipo=1;
        $rutas->save();

        $rutas2= new rutas();
        $rutas2->title="Unidad de Métodos";
        $rutas2->content="Agregar y editar Unidad de Métodos";
        $rutas2->route="admin.catalogos.unidad_metodo";
        $rutas2->estado=1;
        $rutas2->tipo=1;
        $rutas2->save();

        $rutas3= new rutas();
        $rutas3->title="Métodos";
        $rutas3->content="Agregar y editar Métodos";
        $rutas3->route="admin.catalogos.metodos";
        $rutas3->estado=0;
        $rutas3->tipo=1;
        $rutas3->save();

        $rutas4= new rutas();
        $rutas4->title="Categorías ";
        $rutas4->content="Agregar y editar categorías";
        $rutas4->route="admin.catalogos.categorias";
        $rutas4->estado=1;
        $rutas4->tipo=1;
        $rutas4->save();

        $rutas5= new rutas();
        $rutas5->title="Subcategoría";
        $rutas5->content="Agregar y editar subcategoría";
        $rutas5->route="admin.catalogos.subcategorias";
        $rutas5->estado=1;
        $rutas5->tipo=1;
        $rutas5->save();

        $rutas6= new rutas();
        $rutas6->title="Tipo de Muestras";
        $rutas6->content="Agregar y editar Tipo de Muestras";
        $rutas6->route="admin.catalogos.tipo_muestras";
        $rutas6->estado=1;
        $rutas6->tipo=1;
        $rutas6->save();

        $rutas7= new rutas();
        $rutas7->title="Tipo de Análisis";
        $rutas7->content="Agregar y editar Tipo de Análisis";
        $rutas7->route="admin.catalogos.tipo_analisis";
        $rutas7->estado=1;
        $rutas7->tipo=1;
        $rutas7->save();

        $rutas8= new rutas();
        $rutas8->title="Análisis Especificos";
        $rutas8->content="Agregar y editar Análisis Especifico";
        $rutas8->route="admin.catalogos.analisis_especifico";
        $rutas8->estado=1;
        $rutas8->tipo=1;
        $rutas8->save();

        $rutas9= new rutas();
        $rutas9->title="Contenedores";
        $rutas9->content="Agregar y editar Contenedores";
        $rutas9->route="admin.catalogos.contenedores";
        $rutas9->estado=1;
        $rutas9->tipo=1;
        $rutas9->save();

        $rutas10= new rutas();
        $rutas10->title="Recipientes";
        $rutas10->content="Agregar y editar Recipientes";
        $rutas10->route="admin.catalogos.recipientes";
        $rutas10->estado=1;
        $rutas10->tipo=1;
        $rutas10->save();

        $rutas11= new rutas();
        $rutas11->title="Estatus de Orden Servicio";
        $rutas11->content="Agregar y editar estatus para la orden de servicio";
        $rutas11->route="admin.catalogos.status_orden_servicio";
        $rutas11->estado=1;
        $rutas11->tipo=1;
        $rutas11->save();

        $rutas12= new rutas();
        $rutas12->title="Estatus Muestra Orden Servicio";
        $rutas12->content="Agregar y editar estatus muestra orden servicio";
        $rutas12->route="admin.catalogos.status_muestra";
        $rutas12->estado=1;
        $rutas12->tipo=1;
        $rutas12->save();

        $rutas13= new rutas();
        $rutas13->title="Procedencias";
        $rutas13->content="Agregar y editar Procedencias de las muestras";
        $rutas13->route="admin.direcciones.procedencias";
        $rutas13->estado=1;
        $rutas13->tipo=1;
        $rutas13->save();

        $rutas14= new rutas();
        $rutas14->title="Laboratorios";
        $rutas14->content="Agregar y editar Laboratorios";
        $rutas14->route="admin.catalogos.laboratorios";
        $rutas14->estado=1;
        $rutas14->tipo=1;
        $rutas14->save();

        $rutas20= new rutas();
        $rutas20->title="Datos Muestra Específicos";
        $rutas20->content="Agregar y editar Datos Muestra Específicos";
        $rutas20->route="admin.catalogos.datos_muestra";
        $rutas20->estado=1;
        $rutas20->tipo=1;
        $rutas20->save();

        $rutas15= new rutas();
        $rutas15->title="Estados";
        $rutas15->content="Agregar y editar Estados";
        $rutas15->route="admin.direcciones.estados";
        $rutas15->estado=1;
        $rutas15->tipo=1;
        $rutas15->save();

        $rutas16= new rutas();
        $rutas16->title="Municipios";
        $rutas16->content="Agregar y editar Municipios";
        $rutas16->route="admin.direcciones.municipios";
        $rutas16->estado=1;
        $rutas16->tipo=1;
        $rutas16->save();

        $rutas17= new rutas();
        $rutas17->title="Colonias";
        $rutas17->content="Agregar y editar Colonias";
        $rutas17->route="admin.direcciones.colonias";
        $rutas17->estado=1;
        $rutas17->tipo=1;
        $rutas17->save();

        $rutas18= new rutas();
        $rutas18->title="Sucursales de Gisena";
        $rutas18->content="Agregar y editar Sucursales";
        $rutas18->route="admin.direcciones.sucursales";
        $rutas18->estado=1;
        $rutas18->tipo=1;
        $rutas18->save();

        $rutas19= new rutas();
        $rutas19->title="Zonas de Representación";
        $rutas19->content="Agregar y editar Zonas de Representación";
        $rutas19->route="admin.direcciones.representacion";
        $rutas19->estado=1;
        $rutas19->tipo=1;
        $rutas19->save();


        $rutas20= new rutas();
        $rutas20->title="Procedencias";
        $rutas20->content="Agregar y editar Procedencias";
        $rutas20->route="admin.direcciones.procedencias";
        $rutas20->estado=1;
        $rutas20->tipo=1;
        $rutas20->save();
    }
}
