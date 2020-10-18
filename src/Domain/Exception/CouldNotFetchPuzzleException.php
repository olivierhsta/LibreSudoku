<?php

namespace App\Domain\Exception;

use Ramsey\Uuid\UuidInterface;

class CouldNotFetchPuzzleException extends \DomainException
{
    function __construct(UuidInterface $uuid, $code = 0, \Exception $previous = null)
    {
        parent::__construct('Could not fetch Puzzle with id ' . $uuid, $code, $previous);
    }
}
