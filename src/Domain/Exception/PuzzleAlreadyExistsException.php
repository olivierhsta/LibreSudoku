<?php

namespace App\Domain\Exception;

use DomainException;

class PuzzleAlreadyExistsException extends DomainException
{
    function __construct(string $encoding, $code = 0, Exception $previous = null)
    {
        parent::__construct('Puzzle with encoding ' . $encoding . ' already exists.', $code, $previous);
    }
}
