<?php

namespace Database\Seeders;

use App\Models\rutas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DireccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //tipo 1 - Admin
        //content - 2 Procedencias
        $procedencias1 = new rutas();
        $procedencias1->title = "Estados";
        $procedencias1->description = "Agregar y editar estados";
        $procedencias1->route = "admin.direcciones.estados";
        $procedencias1->estado = 1;
        $procedencias1->tipo = 1;
        $procedencias1->content = 2;
        $procedencias1->save();

        $procedencias2 = new rutas();
        $procedencias2->title = "Municipios";
        $procedencias2->description = "Agregar y editar municipios";
        $procedencias2->route = "admin.direcciones.municipios";
        $procedencias2->estado = 1;
        $procedencias2->tipo = 1;
        $procedencias2->content = 2;
        $procedencias2->save();

        $procedencias3 = new rutas();
        $procedencias3->title = "Colonias";
        $procedencias3->description = "Agregar y editar colonias";
        $procedencias3->route = "admin.direcciones.colonias";
        $procedencias3->estado = 1;
        $procedencias3->tipo = 1;
        $procedencias3->content = 2;
        $procedencias3->save();

        $procedencias4 = new rutas();
        $procedencias4->title = "Sucursales de Gisena";
        $procedencias4->description = "Agregar y editar sucursales";
        $procedencias4->route = "admin.direcciones.sucursales";
        $procedencias4->estado = 1;
        $procedencias4->tipo = 1;
        $procedencias4->content = 2;
        $procedencias4->save();

        $procedencias5 = new rutas();
        $procedencias5->title = "Zonas de Representación";
        $procedencias5->description = "Agregar y editar zonas de representación";
        $procedencias5->route = "admin.direcciones.representacion";
        $procedencias5->estado = 1;
        $procedencias5->tipo = 1;
        $procedencias5->content = 2;
        $procedencias5->save();

        $procedencias6 = new rutas();
        $procedencias6->title = "Procedencias";
        $procedencias6->description = "Agregar y editar procedencias de las muestras";
        $procedencias6->route = "admin.direcciones.procedencias";
        $procedencias6->estado = 1;
        $procedencias6->tipo = 1;
        $procedencias6->content = 2;
        $procedencias6->save();
    }
}
