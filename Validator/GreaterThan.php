<?php

namespace Trial\Validator;

use Trial\Exception\Validator\ValidationFailedException;

class GreaterThan implements ValidatorInterface
{

    /**
     * @var
     */
    private $greaterNumber;

    /**
     * @var
     */
    private $lowerNumber;
    /**
     * @var
     */
    private $field;

    public function __construct($greaterNumber, $lowerNumber, $field)
    {
        $this->greaterNumber = $greaterNumber;
        $this->lowerNumber = $lowerNumber;
        $this->field = $field;
    }

    public function validate()
    {
        if ($this->greaterNumber <= $this->lowerNumber) {
            throw new ValidationFailedException(
                sprintf(
                    "%s has to be greater than %s", $this->field, $this->lowerNumber
                )
            );
        }
    }
}
