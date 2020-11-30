<?php

namespace App\Domain\Command\Puzzle;

use App\Domain\Value\Difficulty;
use Ramsey\Uuid\UuidInterface;

/**
 * Command class to define fetching of a list of puzzles
 */
class ListPuzzlesCommand
{
    /**
     * @var Difficulty
     */
    protected $difficulty;

    /**
     * @var bool
     */
    protected $solvable;

    function __construct(?Difficulty $difficulty, ?bool $solvable)
    {
        $this->difficulty = $difficulty;
        $this->solvable = $solvable;
    }
}
