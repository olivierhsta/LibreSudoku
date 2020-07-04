<?php

namespace App\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Infrastructure\Repository\DoctrinePuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Domain\Value\Grid;

/**
 * @ORM\Entity(repositoryClass=DoctrinePuzzleRepository::class)
 * @ORM\Table(name="puzzle")
 */
class DoctrinePuzzle implements Puzzle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="string")
     */
    private $puzzle_uuid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grid;

    /**
     * @ORM\Column(type="boolean")
     */
    private $solvable;

    /**
     * @ORM\Column(type="integer")
     */
    private $difficulty;

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
        return $this->grid = $grid->getEncoding();
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
