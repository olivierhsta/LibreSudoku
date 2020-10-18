<?php

namespace App\Domain\Command\Puzzle;

use App\Domain\Command\Command;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Domain\Service\SolvabilityService;
use App\Domain\Service\DifficultyService;

/**
 * Command class to define saving of a puzzle
 */
class StorePuzzleCommand
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
