<?php

namespace App\Domain\Command\Solution;

use App\Domain\Service\Solvers\Solver;
use App\Domain\Entity\Puzzle;

class SolvePuzzleHandler
{
    public function handle(SolvePuzzleCommand $command): Puzzle
    {
        dd($command->solvers[0]->solve($command->puzzle));
        return $command->puzzle;
    }
}
