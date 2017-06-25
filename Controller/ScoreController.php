<?php

namespace Trial\Controller;

use Trial\Domain\Scoring\GetScores;
use Trial\Domain\Scoring\SaveAbsoluteScore;
use Trial\Domain\Scoring\Validator\GetRequestValidator;
use Trial\Domain\Scoring\Validator\SaveAbsoluteScoreValidator;
use Trial\Domain\Scoring\Validator\SaveRelativeScoreValidator;
use Trial\Core\Request;
use Trial\Core\Response;
use Trial\Domain\Scoring\SaveRelativeScore;
use Trial\Model\Score;
use Trial\Repository\InMemoryScoreRepository;

class ScoreController
{

    public function __construct($database, $scoreRepository = null)
    {
        $this->scoreRepository = $scoreRepository ? : new InMemoryScoreRepository($database);
    }

    public function get(Request $request)
    {
        $from = $request->get('from', 1);
        $to = $request->get('to', null);

        $getScores = new GetScores(
            new GetRequestValidator($from, $to),
            $this->scoreRepository
        );
        $scores = $getScores->get($from, $to);

        return new Response(200, $scores);
    }

    public function saveAbsolute(Request $request)
    {
        $user = $request->get('user');
        $score = $request->get('score');

        $saveAbsoluteScore = new SaveAbsoluteScore(
            new SaveAbsoluteScoreValidator($user, $score),
            $this->scoreRepository
        );
        $saveAbsoluteScore->saveScore($user, $score);

        return new Response(200, []);
    }

    public function saveRelative(Request $request)
    {
        $user = $request->get('user');
        $score = $request->get('score');

        $saveRelativeScore = new SaveRelativeScore(
          new SaveRelativeScoreValidator($user, $score),
            $this->scoreRepository
        );
        $saveRelativeScore->saveScore($user, $score);
        return new Response(200, []);
    }

}
