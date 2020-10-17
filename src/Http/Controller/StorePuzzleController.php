<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Factory\PuzzleFactory;
use App\Http\Request\StorePuzzleRequest;
use App\Http\Factory\GridFactory;
use App\Domain\Command\Puzzle\StorePuzzleCommand;
use App\Domain\Command\Puzzle\StorePuzzleHandler;
use App\Domain\Value\Grid;
use App\Domain\Entity\Puzzle;
use App\Http\Response\StorePuzzleResponse;

class StorePuzzleController extends AbstractController
{
    /**
     * @var PuzzleFactory
     */
    private $puzzleFactory;

    /**
     * @var GridFactory
     */
    private $gridFactory;

    /**
     * @var PuzzleRepository
     */
    private $puzzleRepository;

    /**
     * @var StorePuzzleHandler
     */
    private $handler;

    public function __construct(
        StorePuzzleHandler $handler,
        PuzzleFactory $puzzleFactory,
        GridFactory $gridFactory
    ) {
        $this->puzzleFactory = $puzzleFactory;
        $this->gridFactory = $gridFactory;
        $this->handler = $handler;
    }

    public function __invoke(StorePuzzleRequest $storePuzzleRequest) {
        $command = new StorePuzzleCommand(
            $this->puzzleFactory->create($this->gridFactory->create($storePuzzleRequest->encoding))
        );
        $puzzle = $this->handler->handle($command);
        return new StorePuzzleResponse($puzzle);
    }
}
