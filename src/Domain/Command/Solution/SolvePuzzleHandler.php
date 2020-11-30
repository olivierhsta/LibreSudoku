<?php

namespace App\Domain\Command\Solution;

use App\Domain\Service\Solvers\Solver;
use App\Domain\Entity\Puzzle;
use App\Domain\Entity\Solution;

class SolvePuzzleHandler
{
    public function handle(SolvePuzzleCommand $command): Puzzle
    {
        $solver = $this->solverFactory->createfromStrategies($command->strategies);

        return $solver->solve(
            Solver::prepare($command->puzzle)
        );
    }
}
