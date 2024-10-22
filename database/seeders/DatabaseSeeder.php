<?php

namespace Database\Seeders;


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
        
        $this->call(UserSeeder::class);
        $this->call(CatalogoSeeder::class);
        $this->call(DireccionesSeeder::class);
        $this->call(RegistrosSeeder::class);
        $this->call(FlujosSeeder::class);

    }
}
