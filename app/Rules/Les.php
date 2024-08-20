<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Les implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {


        if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u', $value)) {
        } else {

            if ($attribute == 'nombre' || $attribute == 'newRegister.nombre' || $attribute == 'editRegister.nombre') {
                $fail('El campo nombre solo debe contener letras y espacios.');
            } else if ($attribute == 'paterno' || $attribute == 'newRegister.paterno' || $attribute == 'editRegister.paterno') {

                $fail('El campo Apellido paterno solo debe contener letras y espacios.');
            } else if ($attribute == 'materno' || $attribute == 'newRegister.materno' || $attribute == 'editRegister.materno') {

                $fail('El campo Apellido materno solo debe contener letras y espacios.');
            } else {

                $fail('El campo :attribute solo debe contener letras y espacios.');
            }
        }
    }
}
