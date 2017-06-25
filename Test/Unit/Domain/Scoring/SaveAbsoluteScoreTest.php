<?php

namespace Trial\Test\Unit\Domain\Scoring;

use Trial\Domain\Scoring\SaveAbsoluteScore;
use Trial\Model\Score;
use Trial\Test\Mock\ScoreRepositoryMock;
use Trial\Test\Mock\ValidatorMock;

class SaveAbsoluteScoreTest
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
        $saveAbsoluteScore = new SaveAbsoluteScore($this->validator, $this->repository);
        $saveAbsoluteScore->saveScore(1, 200);

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

        $saveAbsoluteScore = new SaveAbsoluteScore($this->validator, $this->repository);
        $saveAbsoluteScore->saveScore(1, 200);

        $saveCalls = $this->repository->getCalls('save');
        $expected = new Score(1, 200);
        if (count($saveCalls) != 1) {
            return false;
        }
        if ($expected != $saveCalls[0]['score']) {
            return false;
        }
    }

}
