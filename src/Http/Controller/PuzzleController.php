<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Domain\Repository\PuzzleRepository;
use App\Domain\Factory\PuzzleFactory;
use App\Http\Request\SavePuzzleRequest;
use App\Http\Factory\GridFactory;
use App\Domain\Command\Puzzle\SavePuzzleCommand;
use App\Domain\Value\Grid;
use App\Domain\Entity\Puzzle;

class PuzzleController extends AbstractController
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

    public function __construct(
        PuzzleFactory $puzzleFactory,
        GridFactory $gridFactory,
        PuzzleRepository $puzzleRepository
    ) {
        $this->puzzleFactory = $puzzleFactory;
        $this->gridFactory = $gridFactory;
        $this->puzzleRepository = $puzzleRepository;
    }

    public function index(string $encoding)
    {
        return $this->json([
            'message' => 'Get one puzzle',
            'path' => 'src/Http/Controller/PuzzleController.php',
        ]);
    }

    public function list()
    {
        return $this->json([
            'message' => 'List all puzzles',
            'path' => 'src/Http/Controller/PuzzleController.php',
        ]);
    }

    public function random(string $encoding)
    {
        return $this->json([
            'message' => 'Get a random puzzle',
            'path' => 'src/Http/Controller/PuzzleController.php',
        ]);
    }

    public function store(SavePuzzleRequest $savePuzzleRequest) {
        $command = new SavePuzzleCommand(
            $this->puzzleFactory->create($this->gridFactory->create($savePuzzleRequest->encoding)),
            $this->puzzleRepository
        );
        return $command->handle();
    }
}
