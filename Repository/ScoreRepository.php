<?php


namespace Trial\Repository;


use Trial\Model\Score;

interface ScoreRepository
{

    /**
     * @param $user
     * @return Score|null
     */
    public function getScoreByUser($user);

    /**
     * @param int $from
     * @param null $to
     * @return Score[]
     */
    public function getScores($from = 1, $to = null);

    /**
     * @param Score $rankA
     * @param Score $rankB
     * @return mixed
     */
    public function sortRank(Score $rankA, Score $rankB);

    /**
     * @param Score $score
     */
    public function save(Score $score);

    public function flush();

}