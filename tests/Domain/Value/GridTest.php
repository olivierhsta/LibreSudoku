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
}
