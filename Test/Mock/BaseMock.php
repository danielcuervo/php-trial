<?php

namespace Trial\Test\Mock;

class BaseMock
{
    protected $functionCalls = [];

    public function getCalls($function)
    {
        if (!empty($this->functionCalls[$function])) {
            return $this->functionCalls[$function];
        }

        return [];
    }
}
