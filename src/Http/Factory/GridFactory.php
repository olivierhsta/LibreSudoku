<?php

namespace App\Http\Factory;

use App\Domain\Value\Grid;
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

    public function create(array $encoding): Grid
    {
        return new Grid($encoding);
    }

    public function random(): Grid
    {
        $encoding = [];
        for ($i=0; $i < 81; $i++) {
            $pencilMarks = [];
            for ($i = 0; $i < 9; $i++) {
                if ($this->faker->boolean()) {
                    $pencilMarks[] = $faker->unique()->randomDigit;
                }
            }
            $encoding[] = $this->faker->boolean() ? $this->faker->randomDigit : $pencilMarks;
        }
        return $this->create($encoding);
    }
}
