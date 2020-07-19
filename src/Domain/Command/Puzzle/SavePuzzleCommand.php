<?php

namespace App\Domain\Command\Puzzle;

use App\Domain\Command\Command;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Http\Response\SavePuzzleResponse;
use App\Domain\Service\SolvabilityService;
use App\Domain\Service\DifficultyService;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        PuzzleRepository $puzzleRepository)
    {
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
