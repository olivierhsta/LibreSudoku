<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Puzzle;
use Ramsey\Uuid\UuidInterface;

/**
 * Repository interface to fetch and store puzzles
 */
interface PuzzleRepository
{
    public function fetchOne(UuidInterface $puzzleUuid) : Puzzle;

    /**
     * @return Puzzle[]
     */
    public function fetchAll(?array $criteria) : array;

    public function random() : Puzzle;

    public function store(Puzzle $puzzle) : Puzzle;
}
