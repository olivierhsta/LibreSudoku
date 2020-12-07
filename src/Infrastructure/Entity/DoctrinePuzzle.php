<?php

namespace App\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Infrastructure\Repository\DoctrinePuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Domain\Value\Grid;
use App\Domain\Value\Difficulty;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use App\Domain\Factory\GridFactory;

/**
 * @ORM\Entity(repositoryClass=DoctrinePuzzleRepository::class)
 * @ORM\Table(name="puzzle")
 */
class DoctrinePuzzle extends Puzzle
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
     * @var string
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

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(name="updated_at", type="datetime")
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
