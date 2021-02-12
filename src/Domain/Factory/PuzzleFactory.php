<?php
namespace App\Domain\Factory;

use App\Domain\Value\Grid;
use App\Domain\Entity\Puzzle;
use App\Domain\Service\SolvabilityService;
use App\Domain\Service\DifficultyService;

class PuzzleFactory
{
    /**
     * @var SolvabilityService
     */
    private $solvabilityService;

    /**
     * @var DifficultyService
     */
    private $difficultyService;

    public function __construct(
        SolvabilityService $solvabilityService,
        DifficultyService $difficultyService
    ) {
        $this->solvabilityService = $solvabilityService;
        $this->difficultyService = $difficultyService;
    }

    public function create(Grid $grid): Puzzle
    {
        return new Puzzle(
            $grid,
            $this->solvabilityService->isGridSolvable($grid),
            $this->difficultyService->findGridDifficulty($grid)
        );
    }
}
