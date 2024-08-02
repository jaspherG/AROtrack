<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;

class ValidYearRange implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $currentYear = Carbon::now('Asia/Manila')->year;
        $previousYear = $currentYear - 1;
        // dd('Current Year: ' . $currentYear, 'Value: ' . $value, 'Prev: '. $previousYear);
        $value = (int) $value;

        // Check if the value is neither the current year nor the previous year
        if ($value > $currentYear+20) { // !== $previousYear
            $fail('The selected ' . $attribute . ' cannot be greater than the current year.');
            return;
        }
    }

    public function message(): string
    {
        return 'The selected academic year 1 must be the previous year.';
    }
}
