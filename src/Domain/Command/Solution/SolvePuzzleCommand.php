<?php

namespace App\Domain\Command\Solution;

use App\Domain\Entity\Puzzle;
use App\Domain\Service\Solvers\Solver;

/**
 * Command class to handle solving of a puzzle
 */
class SolvePuzzleCommand
{
    /**
     * @var Puzzle
     */
    public $puzzle;

    /**
     * @var Solver[]
     */
    public $solvers;

    function __construct(
        Puzzle $puzzle,
        array $solvers
    ) {
        $this->puzzle = $puzzle;
        $this->solvers = $solvers;
    }
}
