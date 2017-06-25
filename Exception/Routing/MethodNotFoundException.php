<?php

namespace Trial\Exception\Routing;

use Trial\Exception\ClientErrorInterface;

class MethodNotFoundException extends \Exception implements ClientErrorInterface
{

    public function __construct()
    {
        parent::__construct("Method requested has no actions binded");
    }
}
