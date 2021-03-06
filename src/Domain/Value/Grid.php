<?php

namespace App\Domain\Value;

use App\Domain\Exception\InvalidCellKeyException;
use App\Domain\Exception\InvalidPuzzleEncodingException;

/**
 * Grid encoding value.  This class is immutable
 */
class Grid
{
    /**
     * @var Cell[]
     */
    private $cells;

    /**
     * ┌─────────────┬──────────────┬──────────────┐
     * │  00  01  02 │  09  10  11  │  18  19  20  │
     * │  03  04  05 │  12  13  14  │  21  22  23  │
     * │  06  07  08 │  15  16  17  │  24  25  26  │
     * ├─────────────┼──────────────┼──────────────┤
     * │  27  28  29 │  36  37  38  │  45  46  47  │
     * │  30  31  32 │  39  40  41  │  48  49  50  │
     * │  33  34  35 │  42  43  44  │  51  52  53  │
     * ├─────────────┼──────────────┼──────────────┤
     * │  54  55  56 │  63  64  65  │  72  73  74  │
     * │  57  58  59 │  66  67  68  │  75  76  77  │
     * │  60  61  62 │  69  70  71  │  78  79  80  │
     * └─────────────┴──────────────┴──────────────┘
     *
     * @param Cell[] $cells
     * @throws InvalidPuzzleEncodingException
     */
    public function __construct(array $cells)
    {
        if (count($cells) !== 81) {
            throw new InvalidPuzzleEncodingException();
        }

        foreach ($cells as $cell) {
            $this->cells[$cell->key()] = $cell;
        }
    }

    /**
     * @return Cell[]
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    public function getCell(int $key): Cell
    {
        foreach ($this->cells as $cell) {
            if ($cell->key() === $key) return $cell;
        }
        throw new InvalidCellKeyException($key);
    }

    public function getEncoding(bool $withCandidates = true, bool $withEmpties = true): array
    {
        $encoding = [];
        for ($i = 0; $i < count($this->cells); $i++) {
            $cell = $this->cells[$i];
            if ($cell->containsCandidates() && $withCandidates) {
                if (!empty($cell->getCandidates()) || (empty($cell->getCandidates()) && $withEmpties)) {
                    $encoding[$i] = $cell->getCandidates();
                }
            }
            if ($cell->containsValue() && ($cell->getValue() !== 0 || $withEmpties)) {
                $encoding[$i] = $cell->getValue();
            }
        }
        return $encoding;
    }

    /**
     * A buddy of a cell is a cell that is either in the
     * same row, column of box as the cell
     *
     * @return Cell[] buddies of the given cell
     */
    public function getBuddiesOf(Cell $cell): array
    {
        $buddies = [];
        foreach ($this->cells as $potentialBuddy) {
            if ($cell->key() === $potentialBuddy->key()) continue;

            if ($potentialBuddy->row() === $cell->row() ||
                $potentialBuddy->column() === $cell->column() ||
                $potentialBuddy->box() === $cell->box()) {
                    $buddies[] = $potentialBuddy;
            }
        }
        return $buddies;
    }

    public function __toString(): string
    {
        $stringGrid = '';
        foreach ($this->getCells() as $cell) {
            $stringGrid .= $cell->containsValue() ? $cell->getValue() : '0';
        }
        return $stringGrid;
    }

    /**
     * @param Cell[] $cells
     */
    public function setCell(Cell $cell): self
    {
        if ($cell === $this->getCell($cell->key())) return $this;
        return new self(
            [$cell->key() => $cell] + $this->getCells()
        );
    }
}
