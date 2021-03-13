<?php

namespace App\Domain\Command\Puzzle;

use App\Domain\Exception\CouldNotFetchPuzzleException;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Domain\Command\Command;
use Exception;

/**
 * Handler class to handle saving of a puzzle
 */
class FetchPuzzleHandler extends Command
{
    /**
     * @var PuzzleRepository
     */
    private $puzzleRepository;

    function __construct(
        PuzzleRepository $puzzleRepository
    ) {
        $this->puzzleRepository = $puzzleRepository;
    }

    public function handle(FetchPuzzleCommand $command): Puzzle
    {
        $puzzle = $this->puzzleRepository->fetchOne(
            $command->puzzleUuid()
        );
        return $puzzle;
    }
}
