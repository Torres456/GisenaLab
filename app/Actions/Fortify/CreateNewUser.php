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
            'rfc.max' => 'El campo RFC no debe ser mayor que 12 caracteres.',
            'rfc.min' => 'El campo RFC debe contener al menos 12 caracteres.',
            'rfc.unique' => 'El campo RFC ya ha sido registrado.',
            'rfc.required' => 'El campo RFC es obligatorio.',
            'nombre.max' => 'El campo Nombre, no debe ser mayor que 255 caracteres.',
            'nombre.required' => 'El campo Nombre, debe ser obligatorio.',
            'paterno.required' => 'El campo Apellido paterno, debe ser obligatorio.',
            'paterno.max' => 'El campo Apellido paterno, no debe ser mayor que 255 caracteres.',
            'materno.required' => 'El campo Apellido materno, debe ser obligatorio.',
            'materno.max' => 'El campo Apellido materno, no debe ser mayor que 255 caracteres.',
            'nombre_moral.max' => 'El campo Nombre, denominación o razón social, no debe ser mayor que 255 caracteres.',
            'nombre_moral.required' => 'El campo Nombre, denominación o razón social es obligatorio.',
        ];



        if ($input['tipo'] == "fisica") {
            Validator::make($input, [
                'nombre' => ['required', 'string', 'max:255', new Les],
                'paterno' => ['required', 'string', 'max:255', new Les],
                'materno' => ['required', 'string', 'max:255', new Les],
                'rfc' => ['required', 'string', 'min:13', 'max:13', new Fisica, 'unique:cliente'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuario_sistema', 'unique:cliente'],
                'password' => ['required', 'string', Password::default(), 'confirmed'],
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            ], $messages)->validate();
        } else if ($input['tipo'] == "moral") {
            Validator::make($input, [
                'nombre_moral' => ['required', 'string', 'max:255'],
                'rfc' => ['required', 'string', 'min:12', 'max:12', new Moral, 'unique:cliente'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuario_sistema', 'unique:cliente'],
                'password' => ['required', 'string', Password::default(), 'confirmed'],
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            ], $messages)->validate();
        } else {
        }
        DB::beginTransaction();
        try {
            $usuario_sistema = User::create([
                'correo' => $input['correo'],
                'contraseña' => Hash::make($input['password']),
                'estatus' => 1,
                'idtipo_usuario' => 2
            ]);
            $id = DB::table('usuario_sistema')->where('correo', $input['correo'])->value('idusuario_sistema');

            if ($input['tipo'] == "fisica") {

                $razon = strtoupper($input['nombre']) . ' ' . strtoupper($input['materno']) . ' ' . strtoupper($input['materno']);

                $cliente = cliente::create([
                    'razon_social' => $razon,
                    'rfc' => $input['rfc'],
                    'tipo' => 1,
                    'correo' => $input['correo'],
                    'idusuario_sistema' => $id
                ]);
            } else if ($input['tipo'] == "moral") {

                $cliente = cliente::create([
                    'razon_social' => strtoupper($input['nombre_moral']),
                    'rfc' => $input['rfc'],
                    'tipo' => 2,
                    'correo' => $input['correo'],
                    'idusuario_sistema' => $id
                ]);
            } else {
                abort(500);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

        return $usuario_sistema;
    }
}
