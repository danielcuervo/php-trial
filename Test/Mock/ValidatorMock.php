<?php

namespace Trial\Test\Mock;

use Trial\Validator\ValidatorInterface;

class ValidatorMock extends BaseMock implements ValidatorInterface
{

    public function validate()
    {
        $this->functionCalls['validate'][] = true;
    }
}
