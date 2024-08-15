<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Fisica implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\s]+$/u', $value)) {

            if (strlen($value) == '13') {

                $primerosCaracteres = substr($value, 0, 4);

                $SegundosCaracteres = substr($value, 5, 5);


                if (preg_match('/^[a-zA-ZñÑ]+$/u', $primerosCaracteres)) {
                } else {
                    $fail('Estructura del RFC incorrecta.');
                }

                if (is_numeric($SegundosCaracteres)) {
                } else {
                    $fail('Estructura del RFC incorrecta.');
                }
            } else if (strlen($value) == '12') {

                $primerosCaracteres = substr($value, 0, 2);

                $SegundosCaracteres = substr($value, 3, 6);



                if (preg_match('/^[a-zA-ZñÑ]+$/u', $primerosCaracteres)) {
                } else {
                    $fail('Estructura del RFC incorrecta.');
                }

                if (is_numeric($SegundosCaracteres)) {
                } else {
                    $fail('Estructura del RFC incorrecta.');
                }
            }
        } else {
            $fail('Estructura del RFC incorrecta.');
        }
    }
}
