<?php

namespace App\Domain\Service\Solvers;

use App\Domain\Entity\Puzzle;

interface SolverInterface
{
    public function solve(Puzzle $puzzle);

    public function supports(): bool;
}
