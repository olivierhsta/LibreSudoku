<?php

namespace App\Domain\Entity;

/**
 * Sudoku Puzzle class
 */
class Puzzle
{
    private $encoding;

    public function __construct($encoding)
    {
        $this->encoding = $encoding;
    }

    public function getEncoding()
    {
        return $this->encoding;
    }

}
