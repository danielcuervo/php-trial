<?php

namespace Trial\Test\Unit\Validator;

use Trial\Exception\Validator\ValidationFailedException;
use Trial\Validator\GreaterThan;

class GreaterThanTest
{

    public function testValidateWhenFirstParameterIsNotGreaterThrowException()
    {
        $exception = null;
        $greatherThan = new GreaterThan(1, 2, 'field');
        try {
            $greatherThan->validate();
        } catch (ValidationFailedException $e) {
            $exception = $e;
        }

        if (empty($exception)) {
            return false;
        }
    }
    public function testValidateWhenFirstParameterIsGreaterNoExceptionIsThrown()
    {
        $exception = null;
        $greatherThan = new GreaterThan(2, 1, 'field');
        try {
            $greatherThan->validate();
        } catch (ValidationFailedException $e) {
            $exception = $e;
        }

        if (!empty($exception)) {
            return false;
        }
    }

}
