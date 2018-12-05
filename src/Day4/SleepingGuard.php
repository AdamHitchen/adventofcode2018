<?php declare(strict_types=1);

namespace Hitch\Day4;

use Hitch\ProblemSolverInterface;

class SleepingGuard implements ProblemSolverInterface
{
    /**
     * @var array
     */
    private $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function prepareInput(): array
    {
        $guards = [];
        sort($this->input);
        /** @var Guard $currentGuard */
        $currentGuard = null;

        foreach ($this->input as $input) {
            $inputArray = explode(" ", $input);

            $date = str_replace("[", "", $inputArray[0]);
            $time = str_replace("]", "", $inputArray[1]);

            if (strpos($inputArray[2], 'Guard') !== false) {
                $id = str_replace('#', "", $inputArray[3]);
                if (!array_key_exists($id, $guards)) {
                    $currentGuard = new Guard((int)$id);
                    $guards[$id] = $currentGuard;
                } else {
                    $currentGuard = $guards[$id];
                }
            } elseif (strpos($inputArray[2], 'falls') !== false) {
                $currentGuard->setAction(new Action($time, $date, 'falls'));
            } elseif (strpos($inputArray[2], 'wakes') !== false) {
                /** @var Action $sleepAction */

                $minutes = explode(":", $time)[1];
                $sleepMinutes = explode(":", $currentGuard->lastAction->time)[1];


                for ($i = (int)$sleepMinutes; $i < (int)$minutes; $i++) {
                    if (array_key_exists($i, $currentGuard->sleepTimes)) {
                        $currentGuard->sleepTimes[$i]++;
                    } else {
                        $currentGuard->sleepTimes[$i] = 1;
                    }
                }
            }
        }
        return $guards;
    }

    public function solve(): string
    {
        $guards = $this->prepareInput();

        $maxGuard = null;
        $max = 0;
        /** @var Guard $guard */
        foreach($guards as $guard) {
            $maxGuardTime = array_sum($guard->sleepTimes);
            if($maxGuardTime > $max) {
                $maxGuard = $guard;
                $max = $maxGuardTime;
            }
        }
        return (string) (array_keys($maxGuard->sleepTimes,max($maxGuard->sleepTimes))[0] * $maxGuard->id);
    }
}