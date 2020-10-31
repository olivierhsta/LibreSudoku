<?php

namespace App\Domain\Command\Puzzle;

use App\Domain\Command\Command;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Domain\Service\SolvabilityService;
use App\Domain\Service\DifficultyService;
use App\Domain\Exception\CouldNotStorePuzzleException;

/**
 * Handler class to handle saving of a puzzle
 */
class StorePuzzleHandler
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
     * @throws CouldNotStorePuzzleException
     */
    public function handle(StorePuzzleCommand $command): Puzzle
    {
        try {
            $puzzle = $this->puzzleRepository->store(
                $command->puzzle
            );
        } catch (\Exception $exception) {
            throw new CouldNotStorePuzzleException($exception->getCode(), $exception);
        }
        
        return $puzzle;
    }
}