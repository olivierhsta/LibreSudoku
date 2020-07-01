<?php

namespace App\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Domain\Repository\PuzzleRepository;
use App\Application\Request\SavePuzzleRequest;

class PuzzleController extends AbstractController
{
    public function __construct(PuzzleRepository $puzzleRepository) {
        $this->puzzleRepository = $puzzleRepository;
    }

    public function index(string $encoding)
    {
        return $this->json([
            'message' => 'Get one puzzle',
            'path' => 'src/Application/Controller/PuzzleController.php',
        ]);
    }

    public function list()
    {
        return $this->json([
            'message' => 'List all puzzles',
            'path' => 'src/Application/Controller/PuzzleController.php',
        ]);
    }

    public function random(string $encoding)
    {
        return $this->json([
            'message' => 'Get a random puzzle',
            'path' => 'src/Application/Controller/PuzzleController.php',
        ]);
    }

    public function store(SavePuzzleRequest $savePuzzleRequest) {
        return $this->json([
            'message' => 'Save a puzzle',
            'path' => 'src/Application/Controller/PuzzleController.php',
            'request' => $savePuzzleRequest,
        ]);
    }
}
