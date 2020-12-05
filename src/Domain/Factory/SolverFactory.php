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
     * Constructs a chain of solvers starting with the solver associated
     * with the first strategy provided and finishing with the last.
     *
     * @param Strategy[]
     *
     * @return Solver first solver of the chain
     */
    public function createFromStrategies(array $strategies): Solver
    {
        $lastSolver = null;
        foreach (array_reverse($strategies) as $strategy) {
            $solver = $this->createFromStrategy($strategy);
            $solver->setNext($lastSolver);
            $lastSolver = $solver;
        }
        return $lastSolver;
    }

    public function createFromStrategy(Strategy $strategy): Solver
    {
        return new self::$strategyMapping[(string)$strategy];
    }
}
