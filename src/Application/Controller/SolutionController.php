<?php

namespace App\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SolutionController extends AbstractController
{
    public function index(string $encoding)
    {
        return $this->json([
            'message' => 'Solving ' . $encoding,
            'path' => 'src/Application/Controller/SolutionController.php',
        ]);
    }
}
