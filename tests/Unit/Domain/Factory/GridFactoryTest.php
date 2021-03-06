<?php

namespace Tests\Unit\Domain\Factory;

use PHPUnit\Framework\TestCase;
use App\Domain\Exception\InvalidPuzzleEncodingException;
use App\Domain\Factory\GridFactory;

class GridFactoryTest extends TestCase
{
    /** @dataProvider gridFactoryProvider */
    public function test_create(array $encoding, bool $exceptionIsExpected)
    {
        if ($exceptionIsExpected) {
            $this->expectException(InvalidPuzzleEncodingException::class);
        }

        $grid = GridFactory::new()->createFromEncoding($encoding);

        $this->assertEquals($grid->getEncoding(), $encoding);
    }

    public function gridFactoryProvider()
    {
        return [
            [
                [[9,2,4,7],2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9],
                false
            ],
            [
                [1,0,3,[9,2,4,7],0,6,7,8,0,1,2,[3],0,5,6,7,8,9,1,2,3,4,5,[6],0,8,9,1,2,3,4,5,[6],0,8,9,1,2,3,4,0,6,7,8,9,1,2,3,4,[5,1,9],6,0,8,9,0,2,3,[7,2,4],0,6,7,8,9,1,2,0,4,5,6,7,8,[1,2,3,9],1,2,3,4,5,0,7,8,9],
                false
            ],
            [
                [11,0,3,[9,2,4,7],0,6,7,8,0,1,2,[3],0,5,6,7,8,9,1,2,3,4,5,[6],0,8,9,1,2,3,4,5,[6],0,8,9,1,2,3,4,0,6,7,8,9,1,2,3,4,[5,1,9],6,0,8,9,0,2,3,[7,2,4],0,6,7,8,9,1,2,0,4,5,6,7,8,[1,2,3,9],1,2,3,4,5,0,7,8,9],
                true
            ],
            [
                [1,0,3,[9,2,4,7],0,6,7,8,0,1,2],
                true
            ],
            [
                [[1,2,3,4,5,6,7,8,9,10],0,3,[9,2,4,7],0,6,7,8,0,1,2,[3],0,5,6,7,8,9,1,2,3,4,5,[6],0,8,9,1,2,3,4,5,[6],0,8,9,1,2,3,4,0,6,7,8,9,1,2,3,4,[5,1,9],6,0,8,9,0,2,3,[7,2,4],0,6,7,8,9,1,2,0,4,5,6,7,8,[1,2,3,9],1,2,3,4,5,0,7,8,9],
                true
            ],
            [
                [[1,1],0,3,[9,2,4,7],0,6,7,8,0,1,2,[3],0,5,6,7,8,9,1,2,3,4,5,[6],0,8,9,1,2,3,4,5,[6],0,8,9,1,2,3,4,0,6,7,8,9,1,2,3,4,[5,1,9],6,0,8,9,0,2,3,[7,2,4],0,6,7,8,9,1,2,0,4,5,6,7,8,[1,2,3,9],1,2,3,4,5,0,7,8,9],
                true
            ],
        ];
    }
}
