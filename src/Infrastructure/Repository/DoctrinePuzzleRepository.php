<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Infrastructure\Entity\DoctrinePuzzle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Ramsey\Uuid\UuidInterface;

/**
 * Implementation of the PuzzleRepository Interface for a Doctrine object manager
 */
class DoctrinePuzzleRepository extends ServiceEntityRepository implements PuzzleRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctrinePuzzle::class);
    }

    public function fetch(UuidInterface $puzzleUuid): Puzzle {
        return $this->findOneBy(['puzzle_uuid' => $puzzleUuid]);
    }

    public function random(): Puzzle {

    }

    /**
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(Puzzle $puzzle): Puzzle {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($puzzle);

        $entityManager->flush();

        return $puzzle;
    }
}
