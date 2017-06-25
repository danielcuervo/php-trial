<?php

namespace Trial\Test\Unit\Validator;

use Trial\Test\Mock\ValidatorMock;
use Trial\Validator\Collection;

class CollectionTest
{

    public function testValidate()
    {
        $validatorA = new ValidatorMock();
        $validatorB = new ValidatorMock();

        $collection = new Collection([$validatorA, $validatorB]);
        $collection->validate();

        if (count($validatorA->getCalls('validate')) != 1) {
            return false;
        }

        if (count($validatorB->getCalls('validate')) != 1) {
            return false;
        }
    }

}
