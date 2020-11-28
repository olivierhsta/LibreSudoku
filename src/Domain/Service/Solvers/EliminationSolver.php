<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;

class EliminationSolver implements SolverInterface
{
    public static function new(): self
    {
        return new self();
    }

    public function solve(Puzzle $puzzle)
    {
        return "Solving with elimination";
    }
}
