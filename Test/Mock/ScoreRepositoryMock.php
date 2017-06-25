<?php

namespace Trial\Test\Mock;


use Trial\Model\Score;
use Trial\Repository\ScoreRepository;

class ScoreRepositoryMock extends BaseMock implements ScoreRepository
{

    private $scoreToReturn = null;

    public function getScores($from = 1, $to = null)
    {
        $this->functionCalls['getScores'][] = ["from" => $from, "to" => $to];
    }

    /**
     * @param $user
     * @return Score|null
     */
    public function getScoreByUser($user)
    {
        $this->functionCalls['getScoreByUser'][] = ["user"=> $user];
        return $this->scoreToReturn;
    }

    public function setScoreToReturn(Score $score)
    {
        $this->scoreToReturn = $score;
    }

    /**
     * @param Score $rankA
     * @param Score $rankB
     * @return mixed
     */
    public function sortRank(Score $rankA, Score $rankB)
    {
        $this->functionCalls['sortRank'][] = ["rankA" => $rankA, "rankB" => $rankB];
    }

    /**
     * @param Score $score
     */
    public function save(Score $score)
    {
        $this->functionCalls['save'][] = ["score"=> $score];
    }

    public function flush()
    {
        $this->functionCalls['flush'][] = [];
    }
}
