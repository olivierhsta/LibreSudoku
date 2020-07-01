<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SolutionController extends AbstractController
{
    public function index(string $encoding)
    {
        return $this->json([
            'message' => 'Solving ' . $encoding,
            'path' => 'src/Http/Controller/SolutionController.php',
        ]);
    }
}
