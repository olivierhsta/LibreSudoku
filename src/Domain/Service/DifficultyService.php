<?php

namespace App\Domain\Service;

use App\Domain\Value\Difficulty;
use App\Domain\Value\Grid;

class DifficultyService
{
    public function findGridDifficulty(Grid $grid) : Difficulty
    {
        return new Difficulty(2);
    }
}
