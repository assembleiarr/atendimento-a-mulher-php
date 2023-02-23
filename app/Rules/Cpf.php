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
        $cpf = preg_replace( '/[^0-9]/is', '', $value );

        if(!$this->validaCPF($cpf))
        {
            $fail(':attribute inválido.');
        }
         
        // $cpf = preg_replace("/[^0-9]/","", $value);

        // $exists = \App\Models\Pessoa::where('cpf', $cpf)->first();

        // if ($exists) {
        //     $fail(':attribute já cadastrado.');
        // }
        
    }

    public function validaCPF($cpf) { 
       
        if (strlen($cpf) != 11) {
            return false;
        }
    
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;    
    }
}
