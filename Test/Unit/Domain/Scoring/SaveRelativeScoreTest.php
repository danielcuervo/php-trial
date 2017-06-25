<?php

namespace Trial\Test\Unit\Domain\Scoring;

use Trial\Domain\Scoring\SaveRelativeScore;
use Trial\Model\Score;
use Trial\Test\Mock\ScoreRepositoryMock;
use Trial\Test\Mock\ValidatorMock;

class SaveRelativeScoreTest
{

    /**
     * @var ValidatorMock
     */
    private $validator;
    /**
     * @var ScoreRepositoryMock
     */
    private $repository;

    public function setUp()
    {
        $this->validator = new ValidatorMock();
        $this->repository = new ScoreRepositoryMock();
    }

    public function testSaveScoreNonExisting()
    {
        $this->setUp();
        $saveRelativeScore = new SaveRelativeScore($this->validator, $this->repository);
        $saveRelativeScore->saveScore(1, 200);

        $saveCalls = $this->repository->getCalls('save');
        $expected = new Score(1, 200);
        if (count($saveCalls) != 1) {
            return false;
        }
        if ($expected != $saveCalls[0]['score']) {
            return false;
        }
    }

    public function testSaveScoreExisting()
    {
        $this->setUp();
        $this->repository->setScoreToReturn(new Score(1, 100));

        $saveRelativeScore = new SaveRelativeScore($this->validator, $this->repository);
        $saveRelativeScore->saveScore(1, 200);

        $saveCalls = $this->repository->getCalls('save');
        $expected = new Score(1, 300);
        if (count($saveCalls) != 1) {
            return false;
        }
        if ($expected != $saveCalls[0]['score']) {
            return false;
        }
    }

}
