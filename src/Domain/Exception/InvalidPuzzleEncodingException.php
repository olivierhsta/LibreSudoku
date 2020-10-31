<?php

namespace App\Domain\Exception;

class InvalidPuzzleEncodingException extends \DomainException
{
    function __construct($code = 0, Exception $previous = null)
    {
        parent::__construct('Puzzle encoding must contain 81 elements (either numbers or array of max 9 numbers)', $code, $previous);
    }
}
