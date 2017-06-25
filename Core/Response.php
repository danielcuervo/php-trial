<?php

namespace Trial\Core;

class Response
{

    private $code;

    private $body;

    public function __construct($code, $body)
    {
        $this->code = $code;
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return []
     */
    public function getBody()
    {
        return $this->body;
    }

}
