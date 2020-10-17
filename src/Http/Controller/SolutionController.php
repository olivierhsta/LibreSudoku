<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SolutionController extends AbstractController
{
    public function index(string $encoding)
    {
        $command = new SolvePuzzleCommand(
            $this->puzzleFactory->create($this->gridFactory->create($encoding)),
            $this->puzzleRepository
        );
        return $command->handle();
    }
}
