<?php

namespace App\Domain\Entity;

use App\Domain\Value\Grid;
use App\Domain\Value\Difficulty;
use Ramsey\Uuid\UuidInterface;
use App\Domain\Factory\GridFactory;

class Puzzle
{
    /**
     * @var UuidInterface
     */
    private $puzzle_uuid;

    /**
     * @var string
     */
    private $grid;

    /**
     * @var bool
     */
    private $solvable;

    /**
     * @var int
     */
    private $difficulty;

    /**
     * @var DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var DateTimeImmutable
     */
    private $updatedAt;

    public function getPuzzleUuid(): UuidInterface
    {
        return $this->puzzle_uuid;
    }

    public function getGrid(): Grid
    {
        return GridFactory::new()->createFromEncoding(str_split($this->grid, 1));
    }

    public function getSolvable(): bool
    {
        return $this->solvable;
    }

    public function getDifficulty(): Difficulty
    {
        return new Difficulty($this->difficulty);
    }

    public function setGrid(Grid $grid): void
    {
        $this->grid = (string)$grid;
    }

    public function setSolvable(bool $solvable): void
    {
        $this->solvable = $solvable;
    }

    public function setDifficulty(Difficulty $difficulty): void
    {
        $this->difficulty = $difficulty->getValue();
    }
}
