<?php

namespace App\Domain\Command\Puzzle;

use App\Domain\Command\Command;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Domain\Service\SolvabilityService;
use App\Domain\Service\DifficultyService;

/**
 * Command class to handle saving of a puzzle
 */
class SavePuzzleCommand implements Command
{

    /**
     * @var Puzzle
     */
    private $puzzle;

    /**
     * @var PuzzleRepository
     */
    private $puzzleRepository;

    function __construct(
        Puzzle $puzzle,
        PuzzleRepository $puzzleRepository
    ) {
        $this->puzzle = $puzzle;
        $this->puzzleRepository = $puzzleRepository;
    }

    public function handle(): Puzzle
    {
        $puzzle = $this->puzzleRepository->store(
            $this->puzzle
        );
        return $puzzle;
    }
}
