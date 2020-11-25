<?php

namespace App\Http\Request;

use Symfony\Component\HttpFoundation\Request;
use App\Http\Request\RequestDto;

/**
 * API contract for the GET /puzzles endpoint
 */
class ListPuzzlesRequest implements RequestDto
{
    /**
     * @var array
     */
    public $criteria;

    function __construct(Request $request)
    {
        $this->criteria['difficulty'] = $request->query->get('difficulty');
        $this->criteria['solvable'] = $request->query->get('solvable');
    }
}
