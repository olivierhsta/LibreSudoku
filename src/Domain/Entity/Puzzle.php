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
use App\Domain\Factory\GridFactory;

class Puzzle
{
    /**
     * @var UuidInterface
     */
    private $puzzleUuid;

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
        $this->grid = (string) $grid;
        $this->solvable = $solvable;
        $this->difficulty = $difficulty->getValue();
        $this->createdAt = $this->updatedAt = Carbon::now();
        $this->solution = $solution;
    }

    public function getPuzzleUuid(): UuidInterface
    {
        return $this->puzzleUuid;
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
        $this->solution->addStep(
            new SolutionStep(
                $this->getGrid()->setCell($cell),
                $strategy,
                $cell->key()
            )
        );

        return $this;
    }
}
