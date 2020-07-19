<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Puzzle;

/**
 * Repository interface to fetch and store puzzles
 */
interface PuzzleRepository
{
    public function get(string $encoding) : Puzzle;
    public function random() : Puzzle;
    public function store(Puzzle $puzzle) : Puzzle;
}
