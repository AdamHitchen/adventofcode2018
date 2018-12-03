<?php declare(strict_types=1);

namespace Hitch\Day3;

class Claim
{
    /** @var int */
    public $id;
    /** @var int */
    public $x;
    /** @var int */
    public $y;
    /** @var int */
    public $width;
    /** @var int */
    public $height;
    /** @var bool */
    public $excluded;


    public function contains(int $x, int $y): bool
    {
        return ($x >= $this->x
            && $y >= $this->y
            && $x <= $this->x + $this->width
            && $y <= $this->y + $this->height);
    }
}