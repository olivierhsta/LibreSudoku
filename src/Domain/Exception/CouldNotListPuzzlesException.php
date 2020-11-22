<?php

namespace App\Domain\Exception;

use function Safe\json_encode;
use Exception;

class CouldNotListPuzzlesException extends \DomainException
{
    function __construct(array $criteria, $code = 0, Exception $previous = null)
    {
        parent::__construct('Could not fetch Puzzles with criteria ' . json_encode($criteria), $code, $previous);
    }
}
