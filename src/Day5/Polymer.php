<?php declare(strict_types=1);

namespace Hitch\Day5;

use Hitch\ProblemSolverInterface;

class Polymer implements ProblemSolverInterface
{
    /**
     * @var string
     */
    private $input;

    public function __construct(string $input)
    {
        $this->input = $input;
    }

    private function prepareInput()
    {
        return str_split($this->input,1);
    }

    private function matchStrings(string $x, string $y): bool
    {
        return (($x === strtolower($x) && $y === strtoupper($y)) && strtoupper($x) === $y)
            || (($x === strtoupper($x) && $y === strtolower($y)) && strtolower($x) === $y);
    }

    public function solve(): string
    {
        $input = $this->prepareInput();
        for($i = 0; $i < count($input) - 1; $i++) {
            if($this->matchStrings($input[$i], $input[$i+1])) {
                array_splice($input,$i,2);
                $i = $i <= 1 ? -1 : $i - 2;
            }
        }
        return (string) count($input);
    }
}