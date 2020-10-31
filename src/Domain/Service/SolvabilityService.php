<?php

namespace App\Domain\Service;

use App\Domain\Value\Grid;

class SolvabilityService
{
    public function isGridSolvable(Grid $grid): bool
    {
        // no sudoku with less than 17 clues can be solved
        return count($grid->getPureEncoding()) >= 17;
    }
}
