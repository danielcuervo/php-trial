<?php

namespace Trial\Exception\Routing;

use Trial\Exception\ClientErrorInterface;

class PathNotFoundException extends \Exception implements ClientErrorInterface
{

    public function __construct()
    {
        parent::__construct("Path requested does not exists");
    }

}
