<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\cliente;
use App\Models\contacto;
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
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'nombre.max' => 'El campo Nombre, no debe ser mayor que 255 caracteres.',
            'paterno.required' => 'El campo Apellido paterno es obligatorio.',
            'paterno.max' => 'El campo Apellido paterno, no debe ser mayor que 255 caracteres.',
            'materno.required' => 'El campo Apellido materno, debe ser obligatorio.',
            'materno.max' => 'El campo Apellido materno, no debe ser mayor que 255 caracteres.',
            'rfc.required' => 'El campo RFC es obligatorio.',
            'rfc.min' => 'El campo RFC debe contener como minimo 12 caracteres.',
            'rfc.max' => 'El campo RFC debe contener como maximo 13 caracteres.',
            'rfc.unique' => 'El campo RFC ya ha sido registrado.',
        ];

        $validator = Validator::make($input, [
            'nombre' => ['required', 'string', 'max:255', new Les],
            'paterno' => ['required', 'string', 'max:255', new Les],
            'materno' => ['required', 'string', 'max:255', new Les],
            'rfc' => ['required', 'string', 'min:12', 'max:13', new Fisica, 'unique:cliente'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuario_sistema', 'unique:cliente', 'unique:contacto'],
            'password' => ['required', 'string', Password::default(), 'confirmed'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ], $messages)->validate();

        DB::beginTransaction();
        try {
            $usuario_sistema = User::create([
                'nombre' => $input['nombre'],
                'ap_paterno' => $input['paterno'],
                'ap_materno' => $input['materno'],
                'correo' => $input['correo'],
                'contraseña' => Hash::make($input['password']),
                'estatus' => 1,
                'id_tipo_usuario' => 2
            ]);

            $id = DB::table('usuario_sistema')->where('correo', $input['correo'])->value('id_usuario_sistema');

            //Persona fisica
            if (strlen($input['rfc']) == '13') {

                $contacto = contacto::create([
                    'nombre' => $input['nombre'],
                    'ap_paterno' => $input['paterno'],
                    'ap_materno' => $input['materno'],
                    'correo' => $input['correo']
                ]);

                $id2 = DB::table('contacto')->where('correo', $input['correo'])->value('id_contacto');

                $cliente = cliente::create([
                    'rfc' => strtoupper($input['rfc']),
                    'tipo' => 1,
                    'correo' => $input['correo'],
                    'id_usuario_sistema' => $id,
                    'id_contacto' => $id2
                ]);

                //Persona moral
            } else if (strlen($input['rfc']) == '12') {

                $cliente = cliente::create([
                    'rfc' => strtoupper($input['rfc']),
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
            abort(500);
        }

        return $usuario_sistema;
    }
}
