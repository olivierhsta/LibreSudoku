<?php

namespace App\Domain\Command\Solution;

use App\Domain\Service\Solvers\SolverInterface;
use App\Domain\Entity\Puzzle;

class SolvePuzzleHandler
{
    public function handle(SolvePuzzleCommand $command): Puzzle
    {
        return $command->puzzle;
    }
}
