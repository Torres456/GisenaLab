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


        $TipoUser1 = new tipo_usuario();
        $TipoUser1->id_tipo_usuario = 1;
        $TipoUser1->descripcion = "Administrador";
        $TipoUser1->save();

        $TipoUser2 = new tipo_usuario();
        $TipoUser2->id_tipo_usuario = 2;
        $TipoUser2->descripcion = "Usuario";
        $TipoUser2->save();

        $TipoUser3 = new tipo_usuario();
        $TipoUser3->id_tipo_usuario = 3;
        $TipoUser3->descripcion = "Gestores";
        $TipoUser3->save();

        $TipoUser4 = new tipo_usuario();
        $TipoUser4->id_tipo_usuario = 4;
        $TipoUser4->descripcion = "Interesados";
        $TipoUser4->save();

        $TipoUser5 = new tipo_usuario();
        $TipoUser5->id_tipo_usuario = 5;
        $TipoUser5->descripcion = "Empleado";
        $TipoUser5->save();

        $user = new User();
        $user->nombre = "Luis";
        $user->correo = "lued1006@gmail.com";
        $user->contraseña = "Hmcnjsa1*";
        $user->estatus = "1";
        $user->id_tipo_usuario = 1;
        $user->email_verified_at = '05/08/2024';
        $user->save();

        $user2 = new User();
        $user2->nombre = "Jovanny";
        $user2->correo = "barrientostorres9@gmail.com";
        $user2->contraseña = "Torres123#";
        $user2->estatus = "1";
        $user2->id_tipo_usuario = 1;
        $user2->email_verified_at = '05/08/2024';
        $user2->save();

        $user3 = new User();
        $user3->nombre = "Admin";
        $user3->correo = "admin@gmail.com";
        $user3->contraseña = "Admin123#";
        $user3->estatus = "1";
        $user3->id_tipo_usuario = 1;
        $user3->email_verified_at = '05/08/2024';
        $user3->save();

        $user4 = new User();
        $user4->nombre = "Fabian";
        $user4->correo = "cliente@gmail.com";
        $user4->contraseña = "Cliente123#";
        $user4->estatus = "1";
        $user4->id_tipo_usuario = 2;
        $user4->email_verified_at = '05/08/2024';
        $user4->save();

        $user5 = new User();
        $user5->nombre = "Carlos";
        $user5->correo = "gestor@gmail.com";
        $user5->contraseña = "Gestor123#";
        $user5->estatus = "1";
        $user5->id_tipo_usuario = 3;
        $user5->email_verified_at = '05/08/2024';
        $user5->save();

        $user6 = new User();
        $user6->nombre = "Juan";
        $user6->correo = "interesado@gmail.com";
        $user6->contraseña = "Interesado123#";
        $user6->estatus = "1";
        $user6->id_tipo_usuario = 4;
        $user6->email_verified_at = '05/08/2024';
        $user6->save();

        $user6 = new User();
        $user6->nombre = "Diego";
        $user6->correo = "empleado@gmail.com";
        $user6->contraseña = "empleado123#";
        $user6->estatus = "1";
        $user6->id_tipo_usuario = 5;
        $user6->email_verified_at = '05/08/2024';
        $user6->save();

        $rutas = new rutas();
        $rutas->title = "Unidades de Medida";
        $rutas->description = "Agregar y editar Unidades de Medida";
        $rutas->route = "admin.catalogos.unidad_medida";
        $rutas->estado = 1;
        $rutas->tipo = 1;
        $rutas->content = 1;
        $rutas->save();

        $rutas2 = new rutas();
        $rutas2->title = "Unidad de Métodos";
        $rutas2->description = "Agregar y editar Unidad de Métodos";
        $rutas2->route = "admin.catalogos.unidad_metodo";
        $rutas2->estado = 1;
        $rutas2->tipo = 1;
        $rutas2->content = 1;
        $rutas2->save();

        $rutas3 = new rutas();
        $rutas3->title = "Métodos";
        $rutas3->description = "Agregar y editar Métodos";
        $rutas3->route = "admin.catalogos.metodos";
        $rutas3->estado = 0;
        $rutas3->tipo = 1;
        $rutas3->content = 1;
        $rutas3->save();

        $rutas4 = new rutas();
        $rutas4->title = "Categorías ";
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
        $rutas6->description = "Agregar y editar Tipo de Muestras";
        $rutas6->route = "admin.catalogos.tipo_muestras";
        $rutas6->estado = 1;
        $rutas6->tipo = 1;
        $rutas6->content = 1;
        $rutas6->save();

        $rutas7 = new rutas();
        $rutas7->title = "Tipo de Análisis";
        $rutas7->description = "Agregar y editar Tipo de Análisis";
        $rutas7->route = "admin.catalogos.tipo_analisis";
        $rutas7->estado = 1;
        $rutas7->tipo = 1;
        $rutas7->content = 1;
        $rutas7->save();

        $rutas8 = new rutas();
        $rutas8->title = "Análisis Especificos";
        $rutas8->description = "Agregar y editar Análisis Especifico";
        $rutas8->route = "admin.catalogos.analisis_especifico";
        $rutas8->estado = 1;
        $rutas8->tipo = 1;
        $rutas8->content = 1;
        $rutas8->save();

        $rutas9 = new rutas();
        $rutas9->title = "Contenedores";
        $rutas9->description = "Agregar y editar Contenedores";
        $rutas9->route = "admin.catalogos.contenedores";
        $rutas9->estado = 1;
        $rutas9->tipo = 1;
        $rutas9->content = 1;
        $rutas9->save();

        $rutas10 = new rutas();
        $rutas10->title = "Recipientes";
        $rutas10->description = "Agregar y editar Recipientes";
        $rutas10->route = "admin.catalogos.recipientes";
        $rutas10->estado = 1;
        $rutas10->tipo = 1;
        $rutas10->content = 1;
        $rutas10->save();

        $rutas11 = new rutas();
        $rutas11->title = "Estatus de Orden Servicio";
        $rutas11->description = "Agregar y editar estatus para la orden de servicio";
        $rutas11->route = "admin.catalogos.status_orden_servicio";
        $rutas11->estado = 1;
        $rutas11->tipo = 1;
        $rutas11->content = 1;
        $rutas11->save();

        $rutas12 = new rutas();
        $rutas12->title = "Estatus Muestra Orden Servicio";
        $rutas12->description = "Agregar y editar estatus muestra orden servicio";
        $rutas12->route = "admin.catalogos.status_muestra";
        $rutas12->estado = 1;
        $rutas12->tipo = 1;
        $rutas12->content = 1;
        $rutas12->save();

        $rutas13 = new rutas();
        $rutas13->title = "Procedencias";
        $rutas13->description = "Agregar y editar Procedencias de las muestras";
        $rutas13->route = "admin.direcciones.procedencias";
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

        $rutas20 = new rutas();
        $rutas20->title = "Datos Muestra Específicos";
        $rutas20->description = "Agregar y editar Datos Muestra Específicos";
        $rutas20->route = "admin.catalogos.datos_muestra";
        $rutas20->estado = 1;
        $rutas20->tipo = 1;
        $rutas20->content = 1;
        $rutas20->save();

        $rutas15 = new rutas();
        $rutas15->title = "Estados";
        $rutas15->description = "Agregar y editar Estados";
        $rutas15->route = "admin.direcciones.estados";
        $rutas15->estado = 1;
        $rutas15->tipo = 1;
        $rutas15->content = 1;
        $rutas15->save();

        $rutas16 = new rutas();
        $rutas16->title = "Municipios";
        $rutas16->description = "Agregar y editar Municipios";
        $rutas16->route = "admin.direcciones.municipios";
        $rutas16->estado = 1;
        $rutas16->tipo = 1;
        $rutas16->content = 1;
        $rutas16->save();

        $rutas17 = new rutas();
        $rutas17->title = "Colonias";
        $rutas17->description = "Agregar y editar Colonias";
        $rutas17->route = "admin.direcciones.colonias";
        $rutas17->estado = 1;
        $rutas17->tipo = 1;
        $rutas17->content = 1;
        $rutas17->save();

        $rutas18 = new rutas();
        $rutas18->title = "Sucursales de Gisena";
        $rutas18->description = "Agregar y editar Sucursales";
        $rutas18->route = "admin.direcciones.sucursales";
        $rutas18->estado = 1;
        $rutas18->tipo = 1;
        $rutas18->content = 1;
        $rutas18->save();

        $rutas19 = new rutas();
        $rutas19->title = "Zonas de Representación";
        $rutas19->description = "Agregar y editar Zonas de Representación";
        $rutas19->route = "admin.direcciones.representacion";
        $rutas19->estado = 1;
        $rutas19->tipo = 1;
        $rutas19->content = 1;
        $rutas19->save();


        $rutas20 = new rutas();
        $rutas20->title = "Roles de Empleados";
        $rutas20->description = "Agregar y editar roles";
        $rutas20->route = "admin.direcciones.procedencias";
        $rutas20->estado = 1;
        $rutas20->tipo = 1;
        $rutas20->content = 1;
        $rutas20->save();



        $rutas21 = new rutas();
        $rutas21->title = "Empleados";
        $rutas21->description = "Agregar, editar y dar de baja empleados";
        $rutas21->route = "admin.registros.empleados";
        $rutas21->estado = 1;
        $rutas21->tipo = 1;
        $rutas21->content = 2;
        $rutas21->save();


        $rutas22 = new rutas();
        $rutas22->title = "Clientes";
        $rutas22->description = "Agregar, editar y dar de baja clientes";
        $rutas22->route = "admin.registros.clientes";
        $rutas22->estado = 1;
        $rutas22->tipo = 1;
        $rutas22->content = 2;
        $rutas22->save();


        $rutas23 = new rutas();
        $rutas23->title = "Interesados";
        $rutas23->description = "Agregar, editar y dar de baja interesados";
        $rutas23->route = "admin.registros.interesados";
        $rutas23->estado = 1;
        $rutas23->tipo = 1;
        $rutas23->content = 2;
        $rutas23->save();

        $rutas24 = new rutas();
        $rutas24->title = "Gestores";
        $rutas24->description = "Agregar, editar y dar de baja gestores";
        $rutas24->route = "admin.registros.gestores";
        $rutas24->estado = 1;
        $rutas24->tipo = 1;
        $rutas24->content = 2;
        $rutas24->save();
    }
}
