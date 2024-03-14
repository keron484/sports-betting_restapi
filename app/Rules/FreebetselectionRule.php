<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\ValidationException;
class FreebetselectionRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach($value as $picks){
             if($picks['odds'] < 1.70){
                  throw ValidationException::withMessages([
                    'selections' => 'Your picks does not meet the minimum requirements'
                  ]);
             }
        }
        
    }
}
