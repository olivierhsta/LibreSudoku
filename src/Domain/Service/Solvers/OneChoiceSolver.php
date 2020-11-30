<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Solution;

class OneChoiceSolver extends Solver
{
    public function solve(Solution $solution): Solution
    {
        echo 'Solving with one choice';
        $this->next($solution);
    }
}
