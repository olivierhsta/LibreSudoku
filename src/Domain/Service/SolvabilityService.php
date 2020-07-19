<?php

namespace App\Domain\Service;

use App\Domain\Value\Grid;

class SolvabilityService
{
    public function isGridSolvable(Grid $grid): bool
    {
        return true;
    }
}
