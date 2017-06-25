<?php

namespace Trial\Domain\Scoring\Validator;

use Trial\Validator\Collection;
use Trial\Validator\GreaterThan;
use Trial\Validator\IfCollection;
use Trial\Validator\IsNumeric;
use Trial\Validator\NotNull;
use Trial\Validator\ValidatorInterface;

class GetRequestValidator implements ValidatorInterface
{

    /**
     * @var
     */
    private $from;
    /**
     * @var
     */
    private $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function validate()
    {
        $getRequestValidator = new Collection([
            new IfCollection(
                new NotNull($this->to, 'to'),
                new Collection(
                    [
                        new IsNumeric($this->to),
                        new GreaterThan($this->to, $this->from, 'to'),
                        new GreaterThan($this->to, 0, 'to'),
                    ]
                )
            ),
            new IfCollection(
                new NotNull($this->from, 'from'),
                new Collection(
                    [
                        new IsNumeric($this->from),
                        new GreaterThan($this->from, 0, 'from'),
                    ]
                )
            ),
        ]);

        $getRequestValidator->validate();
    }

}
