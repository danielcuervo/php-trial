<?php

namespace Trial\Domain\Scoring\Validator;

use Trial\Validator\Collection;
use Trial\Validator\GreaterThan;
use Trial\Validator\IsNumeric;
use Trial\Validator\NotNull;
use Trial\Validator\ValidatorInterface;

class SaveAbsoluteScoreValidator implements ValidatorInterface
{

    private $user;
    private $score;

    public function __construct($user, $score)
    {
        $this->user = $user;
        $this->score = $score;
    }

    public function validate()
    {
        $validator = new Collection([
            new NotNull($this->user, 'user'),
            new NotNull($this->score, 'score'),
            new IsNumeric($this->user),
            new IsNumeric($this->score),
            new GreaterThan($this->user, 0, 'user'),
            new GreaterThan($this->score, 0, 'score'),
        ]);

        $validator->validate();
    }

}
