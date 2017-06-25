<?php

namespace Trial\Domain\Scoring;

use Trial\Model\Score;
use Trial\Repository\ScoreRepository;
use Trial\Validator\ValidatorInterface;

class SaveRelativeScore
{

    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var ScoreRepository
     */
    private $scoreRepository;

    public function __construct(ValidatorInterface $validator, ScoreRepository $scoreRepository)
    {
        $this->validator = $validator;
        $this->scoreRepository = $scoreRepository;
    }

    public function saveScore($user, $differential)
    {
        $this->validator->validate();

        $score = $this->scoreRepository->getScoreByUser($user);
        if ($score) {
            $score->setScore($score->getScore() + $differential);
        } else {
            $score = new Score($user, $differential);
        }

        $this->scoreRepository->save($score);
        $this->scoreRepository->flush();
    }

}
