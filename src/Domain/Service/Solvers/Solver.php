<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;
use App\Domain\Entity\Solution;
use App\Domain\Value\Cell;

abstract class Solver
{
    /** @var Solver */
    private $nextSolver;

    abstract public function solve(Solution $solution): Solution;

    public static function new(): self
    {
        return new static();
    }

    public static function prepare(Puzzle $puzzle): Solution
    {
        $preparedGrid = $puzzle->getGrid();
        foreach ($puzzle->getGrid()->getCells() as $cell) {
            if ($cell->isEmpty()) {
                $buddies = $puzzle->getGrid()->getBuddiesOf($cell);
                $newCell = $cell->setCandidates(array_unique(array_values(array_map(function(Cell $buddy) {
                    return $buddy->getValue();
                }, $buddies))));
                $preparedGrid = $preparedGrid->setCell($newCell);
            }
        }

        return new Solution($puzzle);
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

    public function next(Solution $solution): Solution
    {
        if ($this->nextSolver) return $this->nextSolver->solve($solution);

        return $solution;
    }
}
