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

    function __construct(array $encoding)
    {
        if (count($encoding) !== 81) {
            throw new InvalidPuzzleEncodingException();
        }
        $this->encoding = '';
        foreach ($encoding as $cellContent) {
            $cell = new Cell($cellContent);
            $cells[] = $cell;
            $this->encoding .= $cell->containsValue() ? $cell->getValue() : '0';
        }
    }

    public function getEncoding()
    {
        return $this->encoding;
    }
}
