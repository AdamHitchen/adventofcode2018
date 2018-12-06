<?php declare(strict_types=1);

namespace Hitch\Day6;

class Point
{
    public $x;
    public $y;
    /** @var array */
    public $coordinates;

    /**
     * Point constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->coordinates = [];
    }

    public static function fromArray(array $arr) {
        return new Point((int) $arr[0], (int) $arr[1]);
    }
}