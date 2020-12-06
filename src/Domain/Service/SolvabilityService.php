<?php

namespace App\Domain\Service;

use App\Domain\Value\Grid;

class SolvabilityService
{
    public static function new(): self
    {
        return new self();
    }

    public function isGridSolvable(Grid $grid): bool
    {
        // no sudoku with less than 17 clues can be solved
        return count($grid->getEncoding(false, false)) >= 17;
    }
}
