<?php

namespace App\Domain\Command\Puzzle;

use App\Domain\Exception\CouldNotFetchPuzzleException;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;

/**
 * Handler class to handle saving of a puzzle
 */
class FetchPuzzleHandler
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
            $puzzle = $this->puzzleRepository->fetch(
                $command->puzzleUuid
            );
        } catch (\Exception $exception) {
            throw new CouldNotFetchPuzzleException($command->puzzleUuid, $exception->getCode(), $exception);
        }
        return $puzzle;
    }
}
