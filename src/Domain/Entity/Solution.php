<?php

namespace App\Domain\Entity;

class Solution
{
    /**
     * @var Puzzle
     */
    private $puzzle;

    /**
     * @var bool
     */
    private $completed;

    public function __construct(
        Puzzle $puzzle,
        bool $completed
    ) {
        $this->puzzle = $puzzle;
        $this->completed = $completed;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function getPuzzle(): Puzzle
    {
        return $this->puzzle;
    }
}