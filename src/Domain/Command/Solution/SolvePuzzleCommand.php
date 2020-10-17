<?php

namespace App\Domain\Command\Solution;

use App\Domain\Command\Command;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Http\Response\SavePuzzleResponse;
use App\Domain\Service\SolvabilityService;
use App\Domain\Service\DifficultyService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Command class to handle solving of a puzzle
 */
class SolvePuzzleCommand implements Command
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

    public function handle(): JsonResponse
    {
        $puzzle = $this->puzzleRepository->store(
            $this->puzzle
        );
        return new SavePuzzleResponse($puzzle);
    }
}
