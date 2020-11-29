<?php

namespace App\Domain\Entity\Solution;

interface Solution
{
    public function getPuzzle(): Puzzle;
    public function setPuzzle(Puzzle $puzzle): void;
}
