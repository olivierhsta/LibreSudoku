<?php

namespace Tests\Domain\Value;

use App\Domain\Value\Cell;
use PHPUnit\Framework\TestCase;
use App\Domain\Value\Grid;
use App\Domain\Factory\GridFactory;

class GridTest extends TestCase
{
    /** @dataProvider gridEncodingProvider */
    public function test_get_encoding(Grid $grid, array $expectedEncoding, bool $withCandidates, bool $withEmpties)
    {
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

    /** @dataProvider cellAttributeProvider */
    public function test_cell_attributes(Grid $grid, int $cellKey, int $value, int $box, int $row, int $column, array $expectedBuddies)
    {
        $this->assertEquals($grid->getCell($cellKey)->getValue(), $value);
        $this->assertEquals($grid->getCell($cellKey)->box(), $box);
        $this->assertEquals($grid->getCell($cellKey)->row(), $row);
        $this->assertEquals($grid->getCell($cellKey)->column(), $column);

        $actualBuddies = $grid->getBuddiesOf($grid->getCell($cellKey));
        $this->assertEquals(count($expectedBuddies), count($actualBuddies));
        foreach ($actualBuddies as $buddy) {
            $this->assertContains($buddy->key(), array_keys($expectedBuddies));
            $this->assertContains($buddy->getValue(), array_values($expectedBuddies));
        }
    }

    public function cellAttributeProvider(): array
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
                2, // value
                0, // box
                0, // row
                0, // col
                [
                    1 => 0, 2 => 0, 3 => 0, 4 => 7, 5 => 0, 6 => 5, 7 => 4, 8 => 0, // box
                    9 => 3, 10 => 6, 11 => 4, 18 => 0, 19 => 0, 20 => 0, // row
                    27 => 0, 30 => 0, 33 => 0, 54 => 7, 57 => 6, 60 => 0 // column
                ]
            ],
            [
                $grid,
                40,
                0, // value
                4, // box
                4, // row
                4, // col
                [
                    36 => 8, 37 => 0, 38 => 0, 39 => 0, 41 => 0, 42 => 0, 43 => 0, 44 => 5, // box
                    30 => 0, 31 => 5, 32 => 9, 48 => 7, 49 => 1, 50 => 0, // row
                    10 => 6, 13 => 5, 16 => 0, 64 => 0, 67 => 7, 70 => 2, // column
                ]
            ],
            [
                $grid,
                74,
                8, // value
                8, // box
                6, // row
                8, // col
                [
                    72 => 0, 73 => 2, 75 => 0, 76 => 5, 77 => 0, 78 => 0, 79 => 0, 80 => 7, // box
                    54 => 7, 55 => 0, 56 => 0, 63 => 0, 64 => 0, 65 => 0, // row
                    20 => 0, 23 => 6, 26 => 3, 47 => 0, 50 => 0, 53 => 0, // column
                ]
            ]
        ];
    }

    public function test_set_cell()
    {
        $grid = GridFactory::new()->createFromEncoding([
            [1,3,9],[2],[3],[],8,[],[],[1,2,3,4],[],[],[],[4],[],[],0,[4,3,8],[],[],[],0,[],[3],[],[],[],1,[],
            [],[],[],[],[],0,[],[4,5],[],[],[],[],4,[],[],[],[],[6],[],[],[],[3,1,9],[],[],[4],[],[],
            9,[],[],[2],[],[],[],[],[],[],0,[],[],[],[],[9],[],0,[],[],[],0,[],[],0,[],[6],
        ]);

        $updatedGrid = $grid->setCell(new Cell(0, 9));

        $this->assertEquals($grid->getCell(0)->getCandidates(), [1,3,9]);
        $this->assertEquals($updatedGrid->getCell(0)->getValue(), 9);
    }
}
