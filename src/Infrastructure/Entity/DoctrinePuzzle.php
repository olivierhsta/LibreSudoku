<?php

namespace App\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Infrastructure\Repository\DoctrinePuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Domain\Value\Grid;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=DoctrinePuzzleRepository::class)
 * @ORM\Table(name="puzzle")
 */
class DoctrinePuzzle implements Puzzle
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $puzzle_uuid;

    /**
     * @var Grid
     *
     * @ORM\Column(type="string", length=255)
     */
    private $grid;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $solvable;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $difficulty;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    public function getPuzzleUuid(): string
    {
        return $this->puzzle_uuid;
    }

    public function getGrid(): Grid
    {
        return new Grid(str_split($this->grid, 1));
    }

    public function getSolvable(): bool
    {
        return $this->solvable;
    }

    public function getDifficulty(): int
    {
        return $this->difficulty;
    }

    public function setGrid(Grid $grid)
    {
        $this->grid = '';
        foreach ($grid->getCells() as $cell) {
            $this->grid .= $cell->containsValue() ? $cell->getValue() : '0';
        }
        return $this->grid;
    }

    public function setSolvable(bool $solvable)
    {
        return $this->solvable = $solvable;
    }

    public function setDifficulty(int $difficulty)
    {
        return $this->difficulty = $difficulty;
    }
}
