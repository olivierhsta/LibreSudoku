<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Puzzle;
use Ramsey\Uuid\UuidInterface;

/**
 * Repository interface to fetch and store puzzles
 */
interface PuzzleRepository
{
    public function fetch(UuidInterface $puzzleUuid) : Puzzle;

    public function random() : Puzzle;

    public function store(Puzzle $puzzle) : Puzzle;
}
