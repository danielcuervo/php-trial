<?php

namespace Trial\Domain\Scoring;

use Trial\Repository\ScoreRepository;
use Trial\Validator\ValidatorInterface;

class GetScores
{

    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var ScoreRepository
     */
    private $scoreRepository;

    /**
     * @param ValidatorInterface $validator
     * @param ScoreRepository $scoreRepository
     */
    public function __construct(ValidatorInterface $validator, ScoreRepository $scoreRepository)
    {
        $this->validator = $validator;
        $this->scoreRepository = $scoreRepository;
    }

    public function get($from, $to)
    {
        $this->validator->validate();

        $scores = $this->scoreRepository->getScores($from, $to);

        $responseScores = [];
        foreach ($scores as $rank => $score) {
            $responseScores[] = ["user" => $score->getUser(), "score" => $score->getScore()];
        }

        return $responseScores;
    }

}
