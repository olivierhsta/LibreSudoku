<?php

namespace App\Tests\Domain\Service;

use PHPUnit\Framework\TestCase;
use App\Domain\Value\Grid;
use App\Domain\Service\SolvabilityService;
use App\Domain\Factory\GridFactory;

class SolvabilityServiceTest extends TestCase
{
    /** @dataProvider gridProvider */
    public function test_is_grid_solvable(Grid $grid, bool $isSolvable)
    {
        $this->assertEquals($isSolvable, SolvabilityService::new()->isGridSolvable($grid));
    }

    public function gridProvider(): array
    {
        $gridFactory = new GridFactory();

        return [
            'Empty grid is not solvable' => [$gridFactory->createFromEncoding([
                0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
                0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
                0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
            ]), false],
            'Grid with only candidates is not solvable' => [$gridFactory->createFromEncoding([
                [1],[2],[3],[],[],[],[],[1,2,3,4],[],[],[],[4],[],[],[],[4,3,8],[],[],[],[],[],[3],[],[],[],[],[],
                [],[],[],[],[],[],[],[4,5],[],[],[],[],[],[],[],[],[],[6],[],[],[],[3,1,9],[],[],[4],[],[],
                [],[],[],[2],[],[],[],[],[],[],[],[],[],[],[],[9],[],[],[],[],[],[],[],[],[],[],[6],
            ]), false],
            'Grid with less than 17 clues (16) is not solvable' => [$gridFactory->createFromEncoding([
                1,2,3,[],[],[1,2],[],1,[],[],[],0,[],[],[],0,[],[],[],[],[],3,[],[7],[],[],[],
                [],[],[],[4,8],[],[],[],0,[],[],[2,3,4],[],[],[],[],[],[],6,[],[],[],0,2,[],4,[],[],
                [],[],[],2,[],[9,4,2],[],[],[],[],[],[],[],[],[],9,[],[],[],[],[],[],1,[],[],[],6,
            ]), false],
            'Grid with 17 clues is solvable' => [$gridFactory->createFromEncoding([
                1,2,3,[],[],[],[],1,[],[],[],0,[],[],[],0,[],[],[],[],[],3,[],[],[],[],[],
                [],[],3,[],[],[],[],0,[],[],[],[],[],[],[],[],[],6,[],[],[],0,2,[],4,[],[],
                [],[],[],2,[],[],[],[],[],[],[],[],[],[],[],9,[],[],[],[],[],[],1,[],[],[],6,
            ]), false],
            'One choice solvable grid is solvable' => [$gridFactory->createFromEncoding([
                2,0,0,0,7,0,5,4,0,3,6,4,0,5,0,0,0,0,0,0,0,0,0,6,0,0,3,
                0,0,7,0,5,9,0,0,1,8,0,0,0,0,0,0,0,5,3,0,0,7,1,0,9,0,0,
                7,0,0,6,0,0,0,0,0,0,0,0,0,7,0,6,2,1,0,2,8,0,5,0,0,0,7,
            ]), true]
        ];
    }
}
