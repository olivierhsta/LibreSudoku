<?php

namespace App\Tests\Domain\Factory;

use PHPUnit\Framework\TestCase;
use App\Domain\Value\Strategy;
use App\Domain\Service\Solvers\OneChoiceSolver;
use App\Domain\Service\Solvers\EliminationSolver;
use App\Domain\Factory\SolverFactory;

class SolverFactoryTest extends TestCase
{
    /** @dataProvider strategies_solvers_provider */
    public function test_create_from_strategies(array $strategies, array $expectedSolvers)
    {
        $actualSolvers = SolverFactory::new()->createFromStrategies($strategies);

        $this->assertEquals($actualSolvers, $expectedSolvers);
    }

    public function strategies_solvers_provider(): array
    {
        return [
            [[Strategy::ONE_CHOICE(), Strategy::ELIMINATION()],[OneChoiceSolver::new(), EliminationSolver::new()]],
            [[Strategy::ONE_CHOICE()],[OneChoiceSolver::new()]],
            [[Strategy::ELIMINATION()],[EliminationSolver::new()]],
        ];
    }
}
