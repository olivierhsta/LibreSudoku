<?php

namespace App\Domain\Entity;

use App\Domain\Value\Grid;
use App\Domain\Value\Strategy;

class SolutionStep
{
    /**
     * @var Solution
     */
    private $solution;

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

    public function __construct(Solution $solution, Grid $grid, Strategy $lastStrategy, int $affectedCell)
    {
        $this->solution = $solution;
        $this->grid = $grid;
        $this->lastStrategy = $lastStrategy;
        $this->affectedCell = $affectedCell;
    }

    public function getSolution(): Solution
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
}