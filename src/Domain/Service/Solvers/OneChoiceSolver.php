<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;

class OneChoiceSolver implements SolverInterface
{
    /**
     * @var SolverInterface
     */
    public $decoratingSolver;

    public function __construct(SolverInterface $decoratingSolver)
    {
        $this->decoratingSolver = $decoratingSolver;
    }

    public function solve(Puzzle $puzzle)
    {
        return $decoratingSolver->solver() . ' and solving with one choice';
    }
}
