<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;

class EliminationSolver extends Solver
{
    public function solve(Puzzle $puzzle): Puzzle
    {
        echo "Solving with elimination";
        $this->next($puzzle);
    }
}
