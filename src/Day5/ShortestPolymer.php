<?php declare(strict_types=1);

namespace Hitch\Day5;

use Hitch\ProblemSolverInterface;

class ShortestPolymer implements ProblemSolverInterface
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

        $alphabet = range('a','z');
        $inputs = [];
        foreach ($alphabet as $character) {
            $inputString = str_replace($character, "", $this->input);
            $inputs[] = str_split(str_replace(strtoupper($character), "", $inputString),1);
        }

        return $inputs;
    }

    private function matchStrings(string $x, string $y): bool
    {
        return (($x === strtolower($x) && $y === strtoupper($y)) && strtoupper($x) === $y)
            || (($x === strtoupper($x) && $y === strtolower($y)) && strtolower($x) === $y);
    }

    public function solve(): string
    {
        
        $inputs = $this->prepareInput();
        $minLength = PHP_INT_MAX;
        foreach ($inputs as $input) {
            for ($i = 0; $i < count($input) - 1; $i++) {
                if ($this->matchStrings($input[$i], $input[$i + 1])) {
                    array_splice($input, $i, 2);
                    $i = $i <= 1 ? -1 : $i - 2;
                }
            }
            $minLength = count($input) < $minLength ? count($input) : $minLength;


        }
        return (string) $minLength;
    }
}