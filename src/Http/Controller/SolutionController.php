<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Domain\Command\Solution\SolvePuzzleCommand;
use App\Domain\Command\Solution\SolvePuzzleHandler;
use App\Domain\Repository\PuzzleRepository;
use App\Http\Response\PuzzleResponse;
use Ramsey\Uuid\Uuid;

class SolutionController extends AbstractController
{
    /**
     * @var SolvePuzzleHandler
     */
    private $handler;

    /**
     * @var PuzzleRepository
     */
    private $puzzleRepository;

    public function __construct(
        SolvePuzzleHandler $handler,
        PuzzleRepository $puzzleRepository
    ) {
        $this->handler = $handler;
        $this->puzzleRepository = $puzzleRepository;
    }

    public function __invoke(string $uuid)
    {
        $command = new SolvePuzzleCommand(
            $this->puzzleRepository->fetchOne(Uuid::fromString($uuid))
        );
        return $this->handler->handle($command);
    }
}
