<?php

namespace App\Tests\Domain\Service\Solvers;

use App\Domain\Factory\GridFactory;
use App\Domain\Factory\PuzzleFactory;
use App\Domain\Service\DifficultyService;
use App\Domain\Service\SolvabilityService;
use App\Domain\Service\Solvers\Solver;
use PHPUnit\Framework\TestCase;

class SolverTest extends TestCase
{
    public function test_prepare() {
        /*
        2,0,0 | 3,6,4 | 0,0,0
        0,7,0 | 0,5,0 | 0,0,6
        5,4,0 | 0,0,0 | 0,0,3
        ---------------------
        0,0,7 | 8,0,0 | 3,0,0
        0,5,9 | 0,0,0 | 7,1,0
        0,0,1 | 0,0,5 | 9,0,0
        ---------------------
        7,0,0 | 0,0,0 | 0,2,8
        6,0,0 | 0,7,0 | 0,5,0
        0,0,0 | 6,2,1 | 0,0,7
         */
        $grid = GridFactory::new()->createFromEncoding([
            2,0,0,0,7,0,5,4,0,3,6,4,0,5,0,0,0,0,0,0,0,0,0,6,0,0,3,
            0,0,7,0,5,9,0,0,1,8,0,0,0,0,0,0,0,5,3,0,0,7,1,0,9,0,0,
            7,0,0,6,0,0,0,0,0,0,0,0,0,7,0,6,2,1,0,2,8,0,5,0,[1,2,3,4,5,6,7,8],0,7,
        ]);
        $puzzleFactory = new PuzzleFactory(
            new SolvabilityService(),
            new DifficultyService()
        );

        $puzzle = $puzzleFactory->create($grid);

        self::assertEquals(array_values(Solver::prepare($puzzle)->getGrid()->getCell(1)->getCandidates()), [1,8,9]);
        self::assertEquals(Solver::prepare($puzzle)->getGrid()->getCell(1)->getValue(), null);

        self::assertEquals(array_values(Solver::prepare($puzzle)->getGrid()->getCell(40)->getCandidates()), [3,4]);
        self::assertEquals(Solver::prepare($puzzle)->getGrid()->getCell(40)->getValue(), null);

        self::assertEquals(array_values(Solver::prepare($puzzle)->getGrid()->getCell(79)->getCandidates()), [3,4,9]);
        self::assertEquals(Solver::prepare($puzzle)->getGrid()->getCell(79)->getValue(), null);

        self::assertEquals(Solver::prepare($puzzle)->getGrid()->getCell(80)->getCandidates(), null);
        self::assertEquals(Solver::prepare($puzzle)->getGrid()->getCell(80)->getValue(), 7);
    }
}