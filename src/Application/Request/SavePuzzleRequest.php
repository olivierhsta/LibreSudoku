<?php

namespace App\Application\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use App\Application\Request\RequestDto;

/**
 * API contract for the POST /puzzles/{encoding} endpoint
 */
class SavePuzzleRequest implements RequestDto
{
    /**
     * @Assert\NotBlank()
     */
    public $encoding;

    public function __construct(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $this->encoding = $data['encoding'] ?? '';
    }
}
