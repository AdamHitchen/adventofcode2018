<?php declare(strict_types=1);

namespace Hitch\Day7;

class Step
{
    public function __construct($timeModifier = 0)
    {
        $this->completed = false;
        $this->before = [];
        $this->after = [];
        $this->timeModifier = $timeModifier;
    }
    public $timeModifier = 61;

    /** @var array */
    public $after;
    /** @var array */
    public $before;
    /** @var string */
    public $id;
    /** @var bool */
    public $completed;
    /** @var bool  */
    public $hasWorker = false;

    public function existsInArray(array $array)
    {
        /** @var Step $item */
        foreach($array as $item) {
            if($item->id === $this->id) {
                return true;
            }
        }

        return false;
    }

    public function getDuration(): int
    {
        return ord(strtoupper($this->id)) - ord("A") + $this->timeModifier;
    }

    public function isAvailable():bool
    {
        $isAvailable = true;
        foreach ($this->before as $prevStep) {
            $isAvailable = $prevStep->completed === true;
            if(!$isAvailable) {
                return false;
            }
        }

        return $isAvailable;
    }

}