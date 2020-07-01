<?php

namespace App\Application\Request;

use Symfony\Component\HttpFoundation\Request;

interface RequestDto
{
    public function __construct(Request $request);
}
