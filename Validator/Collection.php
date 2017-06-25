<?php

namespace Trial\Validator;

class Collection implements ValidatorInterface
{

    /**
     * @var ValidatorInterface[]
     */
    private $validators;

    public function __construct(array $validators)
    {

        $this->validators = $validators;
    }

    public function validate()
    {
        foreach ($this->validators as $validator) {
            if ($validator instanceof ValidatorInterface) {
                $validator->validate();
            }
        }
    }

}
