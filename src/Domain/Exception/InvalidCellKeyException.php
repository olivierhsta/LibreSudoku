<?php

namespace App\Domain\Exception;

use DomainException;
use Throwable;
use function Safe\sprintf;

class InvalidCellKeyException extends DomainException
{
    public function __construct(int $value, Throwable $previous = null)
    {
        parent::__construct(sprintf("%s is an invalid cell key.", $value), 0, $previous);
    }
}