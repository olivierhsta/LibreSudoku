<?php

namespace App\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PuzzleController extends AbstractController
{
    public function __invoke()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Application/Controller/PuzzleController.php',
        ]);
    }
}
