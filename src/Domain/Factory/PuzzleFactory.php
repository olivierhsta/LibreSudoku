<?php

namespace App\Domain\Factory;

use App\Domain\Entity\Puzzle;
use App\Domain\Value\Grid;

interface PuzzleFactory
{
    public function create(Grid $grid): Puzzle;
}
