<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Domain\Command\Puzzle\FetchPuzzleCommand;
use App\Domain\Command\Puzzle\FetchPuzzleHandler;
use Ramsey\Uuid\Uuid;
use App\Http\Response\FetchPuzzleResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class FetchPuzzleController extends AbstractController
{
    /**
     * @var FetchPuzzleHandler
     */
    private $handler;

    public function __construct(
        FetchPuzzleHandler $handler
    ) {
        $this->handler = $handler;
    }

    public function __invoke(string $uuid): JsonResponse
    {
        $command = new FetchPuzzleCommand(
            Uuid::fromString($uuid)
        );
        $puzzle = $this->handler->handle($command);

        return new FetchPuzzleResponse($puzzle);
    }
}
