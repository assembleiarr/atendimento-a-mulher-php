<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class Cpf implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {       
        $cpf = preg_replace("/[^0-9]/","", $value);

        $exists = \App\Models\Pessoa::where('cpf', $cpf)->first();

        if ($exists) {
            $fail(':attribute já cadastrado.');
        }
    }
}
