<?php

namespace App\Domain\Entity;

use App\Domain\Value\Grid;
use App\Domain\Value\Strategy;

class SolutionStep
{
    /**
     * @var Grid
     */
    private $grid;

    /**
     * @var Strategy
     */
    private $lastStrategy;

    /**
     * @var int
     */
    private $affectedCell;

    /**
     * @var Solution|null
     */
    private $solution;

    public function __construct(Grid $grid, Strategy $lastStrategy, int $affectedCell, Solution $solution = null)
    {
        $this->grid = $grid;
        $this->lastStrategy = $lastStrategy;
        $this->affectedCell = $affectedCell;
        $this->solution = $solution;
    }

    public function getSolution(): ?Solution
    {
        return $this->solution;
    }

    public function getGrid(): Grid
    {
        return $this->grid;
    }

    public function getLastStrategy(): Strategy
    {
        return $this->lastStrategy;
    }

    public function getAffectedCell(): int
    {
        return $this->affectedCell;
    }

    public function setSolution(Solution $solution): SolutionStep
    {
        $this->solution = $solution;
        return $this;
    }
}