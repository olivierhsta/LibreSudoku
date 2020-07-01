<?php

namespace App\Infrastructure\DoctrineEntity;

use Doctrine\ORM\Mapping as ORM;
use App\Infrastructure\Repository\DoctrinePuzzleRepository;

/**
 * @ORM\Entity(repositoryClass=DoctrinePuzzleRepository::class)
 * @ORM\Table(name="puzzle")
 */
class DoctrinePuzzle
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

    public function getPuzzleUuid()
    {
        return $this->puzzle_uuid;
    }

    public function getGrid()
    {
        return $this->grid;
    }

    public function getSolvable()
    {
        return $this->solvable;
    }

    public function getDifficulty()
    {
        return $this->difficulty;
    }

    public function setGrid(string $grid)
    {
        return $this->grid = $grid;
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
