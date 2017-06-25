<?php

namespace Trial\Model;

class Score
{
    private $user;

    private $score;

    public function __construct($user, $score)
    {
        $this->user = $user;
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }


}
