<?php

namespace App\Domain\Factory;

use App\Domain\Value\Grid;
use App\Domain\Value\Cell;
use Faker\Factory as FakerFactory;

class GridFactory
{
    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }

    public static function new() {
        return new self();
    }

    /**
     * @var \Faker\Generator
     */
    protected $faker;

    public function createFromEncoding(array $encoding): Grid
    {
        return new Grid(array_map(function ($key, $cellContent) {
            return new Cell($key, $cellContent);
        }, array_keys($encoding), $encoding));
    }

    public function random(): Grid
    {
        $encoding = [];
        for ($i=0; $i < 81; $i++) {
            $candidates = [];
            for ($j = 0; $j < 9; $j++) {
                if ($this->faker->boolean()) {
                    $candidates[] = $this->faker->randomDigit;
                }
            }
            $encoding[] = $this->faker->boolean() ? $this->faker->randomDigit : array_unique($candidates);
        }
        return $this->createFromEncoding($encoding);
    }
}
