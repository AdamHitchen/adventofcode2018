<?php declare(strict_types=1);

namespace Hitch\Day2;

use Hitch\ProblemSolverInterface;

final class Checksum implements ProblemSolverInterface
{

    /**
     * @var array
     */
    private $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function solve(): string
    {
        $twoCount = 0;
        $threeCount = 0;

        foreach ($this->input as $value) {

            $stringArray = str_split($value, 1);
            $counts = array_count_values($stringArray);
            $hasTwo = false;
            $hasThree = false;

            foreach ($stringArray as $str) {
                if ($counts[$str] === 2) {
                    $hasTwo = true;
                } else if ($counts[$str] === 3) {
                    $hasThree = true;
                }
                if ($hasTwo && $hasThree) {
                    break;
                }
            }

            if ($hasTwo) {
                $twoCount++;
            }
            if ($hasThree) {
                $threeCount++;
            }
        }

        return (string)($twoCount * $threeCount);
    }

}