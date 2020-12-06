<?php

namespace App\Tests\Domain\Value;

use PHPUnit\Framework\TestCase;
use App\Domain\Value\Grid;

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
        $emptyEncoding = [
            0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
            0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
            0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
        ];
        return [
            [new Grid($emptyEncoding), $emptyEncoding, true, true   ,],
            [new Grid($emptyEncoding), $emptyEncoding, false, true,],
            [
                new Grid([
                    [1],[2],[3],[],[],[],[],[1,2,3,4],[],[],[],[4],[],[],[],[4,3,8],[],[],[],[],[],[3],[],[],[],[],[],
                    [],[],[],[],[],[],[],[4,5],[],[],[],[],[],[],[],[],[],[6],[],[],[],[3,1,9],[],[],[4],[],[],
                    [],[],[],[2],[],[],[],[],[],[],[],[],[],[],[],[9],[],[],[],[],[],[],[],[],[],[],[6],
                ]),
                [
                    [1],[2],[3],[],[],[],[],[1,2,3,4],[],[],[],[4],[],[],[],[4,3,8],[],[],[],[],[],[3],[],[],[],[],[],
                    [],[],[],[],[],[],[],[4,5],[],[],[],[],[],[],[],[],[],[6],[],[],[],[3,1,9],[],[],[4],[],[],
                    [],[],[],[2],[],[],[],[],[],[],[],[],[],[],[],[9],[],[],[],[],[],[],[],[],[],[],[6],
                ],
                true,
                true,
            ],
        ];
    }
}
