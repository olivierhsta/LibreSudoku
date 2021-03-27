<?php

namespace App\Http\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;
use function Safe\sprintf;

/**
 * API contract for the POST /puzzles endpoint
 */
class StorePuzzleRequest extends RequestDto
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("array")
     * @Assert\Count(81)
     */
    public $encoding;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $data = json_decode($request->getContent(), true);

        $this->encoding = $data['encoding'];
    }
}
