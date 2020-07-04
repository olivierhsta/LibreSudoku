<?php

namespace App\Infrastructure\Factory;

use App\Domain\Factory\PuzzleFactory;
use App\Infrastructure\Entity\DoctrinePuzzle;
use App\Domain\Value\Grid;
use App\Domain\Entity\Puzzle;

class DoctrinePuzzleFactory implements PuzzleFactory
{

    public function createFromGrid(Grid $grid): Puzzle
    {
        $puzzle = new DoctrinePuzzle();

        $puzzle->setGrid($grid);
        $puzzle->setSolvable(true);
        $puzzle->setDifficulty(1);

        return $puzzle;
    }
}
