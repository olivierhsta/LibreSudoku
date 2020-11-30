<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Solution;

class EliminationSolver extends Solver
{
    public function solve(Solution $solution): Solution
    {
        echo "Solving with elimination";
        $this->next($solution);
    }
}
