<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;

class AgeRequirement implements ValidationRule
{
    protected $age;

    public function __construct($age = 18)
    {
        $this->age = $age;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Carbon::parse($value)->age < $this->age) {
            $fail('Invalid Birthdate.');
        }
    }
}
