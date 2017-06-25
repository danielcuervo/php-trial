<?php

namespace Trial\Test\Unit\Validator;

use Trial\Exception\Validator\ValidationFailedException;
use Trial\Validator\IsNumeric;

class IsNumericTest
{

    public function testValidateWhenIsNotNumericThrowException()
    {
        $exception = null;
        $isNumericValidator = new IsNumeric("test");
        try {
            $isNumericValidator->validate();
        } catch (ValidationFailedException $e) {
            $exception = $e;
        }

        if (empty($exception)) {
            return false;
        }
    }
    public function testValidateWhenIsNumericNoExceptionIsThrown()
    {
        $exception = null;
        $isNumericValidator = new IsNumeric("12");
        try {
            $isNumericValidator->validate();
        } catch (ValidationFailedException $e) {
            $exception = $e;
        }

        if (!empty($exception)) {
            return false;
        }
    }

}
