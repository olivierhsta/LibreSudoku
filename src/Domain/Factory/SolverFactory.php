<?php

namespace App\Domain\Factory;

use App\Domain\Value\Strategy;
use App\Domain\Service\Solvers\Solver;
use App\Domain\Service\Solvers\OneChoiceSolver;
use App\Domain\Service\Solvers\EliminationSolver;

class SolverFactory
{
    public static function new(): self
    {
        return new self();
    }

    private static $strategyMapping = [
        Strategy::ONE_CHOICE => OneChoiceSolver::class,
        Strategy::ELIMINATION => EliminationSolver::class
    ];

    /**
     * @param Strategy[]
     * @return Solver[]
     */
    public function createFromStrategies(array $strategies): array
    {
        return array_map([$this, 'createFromStrategy'], array_intersect($strategies, array_keys(self::$strategyMapping)));
    }

    public function createFromStrategy(Strategy $strategy): Solver
    {
        return new self::$strategyMapping[(string)$strategy];
    }
}
