<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;
use App\Domain\Entity\Solution;

abstract class Solver
{
    /** @var Solver */
    private $nextSolver;

    abstract public function solve(Solution $solution): Solution;

    public final function __construct() {}

    public static function new(): self
    {
        return new static();
    }

    public static function prepare(Puzzle $puzzle): Solution
    {
        foreach ($puzzle->getGrid() as $cell) {
            $puzzle->getGrid()->getBuddiesOf($cell);
        }
        return $puzzle->getGrid();
    }

    public function setNext(?Solver $nextSolver): self
    {
        $this->nextSolver = $nextSolver;

        return $this;
    }

    public function getNext(): ?Solver
    {
        return $this->nextSolver;
    }

    public function next(Solution $solution)
    {
        if ($this->$nextSolver) return $this->$nextSolver->solve($solution);
    }
}
