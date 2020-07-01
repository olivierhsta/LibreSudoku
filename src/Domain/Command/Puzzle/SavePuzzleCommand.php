<?php

namespace App\Domain\Command\Puzzle;

use App\Domain\Command\Command;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;

/**
 * Command class to handle saving of a puzzle
 */
class SavePuzzleCommand implements Command
{

    private $puzzle;
    private $puzzleRepository;

    function __construct(Puzzle $puzzle, PuzzleRepository $puzzleRepository)
    {
        $this->puzzle = $puzzle;
        $this->puzzleRepository = $puzzleRepository;
    }

    public function handle()
    {
        return $this->puzzleRepository->store(
            $this->puzzle
        );
    }
}
