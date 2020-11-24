<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;

class EliminationSolver implements SolverInterface
{
    public function solve(Puzzle $puzzle)
    {
        return "solving with elimination";
    }
}
