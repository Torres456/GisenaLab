<?php

namespace Database\Seeders;

use App\Models\rutas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlujosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //tipo 1 -Admin
        //content 4 - Flujos

        $flujos1 = new rutas();
        $flujos1->title = "Flujo de Subcategorías";
        $flujos1->description = "Permite agregar en orden las subcategorias";
        $flujos1->route = "admin.flujos.flujos_subcategorias";
        $flujos1->estado = 1;
        $flujos1->tipo = 1;
        $flujos1->content = 4;
        $flujos1->save();
    }
}
