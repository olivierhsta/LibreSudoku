<?php

namespace App\Domain\Entity;

use App\Domain\Value\Grid;

/**
 * Sudoku Puzzle class
 */
class Puzzle
{
    private $grid;

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
    }

    public function getGrid(): Grid
    {
        return $this->grid;
    }
}
