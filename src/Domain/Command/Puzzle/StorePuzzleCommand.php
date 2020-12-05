<?php

namespace App\Domain\Command\Puzzle;

use App\Domain\Command\Command;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Domain\Service\SolvabilityService;
use App\Domain\Service\DifficultyService;

/**
 * @method Puzzle puzzle()
 */
class StorePuzzleCommand extends Command
{

    /**
     * @var Puzzle
     */
    protected $puzzle;

    function __construct(
        Puzzle $puzzle
    ) {
        $this->puzzle = $puzzle;
    }
}
