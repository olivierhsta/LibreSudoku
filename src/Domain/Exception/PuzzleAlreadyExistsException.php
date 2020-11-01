<?php

namespace App\Domain\Exception;

use DomainException;

class PuzzleAlreadyExistsException extends DomainException
{
    function __construct(string $message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
