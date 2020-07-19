<?php

namespace App\Domain\Entity;

use App\Domain\Value\Grid;
use App\Domain\Value\Difficulty;

interface Puzzle
{
    public function getPuzzleUuid(): string;

    public function getGrid(): Grid;

    public function getSolvable(): bool;

    public function getDifficulty(): Difficulty;
}
