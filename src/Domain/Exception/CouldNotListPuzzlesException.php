<?php

namespace App\Domain\Exception;

class CouldNotListPuzzlesException extends \DomainException
{
    function __construct(array $criteria, $code = 0, \Exception $previous = null)
    {
        parent::__construct('Could not fetch Puzzles with criteria ' . $criteria, $code, $previous);
    }
}
