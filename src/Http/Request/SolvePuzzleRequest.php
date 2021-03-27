<?php

namespace App\Http\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use UnexpectedValueException;

class SolvePuzzleRequest extends RequestDto
{
    /**
     * @var array
     */
    public $strategies;

    function __construct(Request $request)
    {
        parent::__construct($request);

        $this->strategies = $this->jsonData()['strategies'] ?? [];
    }
}
