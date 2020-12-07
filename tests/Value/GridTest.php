<?php

namespace App\Tests\Domain\Value;

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
        $emptyEncoding = [
            0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
            0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
            0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
        ];
        return [
            [$gridFactory->createFromEncoding($emptyEncoding), $emptyEncoding, true, true,],
            [$gridFactory->createFromEncoding($emptyEncoding), $emptyEncoding, false, true,],
            [
                $gridFactory->createFromEncoding([
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
