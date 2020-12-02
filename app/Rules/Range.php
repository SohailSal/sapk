<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Year;

class Range implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $year = Year::where('company_id',session('company_id'))->where('enabled',1)->first();
        return (($value >= $year->begin) && ($value <= $year->end));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Date must be within active fiscal-year range.';
    }
}
