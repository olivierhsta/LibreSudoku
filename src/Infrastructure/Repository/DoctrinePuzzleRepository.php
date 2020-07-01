<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\PuzzleRepository;
use App\Domain\Entity\Puzzle;
use App\Infrastructure\DoctrineEntity\DoctrinePuzzle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

/**
 * Implementation of the PuzzleRepository Interface for a Doctrine object manager
 */
class DoctrinePuzzleRepository extends ServiceEntityRepository implements PuzzleRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctrinePuzzle::class);
    }

    public function get(string $encoding) {
        dd('getting');
    }

    public function random() {

    }

    public function store(Puzzle $puzzle) {
        $entityManager = $this->getEntityManager();

        $doctrinePuzzle = new DoctrinePuzzle();
        $doctrinePuzzle->setGrid($puzzle->getGrid()->getEncoding());
        $doctrinePuzzle->setSolvable(true);
        $doctrinePuzzle->setDifficulty(3);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($doctrinePuzzle);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$doctrinePuzzle->getPuzzleUuid());
    }
}
