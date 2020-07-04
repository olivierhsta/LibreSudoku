<?php

namespace App\Domain\Value;

use App\Domain\Exception\InvalidPuzzleEncodingException;

class Cell
{
    const MAX_PENCIL_MARKS = 9;
    const MAX_CELL_VALUE = 9;
    const MIN_CELL_VALUE = 1;

    protected $pencilMarks;
    protected $value;

    function __construct($content)
    {
        if ($this->isValidValue($content)) {
            $this->pencilMarks = null;
            $this->value = $content;
        } elseif ($this->isValidPencilMarksArray($content)) {
            $this->pencilMarks = $content;
            $this->value = null;
        }
    }

    public function containsPencilMarks(): bool
    {
        return !is_null($this->pencilMarks);
    }

    public function containsValue(): bool
    {
        return !is_null($this->value);
    }

    public function getPencilMarks(): array
    {
        return $this->pencilMarks;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * $throws InvalidPuzzleEncodingException
     */
    private function isValidValue($content)
    {
        if (!is_array($content)) {
            if (!is_int((int) $content) || $content < self::MIN_CELL_VALUE || $content > self::MAX_CELL_VALUE) {
                throw new InvalidPuzzleEncodingException();
            }
            return true;
        }
        return false;
    }

    /**
     * $throws InvalidPuzzleEncodingException
     */
    private function isValidPencilMarksArray($content)
    {
        if (is_array($content)) {
            if (count($content) > self::MAX_PENCIL_MARKS) {
                throw new InvalidPuzzleEncodingException();
            }
            return true;
        }
        return false;
    }
}
