<?php

namespace App\Domain\Command\Puzzle;

use App\Domain\Exception\CouldNotListPuzzlesException;
use App\Domain\Repository\PuzzleRepository;
use Exception;

use App\Domain\Entity\Puzzle;

/**
 * Handler class to handle fetching of a list of puzzle
 */
class ListPuzzlesHandler
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

    /**
     * @return Puzzle[]
     */
    public function handle(ListPuzzlesCommand $command): array
    {
        $criteria = [];
        if ($command->difficulty !== null) {
            $criteria['difficulty'] = $command->difficulty->getValue();
        }
        if ($command->solvable !== null) {
            $criteria['solvable'] = $command->solvable;
        }

        try {
            $puzzles = $this->puzzleRepository->fetchAll($criteria);
        } catch (Exception $exception) {
            throw new CouldNotListPuzzlesException($criteria, $exception->getCode(), $exception);
        }

        return $puzzles;
    }
}
