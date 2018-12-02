<?php declare(strict_types=1);

namespace Hitch\Day1;

use Hitch\ProblemSolverInterface;

final class FrequencyCalculator implements ProblemSolverInterface
{

    /**
     * @var array
     */
    private $input;
    /**
     * @var int
     */
    private $startingFrequency;

    public function __construct(array $input, int $startingFrequency)
    {
        $this->input = $input;
        $this->startingFrequency = $startingFrequency;
    }

    public function solve(): string
    {
        return (string)(array_sum($this->input) + $this->startingFrequency);
    }
}