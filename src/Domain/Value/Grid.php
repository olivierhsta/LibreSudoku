<?php

namespace App\Domain\Value;

use App\Domain\Exception\InvalidPuzzleEncodingException;

/**
 * Grid encoding value
 */
class Grid
{

    private $encoding;
    private $cells;

    /**
     * @thorws InvalidPuzzleEncodingException
     */
    function __construct(array $encoding)
    {
        if (count($encoding) !== 81) {
            throw new InvalidPuzzleEncodingException();
        }
        $this->encoding = [];
        foreach ($encoding as $cellContent) {
            $cell = new Cell($cellContent);
            $this->cells[] = $cell;
            $this->encoding[] = $cell->containsValue() ? $cell->getValue() : $cell->getPencilMarks();
        }
    }

    public function getCells(): array
    {
        return $this->cells;
    }

    public function getEncoding(): array
    {
        return $this->encoding;
    }
}
