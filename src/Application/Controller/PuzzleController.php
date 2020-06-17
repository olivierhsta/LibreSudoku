<?php

namespace App\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PuzzleController extends AbstractController
{
    public function list()
    {
        return $this->json([
            'message' => 'List all puzzles',
            'path' => 'src/Application/Controller/PuzzleController.php',
        ]);
    }

    public function get(string $encoding)
    {
        return $this->json([
            'message' => 'Get one puzzle',
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

    public function store(string $encoding) {
        return $this->json([
            'message' => 'Save a puzzle',
            'path' => 'src/Application/Controller/PuzzleController.php',
        ]);
    }
}
