<?php

namespace App\Domain\Exception;

use App\Domain\Value\Difficulty;

class InvalidDifficultyException extends \DomainException
{

    function __construct($code = 0, Exception $previous = null)
    {
        parent::__construct(sprintf('Difficulty metric must be between %d and %d', Difficulty::getMin(), Difficulty::getMax()), $code, $previous);
    }
}
