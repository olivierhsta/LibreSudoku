<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;
use App\Domain\Value\Cell;
use App\Domain\Value\Strategy;

abstract class Solver
{
    /** @var Solver */
    private $nextSolver;

    private static function findCandidates(array $buddies)
    {
        return array_diff(
            Cell::FULL_SET,
            array_unique(array_values(array_map(function(Cell $buddy) {
                return $buddy->getValue();
            }, $buddies)))
        );
    }

    abstract public function solve(Puzzle $puzzle): Puzzle;

    public static function new(): self
    {
        return new static();
    }

    /**
     * This function is used to place candidates on the grid.  Most solvers need them
     * to perform their algorithm.  Not preparing puzzle will result in sub-optimal solving.
     */
    public static function prepare(Puzzle $puzzle): Puzzle
    {
        foreach ($puzzle->getGrid()->getCells() as $cell) {
            if ($cell->isEmpty()) {
                $buddies = $puzzle->getGrid()->getBuddiesOf($cell);
                $newCell = $cell->setCandidates(self::findCandidates($buddies));
                $puzzle->fill($newCell, Strategy::NULL());
            }
        }
        return $puzzle;
    }

    public function followedBy(?Solver $nextSolver): self
    {
        $this->nextSolver = $nextSolver;

        return $this;
    }

    public function getNext(): ?Solver
    {
        return $this->nextSolver;
    }

    public function next(Puzzle $puzzle): Puzzle
    {
        if ($this->nextSolver) return $this->nextSolver->solve($puzzle);

        return $puzzle;
    }
}
