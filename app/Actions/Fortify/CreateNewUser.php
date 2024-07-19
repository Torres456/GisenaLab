<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\cliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        $messages = [
            'rfc.max' => 'El campo RFC no debe ser mayor que 15 caracteres.',
            'rfc.min' => 'El campo RFC debe contener al menos 12 caracteres.',
            'rfc.unique' => 'El campo RFC ya ha sido registrado.',
            'nombre.max' => 'El campo Nombre, denominación o razón social no debe ser mayor que 255 caracteres.',
            'nombre.required' => 'El campo Nombre, denominación o razón social es obligatorio.',
        ];

        Validator::make($input, [
            'nombre' => ['required', 'string', 'max:255'],
            'rfc' => ['required', 'string', 'max:15', 'min:12', 'unique:cliente'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuario_sistema'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ], $messages)->validate();


        DB::beginTransaction();
        try {
            $usuario_sistema = User::create([
                'correo' => $input['correo'],
                'contraseña' => Hash::make($input['password']),
                'estatus' => 1,
                'idtipo_usuario' => 2
            ]);

            $id = DB::table('usuario_sistema')->where('correo', $input['correo'])->value('idusuario_sistema');

            $cliente = cliente::create([
                'razon_social' => $input['nombre'],
                'rfc' => $input['rfc'],
                'tipo' => 1,
                'correo' => $input['correo'],
                'idusuario_sistema' => $id
            ]);


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }


        return $usuario_sistema;
    }
}
