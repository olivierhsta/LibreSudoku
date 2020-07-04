<?php

namespace App\Domain\Command;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Implementatble definition of a Command
 */
interface Command
{
    public function handle(): JsonResponse;
}
