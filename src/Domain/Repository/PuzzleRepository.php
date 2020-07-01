<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Puzzle;

/**
 * Repository interface to fetch and store puzzles
 */
interface PuzzleRepository
{
    public function get(string $encoding);
    public function random();
    public function store(Puzzle $puzzle);
}
