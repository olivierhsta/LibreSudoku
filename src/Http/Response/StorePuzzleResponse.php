<?php

namespace App\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\Entity\Puzzle;

class StorePuzzleResponse extends JsonResponse
{
    const STATUS = 201;

    public function __construct(Puzzle $puzzle)
    {
        $data = [
            "id" => $puzzle->getPuzzleUuid(),
            "encoding" => $puzzle->getGrid()->getEncoding(),
            "difficulty" => $puzzle->getDifficulty()->getValue(),
            "solvable" => $puzzle->getSolvable()
        ];
        parent::__construct($data, self::STATUS);
    }
}
