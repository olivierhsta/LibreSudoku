<?php

namespace App\Domain\Command\Solution;

use App\Domain\Entity\Puzzle;

/**
 * Command class to handle solving of a puzzle
 */
class SolvePuzzleCommand
{
    /**
     * @var Puzzle
     */
    public $puzzle;

    function __construct(
        Puzzle $puzzle
    ) {
        $this->puzzle = $puzzle;
    }
}
