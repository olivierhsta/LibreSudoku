<?php

namespace App\Http\Request;

use Symfony\Component\HttpFoundation\Request;

interface RequestDto
{
    public function __construct(Request $request);
}
