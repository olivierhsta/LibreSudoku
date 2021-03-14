<?php

namespace App\Domain\Value;

use App\Domain\Exception\InvalidPuzzleEncodingException;

/**
 * Cell value.  Immutable
 */
class Cell
{
    const MAX_CANDIDATES = 9;
    const MAX_CELL_VALUE = 9;
    const MIN_CELL_VALUE = 1;
    const EMPTY_CELL_VALUE = 0;

    const FULL_SET = [1,2,3,4,5,6,7,8,9];

    protected $key;
    protected $candidates;
    protected $value;

    function __construct(int $key, $content)
    {
        $this->key = $key;
        if ($this->isValidValue($content)) {
            $this->candidates = null;
            $this->value = $content;
        } elseif ($this->isValidCandidatesArray($content)) {
            $this->candidates = $content;
            $this->value = null;
        }
    }

    public function containsCandidates(): bool
    {
        return !is_null($this->candidates);
    }

    public function containsValue(): bool
    {
        return !is_null($this->value);
    }

    public function getCandidates(): ?array
    {
        return $this->candidates;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function isEmpty(): bool
    {
        return $this->value === 0 || $this->candidates === [];
    }

    public function key(): int
    {
        return $this->key;
    }

    public function row(): int
    {
        return floor($this->box() / 3) * 3 + floor(($this->key % 9) / 3);
    }

    public function column(): int
    {
        return ($this->box() % 3) * 3 + ($this->key % 3);
    }

    public function box(): int
    {
        return floor($this->key/9);
    }

    private function isValidValue($content)
    {
        if (!is_array($content)) {
            if ((!is_int((int) $content) || $content < self::MIN_CELL_VALUE || $content > self::MAX_CELL_VALUE) && (int)$content !== self::EMPTY_CELL_VALUE ) {
                throw new InvalidPuzzleEncodingException();
            }
            return true;
        }
        return false;
    }

    private function isValidCandidatesArray($content)
    {
        if (is_array($content)) {
            if (count($content) > self::MAX_CANDIDATES || count(array_unique($content)) !== count($content)) {
                throw new InvalidPuzzleEncodingException();
            }
            return true;
        }
        return false;
    }

    /**
     * @param int[] $candidates
     */
    public function setCandidates(array $candidates): self
    {
        return new self(
            $this->key,
            $candidates
        );
    }
}
