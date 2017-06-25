<?php

namespace Trial\Test\Unit\Repository;

use Trial\Core\Database;
use Trial\Model\Score;
use Trial\Repository\InMemoryScoreRepository;
use Trial\Test\Mock\DatabaseMock;

class InMemoryStoreRepositoryTest
{

    const SCORES = ["1" => 23, "2" => 503, "3" => 256, "4" => 333];

    /**
     * @var DatabaseMock
     */
    private $database;

    public function setUp()
    {
        $this->database = new DatabaseMock();
        $this->database->setScores(self::SCORES);
    }

    public function testGetScoreByUserFound()
    {
        $this->setUp();

        $storeRepository = new InMemoryScoreRepository($this->database);
        $score = $storeRepository->getScoreByUser(3);

        if ($score->getScore() != 256) {
            return false;
        }
    }

    public function testGetScoreByUserNotFound()
    {
        $this->setUp();

        $storeRepository = new InMemoryScoreRepository($this->database);
        $score = $storeRepository->getScoreByUser(8);

        if ($score !==  null) {
            return false;
        }
    }

    public function testGetScoresFrom()
    {
        $this->setUp();

        $storeRepository = new InMemoryScoreRepository($this->database);
        $scores = $storeRepository->getScores(2);

        $expected = [
            new Score("4", 333),
            new Score("3", 256),
            new Score("1", 23),
        ];

        if ($scores != $expected) {
            return false;
        }
    }

    public function testGetScoresFromTo()
    {
        $this->setUp();

        $storeRepository = new InMemoryScoreRepository($this->database);
        $scores = $storeRepository->getScores(1, 2);

        $expected = [
            new Score("2", 503),
            new Score("4", 333),
        ];

        if ($scores != $expected) {
            return false;
        }
    }

    public function testSortRankLesserOrEqual()
    {
        $this->setUp();

        $storeRepository = new InMemoryScoreRepository($this->database);
        $result = $storeRepository->sortRank(
            new Score(1, 25), new Score(1, 25)
        );

        if ($result !== 1) {
            return false;
        }
    }

    public function testSortRankGreater()
    {
        $this->setUp();

        $storeRepository = new InMemoryScoreRepository($this->database);
        $result = $storeRepository->sortRank(
            new Score(1, 25), new Score(1, 22)
        );

        if ($result !== -1) {
            return false;
        }
    }

    public function testSaveExisting()
    {
        $this->setUp();

        $storeRepository = new InMemoryScoreRepository($this->database);
        $storeRepository->save(new Score(1, 48));

        $score = $storeRepository->getScoreByUser(1);

        if ($score->getScore() != 48) {
            return false;
        }
    }

    public function testSaveNonExisting()
    {
        $this->setUp();

        $storeRepository = new InMemoryScoreRepository($this->database);
        $storeRepository->save(new Score(8, 48));

        $score = $storeRepository->getScoreByUser(8);

        if ($score->getScore() != 48) {
            return false;
        }
    }

    public function testFlush()
    {
        $this->setUp();

        $storeRepository = new InMemoryScoreRepository($this->database);
        $storeRepository->flush();

        $calls = $this->database->getCalls('record');

        if (count($calls) != 1) {
            return false;
        }

        if ($calls[0]['record'] != self::SCORES) {
            return false;
        }
    }


}
