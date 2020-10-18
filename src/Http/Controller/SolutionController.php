<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Http\Response\PuzzleResponse;

class SolutionController extends AbstractController
{
    public function __invoke(string $encoding)
    {
        $command = new SolvePuzzleCommand(
            $this->puzzleFactory->create($this->gridFactory->create($encoding)),
            $this->puzzleRepository
        );
        return $command->handle();
    }
}
