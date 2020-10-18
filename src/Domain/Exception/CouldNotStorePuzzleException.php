<?php

namespace App\Domain\Exception;

class CouldNotStorePuzzleException extends \DomainException
{
    function __construct($code = 0, Exception $previous = null)
    {
        parent::__construct('Could not store Puzzle', $code, $previous);
    }
}
