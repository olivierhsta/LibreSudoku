<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Domain\Command\Puzzle\FetchPuzzleCommand;
use App\Domain\Command\Puzzle\FetchPuzzleHandler;
use Ramsey\Uuid\UuidFactoryInterface;
use App\Http\Response\FetchPuzzleResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class FetchPuzzleController extends AbstractController
{
    /**
     * @var FetchPuzzleHandler
     */
    private $handler;

    /**
     * @var UuidFactoryInterface
     */
    private $uuidFactory;

    public function __construct(
        FetchPuzzleHandler $handler,
        UuidFactoryInterface $uuidFactory
    ) {
        $this->handler = $handler;
        $this->uuidFactory = $uuidFactory;
    }

    public function __invoke(string $uuid): JsonResponse
    {
        $command = new FetchPuzzleCommand(
            $this->uuidFactory->fromString($uuid)
        );
        $puzzle = $this->handler->handle($command);

        return new FetchPuzzleResponse($puzzle);
    }
}
