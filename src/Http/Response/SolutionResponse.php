<?php

namespace App\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\Entity\Puzzle;

class SolutionResponse extends JsonResponse
{
    const STATUS = 200;

    public function __construct(Puzzle $puzzle)
    {
        $data = [
            "id" => $puzzle->getPuzzleUuid()
        ];
        parent::__construct($data, self::STATUS);
    }
}
