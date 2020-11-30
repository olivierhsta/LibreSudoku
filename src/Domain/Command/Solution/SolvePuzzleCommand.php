<?php

namespace App\Domain\Command\Solution;

use App\Domain\Entity\Puzzle;
use App\Domain\Value\Strategy;
use App\Domain\Service\Solvers\Solver;

/**
 * Command class to handle solving of a puzzle
 */
class SolvePuzzleCommand
{
    /**
     * @var Puzzle
     */
    protected $puzzle;

    /**
     * @var Strategy[]
     */
    protected $strategies;

    function __construct(
        Puzzle $puzzle,
        array $strategies
    ) {
        $this->puzzle = $puzzle;
        $this->strategies = $strategies;
    }
}
