<?php

namespace App\Http\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use function Safe\sprintf;

class RequestDto
{
    /**
     * @var array|null
     */
    private $jsonData;

    public function __construct(Request $request) {
        $this->jsonData = json_decode($request->getContent(), true);
    }

    public function jsonData(): ?array
    {
        return $this->jsonData;
    }
}
