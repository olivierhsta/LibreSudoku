<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;

class OneChoiceSolver implements SolverInterface
{
    public function solve(Puzzle $puzzle)
    {
        return 'solving with one choice';
    }

    public function supports(): bool
    {
        return true;
    }
}
