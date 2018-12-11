<?php declare(strict_types=1);

namespace Hitch\Day7;

use Hitch\ProblemSolverInterface;

class WorkerInstructions implements ProblemSolverInterface
{

    private $input;
    private $timer;
    /**
     * @var int
     */
    private $workerCount;

    /**
     * @param array $input
     * @param int $timer
     * @param int $workerCount
     */
    public function __construct(array $input, int $timer, int $workerCount)
    {
        $this->input = $input;
        $this->timer = $timer;
        $this->workerCount = $workerCount;
    }

    private function prepareInput(array $input)
    {
        $steps = [];
        $stepNames = [];
        foreach ($input as $item) {
            $arr = explode(" ", $item);
            $steps[] = [$arr[1], $arr[7]];
            if (!array_key_exists($arr[1], $stepNames)) {
                $stepNames[$arr[1]] = new Step($this->timer);
                $stepNames[$arr[1]]->id = $arr[1];
            }
            if (!array_key_exists($arr[7], $stepNames)) {
                $stepNames[$arr[7]] = new Step($this->timer);
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
        if($step->isAvailable() && !$step->hasWorker  && !$step->completed && !$step->existsInArray($availableSteps) && !$step->existsInArray($solution)) {
            $availableSteps[$step->id]=$step;
            return $step;
        }
        if($step->completed) {
            foreach($step->after as $next) {
                $this->recursiveStepFind($next, $availableSteps, $solution);
            }
        } else {
            if($step->isAvailable() && !$step->hasWorker && !$step->existsInArray($availableSteps)) {
                $availableSteps[]= $step;
            }
        }

        return $availableSteps;
    }

    public function findNextSteps(array $firstStep, &$solution)
    {
        $availableSteps = [];
        foreach($firstStep as $fstep) {
            $this->recursiveStepFind($fstep, $availableSteps, $solution);
        }

        $this->sortStepArray($availableSteps);

        return $availableSteps;
    }

    private function getSlackingWorkers(array $workers): array
    {
        $array = [];
        /** @var Worker $worker */
        foreach($workers as $worker) {
            if(!$worker->hasStep()) {
                $array[]=$worker;
            }
        }
        return $array;
    }

    private function assignSteps(array $workers, $available)
    {
        $debug = [];
        foreach($available as $av) {
            $debug[]=$av->id;
        }
        /**
         * @var Step $step
         * @var Worker $worker
         */
        foreach($available as $step) {
            foreach($workers as $worker) {
                if(!$worker->hasStep()) {
                    $worker->setStep($step);
                    break;
                }
            }
        }
    }

    public function solve(): string
    {
        $steps = $this->prepareInput($this->input);
        $first = $this->getFirstSteps($steps);
        $this->sortStepArray($first);
        $solution = [];
        $workers = [];

        for($i = 0; $i < $this->workerCount; $i++) {
            $workers[]=new Worker();
        }

        $timer = 0;
        $this->assignSteps($workers, $first);
        while(count($solution) < count($steps)) {
            $timer++;
            /** @var Worker $worker */
            foreach($workers as $worker) {
                if(!$worker->hasStep()) {
                    continue;
                }

                if($worker->tick()) {
                    $worker->getStep()->completed = true;
                    $solution[]=$worker->getStep();
                    $worker->clearStep();
                }
            }

            $slackingWorkers = $this->getSlackingWorkers($workers);

            $availableSteps = $this->findNextSteps($first, $solution);

            $this->assignSteps($slackingWorkers, $availableSteps);
        }
        $output = "";
        foreach($solution as $step) {
            $output.=$step->id;
        }

        return (string) $timer;
    }

}