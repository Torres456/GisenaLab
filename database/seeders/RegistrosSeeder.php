<?php

namespace Database\Seeders;

use App\Models\rutas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //tipo 1 - Admin
        //content 3 - Registros
        
        $registros1 = new rutas();
        $registros1->title = "Empleados";
        $registros1->description = "Agregar, editar y dar de baja empleados";
        $registros1->route = "admin.registros.empleados";
        $registros1->estado = 1;
        $registros1->tipo = 1;
        $registros1->content = 3;
        $registros1->save();


        $registros2 = new rutas();
        $registros2->title = "Clientes";
        $registros2->description = "Agregar, editar y dar de baja clientes";
        $registros2->route = "admin.registros.clientes";
        $registros2->estado = 1;
        $registros2->tipo = 1;
        $registros2->content = 3;
        $registros2->save();


        $registros3 = new rutas();
        $registros3->title = "Interesados";
        $registros3->description = "Agregar, editar y dar de baja interesados";
        $registros3->route = "admin.registros.interesados";
        $registros3->estado = 1;
        $registros3->tipo = 1;
        $registros3->content = 3;
        $registros3->save();

        $registros4 = new rutas();
        $registros4->title = "Gestores";
        $registros4->description = "Agregar, editar y dar de baja gestores";
        $registros4->route = "admin.registros.gestores";
        $registros4->estado = 1;
        $registros4->tipo = 1;
        $registros4->content = 3;
        $registros4->save();
    }
}
