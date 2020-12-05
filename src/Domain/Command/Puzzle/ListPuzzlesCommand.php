<?php

namespace App\Domain\Command\Puzzle;

use App\Domain\Value\Difficulty;
use Ramsey\Uuid\UuidInterface;
use App\Domain\Command\Command;

/**
 * @method Difficulty difficulty()
 * @method bool solvable()
 */
class ListPuzzlesCommand extends Command
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
