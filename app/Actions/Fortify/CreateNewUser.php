<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\cliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;

use App\Rules\Fisica;
use App\Rules\Les;
use App\Rules\Moral;
use App\Rules\Password;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $messages = [
            'nombre.required' => 'El campo Nombre de usuario es requerido.',
            'nombre.max' => 'El campo Nombre de usuario no debe ser mayor que 40 caracteres.',
            'nombre.unique' => 'El Nombre de usuario ya ha sido registrado.',
        ];

        $validator = Validator::make($input, [
            'nombre' => ['required', 'string', 'max:40', 'unique:usuario_sistema'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuario_sistema', 'unique:cliente', 'unique:contacto'],
            'password' => ['required', 'string', Password::default(), 'confirmed'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ], $messages)->validate();

        DB::beginTransaction();
        try {
            $usuario_sistema = User::create([
                'nombre' => $input['nombre'],
                'correo' => $input['correo'],
                'contraseña' => Hash::make($input['password']),
                'estatus' => 1,
                'id_tipo_usuario' => 2
            ]);

            $id = DB::table('usuario_sistema')->where('correo', $input['correo'])->value('id_usuario_sistema');


            $cliente = cliente::create([
                'correo' => $input['correo'],
                'id_usuario_sistema' => $id
            ]);

            DB::commit();
            return $usuario_sistema;
        } catch (\Exception $e) {
            DB::rollback();
            abort(500);
            // dd($e->getMessage());
        }
    }
}
