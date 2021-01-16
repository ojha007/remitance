<?php

namespace Modules\Backend\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequiredIf implements Rule
{

    private $check;
    private $condition;

    /**
     * Create a new rule instance.
     *
     * @param $check
     * @param $condition
     */
    public function __construct($check, $condition)
    {

        $this->check = $check;
        $this->condition = $condition;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if ($this->condition == $this->check) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute is required when ' .$this->check. ' is selected.';
    }
}
