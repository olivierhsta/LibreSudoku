<?php

namespace App\Domain\Entity;

use App\Domain\Value\Grid;
use App\Domain\Value\Difficulty;
use Ramsey\Uuid\UuidInterface;

abstract class Puzzle
{
    abstract public function getPuzzleUuid(): UuidInterface;
    abstract public function getGrid(): Grid;
    abstract public function getSolvable(): bool;
    abstract public function getDifficulty(): Difficulty;
    
    abstract public function setGrid(Grid $grid): void;
    abstract public function setSolvable(bool $solvable): void;
    abstract public function setDifficulty(Difficulty $difficulty): void;
}
