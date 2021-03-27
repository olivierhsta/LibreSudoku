<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Domain\Command\Solution\SolvePuzzleCommand;
use App\Domain\Command\Solution\SolvePuzzleHandler;
use App\Domain\Repository\PuzzleRepository;
use App\Http\Request\SolvePuzzleRequest;
use App\Http\Response\SolvePuzzleResponse;
use App\Domain\Value\Strategy;
use Ramsey\Uuid\Uuid;

class SolvePuzzleController extends AbstractController
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

    public function __invoke(SolvePuzzleRequest $request, string $uuid)
    {
        $strategies = array_map(
            function($strategy) {
                return new Strategy($strategy);
            },
            $request->strategies ?: array_values(Strategy::values()) // default to all strategies if none is provided
        );

        $command = new SolvePuzzleCommand(
            $this->puzzleRepository->fetchOne(Uuid::fromString($uuid)),
            $strategies
        );
        $solvedPuzzle = $this->handler->handle($command);

        return new SolvePuzzleResponse($solvedPuzzle);
    }
}
