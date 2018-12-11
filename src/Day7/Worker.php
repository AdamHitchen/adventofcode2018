<?php declare(strict_types=1);

namespace Hitch\Day7;

class Worker
{
    private $timer = 0;

    /** @var Step */
    private $step;

    public function tick(): bool
    {
        $this->timer++;

        return $this->timer >= $this->step->getDuration();
    }

    public function hasStep(): bool
    {
        return !empty($this->step);
    }

    public function clearStep(): Worker
    {
        $this->timer = 0;
        $this->step->hasWorker = false;
        $this->step = null;
        return $this;
    }

    public function setStep(Step $step): Worker
    {
        $this->step = $step;
        $step->hasWorker = true;
        return $this;
    }

    public function getStep(): Step
    {
        return $this->step;
    }
}