<?php declare(strict_types=1);

namespace Hitch\Day2;

use Hitch\ProblemSolverInterface;

final class StringDiff implements ProblemSolverInterface
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
        $input = $this->prepareInput($this->input);

        for ($i = 0; $i < count($input); $i++) {
            for ($j = $i; $j < count($input); $j++) {

                $diff = $this->getDifferences($input[$i], $input[$j]);
                if (count($diff) === 1) {

                    unset($input[$i][array_keys($diff)[0]]);
                    return implode("", $input[$i]);
                }

            }
        }

        throw new \Exception("Input is invalid");
    }


    private function prepareInput(array $input): array
    {
        $array = [];

        foreach ($input as $string) {
            $array[] = str_split($string, 1);
        }

        return $array;
    }

    private function getDifferences($array1, $array2): array
    {
        $differences = [];
        for ($i = 0; $i < count($array1); $i++) {
            if ($array1[$i] !== $array2[$i]) {
                $differences[$i] = $array1[$i];
            }
        }
        return $differences;
    }

}