<?php

namespace App\Infrastructure\Repository;

use App\Domain\Exception\CouldNotFetchPuzzleException;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Ramsey\Uuid\UuidInterface;
use Throwable;

/**
 * Implementation of the PuzzleRepository Interface for a Doctrine object manager
 */
class DoctrinePuzzleRepository extends ServiceEntityRepository implements PuzzleRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Puzzle::class);
    }

    public function fetchOne(UuidInterface $puzzleUuid): Puzzle {
        try {
            /** @var Puzzle $puzzle */
            $puzzle = $this->findOneBy(['puzzleUuid' => $puzzleUuid]);
        } catch (Throwable $exception) {
            throw new CouldNotFetchPuzzleException($puzzleUuid, $exception->getCode(), $exception);
        }

        return $puzzle;
    }

    /**
     * {@inheritdoc}
     */
    public function fetchAll(?array $criteria): array {
        return $this->findBy($criteria);
    }

    public function random(): Puzzle {

    }

    public function store(Puzzle $puzzle): Puzzle {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($puzzle);

        $entityManager->flush();

        return $puzzle;
    }
}
