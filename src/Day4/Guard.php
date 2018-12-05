<?php declare(strict_types=1);

namespace Hitch\Day4;

class Guard
{
    public $id;
    public $lastAction;
    public $sleepTimes;

    public function __construct(int $id)
    {
        $this->lastAction = null;
        $this->id = $id;
        $this->sleepTimes = [];
    }

    public function setAction(Action $action)
    {
        $this->lastAction = $action;
    }

}