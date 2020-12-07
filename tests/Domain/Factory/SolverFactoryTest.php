<?php

namespace Tests\Domain\Factory;

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
        $actualSolver = SolverFactory::new()->createFromStrategies($strategies);

        foreach ($expectedSolvers as $expectedSolver) {
            $this->assertInstanceOf($expectedSolver, $actualSolver);
            $actualSolver = $actualSolver->getNext();
        }
    }

    public function strategies_solvers_provider(): array
    {
        return [
            [[Strategy::ONE_CHOICE(), Strategy::ELIMINATION()],[OneChoiceSolver::class, EliminationSolver::class]],
            [[Strategy::ONE_CHOICE()],[OneChoiceSolver::class]],
            [[Strategy::ELIMINATION()],[EliminationSolver::class]],
        ];
    }
}
