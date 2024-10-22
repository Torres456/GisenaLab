<?php

namespace Database\Seeders;

use App\Models\tipo_usuario;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
