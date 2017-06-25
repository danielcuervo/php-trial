<?php

namespace Trial\Test\Mock;

use Trial\Core\Database;

class DatabaseMock extends BaseMock implements Database
{

    private $scores = [];

    public function lock()
    {
        $this->functionCalls['lock'][] = [];
    }

    public function unlock()
    {
        $this->functionCalls['unlock'][] = [];
    }

    public function load()
    {
        $this->functionCalls['load'][] = [];
        return $this->scores;
    }

    public function record(array $records)
    {
        $this->functionCalls['record'][] = ["record"=> $records];
    }

    /**
     * @return array
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * @param array $scores
     */
    public function setScores($scores)
    {
        $this->scores = $scores;
    }


}
