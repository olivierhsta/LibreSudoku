<?php

namespace App\Http\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use UnexpectedValueException;

class SolvePuzzleRequest implements RequestDto
{
    /**
     * @var array
     */
    public $strategies;

    function __construct(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $this->strategies = $data['strategies'] ?? [];
    }
}
