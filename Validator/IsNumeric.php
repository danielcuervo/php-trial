<?php

namespace Trial\Validator;

use Trial\Exception\Validator\ValidationFailedException;

class IsNumeric implements ValidatorInterface
{
    /**
     * @var
     */
    private $value;

    /**
     * IsInteger constructor.
     * @param $value
     */
    public function __construct($value) {

        $this->value = $value;
    }

    /**
     * @throws ValidationFailedException
     */
    public function validate()
    {
        if (!is_numeric($this->value)) {
            throw new ValidationFailedException(sprintf("The value should be an integer and is %s", $this->value));
        }
    }
}
