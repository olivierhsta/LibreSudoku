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
            $this->encoding[] = $cell->containsValue() ? $cell->getValue() : $cell->getCandidates();
        }
    }

    /**
     * Return the pure encoding of the grid.  A pure encoding is defined as the array
     * of the numbers in the grid, excluding candidates and empty cells.
     *
     * @return int[]
     */
    public function getPureEncoding(): array
    {
        return array_filter($this->encoding, function($cellEncoding) {
            return is_array($cellEncoding) ? null : (int) $cellEncoding === 0 ? null : $cellEncoding;
        });
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
