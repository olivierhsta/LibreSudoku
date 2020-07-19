<?php

namespace App\Domain\Value;

use App\Domain\Exception\InvalidDifficultyException;

class Difficulty
{

    const MIN_DIFFICULTY = 1;
    const MAX_DIFFICULTY = 5;

    /**
     * @var int
     */
    private $difficulty;

    function __construct(int $difficulty)
    {
        $this->assertDifficultyIsValid($difficulty);
        $this->difficulty = $difficulty;
    }

    private function assertDifficultyIsValid(int $difficulty)
    {
        if ($difficulty < self::MIN_DIFFICULTY || $difficulty > self::MAX_DIFFICULTY) {
            throw InvalidDifficultyException();
        }
    }

    public function getValue(): int
    {
        return $this->difficulty;
    }

    public static function getMin()
    {
        return self::MIN_DIFFICULTY;
    }

    public static function getMax()
    {
        return self::MAX_DIFFICULTY;
    }
}
