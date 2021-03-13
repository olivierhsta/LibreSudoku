<?php

namespace App\Domain\Entity;

class Solution
{
    /**
     * @var array
     */
    private $steps;

    /**
     * @var bool
     */
    private $completed;

    protected function __construct(
        array $steps = [],
        bool $completed = false
    ) {
        $this->steps = $steps;
        $this->completed = $completed;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function addStep(SolutionStep $step): self
    {
        $this->steps[] = $step->setSolution($this);

        return $this;
    }

    public function getSteps(): array
    {
        return $this->steps;
    }
}