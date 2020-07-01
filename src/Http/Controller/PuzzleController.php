<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Domain\Repository\PuzzleRepository;
use App\Http\Request\SavePuzzleRequest;
use App\Domain\Command\Puzzle\SavePuzzleCommand;
use App\Domain\Value\Grid;
use App\Domain\Entity\Puzzle;

class PuzzleController extends AbstractController
{
    public function __construct(PuzzleRepository $puzzleRepository) {
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
            new Puzzle(
                new Grid($savePuzzleRequest->encoding)
            ),
            $this->puzzleRepository
        );
        return $command->handle();
    }
}
