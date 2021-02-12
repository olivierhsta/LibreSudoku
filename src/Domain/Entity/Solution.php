<?php

namespace App\Domain\Entity;

class Solution
{
    /**
     * @var Puzzle
     */
    private $puzzle;

    public function __construct(Puzzle $puzzle)
    {
        $this->puzzle = $puzzle;
    }

    public function getPuzzle(): Puzzle {
        return $this->puzzle;
    }
}
