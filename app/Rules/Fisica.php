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
        $primerosCaracteres = substr($value, 0, 4);

        $SegundosCaracteres = substr($value, 5, 5);


        if ($value != strtoupper($value)) {
            $fail('El campo RFC debe contener puras mayúsculas.');
        }

        if (preg_match('/^[a-zA-Z]+$/u', $primerosCaracteres)) {
        } else {
            $fail('Campo RFC incorrecto.');
        }

        if (is_numeric($SegundosCaracteres)) {
        } else {
            $fail('Campo RFC incorrecto.');
        }
    }
}
