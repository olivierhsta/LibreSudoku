<?php

namespace App\Domain\Entity;

use App\Domain\Value\Cell;
use App\Domain\Value\Grid;
use App\Domain\Value\Difficulty;
use App\Domain\Value\Strategy;
use Carbon\Carbon;
use DateTimeInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Puzzle
{
    /**
     * @var UuidInterface
     */
    private $puzzleUuid;

    /**
     * @var Grid
     */
    private $grid;

    /**
     * @var bool
     */
    private $solvable;

    /**
     * @var Difficulty
     */
    private $difficulty;

    /**
     * @var DateTimeInterface
     */
    private $createdAt;

    /**
     * @var DateTimeInterface
     */
    private $updatedAt;

    /**
     * @var Solution|null
     */
    private $solution;

    public function __construct(
        Grid $grid,
        bool $solvable,
        Difficulty $difficulty,
        Solution $solution = null
    ) {
        $this->puzzleUuid = Uuid::uuid4();
        $this->grid = $grid;
        $this->solvable = $solvable;
        $this->difficulty = $difficulty;
        $this->createdAt = $this->updatedAt = Carbon::now();
        $this->solution = $solution ?? new Solution;
    }

    public function getPuzzleUuid(): UuidInterface
    {
        return $this->puzzleUuid;
    }

    public function getGrid(): Grid
    {
        return $this->grid;
    }

    public function getSolvable(): bool
    {
        return $this->solvable;
    }

    public function getDifficulty(): Difficulty
    {
        return $this->difficulty;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function getSolution(): Solution
    {
        return $this->solution;
    }

    public function fill(Cell $cell, Strategy $strategy): self
    {
        $this->grid = $this->grid->setCell($cell);

        $this->solution->addStep(
            new SolutionStep(
                $this->grid,
                $strategy,
                $cell->key()
            )
        );

        return $this;
    }
}
