<?php declare(strict_types=1);

namespace Hitch\Day4;

class Action
{
    public $time;
    public $date;
    public $action;

    public function __construct($time, $date,  $action)
    {
        $this->time = $time;
        $this->date = $date;
        $this->action = $action;
    }
}