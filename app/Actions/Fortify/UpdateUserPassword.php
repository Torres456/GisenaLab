<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

     //Validate and update the user's contraseña.
     public function update(User $user, array $input): void
     {
         Validator::make($input, [
             'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                 if (! Hash::check($value, $user->password)) {
                     $fail(__('auth.password_incorrect'));
                 }
             }],
             'new_password' => $this->passwordRules(),
         ])->validate();

         $user->forceFill([
             //encriptar contrasena
             'password' => Hash::make($input['new_password']),
         ])->save();
     }
     

}
