<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Domain\Command\Puzzle\ListPuzzlesCommand;
use App\Domain\Command\Puzzle\ListPuzzlesHandler;
use App\Domain\Value\Difficulty;
use App\Http\Request\ListPuzzlesRequest;
use App\Http\Response\ListPuzzlesResponse;

class ListPuzzlesController extends AbstractController
{
    /**
     * @var ListPuzzlesHandler
     */
    private $handler;

    public function __construct(
        ListPuzzlesHandler $handler
    ) {
        $this->handler = $handler;
    }

    function __invoke(ListPuzzlesRequest $listPuzzlesRequest)
    {
        $command = new ListPuzzlesCommand(
            $listPuzzlesRequest->criteria['difficulty'] ? new Difficulty($listPuzzlesRequest->criteria['difficulty']) : null,
            $listPuzzlesRequest->criteria['solvable'] ? filter_var($listPuzzlesRequest->criteria['solvable'], FILTER_VALIDATE_BOOLEAN) : null
        );

        $puzzles = $this->handler->handle($command);

        return new ListPuzzlesResponse($puzzles);
    }
}
