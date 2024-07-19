<?php

namespace Database\Seeders;

use App\Models\rutas;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $user = new User();
        $user->name = 'Luis Luna';
        $user->email = 'lued1006@gmail.com';
        $user->password = bcrypt('Hmcnjsa1*.');
        $user->save();

        $rutas= new rutas();
        $rutas->title="Unidades de Medida";
        $rutas->content="Agregar y editar Unidades de Medida";
        $rutas->route="catalogos.unidad_medida";
        $rutas->estado=1;
        $rutas->save();

        $rutas2= new rutas();
        $rutas2->title="Unidad de Métodos";
        $rutas2->content="Agregar y editar Unidad de Métodos";
        $rutas2->route="catalogos.unidad_metodo";
        $rutas2->estado=1;
        $rutas2->save();

        $rutas3= new rutas();
        $rutas3->title="Métodos";
        $rutas3->content="Agregar y editar Métodos";
        $rutas3->route="catalogos.metodos";
        $rutas3->estado=0;
        $rutas3->save();

        $rutas4= new rutas();
        $rutas4->title="Categorías ";
        $rutas4->content="Agregar y editar categorías";
        $rutas4->route="catalogos.categorias";
        $rutas4->estado=1;
        $rutas4->save();

        $rutas5= new rutas();
        $rutas5->title="Subcategoría";
        $rutas5->content="Agregar y editar subcategoría";
        $rutas5->route="catalogos.subcategorias";
        $rutas5->estado=1;
        $rutas5->save();

        $rutas6= new rutas();
        $rutas6->title="Tipo de Muestras";
        $rutas6->content="Agregar y editar Tipo de Muestras";
        $rutas6->route="catalogos.tipo_muestras";
        $rutas6->estado=1;
        $rutas6->save();

        $rutas7= new rutas();
        $rutas7->title="Tipo de Análisis";
        $rutas7->content="Agregar y editar Tipo de Análisis";
        $rutas7->route="catalogos.tipo_analisis";
        $rutas7->estado=1;
        $rutas7->save();

        $rutas8= new rutas();
        $rutas8->title="Análisis Especificos";
        $rutas8->content="Agregar y editar Análisis Especifico";
        $rutas8->route="catalogos.analisis_especifico";
        $rutas8->estado=1;
        $rutas8->save();

        $rutas9= new rutas();
        $rutas9->title="Contenedores";
        $rutas9->content="Agregar y editar Contenedores";
        $rutas9->route="catalogos.contenedores";
        $rutas9->estado=1;
        $rutas9->save();

        $rutas10= new rutas();
        $rutas10->title="Recipientes";
        $rutas10->content="Agregar y editar Recipientes";
        $rutas10->route="catalogos.recipientes";
        $rutas10->estado=1;
        $rutas10->save();

        $rutas11= new rutas();
        $rutas11->title="Estatus de Orden Servicio";
        $rutas11->content="Agregar y editar estatus para la orden de servicio";
        $rutas11->route="catalogos.status_orden_servicio";
        $rutas11->estado=1;
        $rutas11->save();

        $rutas12= new rutas();
        $rutas12->title="Estatus Muestra Orden Servicio";
        $rutas12->content="Agregar y editar estatus muestra orden servicio";
        $rutas12->route="catalogos.status_muestra";
        $rutas12->estado=1;
        $rutas12->save();
    }
}
