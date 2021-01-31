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
        $puzzle = new Puzzle();

        $puzzle->setGrid($grid);
        $puzzle->setSolvable($this->solvabilityService->isGridSolvable($grid));
        $puzzle->setDifficulty($this->difficultyService->findGridDifficulty($grid));

        return $puzzle;
    }
}
