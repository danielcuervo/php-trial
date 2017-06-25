<?php

namespace Trial\Validator;

use Trial\Exception\Validator\ValidationFailedException;

class IfCollection implements ValidatorInterface
{

    /**
     * @var
     */
    private $conditionalValidation;
    /**
     * @var Collection
     */
    private $validator;

    public function __construct(ValidatorInterface $conditionalValidation, Collection $validator)
    {
        $this->conditionalValidation = $conditionalValidation;
        $this->validator = $validator;
    }

    public function validate()
    {
        try {
            $this->conditionalValidation->validate();
        } catch (ValidationFailedException $e) {
            return;
        }

        $this->validator->validate();
    }
}
