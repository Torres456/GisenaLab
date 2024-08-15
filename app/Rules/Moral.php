<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Moral implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $primerosCaracteres = substr($value, 0, 2);

        $SegundosCaracteres = substr($value, 3, 6);



        if (preg_match('/^[a-zA-Z]+$/u', $primerosCaracteres)) {
        } else {
            $fail('El campo RFC no pertenece a una persona moral.');
        }

        if (is_numeric($SegundosCaracteres)) {
        } else {
            $fail('El campo RFC no pertenece a una persona moral.');
        }
    }
}
