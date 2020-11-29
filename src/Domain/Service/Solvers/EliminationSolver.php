<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;

class EliminationSolver extends Solver
{
    public static function new(): self
    {
        return new self();
    }

    public function solve(Puzzle $puzzle)
    {
        echo "Solving with elimination";
        $this->next();
    }
}
