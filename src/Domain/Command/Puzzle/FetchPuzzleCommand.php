<?php

namespace App\Domain\Command\Puzzle;

use Ramsey\Uuid\UuidInterface;

/**
 * Command class to define fetching of a puzzle
 */
class FetchPuzzleCommand
{

    /**
     * @var UuidInterface
     */
    public $puzzleUuid;

    function __construct(UuidInterface $puzzleUuid)
    {
        $this->puzzleUuid = $puzzleUuid;
    }
}
