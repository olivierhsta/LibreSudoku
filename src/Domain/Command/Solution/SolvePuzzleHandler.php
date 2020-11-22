<?php

namespace App\Domain\Command\Solution;

use App\Domain\Service\Solvers\SolverInterface;

class SolvePuzzleHandler
{
    /**
     * @var SolverInterface
     */
    public $solver;

    public function __construct(
        SolverInterface $solver
    ) {
        $this->solver = $solver;
    }

    public function handle(SolvePuzzleCommand $command): Puzzle
    {
        $this->solver->solve($command->puzzle);
    }
}
