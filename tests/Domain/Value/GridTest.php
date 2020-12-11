<?php

namespace Tests\Domain\Value;

use PHPUnit\Framework\TestCase;
use App\Domain\Value\Grid;
use App\Domain\Factory\GridFactory;

class GridTest extends TestCase
{
    /** @dataProvider gridEncodingProvider */
    public function test_get_encoding(Grid $grid, array $expectedEncoding, bool $withCandidates, bool $withEmpties, string $exceptionClass = null)
    {
        if ($exceptionClass !== null) {
            $this->expectException($exceptionClass);
        }
        $this->assertEquals($expectedEncoding, $grid->getEncoding($withCandidates, $withEmpties));
    }

    public function gridEncodingProvider(): array
    {
        $gridFactory = new GridFactory();
        return [
            [
                $gridFactory->createFromEncoding($encoding = [
                    0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
                    0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
                    0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
                ]),
                $encoding,
                true,
                true,
            ],
            [
                $gridFactory->createFromEncoding($encoding),
                $encoding,
                false,
                true,
            ],
            [
                $gridFactory->createFromEncoding($encoding = [
                    [1],[2],[3],[],[],[],[],[1,2,3,4],[],[],[],[4],[],[],[],[4,3,8],[],[],[],[],[],[3],[],[],[],[],[],
                    [],[],[],[],[],[],[],[4,5],[],[],[],[],[],[],[],[],[],[6],[],[],[],[3,1,9],[],[],[4],[],[],
                    [],[],[],[2],[],[],[],[],[],[],[],[],[],[],[],[9],[],[],[],[],[],[],[],[],[],[],[6],
                ]),
                $encoding,
                true,
                true,
            ],
            [
                $gridFactory->createFromEncoding($encoding = [
                    [1],[2],[3],[],8,[],[],[1,2,3,4],[],[],[],[4],[],[],0,[4,3,8],[],[],[],0,[],[3],[],[],[],1,[],
                    [],[],[],[],[],0,[],[4,5],[],[],[],[],4,[],[],[],[],[6],[],[],[],[3,1,9],[],[],[4],[],[],
                    9,[],[],[2],[],[],[],[],[],[],0,[],[],[],[],[9],[],0,[],[],[],0,[],[],0,[],[6],
                ]),
                array_filter($encoding, function($cell) {
                    return !(empty($cell) || $cell === 0);
                }),
                true,
                false,
            ],
            [
                $gridFactory->createFromEncoding($encoding = [
                    [1],[2],[3],[],8,[],[],[1,2,3,4],[],[],[],[4],[],[],0,[4,3,8],[],[],[],0,[],[3],[],[],[],1,[],
                    [],[],[],[],[],0,[],[4,5],[],[],[],[],4,[],[],[],[],[6],[],[],[],[3,1,9],[],[],[4],[],[],
                    9,[],[],[2],[],[],[],[],[],[],0,[],[],[],[],[9],[],0,[],[],[],0,[],[],0,[],[6],
                ]),
                array_filter($encoding, function($cell) {
                    return !is_array($cell);
                }),
                false,
                true,
            ],
        ];
    }

    /** @dataProvider buddiesProvider */
    public function test_buddies(Grid $grid, int $cellKey, array $expectedBuddies)
    {
        $actualBuddies = $grid->getBuddiesOf($grid->getCell($cellKey));
        $this->assertEquals(count($expectedBuddies), count($actualBuddies));
        foreach ($actualBuddies as $buddy) {
            $this->assertContains($buddy->key(), array_keys($expectedBuddies));
            $this->assertContains($buddy->getValue(), array_values($expectedBuddies));
        }
    }

    public function buddiesProvider(): array
    {
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
            7,0,0,6,0,0,0,0,0,0,0,0,0,7,0,6,2,1,0,2,8,0,5,0,0,0,7,
        ]);
        return [
            [
                $grid,
                0,
                [
                    1 => 0, 2 => 0, 3 => 0, 4 => 7, 5 => 0, 6 => 5, 7 => 4, 8 => 0, // box
                    9 => 3, 10 => 6, 11 => 4, 18 => 0, 19 => 0, 20 => 0, // row
                    27 => 0, 30 => 0, 33 => 0, 54 => 7, 57 => 6, 60 => 0 // column
                ]
            ],
            [
                $grid,
                40,
                [
                    36 => 8, 37 => 0, 38 => 0, 39 => 0, 41 => 0, 42 => 0, 43 => 0, 44 => 5, // box
                    30 => 0, 31 => 5, 32 => 9, 48 => 7, 49 => 1, 50 => 0, // row
                    10 => 6, 13 => 5, 16 => 0, 64 => 0, 67 => 7, 70 => 2, // column
                ]
            ]
        ];
    }
}
