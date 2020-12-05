<?php

namespace App\Domain\Command\Puzzle;

use App\Domain\Exception\CouldNotFetchPuzzleException;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Domain\Command\Command;

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
        try {
            $puzzle = $this->puzzleRepository->fetchOne(
                $command->puzzleUuid()
            );
        } catch (\Exception $exception) {
            throw new CouldNotFetchPuzzleException($command->puzzleUuid(), $exception->getCode(), $exception);
        }
        return $puzzle;
    }
}
