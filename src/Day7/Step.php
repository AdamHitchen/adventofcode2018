<?php declare(strict_types=1);

namespace Hitch\Day7;

class Step
{
    public function __construct()
    {
        $this->completed = false;
        $this->before = [];
        $this->after = [];
    }

    /** @var array */
    public $after;
    /** @var array */
    public $before;
    /** @var string */
    public $id;
    /** @var bool */
    public $completed;

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