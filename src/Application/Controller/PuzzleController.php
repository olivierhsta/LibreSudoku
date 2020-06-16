<?php

namespace App\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PuzzleController extends AbstractController
{
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Application/Controller/PuzzleController.php',
        ]);
    }

    public function show(string $encoding)
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Application/Controller/PuzzleController.php',
        ]);
    }

    public function store(string $encoding)
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Application/Controller/PuzzleController.php',
        ]);
    }
}
