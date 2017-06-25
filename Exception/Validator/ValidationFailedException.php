<?php

namespace Trial\Exception\Validator;

use Trial\Exception\ClientErrorInterface;

class ValidationFailedException extends \Exception implements ClientErrorInterface
{

}
