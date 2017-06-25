<?php

namespace Trial\Validator;

use Trial\Exception\Validator\ValidationFailedException;

class NotNull implements ValidatorInterface
{
    /**
     * @var
     */
    private $value;
    /**
     * @var
     */
    private $field;

    public function __construct($value, $field)
    {
        $this->value = $value;
        $this->field = $field;
    }

    public function validate()
    {
        if (is_null($this->value)) {
            throw new ValidationFailedException(sprintf("%s value cannot be empty", $this->field));
        }
    }
}
