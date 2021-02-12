<?php

namespace App\Domain\Entity;

use App\Domain\Value\Grid;
use App\Domain\Value\Difficulty;
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

    public function __construct(
        Grid $grid,
        bool $solvable,
        Difficulty $difficulty
    ) {
        $this->puzzleUuid = Uuid::uuid4();
        $this->grid = (string) $grid;
        $this->solvable = $solvable;
        $this->difficulty = $difficulty->getValue();
        $this->createdAt = $this->updatedAt = Carbon::now();
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
}
