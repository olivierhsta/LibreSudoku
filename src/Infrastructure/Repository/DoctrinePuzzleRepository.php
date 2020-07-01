<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;

/**
 * Implementation of the PuzzleRepository Interface for a Doctrine object manager
 */
class DoctrinePuzzleRepository implements PuzzleRepository
{
    public function get(string $encoding) {
        dd('getting');
    }

    public function random() {

    }

    public function store(Puzzle $puzzle) {

    }
}
