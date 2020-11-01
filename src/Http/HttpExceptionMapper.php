<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\Response;
use App\Domain\Exception\PuzzleAlreadyExistsException;

class HttpExceptionMapper
{
    private const MAPPING = [
        PuzzleAlreadyExistsException::class => Response::HTTP_CONFLICT
    ];

    public static function fromClassName(string $className)
    {
        return static::MAPPING[$className] ?? Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
