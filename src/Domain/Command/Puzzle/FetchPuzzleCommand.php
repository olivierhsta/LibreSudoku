<?php

namespace App\Domain\Command\Puzzle;

use Ramsey\Uuid\UuidInterface;
use App\Domain\Command\Command;

/**
 * @method UuidInterface puzzleUuid()
 */
class FetchPuzzleCommand extends Command
{
    /**
     * @var UuidInterface
     */
    protected $puzzleUuid;

    function __construct(UuidInterface $puzzleUuid)
    {
        $this->puzzleUuid = $puzzleUuid;
    }
}
