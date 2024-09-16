<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use App\Rules\Password;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    //Validate and update the user's contraseña.
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (! Hash::check($value, $user->contraseña)) {
                    $fail(__('Contraseña incorrecta'));
                }
            }],
            'password' => ['required', 'string', Password::default(), 'confirmed'],
        ])->validate();

        $user->forceFill([
            //encriptar contrasena
            'contraseña' => Hash::make($input['password']),
        ])->save();
    }
}
