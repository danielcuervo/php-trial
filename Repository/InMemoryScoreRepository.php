<?php

namespace Trial\Repository;

use Trial\Core\Database;
use Trial\Model\Score;

class InMemoryScoreRepository implements ScoreRepository
{
    /**
     * @var Score[]
     */
    private $scores = [];

    /**
     * @var Score[]
     */
    private $rank = [];

    /**
     * @var Database
     */
    private $database;

    /**
     * {@inheritdoc}
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->loadScoresFromDatabase();
    }

    /**
     * {@inheritdoc}
     */
    public function getScoreByUser($user)
    {
        if (empty($this->scores[$user])) {
            return null;
        }
        return $this->scores[$user];
    }

    /**
     * {@inheritdoc}
     */
    public function getScores($from = 1, $to = null)
    {
        $from--;

        if ($to === null) {
            return array_slice($this->rank, $from);
        }

        return array_slice($this->rank, $from, $to - $from);
    }

    /**
     * {@inheritdoc}
     */
    public function sortRank(Score $rankA, Score $rankB)
    {
        if ($rankA->getScore() > $rankB->getScore()) {
            return -1;
        }

        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Score $score)
    {
        $this->scores[$score->getUser()] = $score;
    }

    public function flush()
    {
        $storeScores = [];
        foreach ($this->scores as $user => $score) {
            $storeScores[$user] = $score->getScore();
        }
        $this->database->record($storeScores);
    }

    private function loadScoresFromDatabase()
    {
        if ($scores = $this->database->load()) {
            foreach ($scores as $user => $score) {
                $scoreObject = new Score($user, $score);
                $this->scores[$user] = $scoreObject;
                $this->rank[] = $scoreObject;
            }

            usort($this->rank, [$this, "sortRank"]);
            return;
        }
    }

}
