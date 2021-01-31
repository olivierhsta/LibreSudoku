<?php

namespace Tests\Infrastructure;

use PHPUnit\Framework\TestCase;
use App\Domain\Factory\PuzzleFactory;
use App\Domain\Service\SolvabilityService;
use App\Domain\Service\DifficultyService;
use App\Domain\Factory\GridFactory;
use App\Domain\Value\Difficulty;

class DoctrinePuzzleFactoryTest extends TestCase
{
    /**
     * @dataProvider puzzleFactoryProvider
     */
    public function test_create(array $encoding, bool $expectedSolvable, int $expectedDifficuly)
    {
        $grid = GridFactory::new()->createFromEncoding($encoding);

        $puzzleFactory = new PuzzleFactory(
            new SolvabilityService(),
            new DifficultyService()
        );

        $puzzle = $puzzleFactory->create($grid);

        $this->assertEquals($puzzle->getGrid()->getEncoding(), $grid->getEncoding());
        $this->assertEquals($puzzle->getSolvable(), $expectedSolvable);
        $this->assertEquals($puzzle->getDifficulty()->getValue(), $expectedDifficuly);
    }

    public function puzzleFactoryProvider()
    {
        return [
            [
                [1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9],
                true,
                2
            ]
        ];
    }

}
