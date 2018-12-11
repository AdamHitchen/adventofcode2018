<?php declare(strict_types=1);

namespace Hitch\Day7;

use Hitch\ProblemSolverInterface;

class InstructionsParser implements ProblemSolverInterface
{

    private $input;

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        $this->input = $input;
    }

    private function prepareInput(array $input)
    {
        $steps = [];
        $stepNames = [];
        foreach ($input as $item) {
            $arr = explode(" ", $item);
            $steps[] = [$arr[1], $arr[7]];
            if (!array_key_exists($arr[1], $stepNames)) {
                $stepNames[$arr[1]] = new Step();
                $stepNames[$arr[1]]->id = $arr[1];
            }
            if (!array_key_exists($arr[7], $stepNames)) {
                $stepNames[$arr[7]] = new Step();
                $stepNames[$arr[7]]->id = $arr[7];
            }
        }
        /**
         * @var  $key
         * @var Step $stepName
         */
        foreach ($stepNames as $key => $stepName) {
            foreach ($steps as $step) {
                if ($step[1] == $key) {
                    $stepName->before[] = $stepNames[$step[0]];
                    $stepNames[$step[0]]->after[] = $stepNames[$key];
                }
            }
        }
        return $stepNames;

    }

    private function getFirstSteps(array $steps): array
    {
        $arr = [];

        /** @var Step $step */
        foreach ($steps as $step) {
            if (empty($step->before)) {
                $arr[]= $step;
            }
        }
        return $arr;
    }

    private function sortStepArray(array &$array)
    {
        usort($array, function (Step $step1, Step $step2) {
            return $step1->id <=> $step2->id;
        });
        return $array;
    }


    public function recursiveStepFind(Step $step, &$availableSteps, &$solution)
    {
        if($step->isAvailable() && !$step->completed && !$step->existsInArray($availableSteps) && !$step->existsInArray($solution)) {
            $availableSteps[$step->id]=$step;
            return $step;
        }
        if($step->completed) {
            foreach($step->after as $next) {
                $this->recursiveStepFind($next, $availableSteps, $solution);
            }
        } else {
            if($step->isAvailable()) {
                $availableSteps[]= $step;
            }
        }

        return $availableSteps;
    }

    public function findNextStep(array $firstStep, &$solution)
    {
        $availableSteps = [];
        foreach($firstStep as $fstep) {
            $this->recursiveStepFind($fstep, $availableSteps, $solution);
        }

        $this->sortStepArray($availableSteps);

        return $availableSteps[0];
    }

    public function solve(): string
    {
        $steps = $this->prepareInput($this->input);
        $first = $this->getFirstSteps($steps);
        $solution = [];
        $this->sortStepArray($first);
        $solution[]= $first[0];
        $first[0]->completed = true;

        while(count($solution) < count($steps)) {
            $next = $this->findNextStep($first, $solution);
            if(!empty($next)) {
                $next->completed = true;
                $solution[]= $next;
            }
        }
        $output = "";
        foreach($solution as $step) {
            $output.=$step->id;
        }

        return $output;
    }

}