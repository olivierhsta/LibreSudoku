<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;

class OneChoiceSolver extends Solver
{
    public function solve(Puzzle $puzzle): Puzzle
    {
        echo 'Solving with one choice';
        $this->next($puzzle);
    }
}
