<?php declare(strict_types=1);

namespace Hitch\Day1;

use Hitch\ProblemSolverInterface;

final class FrequencyCalibrator implements ProblemSolverInterface
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
        $frequency = $this->startingFrequency;
        //Include the starting frequency
        $frequencies = [$frequency];

        while (true) {
            foreach ($this->input as $value) {
                $frequency += (int)$value;

                if(in_array($frequency, $frequencies)) {
                    return (string)$frequency;
                }
                $frequencies[]= $frequency;
            }
        }

        throw new \Exception();
    }
}