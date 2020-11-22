<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;

class CompositeSolver implements SolverInterface
{
    /**
     * @var SolverInterface[]
     */
    private $solvers;

    public function __construct(array $solvers)
    {
        $this->solvers = $solvers;
    }

    public function solve(Puzzle $puzzle)
    {
        foreach ($this->solvers as $solver) {
            dd($solver->solve($puzzle));
        }
    }

    public function supports(): bool
    {
        return true;
    }
}
