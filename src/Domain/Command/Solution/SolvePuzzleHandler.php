<?php

namespace App\Domain\Command\Solution;

use App\Domain\Service\Solvers\Solver;
use App\Domain\Entity\Puzzle;
use App\Domain\Factory\SolverFactory;

class SolvePuzzleHandler
{
    /**
     * @var SolverFactory
     */
    private $solverFactory;

    public function __construct(SolverFactory $solverFactory)
    {
        $this->solverFactory = $solverFactory;
    }

    public function handle(SolvePuzzleCommand $command): Puzzle
    {
        $solver = $this->solverFactory->createfromStrategies($command->strategies());

        return $solver->solve(
            Solver::prepare($command->puzzle())
        );
    }
}
