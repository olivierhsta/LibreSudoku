<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;

abstract class Solver
{
    /** @var Solver */
    private $nextSolver;

    abstract public function solve(Puzzle $puzzle);

    public function setNext(Solver $nextSolver): self
    {
        $this->nextSolver = $nextSolver;
    }

    public function next(Puzzle $puzzle)
    {
        if ($this->$nextSolver) return $this->$nextSolver->solve($puzzle);
    }
}
