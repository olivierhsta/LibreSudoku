<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;

class OneChoiceSolver implements SolverInterface
{
    public static function new(): self
    {
        return new self();
    }

    public function solve(Puzzle $puzzle)
    {
        return 'Solving with one choice';
    }
}
